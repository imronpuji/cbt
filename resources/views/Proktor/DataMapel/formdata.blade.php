@extends('Proktor/Template/main')
@section('content')
@php 
  if($isUpdate){
    $url = url('admin/update_mapel/'.$mapel['kd_mapel']);
  }else{
    $url = url('admin/store_mapel');
  }
@endphp
<div class="row justify-content-center">
  <div class="col-md-8"> 
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Mapel</a></li>
        <li class="breadcrumb-item active">Kelola Mapel</li>
      </ol>
    </nav>
    <a href=""><span aria-hidden="true">&laquo;</span> Kembali ke menu kelola Mapel</a>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
      </div>
      <div class="card-body">
        <form action="{{ $url }}" method="POST">
          @if($isUpdate)
            {{ method_field('PUT') }}
          @endif
          @csrf
          <div class="form-group">
            <label>Matapelajaran</label>
            <input type="text" name="nm_mapel" class="form-control 
              @error('nm_mapel') is-invalid @enderror"
              @if($isUpdate):
                value="{{ $mapel['nm_mapel'] }}" 
              @endif
              value="{{ old('nm_mapel') }}" />
              @error('nm_mapel')
                <div class="invalid-feedback">
                    {{ $message }}  
                </div>
              @enderror
          </div>
          <input type="hidden" name="id_kelas" 
            @if($isUpdate) value="{{ $mapel['id_kelas'] }}" @endif
            @if(!$isUpdate) value="{{ $kls['id_kelas'] }}" @endif
          />
          <div class="form-group">
            <label>Tanggal Ujian</label>
            <input type="text" name="date_ujian" id="datepicker" class="form-control 
              @error('date_ujian') is-invalid @enderror"
              @if($isUpdate)
                value="{{ $mapel['date_ujian'] }}" 
              @endif
              value="{{ old('date_ujian') }}" />
              @error('password')
                <div class="invalid-feedback">
                    {{ $message }}  
                </div>
              @enderror
          </div>
          <div class="form-group">
            <label>Waktu Ujian</label>
            <input type="text" name="time_start" class="form-control timepicker
              @error('time_start') is-invalid @enderror"
              @if($isUpdate)
                value="{{ $mapel['time_start'] }}" 
              @endif
              value="{{ old('time_start') }}" />
              @error('time_start')
                <div class="invalid-feedback">
                    {{ $message }}  
                </div>
              @enderror
          </div>
          <div class="form-group">
            <label>Lama Ujian</label>
            <input type="text" name="lama_ujian" class="form-control  
              @error('lama_ujian') is-invalid @enderror"
              @if($isUpdate)
                value="{{ $mapel['lama_ujian']/3600 }}" 
              @endif
              value="{{ old('lama_ujian') }}" />
              @error('lama_ujian')
                <div class="invalid-feedback">
                    {{ $message }}  
                </div>
              @enderror
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
      </form>  
      </div>
    </div>
  </div>
</div>
@endsection