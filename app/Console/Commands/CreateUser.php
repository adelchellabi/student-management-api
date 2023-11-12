<?php

namespace App\Console\Commands;

use App\DTOs\UserData;
use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {username?} {email?} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new system user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $userData = $this->getUserData();
            $user = $this->createUser($userData);
            $token = $this->createUserToken($user);

            $this->info("User created successfully! Token: {$token}");

            return Command::SUCCESS;
        } catch (ValidationException $e) {
            $this->error("Validation failed: {$e->getMessage()}");

            return Command::FAILURE;
        } catch (Exception $e) {
            $this->error("Error: {$e->getMessage()}");

            return Command::FAILURE;
        }
    }

    protected function getUserData(): UserData
    {
        $username = $this->argumentOrPrompt('username', 'Enter username');
        $email = $this->argumentOrPrompt('email', 'Enter email');
        $password = $this->optionOrPrompt('password', 'Enter password');

        return new UserData($username, $email, $password);
    }

    protected function argumentOrPrompt($argumentName, $prompt)
    {
        $value = $this->argument($argumentName);
        if (! $value) {
            $value = $this->ask($prompt);
        }

        return $value;
    }

    protected function optionOrPrompt($optionName, $prompt)
    {
        $value = $this->option($optionName);
        if (! $value) {
            $value = $this->secret($prompt);
        }

        return $value;
    }

    protected function createUser(UserData $userData): User
    {
        $this->validateUserData($userData);
        $this->ensureUniqueEmail($userData->getEmail());

        return $this->performUserCreation($userData);
    }

    protected function validateUserData(UserData $userData)
    {
        if (empty($userData->getUsername())) {
            throw ValidationException::withMessages(['username' => 'Username cannot be empty.']);
        }

        if (empty($userData->getEmail()) || ! filter_var($userData->getEmail(), FILTER_VALIDATE_EMAIL)) {
            throw ValidationException::withMessages(['email' => 'Enter a valid email address.']);
        }

        if (empty($userData->getPassword())) {
            throw ValidationException::withMessages(['password' => 'Password cannot be empty.']);
        }
    }

    protected function ensureUniqueEmail(string $email)
    {
        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            throw ValidationException::withMessages(['email' => 'User with this email already exists.']);
        }
    }

    protected function performUserCreation(UserData $userData): User
    {
        return User::create([
            'name' => $userData->getUsername(),
            'email' => $userData->getEmail(),
            'password' => Hash::make($userData->getPassword()),
        ]);
    }

    protected function createUserToken(User $user)
    {
        return $user->createToken('API Token')->plainTextToken;
    }
}
