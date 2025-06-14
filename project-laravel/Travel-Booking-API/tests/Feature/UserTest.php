<?php

namespace tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_index()
    {
        $user = User::factory()->create();
        Auth::login($user);
        $this->get('/users')
            ->assertStatus(200);
    }

    public function test_show()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $user = User::factory()->create();

        $this->get('/users' . '/' . $user->id)
            ->assertStatus(200);
    }

    public function test_update()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $user = User::factory()->create();

        $this->put('/users' . '/' . $user->id, [])
            ->assertStatus(200);
    }

    public function test_store()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $this->post('/users', [])
            ->assertStatus(201);
    }

    public function test_destroy()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $user = User::factory()->create();
        $this->delete('/users' . '/' . $user->id)
            ->assertStatus(204);
    }


}