@extends('master')

@section('content')
<div class=" col-12 mx-auto p-3">
    <form class="m-t-40" method="POST" action="{{ route('product.store') }}">
        @csrf
        <div class="form-group">
            <h1 class="text-left text-info mt-3"> Create a new Product</h1>
        </div>
        <div class="row align-items-center">
            <div class=" col-sm-12 col-lg-6">
                <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }} ">
                        <h3 class="col-md-5"><label class="control-label" for="name">Product Name </label></h3>
                        <div class="col-md-7">
                            <input placeholder=" e.g Happy Joe's Shoe Store" id="name" type="text" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" 
                            name="name" value="{{ old('name') }}" required autofocus >
                            @if ($errors->has('name'))
                                <small class="form-control-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </small>
                            @endif
                        </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                    <div class="form-group row {{ $errors->has('price') ? ' has-danger' : '' }} ">
                            <h3 class="col-md-3"><label class="control-label" for="price">Price </label></h3>
                            <div class="col-md-9">
                                <input  placeholder="100.00" id="price" type="text" class="form-control{{ $errors->has('price') ? ' form-control-danger' : '' }}" 
                                name="price" value="{{ old('price') }}" required
                                data-bts-button-down-class="btn btn-secondary btn-outline" data-bts-button-up-class="btn btn-secondary btn-outline">
                                @if ($errors->has('price'))
                                    <small class="form-control-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </small>
                                @endif
                            </div>
                    </div>
            </div>
            <div class="col-lg-5 col-ms-8">
                    <div class="form-group row {{ $errors->has('stock') ? ' has-danger' : '' }} ">
                            <h3 class="col-md-3"><label class="control-label" for="stock">Stock </label></h3>
                            <div class="col-md-4">
                                <input  placeholder="100.00" id="stock" type="text" class="form-control{{ $errors->has('stock') ? ' form-control-danger' : '' }}" 
                                name="stock" value="{{ old('stock') }}" required
                                data-bts-button-down-class="btn btn-secondary btn-outline" data-bts-button-up-class="btn btn-secondary btn-outline">
                                @if ($errors->has('stock'))
                                    <small class="form-control-feedback" role="alert">
                                        <strong>{{ $errors->first('stock') }}</strong>
                                    </small>
                                @endif
                            </div>
                            <div class="col-md-5"></div>
                            <h3 class="col-md-12"><label class="control-label" for="tags">Tags </label></h3>
                            <div class="col-md-12">
                                <input  placeholder="Add tags e.g action" id="tags" type="text" class="form-control{{ $errors->has('tags') ? ' form-control-danger' : '' }}" 
                                name="tags" value="{{ old('tags') }}" data-role="tagsinput">
                                @if ($errors->has('tags'))
                                    <small class="form-control-feedback" role="alert">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </small>
                                @endif
                            </div>
                    </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group row {{ $errors->has('description')  ? ' has-danger' : '' }} ">
                    <div class="col-12">
                        <h3><label class="control-label" for="description"> Description </label></h3>
                        <textarea class="form-control{{ $errors->has('description') ? ' form-control-danger' : '' }}" 
                        rows="3" placeholder=" e.g Happy Joe's It's a Store where you can find all kinds of fun shoes!!! " id="description"
                         name="description"  >{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="form-control-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                    <div class="form-group row {{ $errors->has('category')  ? ' has-danger' : '' }} ">
                        <div class="col-12">
                            <h3><label class="control-label" for="category"> Category </label></h3>
                            <select class="select2 select2-multiple w-100" multiple id="category" name="category[]"   data-placeholder="Category">
                             {{-- <option value="category 1" {{in_array('category 1' , old('category')) ? 'selected' : '' }} >category 1</option> --}}
                             <option value="category 12">category 2</option>
                             <option value="category 13">category 3</option>
                             <option value="category 14">category 4</option>
                             <option value="category 16">category 5</option>
                            </select>
                            @if ($errors->has('category'))
                                <span class="form-control-feedback" role="alert">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            <div class="col-lg-4 col-sm-12">
                <div class="form-group text-center m-t-20">
                    <button type="submit" class="btn btn-success waves-effect waves-light btn-md"> <i class="fa fa-check"></i> Create</button>
                </div>
            </div>
    </div>

    </form>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/jquery.bootstrap-touchspin.min.css') }}">    
<link rel="stylesheet" href="{{ asset('css/bootstrap-tagsinput.css') }}">   
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">    
@endsection

@section('scripts')
<script src="{{asset('js/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('js/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{ url('assets/plugins/select2/dist/js/select2.min.js') }}"></script>
<script src="{{asset('js/select2.min.js')}}" type="text/javascript"></script>
@endsection

@section('jQuery')
$("input[name='price']").TouchSpin({
    min: 1,
    initval: 10,
    max:9999999.99,
    step: 10,
    decimals: 2,
    boostat: 5,
    maxboostedstep: 10,
    postfix: '$ (USD)'
});
$("input[name='stock']").TouchSpin({
    min: 1,
    initval: 1,
    max:999,
    step: 1,
    boostat: 5,
    maxboostedstep: 10,
});
$(".select2").select2();

@endsection