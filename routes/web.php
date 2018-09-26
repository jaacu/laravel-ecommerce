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

//Temporary routes
Route::get('/', function () {
    $products = App\Product::with('tags', 'categories')->get();
    $shops = App\Shop::with('products')->get();
    return view('store.home' , compact('products' , 'shops'));
})->name('home');

/**
 * Shopping cart routes
 */
Route::group(['prefix' => 'cart' ], function () { // Middlewares applied in the controller constructor
    Route::get('add', 'ShoppingCartController@addModal' )->name('cart.add'); //Get the add product modal 
    Route::post('add', 'ShoppingCartController@addProduct' ); // Same name as above // Save the product to the cart
    Route::get('', 'ShoppingCartController@show' )->name('cart.show'); // Show the cart
    Route::get('delete', 'ShoppingCartController@remove' )->name('cart.delete'); //Show the delete modal
    Route::post('delete', 'ShoppingCartController@delete' )->name('cart.delete'); // Delete the product
    Route::delete('destroy', 'ShoppingCartController@destroy' )->name('cart.destroy'); // Empty the cart
});

/**
 * Checkout form
 */

Route::group(['prefix' => 'checkout'], function () {
    Route::get('' , 'CheckoutController@show')->name('checkout.show');
    Route::post('' , 'CheckoutController@store')->name('checkout.store');
});


Route::get('/dashboard', function(){
    return view('master');
});

/**
 * The user, shop and product resources routes
 */
Route::resources([
    'user' => 'UserController',
    'product' => 'ProductController',
    'shop' => 'ShopController',
    'invoice' => 'InvoiceController'
]);

//Test route -------- To delete later
Route::get('/logout',function(){
    // $cart = new App\ShoppingCart;
    // App\User::first()->shoppingCart()->save($cart);
    // session()->errors('hola');
    // dd( date( 'today') );
    dd( explode( ' , \n'  , '$this->billing_address' ).size );
    // dd( App\User::first()->shoppingCart   );
    // dd( App\ShoppingCart::all()   );
    // dd($cart);
    // $user = App\User::all()->last();
    // $user->removeRole('shopkeeper');
    // dump($user->getRoleNames());
    // $user->assignRole(3);
    // dump($user->getRoleNames());
    // dd($user->email);
});
//Auth routes
Auth::routes();
