<?php

use Illuminate\Database\Seeder;

class ClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert(
            [
                'cover' => '6ptnibqfgQ0UagUBe8cjvVLf1iNG25agrKZV9Gdn.png',
                'urlhash' => 'flowers',
                'sort_id' => 0
            ]);
    }
}
