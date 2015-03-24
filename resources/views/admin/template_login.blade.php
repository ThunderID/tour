<html lang="en">
	<head>
		<title>{{$html_title}}</title>

		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="your,keywords">
		<meta name="description" content="Short explanation about this website">

		<!-- BEGIN STYLESHEETS -->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,300,400,600,700,800' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="{{ elixir('css/admin.css') }}" />
		<!-- Additional CSS includes -->
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="/assets/js/libs/utils/html5shiv.js"></script>
		<script type="text/javascript" src="/assets/js/libs/utils/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		@yield('content')

		<script src="{{elixir('js/admin.js')}}"></script>
	</body>
</html>