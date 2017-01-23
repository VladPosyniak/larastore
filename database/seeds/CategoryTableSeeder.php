<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'cover' => 'RrpZt0dbSrg6mHhwIjTfO1OtizRbsOrB1TbuY02U.png',
            'urlhash' => 'roses',
            'sort_id' => 0,
            'class_id' => 1
        ]);

        DB::table('categories')->insert([
            'cover' => 'MmKmi58yKj94M13mwasqKbCOwXVAhXA5a00HV2Il.png',
            'urlhash' => 'tulips',
            'sort_id' => 0,
            'class_id' => 1
        ]);
    }
}
