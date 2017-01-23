<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(
            [
                'cover' => 'ogafRaMO9uboPFkUdH7nLN9hg7GDcJlBdV2hHKPO.jpg',
                'price' => 11.49,
                'price_old' => 13.41,
                'quantity' => 200,
                'isset' => true,
                'visible' => true,
                'sort_id' => 0,
                'categories_id' => 1,
                'class_id' => 1
            ]
        );
        DB::table('products')->insert(
            [
                'cover' => 'szadReF2pH1n1bZeFPyOd0zWyEmTvNvqnmA7SAg3.jpg',
                'price' => 5.75,
                'price_old' => null,
                'quantity' => 400,
                'isset' => true,
                'visible' => true,
                'sort_id' => 0,
                'categories_id' => 2,
                'class_id' => 1
            ]
        );
    }
}
