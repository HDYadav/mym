<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> @yield('title')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="colorlib.com">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="{{ asset('profile/fonts/material-design-iconic-font/css/material-design-iconic-font.css') }}">

		<!-- DATE-PICKER -->
		<link rel="stylesheet" href="{{ asset('profile/vendor/date-picker/css/datepicker.min.css') }}">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="{{ asset('profile/css/style.css') }}">


	<!-- <script src="{{ asset('profile/js/jquery-3.3.1.min.js') }}"></script> 

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

	 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	 <script src="http://parsleyjs.org/dist/parsley.js"></script>
-->

	  <script src="{{ asset('profile/js/jquery.min.js') }}"></script>  
 
<link rel="stylesheet" href="{{ asset('profile/css/bootstrap.min.css') }}">
<script src="{{ asset('profile/js/bootstrap.min.js') }}"></script> 
 <script src="{{ asset('profile/dist/parsley.js') }}"></script> 
 
  



	</head>
	<body>
		<div class="wrapper">
           @yield('content')
		</div>

	
		
		<!-- JQUERY STEP -->
		<script src="{{ asset('profile/js/jquery.steps.js') }}"></script>

		<script src="{{ asset('profile/js/main.js') }}"></script>
		<script src="{{ asset('profile/js/validation.js') }}"></script>

<!-- Template created and distributed by Colorlib -->




</body>
</html>