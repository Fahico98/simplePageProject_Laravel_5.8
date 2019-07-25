<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostumersTable extends Migration{

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up(){
      Schema::create('costumers', function(Blueprint $table){
         $table->bigIncrements('id');
         $table->string("name", 100);
         $table->string("lastname", 100);
         $table->string("e_mail", 50)->unique();
         $table->string("city", 50);
         $table->string("country", 50);
         $table->bigInteger("phone_number");
         $table->timestamps();
         $table->softDeletes();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down(){
      Schema::table('costumers', function (Blueprint $table) {
         Schema::dropIfExists('costumers');
      });
   }
}
