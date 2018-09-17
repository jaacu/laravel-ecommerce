@extends('master')

@section('content')
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12 col-sm-12 border">
            <h1 class="text-center">All products! </h1>
            <hr>
        </div>
    </div>
</div>
<div class="col-lg-12">
        <div class="text-left pull-right">
        {{ $products->links() }}
        </div>
</div>
<div class="col-lg-12">
<products-masonry productsraw = "{{ collect($products->items() ) }}" tagsraw="{{ $tags }}" categoriesraw="{{ $categories }}"></products-masonry>
</div>
<div class="col-lg-12">
    <div class="text-left pull-right">
    {{ $products->links() }}
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css') }}">   
<link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
<link rel="stylesheet" href="{{ url('assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinModern.css') }}">
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
    min: {{ collect($products->items())->min->price }},
    max: {{ collect($products->items())->max->price }},
    from: 0,
    to: {{ collect($products->items())->max->price }},
    prefix: "$",
    keyboard: true,
    max_postfix: '+'
});
@endsection