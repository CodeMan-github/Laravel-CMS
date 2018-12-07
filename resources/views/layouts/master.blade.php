<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="author" content="{{$settings_general->site_url}}">
    <meta class="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{$settings_general->favicon}}" type="image/x-icon"/>
    <link rel="apple-touch-icon" sizes="57x57" href="{{$settings_general->logo_76}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{$settings_general->logo_76}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{$settings_general->logo_76}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{$settings_general->logo_76}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{$settings_general->logo_120}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{$settings_general->logo_120}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{$settings_general->logo_152}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{$settings_general->logo_152}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{$settings_general->logo_152}}">

    <link rel="icon" type="image/png" href="{{$settings_general->favicon}}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{$settings_general->logo_76}}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{$settings_general->logo_120}}" sizes="96x96">
    <link rel="icon" type="image/png" href="{{$settings_general->logo_152}}" sizes="192x192">

    <link rel="stylesheet" href="/css/reset.css">

    {!! $settings_seo->google_verify !!}

    {!! $settings_seo->bing_verify !!}

    {!! $settings_custom_css->custom_css !!}

    {!! $settings_custom_js->custom_js !!}

    {!! $settings_general->analytics_code !!}




    <!-- Google Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Roboto:100,300,300italic,400,400italic,500,700,700italic,900"
          rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700,700italic" rel="stylesheet"
          type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Raleway:900" rel="stylesheet" type="text/css">

    <!-- Icon Font -->
    <link rel="stylesheet" href="/plugins/font-awesome/css/font-awesome.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/raty/jquery.raty.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="/css/style.min.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('extra_css')
</head>
<body>
<div id="main" class="header-style1" style="direction: {{env('DIRECTION')}}">

    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

</div>
<!-- End Main -->

@include('layouts.mobile_nav')

<div id="go-top-button" class="fa fa-angle-up" title="Scroll To Top"></div>

<div class="mobile-overlay" id="mobile-overlay"></div>

<script src="/js/jquery-1.11.2.min.js"></script>
<script src="/js/modernizr.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.js"></script>
<script src="/plugins/raty/jquery.raty.js"></script>
<script src="/js/script.min.js"></script>
<script src="/js/custom.js"></script>

@yield('extra_js')

</body>

</html>