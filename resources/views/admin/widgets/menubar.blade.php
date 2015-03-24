<div class="menubar-fixed-panel">
	<div>
		<a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
			<i class="fa fa-bars"></i>
		</a>
	</div>
	<div class="expanded">
		<a href="../../html/dashboards/dashboard.html">
			<span class="text-lg text-bold text-primary ">{{$html_title}}</span>
		</a>
	</div>
</div>
<div class="menubar-scroll-panel">

	<!-- BEGIN MAIN MENU -->
	{!! $nav->render() !!}
	<!-- END MAIN MENU -->

	<div class="menubar-foot-panel">
		<small class="no-linebreak hidden-folded">
			<span class="opacity-75">Copyright &copy; 2014</span> <strong>Thunder.id</strong>
		</small>
	</div>
</div><!--end .menubar-scroll-panel-->
