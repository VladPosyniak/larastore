<?php

use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currency')->insert([
            'name' => 'RUB',
            'coefficient' => 63.87,
            'prefix' => 'руб.',
        ]);

        DB::table('currency')->insert([
            'name' => 'UAH',
            'coefficient' => 26.1,
            'prefix' => 'грн.',
        ]);

        DB::table('currency')->insert([
            'name' => 'USD',
            'coefficient' => 1,
            'prefix' => '$',
        ]);
    }
}
