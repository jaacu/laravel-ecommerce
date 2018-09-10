<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;

use App\Http\Requests\StoreShop;

class ShopController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware([ 'auth' , 'role:shopkeeper'])->except(['index' , 'show']);
        $this->middleware([ 'shopkeeperMiddleware'])->only(['create' , 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Shop::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store.shop.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShop $request)
    {
        $validated = $request->validated();

        $shop = Shop::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'user_id' => $request->user()->id
        ]);
        return $shop;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return $shop;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        return 'editing' . $shop->name;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(StoreShop $request, Shop $shop)
    {
        $validated = $request->validated();
        $shop->update($validated);
        // $shop->save();
        return route('shop.show', $shop->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        if( (auth()->id() == $shop->user->id and auth()->user()->hasPermissionTo('delete shop')) or auth()->user()->hasRole('admin') ){
            $shop->delete();
            return redirect('/');
        } else {
            abort(401);
        }
    }
}
