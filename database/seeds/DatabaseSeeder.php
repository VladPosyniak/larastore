<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

//        $this->call(UsersTableSeeder::class);
//        $this->call(CategoryDescriptionTableSeeder::class);
//        $this->call(CategoryTableSeeder::class);
//        $this->call(ClassDescriptionTableSeeder::class);
//        $this->call(ClassTableSeeder::class);
//        $this->call(CouponsTableSeeder::class);
//        $this->call(CurrencyTableSeeder::class);
//        $this->call(FilterDescriptionTableSeeder::class);
//        $this->call(FilterGroupTableSeeder::class);
//        $this->call(FilterGroupDescriptionTableSeeder::class);
//        $this->call(FilterTableSeeder::class);
//        $this->call(LanguageTableSeeder::class);
//        $this->call(ParametersDescriptionTableSeeder::class);
//        $this->call(ParametersTableSeeder::class);
//        $this->call(ProductFilterTableSeeder::class);
//        $this->call(ProductsDescriptionTableSeeder::class);
//        $this->call(ProductsTableSeeder::class);
//        $this->call(RecommendsProductsTableSeeder::class);
//        $this->call(SlidersTableSeeder::class);
//        $this->call(UserAddressTableSeeder::class);
        $this->call(ParametersValuesTableSeeder::class);

        Model::reguard();
    }
}
