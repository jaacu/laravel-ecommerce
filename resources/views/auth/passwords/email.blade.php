@extends('auth.layout')

@section('content')
@if (session('status'))
    <div class="alert alert-success w-100 text-center" style="position: fixed; top:0;"> {{ session('status') }} 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
    </div>
@endif
        
    <div class="login-box card">
    <div class="card-body">
        <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
            @csrf
            <h3 class="box-title m-b-20">{{ __('Reset Password') }}</h3>
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
            <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block  waves-effect waves-light" type="submit">{{ __('Send Password Reset Link') }}</button>
                    </div>
            </div>
        </form>
    </div>
    </div>

@endsection
