<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\User;

class ShoppingCartController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware([ 'auth' ])->only('show' , 'destroy' , 'delete' , 'remove');
    }

    /**
     * Flash a a message to the session to notify the cart changed
     * @return void
     */
    public function notifyCartChanged(){ session()->flash('cart-changed' , true); }

    /**
     * Load the modal for adding products to the cart
     * Verifies if the product exists, if exists shows the modal, otherwise shows an error indicating the product doesn't exists
     * @return \Illuminate\Http\Response
     */
    public function addModal(){
        
        $product =  Product::find( request()->id); //Search the product
        
        if( is_null($product) ){
            return view('shared.modal.error');//Return the modal error 
        } else {
            return view('store.cart.addModal', compact('product')); // Return the add Product Modal
        }
    }

    /**
     * Handles the post request to add a new product to the cart
     * Validate the data, verifies the user is logged in, has a cart and that the product exists, then attach it to the cart 
     * @return \Illuminate\Http\Response
     */
    public function addProduct(Request $request){

        $data = $request->validate([
            'id' => 'required|numeric',
            'max' => 'required|numeric',
            'amount' => 'required|numeric|lte:max|min:1'
        ]); // Validate the inputs

        $user = auth()->user(); // Get the logged user
        
        // Redict back if the user is not login and tell him to log in
        if( is_null($user) ){
            return back()->withErrors('First login to add products to your cart!');
        }

        //Create the shopping cart if the user doesn't have one already
        if( ! $user->hasShoppingCart() ){
            $user->shoppingCart()->create();
            $user = User::find( $user->id ); // Get the logged user
        }
        
        //Find the product 
        $product = Product::find($data['id']);
        
        //Redirect back with error if the product doesn't exists
        if( is_null( $product) ){
            return back()->withErrors('The selected product doesn\'t exists!.');
        }

        //Verify if the product is already in the cart
        if( is_null( $user->shoppingCart->products()->find($data['id']) ) ){
            
            //Add the product if it doesn't exists 
            $user->shoppingCart->products()->attach([
            $product->id => array_only($data, 'amount')
            ]);

        } else {

            //Sum the amounts if the product is already in cart
            $order =  $user->shoppingCart->products()->find($data['id'])->order;
            $amount = $data['amount'] + $order->amount;
            $user->shoppingCart->products()->updateExistingPivot($data['id'] ,[
                 'amount' => $amount > $product->stock ? $product->stock : $amount 
            ]);
            session()->flash('warning' ,'You already have this product in your car, we summed the amounts!');
        }

        //Notify the cart has changed!
        $this->notifyCartChanged();

        //Return back with a success message!
        return back()->withSuccess('Product in cart!');
    }

    /**
     * Show the logged user shopping cart
     * @return \Illuminate\Http\Response
     */
    public function show(){
        return view('store.cart.show');
    }

    /**
     * Load the modal for deleting products in the cart
     * Verifies if the product exists in the cart, if exists shows the modal, otherwise shows an error 
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request){
        
        $cart = auth()->user()->shoppingCart;
        $product = $cart->products()->find($request->id);
        
        //Redirect back if the product is not in the cart 
        if( is_null($product) ) return view('shared.modal.error');//Return the modal error;
            
        $product->loadMissing('order');
        
        return view('store.cart.removeModal', compact('product')); // Return the add Product Modal
    }

    /**
     * Remove a single element from the cart
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request){

        $data = $request->validate([
            'id' => 'required|numeric',
            'max' => 'required|numeric',
            'amount' => 'required|numeric|lte:max|min:1'
        ]); // Validate the inputs


        $user = auth()->user(); // Get the logged user
        
        $product = $user->shoppingCart->products()->find($data['id']);
        //Verify if the product is in the cart
        if( is_null( $product ) ){ return back()->withErrors('The selected product is not in your cart'); } 
        
        $product->loadMissing('order');

        $cart = $user->shoppingCart;
        
        if( $product->order->amount == $data['amount'] ){
            $cart->products()->detach($product->id);
        } else {
            $cart->products()->updateExistingPivot($data['id'] ,[
                'amount' => $product->order->amount - $data['amount'] 
           ]);
        }

        $this->notifyCartChanged();

        return back()->withSuccess('Product remove from the cart successfuly.');
    }

    /**
     * Remove all the products from the cart
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){

        $cart = auth()->user()->shoppingCart;

        // Redirect back with a warning if the cart is empty 
        if( is_null($cart->products) ){ session()->flash('warning' ,'Your cart is already empty!'); return back(); }

        $cart->products()->detach();

        $this->notifyCartChanged();

        return back()->withSuccess('The cart is now empty');
    }
}
