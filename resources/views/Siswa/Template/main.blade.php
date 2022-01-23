@php 
error_reporting(0)
@endphp
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>COMPUTER BASED TEST</title>
	<!-- Custom fonts for this template-->
	<link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
	<link href="{{ asset('sb-admin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<!-- Custom styles for this template-->
	<link href="{{ asset('sb-admin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">
	<div id="wrapper">
		<div id="content-wrapper" class="d-flex flex-column">
			@include('Siswa/Template/navbar')
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
			@include('Siswa/Template/footer')
			<!-- End of Footer -->
		</div>
	</div>
	<script src="{{ asset('sb-admin2/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('sb-admin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('sb-admin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
	<script src="{{ asset('sb-admin2/js/sb-admin-2.min.js') }}"></script>
	<script>
		@php 
		if($tipe == 'kerjakan_soal'){
			$akhir = strtotime($pengerjaan['time_end']);
		}
		if($tipe == 'waktu_tunggu'){
			$akhir = strtotime($detail['time_start']);
		}
		if($tipe == 'konfirmasi'){
			$akhir = strtotime($mapel['time_end']);
		}
		$waktu = $akhir - time();
		$jam = floor($waktu/3600);
		$menit = floor($waktu/60);
		$detik = floor($waktu%60);
		if ($menit < 60) {
			$jam = 0;
			$menit = $menit;
			$detik = $detik;
		}else {
			$jam = (int)($menit/60);
			$menit = $menit%60;
			$detik = $detik;
		}
		@endphp	
		$(document).ready(function() {
			var tipe = '{{ $tipe }}' ;
			var detik   = {{$detik }} ;
			var menit   = {{ $menit }};
			var jam     = {{ $jam }};
			function timeLeft() {
				setTimeout(timeLeft,1000);
				$('.time_left').html(
					jam + ' : ' + menit + ' : ' + detik 
					);
				detik --;
				if(detik < 0) {
					detik = 59;
					menit --;
					if(menit < 0) {
						menit = 59;
						jam --;      
						if(jam < 0) { 
							if(tipe == 'waktu_tunggu'){
								$('.time_left').hide();
								$('.warn').show();
								$('.warn').html('<strong><span class="text-danger">Silahkan Klik Button Mulai, Ujian Telah Dapat Dimulai</span></strong>')
								$('#btn-mulai').removeAttr('disabled');
							}
							if(tipe == 'kerjakan_soal'){
								finish();
							}
						} 
					} 
				} 
			}           
			timeLeft();   
		});

		function start_ujian(id){
			var lm_ujian = $('#lm_ujian').val();
			var _token = "{{ csrf_token() }}";
			$.ajax({
				url: '{{ url('test/start_ujian') }}',
				type : 'POST',
				dataType : 'JSON',
				data : {_token:_token,id:id,lm_ujian:lm_ujian},
				success: function(data) {
					console.log(data);
					window.location.href = '{{ url('test/soal') }}'+'/'+data.kd_mapel+'/'+data.no_soal;
				}
			})
		} 

		function simpan_soal(kondisi,kd_mapel,kd_soal) {
			var answer = '';
			var _token = "{{ csrf_token() }}";
			if($('#esay_answer').val() != null) {
				answer = $('#esay_answer').val();
			}
			else if(document.getElementById('radio1').checked) {
				answer = document.getElementById('radio1').value;
			}
			else if(document.getElementById('radio2').checked) {
				answer = document.getElementById('radio2').value;
			}
			else if(document.getElementById('radio3').checked) {
				answer = document.getElementById('radio3').value;
			}
			else if(document.getElementById('radio4').checked) {
				answer = document.getElementById('radio4').value;
			}
			else if(document.getElementById('radio5').checked) {
				answer = document.getElementById('radio5').value;
			}
			console.log(answer)
			$.ajax({
				url : '{{ url('test/simpan') }}',
				type : 'POST',
				dataType : 'JSON',
				data : {_token:_token,kd_mapel:kd_mapel,kd_soal:kd_soal,answer:answer,kondisi:kondisi},
				success : function(response) {
					console.log('OK');
					$('.simpan_soal').show();
				}
			});
		}

		function finish(){
				var kd_mapel = '{{ Request::segment(3) }}';
				var _token = "{{ csrf_token() }}";
				$.ajax({
					url : '{{url('test/selesai')}}',
					type : 'POST',
					data : {_token:_token,kd_mapel:kd_mapel},
					success : function(response){
						window.location.href = '{{url('welcome')}}'
					}
				})
			}   

	</script>
</body>
</html>