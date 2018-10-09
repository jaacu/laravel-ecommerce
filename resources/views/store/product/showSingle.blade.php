@extends('master')


@section('content')
<div class="col-lg-12">
<div class="row">
    <div class="col-lg-5 col-sm-12 el-element-overlay">
        <div class="product-image-wrapper el-card-item">
            <div class="el-card-avatar el-overlay-1"> <img src="{{ url('assets/images/background/socialbg.jpg')}}" class="img-rounded card-img {{ $product->trashed() ? 'blur' : '' }}" />
                <div class="el-overlay">
                    <ul class="el-info">
                        <li><a class="btn default btn-outline image-popup-vertical-fit" href="{{ url('assets/images/background/socialbg.jpg')}}"><i class="icon-magnifier"></i></a></li>
                        {{-- <li><a class="btn default btn-outline" href="javascript:void(0);"><i class="icon-link"></i></a></li> --}}
                    </ul>
                </div>
            </div>
            {{-- <img src="{{ url('assets/images/background/socialbg.jpg')}}" alt="Product" class="img-rounded card-img {{ $product->trashed() ? 'blur' : '' }} "> --}}
        </div>
    </div>
    <div class="col-lg-7 col-sm-12 border">
        <h1 class="text-center"> {{ $product->name}}
            @if( auth()->check() && auth()->user()->shoppingCartHasProduct($product->id) ) <small class="badge badge-inverse badge-pill in-cart"> In Cart </small>  @endif 
            @if( $product->trashed() ) <small class="badge badge-warning badge-pill in-cart"> Out of Stock! </small>  @endif</h1>
        <hr>
        <h3 class="text-center"><i class=" fa fa-list-alt product-icon " data-toggle="tooltip" title="Description"></i></h3>
        <p class="text-justify p-3">{{ $product->description}}</p>
    <div class="col-sm-12 text-right my-2"><small>Published {{ $product->getCreatedForHumans() }} in <a class="link" href="{{ route('shop.show', $product->getShopId()) }}">{{ $product->getShopName() }}</a></small></div>
        <div class="row border">
            <div class="col-lg-6 col-sm-12 border py-2">
                <h4 class="text-center" data-toggle="tooltip" title="Price"><span class="price" >$ {{ $product->price }}</span> <i class="fa fa-money"></i></h4>
            </div>
            <div class="col-lg-6 col-sm-12 border py-2">
                    <h4 class="text-center" data-toggle="tooltip" title="{{ $product->trashed() ? 'Out of Stock!' : 'In Stock' }} "><span class="stock" > {{ $product->stock }}</span> <i class="fa fa-cubes"></i></h4>
            </div>
            <div class="col-lg-6 col-sm-12 border py-2">
                <h4 class="text-center" data-toggle="tooltip" title="Tags"><span class="tags" > {{ count($product->tags) }}</span> <i class="fa fa-tags"></i></h4>
                @forelse ($product->tags as $tag)
                   <a href=""><span class="tag badge badge-info btn" data-toggle="tooltip" title="{{$tag->name}}">{{$tag->name}}</span></a> 
                @empty
                    <h4 class="text-center"> This product doesn't have tags.</h4>
                @endforelse
            </div>
            <div class="col-lg-6 col-sm-12 border py-2">
                <h4 class="text-center" data-toggle="tooltip" title="Categories"><span class="categories" > {{ count($product->categories) }}</span> <i class="fa fa-folder-o"></i></h4>
                @forelse ($product->categories as $category)
                   <a href=""><h5 class="category btn" data-toggle="tooltip" title="{{$category->name}}"> <i class="fa fa-folder-open"></i> {{$category->name}}</h5></a> 
                @empty
                    <h4 class="text-center"> This product doesn't have categories.</h4>
                @endforelse
            </div>
            <div class="col-sm-12 border py-2 text-center">
                @if ( $product->trashed() )
                <button disabled class="btn btn-warning btn-md btn-rounded waves-effect waves-dark">Out of Stock!</button>                    
                @else                    
                <button class="btn btn-outline-primary btn-md btn-rounded waves-effect waves-dark modal-load-button" data-url="{{ route('cart.add') }}" data-id="{{ $product->id}}" >Add to cart</button>
                @if( auth()->check() && auth()->user()->shoppingCartHasProduct($product->id) )
                <button  class="btn btn-outline-danger btn-md btn-rounded waves-effect waves-dark modal-load-button" data-url="{{ route('cart.delete') }}" data-id="{{ $product->id }}"> Remove from cart </button>  
                @endif
            @endif


            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
<style>
.product-image-wrapper{
    height: 630px;
}
.product-image-wrapper img {
    max-height: 100%;
}
.product-icon{
    font-size: 40px;
}
.tag{
    color: #fff;
    font-size: 15px;
    padding: 10px;
    margin: 3px 10px;
}
.el-element-overlay .el-card-item .el-overlay-1{
    height: 100%;
}
</style>
@endsection

@section('scripts')
<script src="{{ url('assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>    
@endsection

@section('jQuery')
setTimeout(function(){
$('.sidebartoggler').click();
},400)
$('.image-popup-vertical-fit').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    mainClass: 'mfp-img-mobile',
    image: {
        verticalFit: true
    }
    
});
@endsection