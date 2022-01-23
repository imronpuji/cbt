@extends('Siswa.Template.main')
@section('content')
<div class="row justify-content-center">
	<div class="col-md-8 mt-5 mb-5">
		<div class="card shadow mt-5 mb-5">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Daftar Ujian Hari <u class="text-success">
				 <?php echo date('d F Y'); ?></u></h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<h6 class="text-success"><b>Data siswa peserta ujian</b></h6>
					<table class="table table-sm table-bordered">
						<thead>
							<tr>
								<th>NIS</th>
								<th>Nama</th>
								<th>Kelas</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ Session::get('nis') }}</td>
								<td>{{ Session::get('nama') }}</td>
								<td>{{ Session::get('kelas') }}</td>
							</tr>
						</tbody>
					</table>
					<h6 class="text-success"><b>Matapelajaran yang diujiakan</b></h6>
					<table class="table table-sm table-bordered table-striped" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>Mata Pelajaran</th>
								<th>Ujian Dimulai</th>
								<th>Lama Ujian</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@php $no = 0; @endphp
							@foreach($mapel as $data) @php $no++; @endphp
							<tr>
								<td>{{ $no }}</td>
								<td>{{ $data->nm_mapel }}</td>							
								<td>{{ $data->time_start }}</td>
								<td>{{ $data->lama_ujian/3600 }}</td>
								<td>
									@if(cekSudahDikerjakan($data->kd_mapel,Session::get('id_siswa')) > 0 && cekMasihDikerjakan($data->kd_mapel,Session::get('id_siswa')) == 0 )
										<a href="#" class="btn btn-secondary btn-sm">Sudah Dikerjakan</a>
									@elseif(cekMasihDikerjakan($data->kd_mapel,Session::get('id_siswa')) == 1 )
										<a href="{{ url('test/soal/'.$data->kd_mapel.'/'.'1') }}" class="btn btn-warning btn-sm">Masih Dikerjakan</a>
									@else
										<a href="{{ url('test/detail/'.$data->kd_mapel) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="mt-5">

</div>
@endsection