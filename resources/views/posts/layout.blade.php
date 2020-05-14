<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <title>Blog - @yield('title')</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
    <link href="{{ asset("css/default.css") }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset("css/fonts.css") }}" rel="stylesheet" type="text/css" media="all" />

</head>
<body>
<div id="header-wrapper">
    <div id="header" class="container">
        <div id="logo">
            <h1><a href="/">Blog</a></h1>
        </div>
        <div id="menu">
            <ul>
                <li class="{{ Request::path() == '/'? 'current_page_item':'' }}"><a href="/" accesskey="1" title="">Homepage</a></li>
                <li class="{{ Request::path() == 'd'? 'current_page_item':'' }}"><a href="#" accesskey="2" title="">Our Clients</a></li>
                <li class="{{ Request::path() == 'about'? 'current_page_item':'' }}"><a href="/about" accesskey="3" title="">About Us</a></li>
                <li class="{{ Request::is('articles*') ? 'current_page_item':'' }}"><a href="/articles" accesskey="4" title="">Articles</a></li>
                <li class="{{ Request::path() == 'f'? 'current_page_item':'' }}"><a href="#" accesskey="5" title="">Contact Us</a></li>
            </ul>
        </div>
    </div>
@yield('header')
</div>
    @yield('content')
    <div id="copyright" class="container">
        <p>&copy; Untitled. All rights reserved. | Photos by <a href="http://fotogrph.com/">Fotogrph</a> | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</p>
    </div>
</body>
</html>
