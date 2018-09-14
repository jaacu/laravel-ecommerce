<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests\StoreProduct;

use App\Tag;
class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware([ 'auth' , 'role:shopkeeper' , 'shopkeeperMiddleware'])->except(['index' , 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {

        $validated = $request->validated();
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'stock' => $validated['stock'],
            'price' => $validated['price'],
            'shop_id' => $request->user()->getShopId()
            ]);
        if( isset($validated['tags']) ){
            $tags = Tag::parseTags($validated['tags']);
            $product->tags()->attach($tags);
        }
        if( isset($validated['category'] ) )
        $product->categories()->attach($validated['category']);

        return redirect(route('product.show', $product->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load(['categories' , 'tags']);
        return view('store.product.showSingle' , compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return 'editando' . $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(storeProduct $request, Product $product)
    {
        $validated = $request->validated();
        $product->update($validated);
        return route('product.show', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if( (auth()->id() == $product->getUser()->id and auth()->user()->hasPermissionTo('delete product')) or auth()->user()->hasRole('admin') ){
            $product->delete();
            return redirect('/');
        } else {
            abort(401);
        }
    }
}
