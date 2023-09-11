<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create(['product_name' => '如何製作牛仔褲','price' => 500,'photo'=>'1.jpg','product_description'=>'如何製作牛仔褲']);
        Product::create(['product_name' => '如何製作跑鞋', 'price' => 600, 'photo' => '2.jpg','product_description'=>'如何製作跑鞋']);
        Product::create(['product_name' => '如何製作女用運動褲', 'price' => 700, 'photo' => '3.jpg','product_description'=>'如何製作女用運動褲']);
        Product::create(['product_name' => '如何製作男短褲', 'price' => 400, 'photo' => '4.jpg','product_description'=>'如何製作男短褲']);
        Product::create(['product_name' => '如何製作特色套裝', 'price' => 1500, 'photo' => '5.jpg','product_description'=>'如何製作特色套裝']);
        Product::create(['product_name' => '如何製作性感套裝', 'price' => 800, 'photo' => '6.jpg','product_description'=>'如何製作性感套裝']);
        Product::create(['product_name' => '如何製作品牌包', 'price' => 900, 'photo' => '7.jpg','product_description'=>'如何製作品牌包']);
        Product::create(['product_name' => '如何製作太陽眼鏡', 'price' => 1000, 'photo' => '8.jpg','product_description'=>'如何製作太陽眼鏡']);
        Product::create(['product_name' => '如何製作黑色上衣', 'price' => 300, 'photo' => '9.jpg','product_description'=>'如何製作黑色上衣']);
    }
}
