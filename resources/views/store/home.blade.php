@extends('master')

@section('content')
<div class="col-lg-12">
    <!-- CAROUSEL -->
    <div id="featuredProductsCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="r"> <img class="d-block img-fluid carrousel-img" src="{{asset('assets/images/big/img1.jpg')}}" alt="First slide"></div>
                </div>
                <div class="carousel-item">
                    <div class="r"><img class="d-block img-fluid carrousel-img" src="{{asset('assets/images/big/img2.jpg')}}" alt="Second slide"></div>
                </div>
                <div class="carousel-item">
                    <div class="r"><img class="d-block img-fluid carrousel-img" src="{{asset('assets/images/big/img3.jpg')}}" alt="Third slide"></div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#featuredProductsCarousel" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
            <a class="carousel-control-next" href="#featuredProductsCarousel" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
    </div>
    <!-- End CAROUSEL -->
</div>
@endsection

@section('styles')
<style>
.carrousel-img{
    height: 500px;
    width: 100%;
}
</style>
@endsection