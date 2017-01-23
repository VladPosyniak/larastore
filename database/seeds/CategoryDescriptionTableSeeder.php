<?php

use Illuminate\Database\Seeder;

class CategoryDescriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_description')->insert([
            'category_id' => 1,
            'language_id' => 1,
            'name' => 'Розы',
            'title' => 'Розы',
            'description' => 'Ро́за — собирательное название видов и сортов представителей рода Шиповник, выращиваемых человеком. Большая часть сортов роз получена в результате длительной селекции путём многократных повторных скрещиваний и отбора.',
            'keywords' => 'цветы, букет, роза, розы, тюльпаны, 8 марта',
        ]);

        DB::table('category_description')->insert([
            'category_id' => 1,
            'language_id' => 2,
            'name' => 'Roses',
            'title' => 'Roses',
            'description' => 'Rose - the collective name of the species and varieties of the genus Rosehip grown man. Most of the varieties of roses obtained by continuous selection by multiple repeated crosses and selection.',
            'keywords' => 'flowers, bouquet, rose, roses, tulips, 8 March',
        ]);

        DB::table('category_description')->insert([
            'category_id' => 1,
            'language_id' => 3,
            'name' => 'Троянди',
            'title' => 'Троянди',
            'description' => 'Роза - збірна назва видів і сортів представників роду Шипшина, вирощуваних людиною. Більша частина сортів троянд отримана в результаті тривалої селекції шляхом багаторазових повторних схрещувань і відбору.',
            'keywords' => 'квіти, букет, троянда, троянди, тюльпани, 8 березня',
        ]);

        DB::table('category_description')->insert([
            'category_id' => 2,
            'language_id' => 1,
            'name' => 'Тюльпаны',
            'title' => 'Тюльпаны',
            'description' => 'Тюльпа́н — род многолетних травянистых луковичных растений семейства Лилейные, в современных систематиках включающий более 80 видов. Центр происхождения и наибольшего разнообразия видов тюльпанов — горы северного Ирана, Памиро-Алай и Тянь-Шань.',
            'keywords' => 'цветы, букет, роза, розы, тюльпаны, 8 марта',
        ]);

        DB::table('category_description')->insert([
            'category_id' => 2,
            'language_id' => 2,
            'name' => 'Tulips',
            'title' => 'Tulips',
            'description' => 'Tulip - genus of perennial herbaceous bulbous plants Liliaceae family in modern taxonomy includes more than 80 species. The center of origin and greatest diversity of species tulips - the mountains of northern Iran, the Pamir-Alai and Tien Shan.',
            'keywords' => 'flowers, bouquet, rose, roses, tulips, 8 March',
        ]);

        DB::table('category_description')->insert([
            'category_id' => 2,
            'language_id' => 3,
            'name' => 'Тюльпани',
            'title' => 'Тюльпани',
            'description' => 'Тюльпан - рід багаторічних травянистих цибулинних рослин сімейства Лілійні, в сучасних систематиках що включає більше 80 видів. Центр походження і найбільшої розмаїтості видів тюльпанів - гори північного Ірану, Паміро-Алай і Тянь-Шань.',
            'keywords' => 'квіти, букет, троянда, троянди, тюльпани, 8 березня',
        ]);
    }
}
