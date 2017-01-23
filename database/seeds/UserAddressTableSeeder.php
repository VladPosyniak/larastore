<?php

use Illuminate\Database\Seeder;

class UserAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_address')->insert(
            [
                'address_name' => 'Main address',
                'user_id' => 1,
                'city' => 'Kiev',
                'address' => 'Vasila Kasiana 3b',
                'country' => 'Ukraine',
                'postal_code' => '515125',
                'company' => 'Majento',
                'comment' => 'The first house on the street'
            ]
        );
    }
}
