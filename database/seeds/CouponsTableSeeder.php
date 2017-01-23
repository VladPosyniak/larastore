<?php

use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert(
            [
                'discount' => 20,
                'user_id' => 1,
                'expiration_date' => '2018-01-17 20:31:00'
            ]
        );
    }
}
