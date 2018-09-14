@extends('master')


@section('content')
<div class="col-lg-12">
<div class="row">
    <div class="col-lg-5 col-sm-12">
        <div class="product-image-wrapper">
            <img src="{{ url('assets/images/background/socialbg.jpg')}}" alt="Product" class="img-rounded card-img">
        </div>
    </div>
    <div class="col-lg-7 col-sm-12 border">
        <h1 class="text-center"> {{ $product->name}} </h1>
        <hr>
        <h3 class="text-center"><i class=" fa fa-list-alt product-icon " data-toggle="tooltip" title="Description"></i></h3>
        <p class="text-justify p-3">{{ $product->description}}</p>
    <div class="col-sm-12 text-right my-2"><small>Published {{ $product->getCreatedForHumans() }} in <a class="link" href="{{ route('shop.show', $product->getShopId()) }}">{{ $product->getShopName() }}</a></small></div>
        <div class="row border">
            <div class="col-lg-6 col-sm-12 border py-2">
                <h4 class="text-center" data-toggle="tooltip" title="Price"><span class="price" >$ {{ $product->price }}</span> <i class="fa fa-money"></i></h4>
            </div>
            <div class="col-lg-6 col-sm-12 border py-2">
                    <h4 class="text-center" data-toggle="tooltip" title="In Stock"><span class="stock" > {{ $product->stock }}</span> <i class="fa fa-cubes"></i></h4>
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
        </div>
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
.tag{
    color: #fff;
    font-size: 15px;
    padding: 10px;
    margin: 3px 10px;
}
</style>
@endsection

@section('jQuery')
setTimeout(function(){
$('.sidebartoggler').click();
},400)
@endsection