@extends('master')

@section('content')

<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-8 col-sm-12 border mx-auto">
            @if(auth()->user()->hasShoppingCart())
            @forelse ( auth()->user()->shoppingCart->products as $product)
                @if ($loop->first)
                    <h1 class="text-center"> Products in Cart </h1>
                    <hr>
                @endif
                <div class="row my-2 py-2 border">
                    <div class="col-sm-4">
                        <img src="{{ url('assets/images/background/socialbg.jpg')}}" alt="Product" class="img-circle card-img product-img mx-auto">
                    </div>
                    <div class="col-sm-8 border p-3">
                        <h4>{{ $product->name }} </h4>
                        <p> {{ $product->description}}</p>
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <h5 class=""> Total : <span class="badge badge-inverse"> {{ $product->stock}}</span> </h5>
                                <h5 class=""> In cart: <span class="badge badge-inverse">{{ $product->order->amount}}</span> </h5>
                                <button class="btn btn-outline-primary btn-md btn-rounded waves-effect waves-dark modal-load-button" data-url="{{ route('cart.add') }}" data-id="{{ $product->id}}" >Add to more</button>
                            </div>
                            <div class="col-sm-8 text-center">
                                <h5 class=""> Price (Per unit): <span class="text-info"> $ {{ $product->price }} </span> <span class="badge badge-secondary">USD</span> </h5>
                                <h5 class=""> Price (Total): <span class="text-info"> $ {{ $product->price * $product->order->amount }} </span> <span class="badge badge-secondary">USD</span> </h5>
                                <button class="btn btn-outline-danger btn-rounded waves-effect waves-dark remove-item-cart modal-load-button" data-url="{{ route('cart.delete') }}" data-id="{{ $product->id }}" >Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($loop->last)
                    <div class="row my-2 p-2 border">
                        <div class="col-sm-12">
                        <h3> <strong> Sub-Total: </strong> $ {{ auth()->user()->shoppingCart->getSubTotal() }}</h3>
                        <h5> <strong> Taxes and Shipping and stuff: </strong> There are none because the products are imaginary lol.</h5>
                        <h3> <strong> Total: </strong> $ {{ auth()->user()->shoppingCart->getTotal() }}</h3>
                        </div>
                        <div class="col-sm-6">
                            <form action="{{ route('cart.destroy') }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-block btn-md waves-effect waves-dark confirmate" type="submit">
                                    Empty cart
                                </button>
                            </form>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('checkout.store')}}" class="btn btn-success btn-block btn-md waves-effect waves-dark" type="submit">
                                        Proceed to checkout
                                </a>
                        </div>
                    </div>
                @endif                   
            @empty
            <h1 class="text-center"> Your cart is empty! </h1>
            <hr>   
            @endforelse
            @else
            <h1 class="text-center"> Your cart is empty! </h1>
            <hr>
            @endif
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
.product-img{
    max-width: 175px;
    max-height: 175px;
}

</style>
@endsection