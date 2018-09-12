@extends('master')


@section('content')
<div class="col-lg-12">
<div class="row">
    <div class="col-lg-5 col-sm-12">
        <div class="product-image-wrapper">
            <img src="{{ url('assets/images/background/socialbg.jpg')}}" alt="Product" class="card-img">
        </div>
    </div>
    <div class="col-lg-7 col-sm-12 border">
        <h1 class="text-center"> {{ $product->name}} </h1>
        <hr>
        <h3 class="text-center"><i class=" fa fa-list-alt product-icon " data-toggle="tooltip" title="Description"></i></h3>
        <p class="text-justify p-3">{{ $product->description}}</p>
        <div class="row border">
            <div class="col-lg-6 col-sm-12 border py-2">
                <h4 class="text-center" data-toggle="tooltip" title="Price"><span class="price" >$ {{ $product->price }}</span> <i class="fa fa-money"></i></h4>
            </div>
            <div class="col-lg-6 col-sm-12 border py-2">
                    <h4 class="text-center" data-toggle="tooltip" title="In Stock"><span class="stock" > {{ $product->stock }}</span> <i class="fa fa-cubes"></i></h4>
            </div>
        </div>
    
    </div>
@endsection

@section('styles')
<style>
.product-image-wrapper{
    height: 630px;
}
.product-image-wrapper > img {
    max-height: 100%;
}
.product-icon{
    font-size: 40px;
}

</style>
@endsection

@section('jQuery')
setTimeout(function(){
$('.sidebartoggler').click();
},400)
@endsection