@extends('Siswa.Template.main')
@section('content')
	<div class="row mt-5 justify-content-center">
		<div class="col-md-4 mt-5 mb-5">
			<div class="card shadow mb-5 mt-5">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Konfirmasi Penyelesaian</h6>
				</div>
				<div class="card-body">
					<h5>Periksa kembali pengerjaan anda waktu anda masih tersisa <strong><span class="time_left text-danger"></span></strong></h5>
				</div>
				<div class="card-footer">
					<a href="{{ url()->previous() }}" class="btn btn-primary btn-sm">Kembali mengerjakan</a>
					<button class="btn btn-sm btn-danger" id="selesai_sudah" onclick="finish()">Selesai mengerjakan</button>
				</div>
			</div>
		</div>
	</div>
	@php $tipe='konfirmasi'; @endphp
@endsection