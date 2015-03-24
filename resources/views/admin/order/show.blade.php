@section('breadcrumb')
	<li>Home</li>
	<li>{!! HTML::link(route('admin.'.$controller_name .'.index'), ucwords(str_plural($controller_name))) !!}</li>
	<li class='active'>{{!$data->id ? 'Create' : 'Edit'}}</li>
@stop

@section('content')

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<a href='{{route("admin.".$controller_name.".index")}}' class='text-primary ink-reaction'>
				<span class='md md-keyboard-arrow-left'></span>
				All {{$controller_name}}
			</a>

			<div class='pull-right'>
				<a href='{{route("admin.".$controller_name.".create", [$data->id])}}' class='ink-reaction btn btn-sm btn-primary '>Edit</a>
				<a href='javascript:;' data-form-method='get' data-form-action='{{route("admin.".$controller_name.".delete", [$data->id])}}' id='delete_btn' class='ink-reaction btn btn-sm btn-danger '>Delete</a>
			</div>
		</div>
	</div>

	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class='card'>
				<div class='card-body'>
					{{-- Name --}}
					<div class="form-group">
						<label for='name'>Name</label>
						<p class='form-control-static text-light'>{{$data->name}}</p>
					</div>

					{{-- Logo --}}
					<div class="form-group">
						<label for='logo'>Logo</label>
						<img src="{{$data->logo}}" class="img-responsive thumbnail" alt="Image">
					</div>

					{{-- Description --}}
					<div class="form-group">
						<label for='description'>Description</label>
						<p class='form-control-static text-light '><span class='text-sm'>{!! $data->description !!}</span></p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
			<div class='card'>
				<div class='card-body'>
					{{-- CP Name --}}
					<div class="form-group">
						<label for='contact_person.name'>Contact Person</label>
						<p class='form-control-static text-light'>{{ $data->contact_person['name']}}</p>
					</div>

					{{-- CP Phone --}}
					<div class="form-group">
						<label for='contact_person.phone'>Phone</label>
						<p class='form-control-static text-light'>{{ $data->contact_person['phone']}}</p>
					</div>

					{{-- CP Email --}}
					<div class="form-group">
						<label for='contact_person.email'>Email</label>
						<p class='form-control-static text-light'>{{ $data->contact_person['email']}}</p>
					</div>
				</div>
			</div>
			<div class='card'>
				<div class='card-body'>
					{{-- Addr Street --}}
					<div class="form-group">
						<label for='address.street'>Street</label>
						<p class='form-control-static text-light'>{{ $data->address['street']}}</p>
					</div>

					{{-- Addr City --}}
					<div class="form-group">
						<label for='address.city'>City</label>
						<p class='form-control-static text-light'>{{ $data->address['city']}}</p>
					</div>

					{{-- Addr Province --}}
					<div class="form-group">
						<label for='address.province'>Province</label>
						<p class='form-control-static text-light'>{{ $data->address['province']}}</p>
					</div>

					{{-- Addr Country --}}
					<div class="form-group">
						<label for='address.country'>Country</label>
						<p class='form-control-static text-light'>{{$data->address['country']}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
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

		$('#logo').thumbnail_upload();
		$('#delete_btn').type2confirm();
	</script>
@stop