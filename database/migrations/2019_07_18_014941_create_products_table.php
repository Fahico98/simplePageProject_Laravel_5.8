<?php

/**
 *
 * GENERATING MIGRATIONS.
 *
 * To create a migration, use the "make:migration" Artisan command:
 *
 * php artisan make:migration create_users_table
 *
 * The new migration will be placed in your "database/migrations" directory. Each migration file
 * name contains a timestamp which allows Laravel to determine the order of the migrations.
 *
 * The "--table" and "--create" options may also be used to indicate the name of the table and
 * whether the migration will be creating a new table. These options pre-fill the generated
 * migration stub file with the specified table:
 *
 * php artisan make:migration create_users_table --create=users
 *
 * php artisan make:migration add_votes_to_users_table --table=users
 *
 * If you would like to specify a custom output path for the generated migration, you may use the
 * "--path" option when executing the "make:migration" command. The given path should be relative
 * to your application's base path.
 *
 * --------------------------------------------------------------------------------------------------
 *
 * ROLLING BACK MIGRATIONS.
 *
 * To rollback the latest migration operation, you may use the "rollback" command. This command rolls
 * back the last "batch" of migrations, which may include multiple migration files:
 *
 * php artisan migrate:rollback
 *
 * You may rollback a limited number of migrations by providing the "step" option to the "rollback"
 * command. For example, the following command will rollback the last five migrations:
 *
 * php artisan migrate:rollback --step=5
 *
 * The "migrate:reset" command will roll back all of your application's migrations:
 *
 * php artisan migrate:reset
 *
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration{

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up(){
      Schema::create('products', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->bigInteger("costumer_id");
         $table->string("name", 100);
         $table->double("price", 8, 2);
         $table->string("country_origin", 100);
         $table->text("remarks");
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down(){
      Schema::dropIfExists('products');
   }
}
