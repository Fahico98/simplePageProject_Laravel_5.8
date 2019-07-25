<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder{

   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run(){

      // Make empty the "products" table before seed it...
      DB::table('products')->truncate();

      DB::table('products')->insert([
         "costumer_id" => 2,
         "name" => "Shirt",
         "price" => 35.50,
         "country_origin" => "Unite States",
         "section" => "Clothing",
         "remarks" => "none"
      ]);

      DB::table('products')->insert([
         "costumer_id" => 2,
         "name" => "Jean",
         "price" => 79.99,
         "country_origin" => "Scotland",
         "section" => "Clothing",
         "remarks" => "none"
      ]);

      DB::table('products')->insert([
         "costumer_id" => 4,
         "name" => "Globes",
         "price" => 120.55,
         "country_origin" => "Unite States",
         "section" => "Sports",
         "remarks" => "none",
      ]);

      DB::table('products')->insert([
         "costumer_id" => 1,
         "name" => "Brush",
         "price" => 20.75,
         "country_origin" => "Engrand",
         "section" => "Tools",
         "remarks" => "none"
      ]);

      DB::table('products')->insert([
         "costumer_id" => 5,
         "name" => "Cup set",
         "price" => 224.99,
         "country_origin" => "China",
         "section" => "Kitchen",
         "remarks" => "none"
      ]);
   }
}
