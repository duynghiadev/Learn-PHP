<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::checkIssetBeforeCreate([
            'name' => 'Nguyễn Thị Hạnh',
            'email' => 'hanh@gmail.com',
            'phone' => '0961136648',
            'password' => Hash::make('123456'),
            'address'=> 'Số 23, Trâu Quỳ - Gia Lâm - Hà Nội',
            'gender'=> Customer::GENDER_FEMALE,
            'status' => Customer::STATUS['ACTIVE']
        ]);
    }

    public function checkIssetBeforeCreate($data) {
        $admin = Customer::where('email', $data['email'])->first();
        if (empty($admin)) {;
            Customer::create($data);
        } else {
            $admin->update($data);
        }
    }
}
