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
    return view('store.home');
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
    'shop' => 'ShopController'
]);

//Test route -------- To delete later
Route::get('/logout',function(){
    $user = App\User::all()->last();
    // $user->removeRole('shopkeeper');
    dump($user->getRoleNames());
    $user->assignRole(3);
    dump($user->getRoleNames());
    // dd($user->email);


    return view('shared.errorsahhh');
});
//Auth routes
Auth::routes();
