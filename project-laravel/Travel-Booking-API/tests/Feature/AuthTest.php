<?php

namespace test\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_register()
    {
        $user = User::where('email', 'test@test.com')->first();
        if ($user) {
            $user->delete();
        }
        $data = [
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => 'test'

        ];
        $this->post('/register', $data)
            ->assertStatus(200);
    }

    public function test_login()
    {
        $data = [
            'email' => 'test@test.com',
            'password' => 'test'

        ];
        $this->post('/login', $data)
            ->assertStatus(200);
    }

    public function test_logout()
    {
        $data = [
            'email' => 'test@test.com',
            'password' => 'test'

        ];
        $this->post('/login', $data);
        $this->post('/logout', $data)
            ->assertOk();
    }
}
