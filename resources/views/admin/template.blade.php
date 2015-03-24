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
		@section('css')
		@show
		<!-- Additional CSS includes -->
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="js/html5shiv.js"></script>
		<script type="text/javascript" src="js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="header-fixed ">
		<header id="header">
			@include('admin.widgets.headerbar')
		</header>
		<div id="base" class="menubar-hoverable">
			<div class="offcanvas">
			</div>
			<div id="content">
				<section>
					<div class="section-header">
						<ol class="breadcrumb">
							@yield('breadcrumb')
						</ol>
					</div><!--end .section-header -->
					<div class="section-body contain-lg">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<h1 class='text-primary'>{{$page_title}} <small>{{Input::get('page') > 1 ? ' / Page ' . Input::get('page') : ""}}</small> </h1>
								@include('admin.widgets.alerts')
								@yield('content')
							</div>
						</div>
					</div><!--end .section-body -->
				</section>
			</div>
			<div id="menubar">
				@include('admin.widgets.menubar')
			</div>
			<div class="offcanvas">
			</div>
		</div>

		<script src="{{elixir('js/admin.js')}}"></script>
		<script>
			$('.select2').select2();
			$('.select2-tags').select2({
				tags: [],
				tokenSeparators: [',', "'", '"', " "]

			});
		</script>

		@section('js')
		@show
	</body>
</html>