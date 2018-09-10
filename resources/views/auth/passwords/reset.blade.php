@extends('auth.layout')

@section('content')
    <div class="login-box card">
    <div class="card-body">
        <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <h3 class="box-title m-b-20">{{ __('Reset Password') }}</h3>
            <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                <div class="col-xs-12">
                    <input placeholder="Email" class="form-control" id="email" type="email" class="form-control{{ $errors->has('email') ? ' form-control-danger' : '' }}" name="email"  value="{{ $email ?? old('email') }}" required autofocus>
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
                    <div class="col-xs-12">
                            <input placeholder="{{ __('Confirm Password') }}" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
            </div>
            <div class="form-group text-center m-t-20">
                <div class="col-xs-12">
                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">{{ __('Reset Password') }}</button>
                </div>
            </div>
        </form>
    </div>
    </div>

@endsection
