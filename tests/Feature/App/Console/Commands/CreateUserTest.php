<?php

namespace Tests\Feature\App\Console\Commands;

use App\Console\Commands\CreateUser;
use App\DTOs\UserData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_creates_user_successfully()
    {
        $userData = $this->getUserData();
        $command = $this->prepareCommand($userData);

        $command->run();

        $command->assertExitCode(CreateUser::SUCCESS);
        $this->assertDatabaseHas('users', ['email' => $userData->getEmail()]);
    }

    /** @test */
    public function it_fails_to_create_user_with_existing_email()
    {
        $userData = $this->getUserData();
        $command = $this->prepareCommand($userData);

        $result1 = $command->run();
        $result2 = $command->run();

        $this->assertEquals(CreateUser::SUCCESS, $result1);
        $this->assertEquals(CreateUser::FAILURE, $result2);
    }

    private function prepareCommand(UserData $userData)
    {
        return $this->artisan('user:create', [
            'username' => $userData->getUsername(),
            'email' => $userData->getEmail(),
            '--password' => $userData->getPassword(),
        ]);
    }

    private function getUserData()
    {
        $username = $this->faker->username;
        $email = $this->faker->email;
        $password = $this->faker->password;

        return new UserData($username, $email, $password);
    }
}
