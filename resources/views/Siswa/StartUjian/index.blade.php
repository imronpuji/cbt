@extends('Siswa.Template.main')
@section('content')
<input type="hidden" name="lm_ujian" id="lm_ujian" value="{{ $detail['lama_ujian'] }}" />
<div class="row justify-content-center">
	<div class="col-md-8 mt-5">
		<div class="card shadow mb-5">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Petunjuk Ujian CBT {{ $detail['time_start']}}</h6>
			</div>
			<div class="card-body">
				<span class="text-danger">Waktu tunggu ujian <span class="time_left"></span></span>
				<div class="warn" style="display: none;"></div>
				<ol>
					<li>Berdoa kepada Allah SWT sebelum melakukan ujian semoga diberi kemudahan dan kelancaran.</li>
					<li>Tombol mulai ujian akan dapat di klik apabila waktu tunggu ujian telah selesai.</li>
					<li>Saat anda menjawab soal ujian setelah memilih jawaban yang anda anggap benar <b>WAJIB</b> menekan tombol <b>SIMPAN</b>, Agar jawaban anda tersimpan dan diproses oleh sistem.
						Hingga muncul pemberitahuan seperti gambar dibawah ini jawaban telah berhasil disimpan.<br/>
						<img style="width: 400px;" src="{{ asset('files/petunjuk_pengerjaan/Screenshot_5.png') }}" />
					</li>
					<li>Bila anda memiliki keraguan pada jawaban anda silahkan klik tombol <b>RAGU-RAGU</b> untuk memudahkan anda dalam meneliti jawaban anda.
						Hingga muncul pemberitahuan seperti gambar dibawah ini jawaban telah berhasil disimpan.<br/>
						<img style="width: 400px;" src="{{ asset('files/petunjuk_pengerjaan/Screenshot_5.png') }}" />
					</li>
					<li>
						Gambar dibawah ini merupakan daftar soal yang akan anda kerjakan dengan keterangan berada dibawah gambar tersebut.
						<img style="width: 400px;" src="{{ asset('files/petunjuk_pengerjaan/Screenshot_6.png') }}" /><br/>
						<b>Keterangan :</b>
						<ul>
							<li>Warna biru menandakan anda sedang mengerjakan soal tersebut.</li>
							<li>Warna hijau menandakan anda telah menyimpan jawaban anda.</li>
							<li>Warna kuning menandakan anda telah menyimpan jawaban anda dengan .</li>
						</ul>
					</li>
				</ol>
			</div>
			<div class="card-footer">
				<button onclick="start_ujian('{{ $detail['kd_mapel'] }}')" type="button" class="btn btn-primary" id="btn-mulai" disabled>
					Mulai Ujian
				</button>
			</div>
		</div>
	</div>
</div>
@php
	$tipe = 'waktu_tunggu';
@endphp	
@endsection