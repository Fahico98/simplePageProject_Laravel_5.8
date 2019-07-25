<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Product;

class Costumer extends Model{

   use SoftDeletes;

   protected $table = "costumers";
   protected $fillable = ["name", "lastname", "e_mail", "city", "country", "phone_number"];

   public function product(){
      return $this->hasOne(Product::class);
   }
}
