@section('breadcrumb')
	<li>Home</li>
	<li class='active'>{{ucwords(str_plural($controller_name))}}</li>
@stop

@section('content')
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<br>
			<a href='{{route("admin.".$controller_name.".create")}}' class='btn btn-primary btn-raised ink-reaction'>Create</a>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form">
			{!! Form::open(['url' => route('admin.'.$controller_name.'.index'), 'method' => 'get', 'class' => 'form']) !!}
				<div class="form-group floating-label">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-search"></i></span>
						<div class="input-group-content">
							{!! Form::text("q", Input::get('q'), ['class' => 'form-control text-light']) !!}
							<label for="search">Search</label>
						</div>
					</div>
				</div><!--end .form-group -->
			{!! Form::close() !!}
		</div>
	</div>

	<div class='card'>
		<div class='card-body'>
			<table class="table table-responsive no-margin">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Location</th>
						<th>Contact Person</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@if ($data->count())
						<?php $i = -1; ?>
						@foreach ($data as $x)
							<tr>
								<td>{{$data->firstItem() + ++$i}}</td>
								<td>{{$x->name}}</td>
								<td>{{$x->address['city']}}, {{$x->address['country']}}</td>
								<td>{{$x->contact_person['name']}}</td>
								<td class='text-center'>
									<a href='{{route("admin.".$controller_name.".create", [$x->id])}}' class='btn btn-flat  btn-primary'>Edit</a>
									<a href='{{route("admin.".$controller_name.".show", [$x->id])}}' class='btn btn-flat  btn-primary'>Show</a>
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan='5' class='text-center text-light text-xs'>No data found</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
		@if ($data->nextPageUrl())
			<div class='card-actionbar-row'>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-left text-regular text-default-light ">
					<br>
					Displaying {{$data->firstItem()}} - {{$data->lastItem()}} of {{$data->total()}}
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					{!! $data->render() !!}
				</div>
			</div>
		@endif
	</div>
@stop