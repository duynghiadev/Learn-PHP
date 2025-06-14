<?php

namespace tests\Feature;

use App\Models\Backlog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class BacklogTest extends TestCase
{

    public function test_index()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $this->get('/backlogs')
            ->assertStatus(200);
    }

    public function test_show()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $backlog = Backlog::factory()->create();

        $this->get('/backlogs' . '/' . $backlog->id)
            ->assertStatus(200);
    }

    public function test_update()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $backlog = Backlog::factory()->create();

        $this->put('/backlogs' . '/' . $backlog->id, [])
            ->assertStatus(200);
    }

    public function test_store()
    {
        $user = User::factory()->create();
        Auth::login($user);

        // $backlog = Backlog::factory()->create();

        $this->post('/backlogs', [])
            ->assertStatus(201);
    }

    public function test_destroy()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $backlog = Backlog::factory()->create();
        $this->delete('/backlogs' . '/' . $backlog->id)
            ->assertStatus(204);
    }
}
