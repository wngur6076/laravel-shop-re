<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="{{ asset('/color/assets/css/default/app.min.css') }}" rel="stylesheet" />
<!-- ================== END BASE CSS STYLE ================== -->

<!-- CSS Global Compulsory -->
<link rel="stylesheet" href="{{ asset('unify/assets/vendor/bootstrap/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('unify/assets/vendor/icon-line-pro/style.css') }}">
<link rel="stylesheet" href="{{ asset('unify/assets/vendor/icon-hs/style.css') }}">
<link rel="stylesheet" href="{{ asset('unify/assets/vendor/animate.css') }}">
<link rel="stylesheet" href="{{ asset('unify/assets/vendor/hs-megamenu/src/hs.megamenu.css') }}">
<link rel="stylesheet" href="{{ asset('unify/assets/vendor/hamburgers/hamburgers.min.css') }}">

<!-- CSS Unify -->
<link rel="stylesheet" href="{{ asset('unify/assets/css/unify-core.css') }}">
<link rel="stylesheet" href="{{ asset('unify/assets/css/unify-components.css') }}">
<link rel="stylesheet" href="{{ asset('unify/assets/css/unify-globals.css') }}">

@stack('css')
