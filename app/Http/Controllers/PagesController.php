<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
      //
   }
}
