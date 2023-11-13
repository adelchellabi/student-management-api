<?php

namespace Tests\Feature\App\Console\Commands;

use App\Console\Commands\DeleteUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_deletes_user_successfully()
    {
        $user = $this->prepareUser();
        $command = $this->prepareCommand($user->email);

        $result = $command->run();

        $this->assertEquals(DeleteUser::SUCCESS, $result);

        $this->assertDatabaseMissing('users', ['email' => $user->email]);
    }

    /** @test */
    public function it_fails_to_delete_nonexistent_user()
    {
        $nonExistentEmail = $this->faker->email;
        $command = $this->prepareCommand($nonExistentEmail);

        $result = $command->run();

        $this->assertEquals(DeleteUser::FAILURE, $result);
    }

    private function prepareUser()
    {
        $user = User::factory(1)->create()->first();
        $user->createToken('test token');

        return $user;
    }

    private function prepareCommand($email)
    {
        return $this->artisan('user:delete', [
            'email' => $email,
        ]);
    }
}
