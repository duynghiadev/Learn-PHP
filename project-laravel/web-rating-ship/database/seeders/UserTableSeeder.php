<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::checkIssetBeforeCreate([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '0961130648',
            'password' => Hash::make('123456'),
            'address'=> 'Ha Noi',
            'status' => User::STATUS['ACTIVE']
        ]);
    }

    public function checkIssetBeforeCreate($data) {
        $admin = User::where('email', $data['email'])->first();
        if (empty($admin)) {;
            User::create($data);
        } else {
            $admin->update($data);
        }
    }
}
