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

					{{-- Logo --}}
					<div class="form-group {{($errors->has('logo') ? 'has-error has-feedback' : '')}}">
						{!! Form::file('logo', ['class' => ' form-control text-sm hidden', 'id' => 'logo', 'tabindex' => 2, 'data-img' => $data->logo])!!}
						<label for='logo'>Logo</label>
						@if ($errors->has('logo'))
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
					{{-- CP Name --}}
					<div class="form-group {{($errors->has('contact_person.name') ? 'has-error has-feedback' : '')}}">
						{!! Form::text('contact_person.name', $data->contact_person['name'], ['class' => ' form-control text-light', 'id' => 'contact_person.name'])!!}
						<label for='contact_person.name'>Contact Person</label>
						@if ($errors->has('contact_person.name'))
							<span class='glyphicon glyphicon-remove form-control-feedback'></span>
						@endif
					</div>

					{{-- CP Phone --}}
					<div class="form-group {{($errors->has('contact_person.phone') ? 'has-error has-feedback' : '')}}">
						{!! Form::text('contact_person.phone', $data->contact_person['phone'], ['class' => ' form-control text-light', 'id' => 'contact_person.phone'])!!}
						<label for='contact_person.phone'>Phone</label>
						@if ($errors->has('contact_person.phone'))
							<span class='glyphicon glyphicon-remove form-control-feedback'></span>
						@endif
					</div>

					{{-- CP Email --}}
					<div class="form-group {{($errors->has('contact_person.email') ? 'has-error has-feedback' : '')}}">
						{!! Form::text('contact_person.email', $data->contact_person['email'], ['class' => ' form-control text-light', 'id' => 'contact_person.email'])!!}
						<label for='contact_person.email'>Email</label>
						@if ($errors->has('contact_person.email'))
							<span class='glyphicon glyphicon-remove form-control-feedback'></span>
						@endif
					</div>
				</div>
			</div>
			<div class='card'>
				<div class='card-body'>
					{{-- Addr Street --}}
					<div class="form-group {{($errors->has('address.street') ? 'has-error has-feedback' : '')}}">
						{!! Form::text('address.street', $data->address['street'], ['class' => ' form-control text-light', 'id' => 'address.street'])!!}
						<label for='address.street'>Street</label>
						@if ($errors->has('address.street'))
							<span class='glyphicon glyphicon-remove form-control-feedback'></span>
						@endif
					</div>

					{{-- Addr City --}}
					<div class="form-group {{($errors->has('address.city') ? 'has-error has-feedback' : '')}}">
						{!! Form::text('address.city', $data->address['city'], ['class' => ' form-control text-light', 'id' => 'address.city'])!!}
						<label for='address.city'>City</label>
						@if ($errors->has('address.city'))
							<span class='glyphicon glyphicon-remove form-control-feedback'></span>
						@endif
					</div>

					{{-- Addr Province --}}
					<div class="form-group {{($errors->has('address.province') ? 'has-error has-feedback' : '')}}">
						{!! Form::text('address.province', $data->address['province'], ['class' => ' form-control text-light', 'id' => 'address.province'])!!}
						<label for='address.province'>Province</label>
						@if ($errors->has('address.province'))
							<span class='glyphicon glyphicon-remove form-control-feedback'></span>
						@endif
					</div>

					{{-- Addr Country --}}
					<div class="form-group {{($errors->has('address.country') ? 'has-error has-feedback' : '')}}">
						{!! Form::select('address.country', $country_list, $data->address['country'], ['class' => ' form-control text-light text-xs', 'id' => 'address.country', 'data-source' => asset('data/countries.json')])!!}
						<label for='address.country'>Country</label>
						@if ($errors->has('address.country'))
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

		$('#logo').thumbnail_image_upload();
	</script>
@stop