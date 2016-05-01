<!doctype html>
<html class="no-js" lang="fr">
	<head>
	    <meta charset="UTF-8">
	    <meta charset="UTF-8">
	    <title>Blog PHP - @yield('title')</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" type="text/css">
	    <link rel="stylesheet" href="{{url('assets/css/jquery-ui-timepicker-addon.css')}}" type="text/css">
	    <link rel="stylesheet" href="{{url('assets/css/app.min.css')}}" media="all">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

	    @yield('head')
	</head>
	<body>
		
		@include('admin.partials.nav')
	

		<div id="wrapper" class="">
			@include('admin.partials.sidebar')

	        <div id="page-content-wrapper">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-lg-12">
	                       @yield('content')
	                    </div>
	                </div>
	            </div>
	        </div>

    	</div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<script src="{{url('assets/js/jquery-ui-timepicker-addon.min.js')}}"></script>
		<script src="{{url('assets/js/app.min.js')}}"></script>
		
	</body>
</html>

