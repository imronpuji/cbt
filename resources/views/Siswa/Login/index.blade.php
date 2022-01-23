<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login Page</title>
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
	<link href="{{ asset('sb-admin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('sb-admin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body id="page-top" class="bg-light">
	<div class="wrapper">
		<div class="row container-login">
			<div class="col-md-4 login-page">
				<div class="text-center">			
					<img src="{{ asset('logo/school.png') }}" style="width: 100px;" />
					<h5><strong>COMPUTER BASED TEST</strong></h5>
				</div><br/>
				<div class="card shadow mb-4">
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Login Peserta CBT</h6>
					</div>
					<div class="card-body">
						@if(Session::has('error'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							{{ Session::get('error') }}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						@endif
						<form action="{{ url('login_siswa') }}" method="POST">
							@csrf
							<div class="form-group">						
								<div class="input-group mb-3">
									<input type="text" name="nis" class="form-control" placeholder="Nomor Induk Siswa" />
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i></span>				
									</div>
								</div>
							</div>
							<div class="form-group">						
								<div class="input-group mb-3">
									<input type="password" name="password" class="form-control" placeholder="Password" />
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2"><i class="fa fa-lock"></i></span>
									</div>
								</div>
							</div>
							<button class="btn btn-primary btn-block" type="submit">Login</button>
						</form>
						<hr/>
						<div class="text-center">
							&copy;2020
						</div>
					</div>
				</div>
			</div>			

		</div>	
	</div>
	<script src="{{ asset('sb-admin2/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('sb-admin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('sb-admin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
	<script src="{{ asset('sb-admin2/js/sb-admin-2.min.js') }}"></script>
</body>
</html>