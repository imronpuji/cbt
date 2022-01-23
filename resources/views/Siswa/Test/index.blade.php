@extends('Siswa.Template.main')
@section('content')
<div class="mt-5 row justify-content-end">
	<div class="col-md-4">
		<div class="row">
			<h4 class="ml-auto">Waktu tersisa <span class="shadow badge badge-info time_left"></span></h4>
		</div>
	</div>
</div>
<div class="row mb-5 justify-content-center">
	<div class="col-md-8">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Soal No {{ $soal['nomor_soal'] }}  dari {{ getJumlahSoal($soal['kd_mapel']) }}</h6>
			</div>
			<div class="card-body">
				<div style="display: none;" class="simpan_soal alert alert-success alert-dismissible fade show" role="alert">
					<strong>Jawaban berhasil disimpan.</strong> Silahkan mengerjakan soal selanjutnya!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<strong class="text-dark">Soal nomor {{ $soal['no_soal'] }}</strong>
				<h5>{{ $soal['soal'] }}</h5>
				@if($soal['soal_file'] != NULL)
					@if(strpbrk($soal['soal_file'], 'png') == 'png' || 
						strpbrk($soal['soal_file'], 'jpg') == 'jpg')
					  <img class="mb-3" src="{{ asset('files/file_soal/'.$soal['soal_file']) }}" />
					@elseif(strpbrk($soal['soal_file'], 'mp3') == 'mp3' || 
						strpbrk($soal['soal_file'], 'wav') == 'wav')
						<audio controls><source src="{{ asset('files/file_soal/'.$soal['soal_file']) }}" type="audio/mpeg"></audio>
					@endif
				@endif
				<br/>
				@if($soal['option_1'] != null && $soal['option_2'] != null && $soal['option_3'] != null && $soal['option_4'] != null && $soal['option_5'] != null)
				<strong class="text-dark mt-5">Pilih salah satu jawaban</strong>
				<ul class="option_test">
					<li>
						<div class="custom-control custom-radio">
							<input type="radio" id="radio1"  class="custom-control-input" name="answer" value="a" 
							 @if(CekYourAnswer($soal['kd_soal'],Session::get('id_siswa')) == 'a')
							 	{{ 'checked' }}
							 @endif
							/>
							<label class="custom-control-label" for="radio1">
								@if(strpbrk($soal['option_1'], 'jpg') == 'jpg' || strpbrk($soal['option_1'], 'JPG') == 'JPG' || strpbrk($soal['option_1'], 'png') == 'png' || strpbrk($soal['option_1'], 'PNG') == 'PNG' )
				                    <img  class="mb-2" style="width: 100px;" src="{{ asset('files/gambar_jawaban/'.$soal['option_1']) }}" />							
								@else
				                   {{ $soal['option_1'] }}
				                @endif
							</label>
						</div>
					</li>
					<li>
						<div class="custom-control custom-radio">
							<input type="radio" id="radio2" class="custom-control-input" name="answer" value="b" 
							 @if(CekYourAnswer($soal['kd_soal'],Session::get('id_siswa')) == 'b')
							 	{{ 'checked' }}
							 @endif
							/>
							<label class="custom-control-label" for="radio2">
								@if(strpbrk($soal['option_2'], 'jpg') == 'jpg' || strpbrk($soal['option_2'], 'JPG') == 'JPG' || strpbrk($soal['option_2'], 'png') == 'png' || strpbrk($soal['option_2'], 'PNG') == 'PNG' )
				                    <img class="mb-2" style="width: 100px;" src="{{ asset('files/gambar_jawaban/'.$soal['option_2']) }}" />
				                @else
				                   {{ $soal['option_2'] }}
				                @endif
							</label>
						</div>
					</li>
					<li>
						<div class="custom-control custom-radio">
							<input type="radio" id="radio3" class="custom-control-input" name="answer" value="c" 
							 @if(CekYourAnswer($soal['kd_soal'],Session::get('id_siswa')) == 'c')
							 	{{ 'checked' }}
							 @endif
							/>
							<label class="custom-control-label" for="radio3">
								@if(strpbrk($soal['option_3'], 'jpg') == 'jpg' || strpbrk($soal['option_3'], 'JPG') == 'JPG' || strpbrk($soal['option_3'], 'png') == 'png' || strpbrk($soal['option_3'], 'PNG') == 'PNG' )
				                    <img class="mb-2" style="width: 100px;" src="{{ asset('files/gambar_jawaban/'.$soal['option_3']) }}" />
				                @else
				                   {{ $soal['option_3'] }}
				                @endif
							</label>
						</div>
					</li>
					<li>
						<div class="custom-control custom-radio">
							<input type="radio" id="radio4" class="custom-control-input" name="answer" value="d" 
							 @if(CekYourAnswer($soal['kd_soal'],Session::get('id_siswa')) == 'd')
							 	{{ 'checked' }}
							 @endif
							/>
							<label class="custom-control-label" for="radio4">
								@if(strpbrk($soal['option_4'], 'jpg') == 'jpg' || strpbrk($soal['option_4'], 'JPG') == 'JPG' || strpbrk($soal['option_4'], 'png') == 'png' || strpbrk($soal['option_4'], 'PNG') == 'PNG' )
				                    <img class="mb-2" style="width: 100px;" src="{{ asset('files/gambar_jawaban/'.$soal['option_4']) }}" />
				                @else
				                   {{ $soal['option_4'] }}
				                @endif
							</label>
						</div>
					</li>
					<li>
						<div class="custom-control custom-radio">
							<input type="radio" id="radio5" class="custom-control-input" name="answer" value="e" 
							 @if(CekYourAnswer($soal['kd_soal'],Session::get('id_siswa')) == 'e')
							 	{{ 'checked' }}
							 @endif
							/>
							<label class="custom-control-label" for="radio5">
								@if(strpbrk($soal['option_5'], 'jpg') == 'jpg' || strpbrk($soal['option_5'], 'JPG') == 'JPG' || strpbrk($soal['option_5'], 'png') == 'png' || strpbrk($soal['option_5'], 'PNG') == 'PNG' )
				                    <img class="mb-2" style="width: 100px;" src="{{ asset('files/gambar_jawaban/'.$soal['option_5']) }}" />
				                @else
				                   {{ $soal['option_5'] }}
				                @endif
							</label>
						</div>
					</li>
				</ul>	
				@else
					<strong class="text-dark mt-5">Masukan jawaban anda</strong>
					<textarea name="answer" id="esay_answer" class="form-control" placeholder="Jawab disini">{{ CekYourAnswer($soal['kd_soal'],Session::get('id_siswa')) }}</textarea>	
				@endif
			</div>
			<div class="card-footer">
				<button type="button" class="btn btn-success btn-sm mb-2" 
				onclick="simpan_soal('1','{{ $soal['kd_mapel'] }}','{{ $soal['kd_soal'] }}')">Simpan</button>
				<button type="button" class="btn btn-warning btn-sm mb-2" 
				onclick="simpan_soal('0','{{ $soal['kd_mapel'] }}','{{ $soal['kd_soal'] }}')">Ragu-Ragu</button>
				@if($soal['nomor_soal'] != 1)
				<a href="{{ url('test/soal/'.$soal['kd_mapel'].'/'.($soal['nomor_soal']-1)) }}" class="btn btn-secondary btn-sm mb-2">Sebelumnya</a>
				@endif
				@if($soal['nomor_soal'] == getJumlahSoal($soal['kd_mapel']))
				<a href="{{ url('test/konfirmasi/'.$soal['kd_mapel']) }}" class="btn btn-danger btn-sm mb-2">Selesai</a>
				@else
				<a href="{{ url('test/soal/'.$soal['kd_mapel'].'/'.($soal['nomor_soal']+1)) }}" class="btn btn-secondary btn-sm mb-2">Selanjutnya</a>
				@endif
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Daftar Soal</h6>
			</div>
			<div class="card-body">
				@foreach($daftarSoal as $data) 
					@php $status = 'btn-secondary'; @endphp
					@if($data->nomor_soal == $soal['nomor_soal'])
						@php $status = 'btn-info'; @endphp
					@elseif($data->nomor_soal != $soal['nomor_soal'])
							@if(CekYakin($data->kd_soal,Session::get('id_siswa')) == 1)
								@php $status = 'btn-success'; @endphp
							@endif
							@if(CekRagu2($data->kd_soal,Session::get('id_siswa')) == 1)
								@php $status = 'btn-warning'; @endphp	
							@endif	
					@endif
					<a href="{{ url('test/soal/'.$data->kd_mapel.'/'.$data->nomor_soal) }}" class="btn {{ $status }} btn-lg mb-2">{{ $data->nomor_soal }}</a>
				@endforeach
			</div>	
		</div>
	</div>
</div>
@php
$tipe = 'kerjakan_soal';
@endphp	
@endsection