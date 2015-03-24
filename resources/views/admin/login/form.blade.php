@section('content')
	<section class="section-account">
		<div class="img-backdrop" style="background-image: url('{{asset("images/login-bg.jpg")}}')"></div>
		<div class="spacer"></div>
		<div class="card contain-sm style-transparent">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-6">
						<br/>
						<span class="text-lg text-bold text-primary">CONTROL PANEL</span>

						<br/><br/>
						<form class="form floating-label" action="{{ route('admin.login.post') }}" accept-charset="utf-8" method="post">
							<input type='hidden' name='_token' value="{{csrf_token()}}">
							@include('admin.widgets.alerts')
							<div class="form-group">
								<input type="text" class="form-control" id="username" name="username">
								<label for="username">Username</label>
							</div>
							<div class="form-group">
								<input type="password" class="form-control" id="password" name="password">
								<label for="password">Password</label>
							</div>
							<br/>
							<div class="row">
								<div class="col-xs-6 text-left">
									<div class="checkbox checkbox-inline checkbox-styled">
										<label>
											<input type="checkbox" name='remember'> <span>Remember me</span>
										</label>
									</div>
								</div><!--end .col -->
								<div class="col-xs-6 text-right">
									<button class="btn btn-primary btn-raised" type="submit">Login</button>
								</div><!--end .col -->
							</div><!--end .row -->
						</form>
					</div><!--end .col -->
					
					<div class="col-sm-5 col-sm-offset-1 text-center">
						<br><br>
						<h3 class="text-light">
							Unauthorized User?
						</h3>
						<p class='text-left'>
							If you are an unauthorized user to control panel, please leave this page. 
							We are tracking IP Addresses and we will take legal action for anyone trying to breach our system
						</p>

						<h3 class="text-light">
							Forgot Your Password?
						</h3>
						<p class='text-left'>Please contact your system administrator to retrieve your new password</p>
						<br><br><br>
					</div><!--end .col -->

				</div><!--end .row -->
			</div><!--end .card-body -->
		</div><!--end .card -->
	</section>
	<!-- END LOGIN SECTION -->
@stop