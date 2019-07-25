<?php

use Illuminate\Database\Seeder;

class CostumersTableSeeder extends Seeder{

   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run(){

      // Make empty the "costumers" table before seed it...
      DB::table('costumers')->truncate();

      DB::table('costumers')->insert([
         "name" => "Jose",
         "lastname" => "Cardozo",
         "e_mail" => "jjcardozo155@hotmail.com",
         "city" => "Liberty city",
         "country" => "Colombia",
         "phone_number" => 3219998880
      ]);

      DB::table('costumers')->insert([
         "name" => "Jairo",
         "lastname" => "Peralta",
         "e_mail" => "dolorysangre@gmail.com",
         "city" => "Liberty city",
         "country" => "Colombia",
         "phone_number" => 3127774342
      ]);

      DB::table('costumers')->insert([
         "name" => "Claudia",
         "lastname" => "Porras",
         "e_mail" => "porras23@gmail.com",
         "city" => "Vice city",
         "country" => "United States",
         "phone_number" => 3141234567
      ]);

      DB::table('costumers')->insert([
         "name" => "Miguel",
         "lastname" => "Rodriguez",
         "e_mail" => "migue_rodriguez09@outlook.com",
         "city" => "San andreas",
         "country" => "Brazil",
         "phone_number" => 3170987654
      ]);

      DB::table('costumers')->insert([
         "name" => "Jennifer",
         "lastname" => "Sosa",
         "e_mail" => "avejita457@outlook.com",
         "city" => "Vice city",
         "country" => "United States",
         "phone_number" => 3111111239
      ]);
   }
}
