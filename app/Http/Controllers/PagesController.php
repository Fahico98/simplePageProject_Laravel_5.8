<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PagesController extends Controller{

   /**
    * PASSING ARGUMENTS TO VIEWS.
    *
    * To call views with parameters we use the with() method, this is the right way to pass ceveral arguments
    * to a view, however, we can pass one single argument to views as second parameter in the view method:
    * view("profile", $userName);
    *
    *----------------------------------------------------------------------------------------------------------------------
   *
   * SCAPING USER INPUT.
   *
   * If you pass data from your Controller to a View with some HTML styling like: $first = "<b>Narendra Sisodia</b>";
   * And it is accessed, within Blade, with {{ $first }} then the output'll be: <b>Narendra Sisodia</b>.
   * But if it is accessed with {!! $first !!} then the output'll be: Narendra Sisodia.
   */
   public function profilePage($userId = 0, $userName = ""){
      return view("profile")->with(["userId" => $userId, "userName" => $userName]);
   }

   public function showProductsCostumer($costumerId = 0){
      if($costumerId == 0){
         echo("<h2>The costumer don't have products...!</h2>");
      }else{
         $products = Product::where("costumer_id", $costumerId)->get();
         $costumer = Costumer::find($costumerId);
         echo("<h2>Products of $costumer->name $costumer->lastname:</h2>");
         foreach($products as $product){
            echo(
               "<h4>
                  Name: $product->name,&emsp;
                  Price: $product->price,&emsp;
                  Country origin: $product->country_origin,&emsp;
                  Section: $product->section,&emsp;
                  Remarks: $product->remarks
               </h4>"
            );
         }
      }
   }
}
