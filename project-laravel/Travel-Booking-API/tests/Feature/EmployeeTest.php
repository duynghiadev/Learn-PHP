<?php

namespace tests\Feature;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class EmployeeTest extends TestCase
{

    public function test_index()
    {
        $user = User::factory()->create();
        Auth::login($user);
        $this->get('/employees')
            ->assertStatus(200);
    }

    public function test_show()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $employee = Employee::factory()->create();

        $this->get('/employees' . '/' . $employee->id)
            ->assertStatus(200);
    }

    public function test_update()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $employee = Employee::factory()->create();

        $this->put('/employees' . '/' . $employee->id, [])
            ->assertStatus(200);
    }

    public function test_store()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $this->post('/employees', [])
            ->assertStatus(201);
    }

    public function test_destroy()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $employee = Employee::factory()->create();
        $this->delete('/employees' . '/' . $employee->id)
            ->assertStatus(204);
    }

}