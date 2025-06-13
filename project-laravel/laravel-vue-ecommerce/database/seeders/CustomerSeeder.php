<?php

namespace Database\Seeders;

use App\Enums\CustomerStatus;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $customers = [
      [
        'user_id' => 4,
        'first_name' => 'John',
        'last_name' => 'Doe',
        'phone' => '123-456-7890',
        'status' => CustomerStatus::Active->value,
      ],
      [
        'user_id' => 5,
        'first_name' => 'Jane',
        'last_name' => 'Smith',
        'phone' => '987-654-3210',
        'status' => CustomerStatus::Active->value,
      ],
    ];

    foreach ($customers as $customer) {
      Customer::updateOrCreate(
        ['user_id' => $customer['user_id']],
        $customer
      );
    }
  }
}
