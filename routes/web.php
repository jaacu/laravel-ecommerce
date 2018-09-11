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
    return view('store.home');
});

Route::get('/dashboard', function(){
    return view('master');
});

Route::resource('user', 'UserController');

Route::resource('product', 'ProductController');

Route::resource('shop', 'ShopController');

Route::get('/logout',function(){
    $user = App\User::all()->last();
    // $user->removeRole('shopkeeper');
    dump($user->getRoleNames());
    $user->assignRole(3);
    dump($user->getRoleNames());
    // dd($user->email);


    return view('shared.errorsahhh');
});

Auth::routes();
