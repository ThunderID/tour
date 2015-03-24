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
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
							{{-- Name --}}
							<div class="form-group {{($errors->has('name') ? 'has-error has-feedback' : '')}}">
								{!! Form::text('name', $data->name, ['class' => ' form-control text-light', 'id' => 'name', 'tabindex' => 1])!!}
								<label for='name'>Name</label>
								@if ($errors->has('name'))
									<span class='glyphicon glyphicon-remove form-control-feedback'></span>
								@endif
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
							{{-- Category --}}
							<div class="form-group {{($errors->has('categories') ? 'has-error has-feedback' : '')}}">
								{!! Form::select('categories[]', $destination_categories, $data->categories, ['class' => ' form-control select2 text-light', 'id' => 'categories', 'multiple' => 'multiple'])!!}
								<label for='categories'>Categories</label>
								@if ($errors->has('categories'))
									<span class='glyphicon glyphicon-remove form-control-feedback'></span>
								@endif
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
							{{-- Tag --}}
							<div class="form-group {{($errors->has('tags') ? 'has-error has-feedback' : '')}}">
								{!! Form::text('tags', implode(',', $data->tags), ['class' => ' form-control text-light select2-tags', 'id' => 'tags'])!!}
								<label for='tags'>Tags</label>
								@if ($errors->has('tags'))
									<span class='glyphicon glyphicon-remove form-control-feedback'></span>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class='card card-underline'>
				<div class='card-head height-1'>
					<header>
						<h1>Gallery</h1>
					</header>
				</div>
				<div class='card-body height-5'>
					<div class='row'>
						@for ($i = 0; $i < 12; $i++)
							<div class="col-xs-4 col-sm-4 col-md-3 col-lg-2">
								{!! Form::file('image_' . $i, ['class' => 'form-control image_upload']) !!}
							</div>
						@endfor
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- MAP --}}
	<div class='row'>
		<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>
			<div class='card card-underline'>
				<div class='card-head height-1'>
					<header>
						<div class="row">	
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
								<input type='text' name='search_geo' class='form-control text-light' placeholder='search...' autocomplete="off" style='font-size:12px'>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
								<a class='btn btn-primary btn-sm' href='javascript:;' id='gmap_search'>
									<i class='md md-place'></i> Search
								</a>
							</div>
						</div>
					</header>
				</div>
				<div class='card-body height-10' id='map'>
				</div>
			</div>
		</div>
		<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>
			<div class='card height-11' >
				<div class='card-body'>
					{!! Form::hidden('address_latitude', ($data->address['latitude'] ? $data->address['latitude'] : -6.2087634)) !!}
					{!! Form::hidden('address_longitude', ($data->address['longitude'] ? $data->address['longitude'] : 106.84559899999999))!!}


					{{-- Lat & Lng --}}
					<div class="form-group {{($errors->has('address_street') ? 'has-error has-feedback' : '')}}">
						<label for='description'>Latitude &amp; Longitude</label>
						<p class='form-control-static text-light '><span class='' id='text_latlng'>
							{!! $data->address['latitude'] ? $data->address['latitude'] : '-' !!},
							{!! $data->address['longitude'] ? $data->address['longitude'] : '-' !!}
						</span></p>
					</div>
					
					{{-- Addr Street --}}
					<div class="form-group {{($errors->has('address_street') ? 'has-error has-feedback' : '')}}">
						{!! Form::text('address_street', $data->address['street'], ['class' => ' form-control text-light', 'id' => 'address_street'])!!}
						<label for='address_street'>Street</label>
						@if ($errors->has('address_street'))
							<span class='glyphicon glyphicon-remove form-control-feedback'></span>
						@endif
					</div>

					{{-- Addr City --}}
					<div class="form-group {{($errors->has('address_city') ? 'has-error has-feedback' : '')}}">
						{!! Form::text('address_city', $data->address['city'], ['class' => ' form-control text-light', 'id' => 'address_city'])!!}
						<label for='address_city'>City</label>
						@if ($errors->has('address_city'))
							<span class='glyphicon glyphicon-remove form-control-feedback'></span>
						@endif
					</div>

					{{-- Addr Province --}}
					<div class="form-group {{($errors->has('address_province') ? 'has-error has-feedback' : '')}}">
						{!! Form::text('address_province', $data->address['province'], ['class' => ' form-control text-light', 'id' => 'address_province'])!!}
						<label for='address_province'>Province</label>
						@if ($errors->has('address_province'))
							<span class='glyphicon glyphicon-remove form-control-feedback'></span>
						@endif
					</div>

					{{-- Addr Country --}}
					<div class="form-group {{($errors->has('address_country') ? 'has-error has-feedback' : '')}}">
						{!! Form::select('address_country', $country_list, $data->address['country'], ['class' => ' form-control text-light ', 'id' => 'address_country', 'data-source' => asset('data/countries.json')])!!}
						<label for='address_country'>Country</label>
						@if ($errors->has('address_country'))
							<span class='glyphicon glyphicon-remove form-control-feedback'></span>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class='row'>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
	{!! HTML::script('js/dropzone.min.js')!!}	
	{!! HTML::script('http://maps.google.com/maps/api/js?sensor=true')!!}	
	{!! HTML::script('js/gmaps.js')!!}	
	<script>
		var map;
		var marker;

		// Search button
		$("#gmap_search").on('click',function(e){
			$(this).prop('disabled', true);
			GMaps.geocode({
				address: $('input[name=search_geo]').val(),
				callback: function(results, status) 
						{
							if (status == 'OK') 
							{
								var latLng = results[0].geometry.location;
								map.setCenter(latLng.lat(), latLng.lng());
								marker.setPosition({
									lat: latLng.lat(),
									lng: latLng.lng()
								});

								// get location name
								populate_address(map, latLng);
							}
							else 
							{
								alert("Cannot find location");
							}
							$("#gmap_search").prop('disabled', false);
						}
				});
		});

		function populate_address(map, latLng)
		{
			var country = '';
			var province = '';
			var city = '';
			var street = '';

			geocoder = new google.maps.Geocoder();
			geocoder.geocode({'latLng': latLng}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) 
				{
					console.log(results);
					for (i = 0; i < results.length; i++)
					{
						for (j = 0; j <results[i].address_components.length; j++)
						{
							if (results[i].address_components[j].types.indexOf('country') != -1)
							{
								country = results[i].address_components[j].long_name;
							}
							if (results[i].address_components[j].types.indexOf('administrative_area_level_1') != -1)
							{
								province = results[i].address_components[j].long_name;
							}
							if (results[i].address_components[j].types.indexOf('locality') != -1)
							{
								city = results[i].address_components[j].long_name;
							}
							if (results[i].address_components[j].types.indexOf('route') != -1)
							{
								street = results[i].address_components[j].long_name;
							}
						}
					}
					
					console.log(city);
					console.log(province);
					console.log(country);

					$('input[name=address_latitude]').val(latLng.lat());
					$('input[name=address_longitude]').val(latLng.lng());
					$('select[name=address_country]').val(country);
					$('input[name=address_province]').val(province);
					$('input[name=address_city]').val(city);
					$('input[name=address_street]').val(street);
					$('span#text_latlng').html(latLng.lat() + ', ' + latLng.lng());
				} 
				else 
				{
					alert("Location not found");
				}
			});
		}

		function sendFile(file, editor, welEditable) 
		{
			data = new FormData();
			data.append("file", file);
			data.append('_token', $('input[name=_token]').val());

			$.ajax({
				data: data,
				type: "POST",
				url: "{{ route('api.upload.image')}}",
				cache: false,
				contentType: false,
				processData: false,
				success: function(url) {
                    editor.restoreRange(welEditable);
					editor.insertImage(welEditable, url);
				}
			});
		}

		$(document).ready(function(){
			initial_marker_latlng = new google.maps.LatLng($('input[name=address_latitude]').val(), $('input[name=address_longitude]').val());
			populate_address(map, initial_marker_latlng);
			// gmap
			map = new GMaps({
				div: '#map',
				zoom: 15,
				lat: initial_marker_latlng.lat(),
				lng: initial_marker_latlng.lng()
			});

			marker = map.addMarker({
				lat: initial_marker_latlng.lat(),
				lng: initial_marker_latlng.lng(),
				draggable: true,
			})

			google.maps.event.addListener(marker, 'dragend', function(event) {
				populate_address(map, event.latLng);
			});

			// summernote
			$('.summernote').summernote({
				height: 600,
				toolbar: [
					['style', ['bold', 'italic', 'underline', 'clear']],
					['font', ['strikethrough']],
					['fontsize', ['fontsize']],
					['insert',['link','picture','table']],
					['para', ['ul', 'ol', 'paragraph']],
				  ],
				onImageUpload: function(files, editor, welEditable) {
					sendFile(files[0], editor, welEditable);
				}
			});

			// file upload
			$('.image_upload').thumbnail_image_upload();

			// ------------------------------- SEARCH BY LOCATION NAME ---------------------------
			// Enter on textbox
			$("input[name=search_geo]").on('keydown', function(event){
				if(event.keyCode == 13){
					$("#gmap_search").click();
					event.preventDefault();
				}
			});

		});

		// resize window maintain google map size
		window.addEventListener('resize', function(event){
			$('div#map').css('width', '100%');
		});

	</script>
@stop