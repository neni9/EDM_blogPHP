<!doctype html>
<html class="no-js" lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta charset="UTF-8">
        <title>Blog PHP- @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{url('assets/css/app.min.css')}}" media="all">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        @yield('head')
    </head>
    <body>
       
        @include('front.partials.nav')
        @include('front.partials.header')
     
        <div id="main" role="main" class="container">
            <div class="content col-md-9 col-lg-9 col-xs-12 col-sm-12">
                @yield('content')
            </div>
            <div class="sidebar-front col-md-3 hidden-xs hidden-sm">
                @section('sidebar')
                    @include('front.partials.sidebar')
                @show
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="{{url('assets/js/app.min.js')}}"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>

    </body>
</html>