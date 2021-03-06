<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:site_name" content="Vecto" />
    <meta property="og:description" content="Vecto, from the latin word vectō, i.e. travel, was created with life journeys in mind." />
    <meta property="og:locale" content="{{ app()->getLocale() }}" />
    <meta property="og:url" content="{{url()->current()}}" />
    @yield('opengraph')

    <title>@yield("title")</title>

    <!-- Styles -->
    <link href="{{ asset('css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body class="bg-light">
    @include('partials.navbar')
    @yield('content')
    @include('partials.footer')

<!-- JavaScript -->
<script src="{{ asset('js/external/jquery-3.3.1.min.js') }}" ></script>
<script src="{{ asset('js/external/bootstrap.min.js') }}" ></script>
<script src="{{ asset('js/external/swal.min.js') }}" ></script>
<script src="{{ asset('js/app.js') }}" ></script>
@yield('scripts')

</body>

</html>