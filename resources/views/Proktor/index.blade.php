@extends('Proktor/Template/main')
@section('content')
<h4>Selamat Datang, <strong>{{ Session::get('username') }}</strong></h4>
<div class="row">
	@if(Session::has('success'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		{{ Session::get('success') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif
	<div class="col-xl-12 col-md-12 mb-4">
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<a class="text-info h5 mb-0 font-weight-bold text-gray-800">Sebelum melakukan ujian berbasis CBT, Silahkan Lakukan Pembersihan Data-Data Bekas Ujian Dengan Cara Melakukan Penghapusan Junk Files.</a>
					</div>
					<div class="col-auto">
						<i class="fas fa-calendar fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Junk Files</div>
						<a class="text-danger h5 mb-0 font-weight-bold text-gray-800" data-toggle="modal" data-target="#exampleModal">Hapus Semua Junk Files</a>
					</div>
					<div class="col-auto">
						<i class="fas fa-calendar fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Junk Files</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Dengan Menghapus Junks Data, Akan Menghapus Data Soal Temporary, Data Memulai Ujian dan Data Pengerjaan Soal Yang Dilakukan Oleh Siswa Saat Ujian.</p><hr/>
				<a href="{{ url('admin/clear_junk_files') }}" class="btn btn-danger">Hapus Junk Files</a>
			</div>
		</div>
	</div>
</div>
@endsection