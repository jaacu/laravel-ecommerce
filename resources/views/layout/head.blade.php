<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ecommerce</title>
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/template.css') }}">
<link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
<link href="{{ asset('css/colors/green-dark.css') }}" id="theme" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@yield('styles')