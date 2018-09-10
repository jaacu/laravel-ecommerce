@extends('auth.layout')
@section('content')

    <div class="login-box card">
    <div class="card-body">
        <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                @csrf
            <h3 class="box-title m-b-20">{{ __('Register') }}</h3>
            <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }} ">
                <div class="col-xs-12">
                    <input placeholder="{{ __('Name') }}" id="name" type="text" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" name="name" value="{{ old('name') }}" required autofocus >
                    @if ($errors->has('name'))
                        <span class="form-control-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}  ">
                <div class="col-xs-12">
                        <input placeholder="{{ __('Email Address') }}" id="email" type="email" class="form-control{{ $errors->has('email') ? ' form-control-danger' : '' }}" name="email" value="{{ old('email') }}" required >

                        @if ($errors->has('email'))
                            <span class="form-control-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}  ">
                <div class="col-xs-12">
                        <input placeholder="{{ __('Password') }}" id="password" type="password" class="form-control{{ $errors->has('password') ? ' form-control-danger' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="form-control-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                        <input placeholder="{{ __('Confirm Password') }}" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
            <div class="form-group {{ $errors->has('rol') ? ' has-danger' : '' }}  ">
                    <div class="col-xs-12">
                            <select class="form-control {{ $errors->has('rol') ? ' form-control-danger' : '' }}" name="rol" id="rol">
                                <option value="3">Client</option>
                                <option value="4">Shopkeeper</option>
                            </select>
                            @if ($errors->has('rol'))
                                <span class="form-control-feedback" role="alert">
                                    <strong>{{ $errors->first('rol') }}</strong>
                                </span>
                            @endif
                    </div>
            </div>
            <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">{{ __('Register') }}</button>
                </div>
            </div>
            <div class="form-group m-b-0">
                <div class="col-sm-12 text-center">
                    <p>Already have an account? <a href="{{ route('login')}} " class="text-info m-l-5"><b>{{__('Login') }}</b></a></p>
                </div>
            </div>
        </form>
        
    </div>
  </div>

@endsection
