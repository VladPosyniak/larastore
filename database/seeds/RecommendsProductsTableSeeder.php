<?php

use Illuminate\Database\Seeder;

class RecommendsProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recommendsProducts')->insert(
            [
                'product_id' => 2,
                'product_id_recommend' => 1
            ]
        );
        DB::table('recommendsProducts')->insert(
            [
                'product_id' => 1,
                'product_id_recommend' => 2
            ]
        );
    }
}
