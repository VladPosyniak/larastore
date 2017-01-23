<?php

use Illuminate\Database\Seeder;

class ParametersValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parameters_values')->insert(
            [
                'items_id' => 1,
                'parameters_id' => 2,
                'language_id' => 1,
                'value' => 20
            ]);
        DB::table('parameters_values')->insert(
            [
                'items_id' => 1,
                'parameters_id' => 2,
                'language_id' => 2,
                'value' => 20
            ]);
        DB::table('parameters_values')->insert(
            [
                'items_id' => 1,
                'parameters_id' => 2,
                'language_id' => 3,
                'value' => 20
            ]);

        DB::table('parameters_values')->insert(
            [
                'items_id' => 2,
                'parameters_id' => 2,
                'language_id' => 1,
                'value' => 30
            ]);
        DB::table('parameters_values')->insert(
            [
                'items_id' => 2,
                'parameters_id' => 2,
                'language_id' => 2,
                'value' => 30
            ]);
        DB::table('parameters_values')->insert(
            [
                'items_id' => 2,
                'parameters_id' => 2,
                'language_id' => 3,
                'value' => 30
            ]);
    }
}
