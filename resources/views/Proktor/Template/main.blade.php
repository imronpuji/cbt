<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Proktor - Dashboard</title>
	<!-- Custom fonts for this template-->
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
	<link href="{{ asset('sb-admin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="{{ asset('sb-admin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('sb-admin2/vendor/datatables/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-timepicker/jquery.timepicker.min.css') }}">
</head>
<body id="page-top">
	<div id="wrapper">
		@include('Proktor/Template/sidebar')
		<div id="content-wrapper" class="d-flex flex-column">
			@include('Proktor/Template/navbar')
			<!-- Main Content -->
			<div id="content">
				<!-- Begin Page Content -->
				<div class="container-fluid">
					@yield('content')
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- End of Main Content -->
			<!-- Footer -->
			@include('Proktor/Template/footer')
			<!-- End of Footer -->
		</div>
	</div>
	<script src="{{ asset('sb-admin2/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('sb-admin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('sb-admin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
	<script src="{{ asset('sb-admin2/js/sb-admin-2.min.js') }}"></script>
	<script src="{{ asset('plugins/jquery-timepicker/jquery.timepicker.min.js') }}"></script>
	<script src="{{ asset('sb-admin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('sb-admin2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('sb-admin2/vendor/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
	<script>
		$(function () {
	       // menampilkan datetime
	       $('#datepicker').datepicker({
		        dateFormat: 'yy-mm-dd',
		        changeMonth: true,
		        changeYear: true,
		        yearRange : '1990:2050',  
		        autoclose: true
      		});

       		$('.timepicker').timepicker({
        		'timeFormat' : 'H:i:s'
       		});
     	});
     	
		$(document).ready(function() {
			$('#data-master').DataTable();
		});
	</script>

	<script>
		$(document).ready(function () {
			bsCustomFileInput.init();
		});
	</script>

	<script>
		var count = 0;
		function pilgan(){
			$('#pilihan_ganda').show();
			$('#esay').hide();
			document.getElementById('esay_answer').value = '';
		}

		function esay(){
			$('#pilihan_ganda').hide();
			$('#esay').show();
			document.getElementById('option_1').value = '';
			document.getElementById('option_2').value = '';
			document.getElementById('option_3').value = '';
			document.getElementById('option_4').value = '';
			document.getElementById('option_5').value = '';
		}

		function add_selected(id){
			var check = $('#checkDT'+id+':checked').length
			if(check > 0){
			   count = count + 1
			}else {
				count = count - 1
				if(count < 0){
					count = 0
				}
			}
			get_selected()
		}
		  
		function get_selected(){
			$('#showSelected').html(count+" siswa terpilih")
		}

		
		  
	</script>
</body>
</html>