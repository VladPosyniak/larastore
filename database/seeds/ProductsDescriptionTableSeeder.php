<?php

use Illuminate\Database\Seeder;

class ProductsDescriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_description')->insert(
            [
                'product_id' => 1,
                'language_id' => 1,
                'name' => 'Корзина роз',
                'title' => 'Корзина роз',
                'keywords' => 'Корзина роз, розы, цветы',
                'description' => 'Сделайте невероятно милый сюрприз своим близким, подарив им эту прекрасную корзину с красными и белыми розами!',
                'description_full' => 'Ро́за — собирательное название видов и сортов представителей рода Шиповник, выращиваемых человеком. Большая часть сортов роз получена в результате длительной селекции путём многократных повторных скрещиваний и отбора.',
            ]
        );
        DB::table('products_description')->insert(
            [
                'product_id' => 1,
                'language_id' => 2,
                'name' => 'Basket of roses',
                'title' => 'Basket of roses',
                'keywords' => 'Basket of roses, roses, flowers',
                'description' => 'Make an incredibly pleasant surprise your loved ones by giving them this beautiful basket of red and white roses!',
                'description_full' => 'Rose - the collective name of the species and varieties of the genus Rosehip grown man. Most of the varieties of roses obtained by continuous selection by multiple repeated crosses and selection.',
            ]
        );
        DB::table('products_description')->insert(
            [
                'product_id' => 1,
                'language_id' => 3,
                'name' => 'Кошик троянд',
                'title' => 'Кошик троянд',
                'keywords' => 'Кошик троянд, троянди, квіти',
                'description' => 'Зробіть неймовірно милий сюрприз своїм близьким, подарувавши їм цю прекрасну кошик з червоними і білими трояндами!',
                'description_full' => 'Роза - збірна назва видів і сортів представників роду Шипшина, вирощуваних людиною. Більша частина сортів троянд отримана в результаті тривалої селекції шляхом багаторазових повторних схрещувань і відбору.',
            ]
        );



        DB::table('products_description')->insert(
            [
                'product_id' => 2,
                'language_id' => 1,
                'name' => 'Букет тюльпанов',
                'title' => 'Букет тюльпанов',
                'keywords' => 'Букет тюльпанов, тюльпаны, цветы',
                'description' => 'Удивите свою вторую половинку очень ярким букетом тюльпанов, который надолго запомниться вашей половинке!',
                'description_full' => 'Тюльпа́н — род многолетних травянистых луковичных растений семейства Лилейные, в современных систематиках включающий более 80 видов. Центр происхождения и наибольшего разнообразия видов тюльпанов — горы северного Ирана, Памиро-Алай и Тянь-Шань.',
            ]
        );
        DB::table('products_description')->insert(
            [
                'product_id' => 2,
                'language_id' => 2,
                'name' => 'Bouquet of tulips',
                'title' => 'Bouquet of tulips',
                'keywords' => 'Bouquet of tulips, tulips, flowers',
                'description' => 'Surprise your mate is very bright bouquet of tulips, which will long be remembered by your spouse!',
                'description_full' => 'Tulip - genus of perennial herbaceous bulbous plants Liliaceae family in modern taxonomy includes more than 80 species. The center of origin and greatest diversity of species tulips - the mountains of northern Iran, the Pamir-Alai and Tien Shan.',
            ]
        );
        DB::table('products_description')->insert(
            [
                'product_id' => 2,
                'language_id' => 3,
                'name' => 'Букет тюльпанів',
                'title' => 'Букет тюльпанів',
                'keywords' => 'Букет тюльпанів, тюльпани, квіти',
                'description' => 'Здивуйте свою другу половинку дуже яскравим букетом тюльпанів, який надовго запамятатися вашій половинці!',
                'description_full' => 'Тюльпан - рід багаторічних трав\'янистих цибулинних рослин сімейства Лілійні, в сучасних систематиках що включає більше 80 видів. Центр походження і найбільшої розмаїтості видів тюльпанів - гори північного Ірану, Паміро-Алай і Тянь-Шань.',
            ]
        );
    }
}
