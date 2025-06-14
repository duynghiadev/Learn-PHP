<?php

namespace tests\Feature;

use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PackageTest extends TestCase
{
    public function test_index()
    {
        $user = User::factory()->create();
        Auth::login($user);
        $this->get('/packages')
            ->assertStatus(200);
    }

    public function test_show()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $package = Package::factory()->create();

        $this->get('/packages' . '/' . $package->id)
            ->assertStatus(200);
    }

    public function test_update()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $package = Package::factory()->create();

        $this->put('/packages' . '/' . $package->id, [])
            ->assertStatus(200);
    }

    public function test_store()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $this->post('/packages', [])
            ->assertStatus(201);
    }

    public function test_destroy()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $package = Package::factory()->create();
        $this->delete('/packages' . '/' . $package->id)
            ->assertStatus(204);
    }

}
