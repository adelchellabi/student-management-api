<?php

namespace App\Console\Commands;

use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Validation\ValidationException;

class DeleteUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete {email : The email of the user to be deleted}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a system user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $email = $this->argument('email');
            $this->validateEmail($email);

            $user = $this->findUserByEmail($email);
            $this->deleteUser($user);

            return Command::SUCCESS;

        } catch (Exception $e) {
            $this->error($e->getMessage());

            return Command::FAILURE;
        }

    }

    protected function validateEmail($email)
    {
        if (empty($email) || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw ValidationException::withMessages(['email' => 'Enter a valid email address.']);
        }
    }

    protected function findUserByEmail($email)
    {
        $user = User::where('email', $email)->first();

        if (! $user) {
            throw new Exception("No user found for email: {$email}");
        }

        return $user;
    }

    protected function deleteUser($user)
    {
        if ($user->tokens()->delete() && $user->delete()) {
            $this->info('User deleted successfully');

            return;
        }

        throw new Exception('User was not deleted');
    }
}
