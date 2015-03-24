@foreach (['alert_success', 'alert_warning', 'alert_danger', 'alert_info'] as $alert)
	@if (Session::has($alert))
		<div class='alert {{str_replace("alert_", "style-", $alert)}}'>
				@if (is_array(Session::get($alert)))
					@foreach (Session::get($alert) as $message)
						<p>{{$message}}</p>
					@endforeach
				@else
					<p>{{Session::get($alert)}}</p>
				@endif
		</div>
	@endif
@endforeach

@if ($errors->count())
	<div class='alert style-danger'>
		@foreach ($errors->all('<p>:message</p>') as $error)
			{!! $error !!}
		@endforeach
	</div>
@endif