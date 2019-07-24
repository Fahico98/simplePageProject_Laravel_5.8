<?php

use App\Product;

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
Route::get('user', "PagesController@profilePage")->where("userId", "[0-9]+")->name("noLoginUserRoute");

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

/**
 * RAW SQL.
 *
 * it’s possible to make any raw call to the database using the DB facade and the statement() method:
 * DB::statement('SQL statement here').
 */
Route::get("/insertLaptop", function(){ // Insert statement...
   DB::insert(
      "INSERT INTO product (
         name,
         price,
         country_origin,
         section,
         remarks
      ) values (?, ?, ?, ?, ?)",
      [
         "Laptop",
         600.0,
         "South Corea",
         "Technology",
         "none"
      ]
   );
   // $usersOfType = DB::select("SELECT * FROM product WHERE name = ?", ["Fahico"]);
   // $countUpdated = DB::update("UPDATE product SET section = ? WHERE name = ?", ["computers", "Laptop"]);
   // $countDeleted = DB::delete("DELETE FROM product WHERE id = ?', [1]);
});

/**
 * ELOQUENT.
 *
 * Laravel 5 promotes the use of namespaces for things like Models and Controllers. "Product" Model is
 * under the App namespace thus "use App\Product" is required...
 */
Route::get("/productModelTest", function(){

   $products = Product::all();

   echo("<h2>All items in 'product' table...</h2>");
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

   $products = Product::where("country_origin", "Unite States")->get();

   echo("</br><h2>American items in 'product' table...</h2>");
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
});

/**
 *
 * ************************************************* NOTES *************************************************
 *
 * TYPE-HINTED: variable type setting in function argument, for example.
 *
 * |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 *
 * ROUTE MODEL BINDING.
 *
 * -> Implicit Route Model Bindin.
 *
 * The simplest way to use route model binding is to name your route parameter
 * something unique to that model (e.g., name it $conference instead of $id), then typehint that parameter
 * in the closure/controller method and use the same variable name there.
 *
 * Route::get('conferences/{conference}', function (Conference $conference){
 *    return view('conferences.show')->with('conference', $conference);
 * });
 *
 * Because the route parameter ({conference}) is the same as the method parameter ($conference), and the
 * method parameter is ***typehinted*** with a Conference model (Conference $conference), Laravel sees this
 * as a route model binding. Every time this route is visited, the application will assume that whatever is
 * passed into the URL in place of {conference} is an ID that should be used to look up a Conference, and
 * then that resulting model instance will be passed in to your closure or controller method.
 *
 * -> Explicit or Custom Route Model Binding.
 *
 * To manually configure route model bindings, add a line like the following to the boot() method in
 * App\Providers\RouteServiceProvider.
 *
 * public function boot(){
 *    parent::boot();
 *    Route::model('event', Conference::class); // Binding customized...
 * }
 *
 * You’ve now defined that whenever a route has a parameter in its definition named {event}, the route
 * resolver will return an instance of the Conference class with the ID of that URL parameter.
 *
 * Using an explicit route model binding...
 *
 * Route::get('events/{event}', function(Conference $event){
 *    return view('events.show')->with('event', $event);
 * });
 *
 * |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 *
 * CUSTOM BLADE DIRECTIVES.
 *
 * All of the built-in syntax of Blade like @if, @unless, and so on—are called directives. Each Blade
 * directive is a mapping between a pattern (e.g., @if ($condition)) and a PHP output
 * (e.g., <?php if ($condition): ?>). Directives aren’t just for the core; you can actually create your own.
 *
 * As with view composers, it might be worth having a custom service provider to register these, but for now
 * let’s just put it in the boot() method of App\Providers\AppServiceProvider.
 *
 * public function boot(){
 *    Blade::directive('ifGuest', function(){
 *       return("<?php if (auth()->guest()): ?>");
 *    });
 * }
 *
 * We’ve now registered a custom directive, @ifGuest, which will be replaced with the PHP code
 * "<?php if(auth()->guest()): ?>". This might feel strange. You’re writing a string that will be returned
 * and then executed as PHP. But what this means is that you can now take the complex, or ugly, or unclear,
 * or repetitive aspects of your PHP templating code and hide them behind clear, simple, and expressive
 * syntax.
 *
 * -> Parameters in Custom Blade Directives.
 *
 * What if you want to check a condition in your custom logic?
 *
 * public function boot{
 *    Blade::directive('newlinesToBr', function($expression){
 *       return("<?php echo nl2br({$expression}); ?>");
 *    });
 * }
 *
 * // Using...
 * <p>@newlinesToBr($message->body)</p>
 *
 * The $expression parameter received by the closure represents whatever’s within the parentheses (lo que
 * sea que esté dentro de los parentesis). As you can see, we then generate a valid PHP code snippet and
 * return it.
 *
 * |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 *
 * CHAINING WITH QUERY BUILDER.
 *
 * The query builder makes it possible to chain methods together to, you guessed it, build a query. At
 * the end of your chain you’ll use some method—likely get()—to trigger the actual execution of the query
 * you’ve just built.
 *
 * $usersOfType = DB::table('users')->where('type', $type)->get();
 *
 * $emails = DB::table('contacts')->select('email', 'email2 as second_email')->get();
 *
 * or
 *
 * $emails = DB::table('contacts')->select('email')->addSelect('email2 as second_email')->get();
 *
 * -> where(): allows you to limit the scope of what’s being returned using WHERE. By default, the signature
 * of the where() method is that it takes three parameters—the column, the comparison operator, and the
 * value:
 *
 * $newContacts = DB::table('contact')->where('age', '>', 18)->get();
 *
 * However, if your comparison is "=", which is the most common comparison, you can drop the second
 * operator:
 *
 * $vipContacts = DB::table('contacts')>where('vip',true)->get();
 *
 * If you want to combine where() statements, you can either chain them after each other, or pass an
 * array of arrays:
 *
 * $newVips = DB::table('contacts')->where('vip', true)->where('age', '>', 18);
 *
 * or
 *
 * $newVips = DB::table('contacts')->where(
 *    [
 *       ['vip', true],
 *       ['age', '>', 18]
 *    ]
 * );
 *
 * -> orWhere() Creates simple OR WHERE statements:
 *
 * $priorityContacts = DB::table('contacts')->where('vip', true)->orWhere('age', '>', 18)->get();
 *
 * To create a more complex OR WHERE statement with multiple conditions, pass orWhere() a closure:
 *
 * $contacts = DB::table('contacts')->where('vip', true)->orWhere(function($query){
 *    $query->where('age', '>', 18)->where('trial', false);
 * })->get();
 *
 * ...
 *
 * |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
 *
 * TRANSACTIONS.
 *
 * If you’re not familiar with database transactions, they’re a tool that allows you to wrap up a series
 * of database queries to be performed in a batch, which you can choose to roll back, undoing the entire
 * series of queries. Transactions are often used to ensure that all or none, but not some, of a series of
 * related queries are performed—if one fails, the ORM will roll back the entire series of queries.
 *
 * With the Laravel query builder’s transaction feature, if any exceptions are thrown at any point within
 * the transaction closure, all the queries in the transaction will be rolled back. If the transaction
 * closure finishes successfully, all the queries will be committed and not rolled back.
 *
 * // (use): https://www.php.net/manual/es/functions.anonymous.php
 * DB::transaction(function () use ($userId, $numVotes) {
 *
 *    // Possibly failing DB query.
 *    DB::table('users')->where('id', $userId)->update(['votes' => $numVotes]);
 *
 *    // Caching query that we don't want to run if the above query fails.
 *    DB::table('votes')->where('user_id', $userId)->delete();
 * });
 *
 */
