<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

/**
 * ROUTE NAMING CONVENTIONS.
 *
 * You can name your route anything you’d like, but the common convention is to use the plural of the
 * resource name, then a period, then the action. So, here are the routes most common for a resource named
 * photo:
 *
 * photos.create
 * photos.store
 * photos.show
 */
Route::get('user', "PagesController@profilePage")->where("userId", "[0-9]+")->name("noLogginUserRoute");

/**
 * THE NAMING RELATIONSHIP BETWEEN ROUTE PARAMETERS AND CLOSURE/CONTROLLER METHOD PARAMETERS.
 *
 * It’s most common to use the same names for your route parameters ({id}) and the method parameters they
 * inject into your route definition (function ($id)). But is this necessary?
 *
 * Unless you’re using route/model binding, no. The only thing that defines which route parameter matches
 * with which method parameter is their order (left to right). That having been said, just because you can
 * make them different doesn’t mean you should. I recommend keeping them the same for the sake of future
 * developers, who could get tripped up by inconsistent naming.
 *
 * --------------------------------------------------------------------------------------------------------
 *
 * REGULAR EXPRESSION ROUTE CONSTRAINTS.
 *
 * And you can use regular expressions (regexes) to define that a route should only match if a parameter
 * meets particular requirements (where method).
 */
Route::get('user/{userId}', "PagesController@profilePage")->where("userId", "[0-9]+");
Route::get('user/{userId}/{userName}', "PagesController@profilePage")->where(["userId" => "[0-9]+", "userName" => "[a-zA-Z]+",]);
