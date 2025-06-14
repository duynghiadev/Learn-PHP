<?php

namespace tests\Feature;

use App\Models\Destination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DestinationTest extends TestCase
{
    /*
    public function test_index_requires_authentication()
    {
     $this->get('/destinations')->assertRedirect('login');
    }
    */

    public function test_index()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $response = $this->get('/destinations');
        $response->assertStatus(200);
    }

    /*
    public function testShowRequiresAuthentication()
    {
        $this->get('/employees/1')->assertRedirect('/login');
    }
    */

    public function test_show()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $destionation = Destination::factory()->create();

        $response = $this->get('/destinations' . '/' . $destionation->id);
        $response->assertStatus(200);
    }

    public function test_update()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $destination = Destination::factory()->create();
        $destination2 = Destination::factory()->create();

        $response = $this->put('/destinations' . '/' . $destination->id, []);
        $response->assertStatus(200);
        $this->assertDatabaseHas('destinations', [
            'id' => $destination2->id,
            'city' => $destination2->city
        ]);
    }

    public function test_store()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $destination = Destination::factory()->create();
    
        $this->post('/destinations', [])
            ->assertStatus(201);

        $this->assertDatabaseHas('destinations', [
            'id' => $destination->id,
            'city' => $destination->city
        ]);
    }

    public function test_destroy()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $destination = Destination::factory()->create();
        $this->delete('/destinations'.'/'.$destination->id)
        ->assertStatus(204);
        $this->assertDatabaseMissing('destinations', [
            'id' => $destination->id
        ]);
    }

}
