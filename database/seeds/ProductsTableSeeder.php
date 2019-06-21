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
        for ($i = 1; $i <= 10; $i++){
            DB::table('products')->insert([
                'name' => 'Shoe '.$i,
                'description' => 'Shoe '.$i.' Description',
                'price' => rand(100,200)/10,
                'images' => '["img/product/p1.jpg","img/product/p2.jpg","img/product/p3.jpg"]',
                'avgPoint' => rand(1,50)/10,
                'quantity' => rand(1,50),
                'slug' => uniqid(),
                'category_id' => 1,
            ]);
        }

        for ($i = 11; $i <= 20; $i++){
            DB::table('products')->insert([
                'name' => 'Organic Food '.$i,
                'description' => 'Organic Food '.$i.' Description',
                'price' => rand(100,200)/10,
                'images' => '["img/organic-food/p1.jpg","img/organic-food/p2.jpg","img/organic-food/p3.jpg"]',
                'avgPoint' => rand(30,50)/10,
                'quantity' => rand(1,50),
                'slug' => uniqid(),
                'category_id' => 2,
            ]);
        }
    }
}
