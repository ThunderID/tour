@section('breadcrumb')
	<li>Home</li>
	<li>{!! HTML::link(route('admin.'.$controller_name .'.index'), ucwords(str_plural($controller_name))) !!}</li>
	<li class='active'>{{!$data->id ? 'Create' : 'Edit'}}</li>
@stop

@section('content')
	{!! Form::open(['url' => route('admin.' . $controller_name . '.store', $data->id), 'class' => 'form', 'files' => true]) !!}

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<a href='{{route("admin.".$controller_name.".index")}}' class='text-primary ink-reaction'>
				<span class='md md-keyboard-arrow-left'></span>
				All {{str_plural($controller_name)}}
			</a>
			{!! Form::submit('Save', ['class' => 'btn btn-flat btn-primary ink-reaction pull-right']) !!}
		</div>
	</div>

	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class='card'>
				<div class='card-body'>
					{{-- Name --}}
					<div class="form-group {{($errors->has('name') ? 'has-error has-feedback' : '')}}">
						{!! Form::text('name', $data->name, ['class' => ' form-control text-light', 'id' => 'name', 'tabindex' => 1])!!}
						<label for='name'>Name</label>
						@if ($errors->has('name'))
							<span class='glyphicon glyphicon-remove form-control-feedback'></span>
						@endif
					</div>

					{{-- Avatar --}}
					<div class="form-group {{($errors->has('avatar') ? 'has-error has-feedback' : '')}}">
						{!! Form::file('avatar', ['class' => ' form-control text-sm hidden', 'id' => 'avatar', 'tabindex' => 2, 'data-img' => $data->avatar])!!}
						<label for='avatar'>Avatar</label>
						@if ($errors->has('avatar'))
							<span class='glyphicon glyphicon-remove form-control-feedback'></span>
						@endif
					</div>

					{{-- Description --}}
					<div class="form-group {{($errors->has('description') ? 'has-error has-feedback' : '')}}">
						{!! Form::textarea('description', $data->description, ['class' => ' form-control text-light control-12-rows summernote', 'id' => 'description', 'style' => 'resize:none', 'tabindex' => 3])!!}
						<label for='description'>Description</label>
						@if ($errors->has('description'))
							<span class='glyphicon glyphicon-remove form-control-feedback'></span>
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class='card'>
				<div class='card-body'>
					{{-- Password --}}
					<div class="form-group {{($errors->has('password') ? 'has-error has-feedback' : '')}}">
						{!! Form::text('password', null, ['class' => ' form-control text-light', 'id' => 'password'])!!}
						<label for='password'>Password</label>
						@if ($errors->has('password'))
							<span class='glyphicon glyphicon-remove form-control-feedback'></span>
						@endif
					</div>

					{{-- Access --}}
					<div class="form-group {{($errors->has('password') ? 'has-error has-feedback' : '')}}">
						{!! Form::text('password', null, ['class' => ' form-control text-light', 'id' => 'password'])!!}
						<label for='password'>Password Confirmation</label>
						@if ($errors->has('password'))
							<span class='glyphicon glyphicon-remove form-control-feedback'></span>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
			{!! Form::submit('Save', ['class' => 'btn btn-flat btn-primary ink-reaction']) !!}
		</div>
	</div>

	{!! Form::close() !!}
@stop

@section('css')
	{!! HTML::style('css/summernote.css')!!}	
	{!! HTML::style('css/dropzone-theme.css')!!}	
@stop

@section('js')
	{!! HTML::script('js/summernote.min.js')!!}	
	<script>
		$('.summernote').summernote({
			height: 327,
			toolbar: [
				['style', ['bold', 'italic', 'underline', 'clear']],
				['font', ['strikethrough']],
				['fontsize', ['fontsize']],
				['para', ['ul', 'ol', 'paragraph']],
			  ]
		});

		$('#avatar').thumbnail_image_upload();
	</script>
@stop