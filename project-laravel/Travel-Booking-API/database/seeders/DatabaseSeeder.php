<?php

namespace Database\Seeders;

use App\Models\Backlog;
use App\Models\Destination;
use App\Models\Employee;
use App\Models\Package;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(50)->create();
        Destination::factory(50)->create();
        Employee::factory(50)->create();
        Package::factory(100)->create();
        Backlog::factory(100)->create();

        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
    }
}
