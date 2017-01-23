<?php

use Illuminate\Database\Seeder;

class ProductFilterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_filter')->insert(
            [
                'product_id' => 1,
                'filter_id' => 1
            ]
        );
        DB::table('product_filter')->insert(
            [
                'product_id' => 2,
                'filter_id' => 2
            ]
        );
    }
}
