@extends('auth.layout')

@section('content')
<div class="login-register" style="background-image:url({{asset('assets/images/background/login-register.jpg')}});">         
    <div class="login-box card">
    <div class="card-body">
        <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf
            <h3 class="box-title m-b-20">{{ __('Login') }}</h3>
            <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                <div class="col-xs-12">
                    <input placeholder="Email" class="form-control" id="email" type="email" class="form-control{{ $errors->has('email') ? ' form-control-danger' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="form-control-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
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
                <div class="col-md-12">
                    <div class="checkbox checkbox-primary pull-left p-t-0">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember"> {{ __('Remember Me') }} </label>
                    </div> <a href="{{ route('password.request') }}" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> {{ __('Forgot Your Password?') }}</a> </div>
            </div>
            <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">{{__('Login')}}</button>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                    <div class="social">
                        <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                        <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                    </div>
                </div>
            </div> --}}
            <div class="form-group m-b-0">
                <div class="col-sm-12 text-center">
                <p>Don't have an account? <a href="{{ route('register')}}" class="text-info m-l-5"><b>Sign Up</b></a></p>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>

@endsection
