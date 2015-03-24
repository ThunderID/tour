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
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class='card'>
				<div class='card-body'>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							{{-- Name --}}
							<div class="form-group {{($errors->has('name') ? 'has-error has-feedback' : '')}}">
								{!! Form::text('name', $data->name, ['class' => ' form-control text-light', 'id' => 'name'])!!}
								<label for='name'>Name</label>
								@if ($errors->has('name'))
									<span class='glyphicon glyphicon-remove form-control-feedback'></span>
								@endif
							</div>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							{{-- Vendor --}}
							<div class="form-group {{($errors->has('vendor') ? 'has-error has-feedback' : '')}}">
								{!! Form::select('vendor', $vendor_list, $data->vendor, ['class' => ' form-control select2 text-light', 'id' => 'vendor'])!!}
								<label for='vendor'>Vendor</label>
								@if ($errors->has('vendor'))
									<span class='glyphicon glyphicon-remove form-control-feedback'></span>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class='row'>
		<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
			<div class='card '>
				<div class='card-body no-padding no-margin'>
					{{-- Description --}}
						{!! Form::textarea('description', $data->description, ['class' => ' form-control text-light control-12-rows summernote', 'id' => 'description', 'style' => 'resize:none', 'tabindex' => 3])!!}
						@if ($errors->has('description'))
							<span class='glyphicon glyphicon-remove form-control-feedback'></span>
						@endif
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
			<div class='card'>
				<div class='card-body'>
					<div class="row">
						<div class="form-group {{($errors->has('destination') ? 'has-error has-feedback' : '')}}">
							{!! Form::text('destination', implode(',',$data->destination_ids), ['class' => ' form-control text-light select2-load-destination', 'id' => 'destination'])!!}
							<label for='destination'>Related Destination</label>
							@if ($errors->has('destination'))
								<span class='glyphicon glyphicon-remove form-control-feedback'></span>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class='row'>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class='card'>
				<div class='card-body'>
					<div class="row">
						<div class="form-group {{($errors->has('gallery') ? 'has-error has-feedback' : '')}}">
							{!! Form::text('gallery', implode(',',$data->gallery_ids), ['class' => ' form-control text-light select2-load-gallery', 'id' => 'gallery'])!!}
							<label for='gallery'>Gallery</label>
							@if ($errors->has('gallery'))
								<span class='glyphicon glyphicon-remove form-control-feedback'></span>
							@endif
						</div>
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

		function repoFormatResult(repo) {
			var markup = repo.name;

			return markup;
		}

		function repoFormatSelection(repo) {
			return repo.name;
		}

		$('.select2-load-destination').select2({
			placeholder: 'select destination',
			multiple: true,
			minimumInputLength: 3,
			quietMillis: 100,
			id: function(data) { return data._id; },
			ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
					url: "{{route('api.destination.search')}}",
					dataType: 'json',
					quietMillis: 250,
					data: function (term, page) {
							return {
								q: term, // search term
							};
						},
					results: function (data, page) { // parse the results into the format expected by Select2.
							// since we are using custom formatting functions we do not need to alter the remote JSON data
							console.log(data);
							return { results: data };
						},
					cache: true
			},
			initSelection: function(element, callback) {
					// the input tag has a value attribute preloaded that points to a preselected repository's id
					// this function resolves that id attribute to an object that select2 can render
					// using its formatResult renderer - that way the repository name is shown preselected
					var id = $(element).val();
					if (id !== "") 
					{
						$.ajax("{{route('api.destination.find')}}?id=" + id, {
							dataType: "json"
						}).done(function(data) { callback(data); });
					}
			},
			formatResult: repoFormatResult, // omitted for brevity, see the source of this page
			formatSelection: repoFormatSelection, // omitted for brevity, see the source of this page
			dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
			escapeMarkup: function (m) { return m; } // we do not want to escape markup since we are displaying html in results
		});
	</script>
@stop