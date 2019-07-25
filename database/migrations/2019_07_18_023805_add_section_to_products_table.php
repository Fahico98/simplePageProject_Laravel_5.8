<?php

/**
 *
 * COLUMN MODIFIERS.
 *
 * There are several column "modifiers" you may use while adding a column to a database table.
 * For example, to make the column "nullable", you may use the nullable method:
 *
 * Schema::table('users', function(Blueprint $table){
 *    $table->string('email')->nullable();
 * });
 *
 * ---------------------------------------------------------------------------------------------------
 *
 * MODIFYING COLUMNS.
 *
 * -> Prerequisites.
 *
 * Before modifying a column, be sure to add the "doctrine/dbal" dependency to your "composer.json"
 * file. The Doctrine DBAL library is used to determine the current state of the column and create
 * the SQL queries needed to make the specified adjustments to the column:
 *
 * composer require doctrine/dbal
 *
 * -> Updating Column Attributes.
 *
 * The "change" method allows you to modify some existing column types to a new type or modify the
 * column's attributes. For example, you may wish to increase the size of a string column. To see the
 * "change" method in action, let's increase the size of the "name" column from 25 to 50:
 *
 * Schema::table('users', function(Blueprint $table){
 *    $table->string('name', 50)->change();
 * });
 *
 * We could also modify a column to be nullable:
 *
 * Schema::table('users', function(Blueprint $table){
 *    $table->string('name', 50)->nullable()->change();
 * });
 *
 * (!) Only the following column types can be "changed": bigInteger, binary, boolean, date, dateTime,
 * dateTimeTz, decimal, integer, json, longText, mediumText, smallInteger, string, text, time,
 * unsignedBigInteger, unsignedInteger and unsignedSmallInteger.
 *
 * -> Renaming Columns.
 *
 * To rename a column, you may use the "renameColumn" method on the Schema builder. Before renaming a
 * column, be sure to add the "doctrine/dbal" dependency to your "composer.json" file:
 *
 * Schema::table('users', function(Blueprint $table){
 *    $table->renameColumn('from', 'to');
 * });
 *
 * (!) Renaming any column in a table that also has a column of type "enum" is not currently supported.
 *
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSectionToProductsTable extends Migration{

   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up(){
      Schema::table('products', function (Blueprint $table) {
         $table->string("section")->after("country_origin");
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down(){
      Schema::table('products', function (Blueprint $table) {
         $table->dropColumn('section');
      });
   }
}
