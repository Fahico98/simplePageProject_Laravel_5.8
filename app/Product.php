<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model{

   use SoftDeletes;

   protected $table = "product";
   protected $fillable = ["name", "price", "country_origin", "section", "remarks"];
}

/**
 * ***************************************************** NOTES ********************************************************
 *
 * SOFT DELETING.
 *
 * In addition to actually removing records from your database, Eloquent can also "soft delete" models. When models are
 * soft deleted, they are not actually removed from your database. Instead, a "deleted_at" attribute is set on the model
 * and inserted into the database. If a model has a non-null "deleted_at" value, the model has been soft deleted. To
 * enable soft deletes for a model, use the "Illuminate\Database\Eloquent\SoftDeletes" trait on the model:
 *
 * You should also add the "deleted_at" column to your database table. The Laravel schema builder contains a helper
 * method to create this column:
 *
 * Schema::table('flights', function (Blueprint $table) {
 *    $table->softDeletes();
 * });
 *
 * Now, when you call the "delete" method on the model, the "deleted_at" column will be set to the current date and time.
 * And, when querying a model that uses soft deletes, the soft deleted models will automatically be excluded from all
 * query results.
 *
 * To determine if a given model instance has been soft deleted, use the trashed method:
 *
 * if($flight->trashed()){
 *    //...
 * }
 */
