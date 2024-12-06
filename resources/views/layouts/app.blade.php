<!doctype html>

<?php
    $theme = 'light';
    $font = '';
    if (Auth::check()) {
        $data_them = Auth::user()->sSetup;
        if($data_them != '' && $data_them != null) {
            $array = json_decode($data_them, true);
            $theme =  $array['ntp_mode'] = 0? 'light' : 'dark';
            $font = $array['ntp_font'];
        }
    }
?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="{{$theme}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('uploads\logo\Logo.jpg') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/global.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick_theme.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet">

    @if (isset($isSingle) && $isSingle)
        <link href="{{ asset('css/single.css') }}" rel="stylesheet">
    @endif

    @if (isset($is_user_page) && $is_user_page)
        <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    @endif

    @if (isset($is_chapter_page) && $is_chapter_page)
        <link href="{{ asset('css/chapter.css') }}" rel="stylesheet">
    @endif

     @if (isset($is_author_page) && $is_author_page)
        <link href="{{ asset('css/author.css') }}" rel="stylesheet">
    @endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/slick.min.js') }}" defer></script>

    <script src="{{ asset('js/main.min.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/ea5e6a5537.js" crossorigin="anonymous"></script>




</head>

<body style="font-family: {{$font}}; background-image: url({{ asset('uploads/background/truyen-tien-hiep-hay-1.jpg') }});
        background-size: 100% auto;
         background-repeat: repeat-y;">
    <div id="app">
        <main class="main" >
            @include('layouts.nav')
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
</body>

</html>
