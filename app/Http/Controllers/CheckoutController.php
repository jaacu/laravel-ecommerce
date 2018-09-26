<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Invoice;
use App\Checkout;

use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the checkout step form
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(){
        if( auth()->user()->isShoppingCartEmpty() ) return redirect( route('home') )->withErrors('Your cart is empty!'); 
        return view('store.checkout.stepForm');
    }

    /**
     * Store and process the checkout info 
     * 
     * Validate the inputs,
     * Create or update the checkout for the user making the request,
     * Create the invoice,
     * Empty the cart and update the products
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        if( auth()->user()->isShoppingCartEmpty() ) return redirect( route('home') )->withErrors('Your cart is empty!'); 
        
        $data = $request->validate([
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
            'email' => 'required|string|email|max:50',
            'phone' => 'required',
            'birth' => 'required|date|before:2000-01-01',
            'billingCountry' => 'required|string|max:50',
            'billingState' => 'required|string|max:50',
            'billingStreet' => 'required|string|max:50',
            'extraBilling' => 'nullable|string|max:50',
            'repeatBilling' => 'nullable',
            'shippingCountry' => 'required_unless:repeatBilling,on|nullable|string|max:50',
            'shippingState' => 'required_unless:repeatBilling,on|nullable|string|max:50',
            'shippingStreet' => 'required_unless:repeatBilling,on|nullable|string|max:50',
            'extraShipping' => 'nullable|string|max:50',
            'paymentMethod' => [
                'required','string',
                Rule::in(['free', 'stripe' , 'paypal' , 'credit-card']),
            ]
        ]);
        
        $user = auth()->user();

        // If the user has a checkout, update it, otherwise create a new one 
        if( $user->hasCheckout() ){
            $checkout = $user->checkout;
            $checkout->save( array_only( $data , ['firstName' , 'lastName' , 'email' , 'phone' , 'birth'] ) );
        } else {
            $checkout = new  Checkout( array_only($data , ['firstName' , 'lastName' , 'email' , 'phone' , 'birth'] ) ) ;
        }
        
        //Updated the addresses with the parsed string
        $checkout->billing_address = $checkout->parseAddress( $data[ 'billingCountry'] , $data['billingState'] , $data['billingStreet'] , $data['extraBilling' ] );
        $checkout->shipping_address = $checkout->parseAddress( $data[ 'shippingCountry'] , $data[ 'shippingState'] , $data[ 'shippingStreet'] , $data[ 'extraShipping' ] );

        $user->checkout()->save( $checkout );

        //Checkout successfull

        $cart = $user->shoppingCart;
        $products = $cart->products;
        $checkout = $user->checkout;

        //Create the invoice with the checkout data, the user data and the input data
        $invoice = Invoice::create([
            'user_id' => $user->id,
            'firstName' => $checkout->firstName,
            'lastName' => $checkout->lastName,
            'email' => $checkout->email,
            'phone' => $checkout->phone,
            'shipping_address' => $checkout->shipping_address,
            'billing_address' => $checkout->billing_address,
            'products' => $products->loadMissing('order'),
            'total' => $cart->getTotal(),
            'pay_method' => $data['paymentMethod']
        ]);

        //Update the products stock or delete them 
        foreach($cart->products as $product ){
            if( $product->order->amount  == $product->stock ){
                $product->delete();
            } else {
                $product->stock = $product->stock - $product->order->amount;
                $product->save();
            }
        }

        //Empty the shopping cart
        $cart->products()->detach();
        
        return redirect( route('invoice.show' , $invoice) )->withSuccess('Checkout successfull!');
    }

}
