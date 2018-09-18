@extends('master')

@section('content')
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12 col-sm-12 border">
            <h1 class="text-center">Welcome to {{ $shop->name}} </h1>
            <hr>
        <h3 class="text-center"><a data-toggle="collapse" href="#about" aria-expanded="false" aria-controls="about"><i class=" fa fa-list-alt " data-toggle="tooltip" title="About {{ $shop->name }}"></i></a></h3>
            <div class="collapse" id="about">
                <div class="row">
                    <div class="col-lg-7 col-sm-12 mx-auto"><p class="text-justify p-3 shop-description">{{ $shop->description}}</p></div>
                    <div class="col-sm-12 text-right my-2"><small>Created {{ $shop->getCreatedForHumans() }} by <a class="link" href="{{ route('user.show', $shop->getUserId()) }}">{{ $shop->user->name }}</a></small></div>
                    <div class="col-lg-6 col-sm-12 border py-2">
                            <h4 class="text-center" data-toggle="tooltip" title="Over Different Products!"><span class="products" >{{ $shop->getTotalProducts() }}</span> <i class="fa  fa-th"></i></h4>
                    </div>
                    <div class="col-lg-6 col-sm-12 border py-2">
                            <h4 class="text-center" data-toggle="tooltip" title="Over Units in Stock!"><span class="stock" >{{ $shop->getTotalStock() }}</span> <i class="fa fa-cubes"></i></h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 text-right my-2"><small>Active {{ $shop->getUpdatedForHumans() }}</small></div>
        </div>
    </div>
</div>
<div class="col-lg-12">
<products-masonry productsraw = "{{$shop->products->load(['tags' , 'categories']) }}" categoriesraw="{{ $shop->getCategories() }}"></products-masonry>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css') }}">   
<link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
<link rel="stylesheet" href="{{ url('assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinModern.css') }}">
<style>
.shop-description{
    font-size: 18px;
}
</style>
@endsection

@section('scripts')
<script src="{{asset('js/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}" type="text/javascript"></script>
<script src="{{ url('assets/plugins/ion-rangeslider/js/ion-rangeSlider/ion.rangeSlider.min.js') }}"></script>
@endsection

@section('jQuery')
$('#price_range').ionRangeSlider({
    type: "double",
    grid: true,
    min: {{ $shop->getCheap() }},
    max: {{ $shop->getExpensive() }},
    from: 0,
    to: {{ $shop->getExpensive() }},
    prefix: "$",
    keyboard: true,
    max_postfix: '+'
});
@endsection