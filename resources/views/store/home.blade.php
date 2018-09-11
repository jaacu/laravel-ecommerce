@extends('master')

@section('content')
{{ App\Shop::all() }}
@endsection