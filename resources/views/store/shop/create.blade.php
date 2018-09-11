@extends('master')

@section('content')
<div class="col-xs-6 col-7 mx-auto">
    <form class="form-material m-t-40" method="POST" action="{{ route('shop.store') }}">
        @csrf
        <div class="form-group">
            <h1 class="text-center text-info mt-3"> Time to create Your very own Shop!!!</h1>
        </div>
        <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }} ">
                <div class="col-xs-12">
                    <h3><label for="name">Your Shop's Name </label></h3>
                    <input placeholder=" e.g Happy Joe's Shoe Store" id="name" type="text" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" name="name" value="{{ old('name') }}" required autofocus >
                    @if ($errors->has('name'))
                        <span class="form-control-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
        </div>
        <div class="form-group {{ $errors->has('description') ? ' has-danger' : '' }} ">
                <div class="col-xs-12">
                    <h3><label for="description">Your Shop's Description </label></h3>
                    <textarea class="form-control{{ $errors->has('description') ? ' form-control-danger' : '' }}" rows="5" placeholder=" e.g Happy Joe's It's a Store where you can find all kinds of fun shoes!!! " id="description" name="description"  required >{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="form-control-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
        </div>
        <div class="form-group text-center m-t-20">
                    <button class="btn btn-outline-info btn-rounded btn-block waves-effect waves-light" type="submit">{{ __('Create Shop') }}</button>
        </div>
    </form>
</div>
@endsection