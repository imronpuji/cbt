@extends('Proktor/Template/main')
@section('content')
@php 
  if($isUpdate){
    $url = url('admin/update_sesiujian/'.$sesi['id_sesi']);
  }else{
    $url = url('admin/store_sesiujian');
  }
@endphp
<div class="row justify-content-center">
  <div class="col-md-8"> 
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Sesi Ujian</a></li>
        <li class="breadcrumb-item active">Kelola Sesi Ujian</li>
      </ol>
    </nav>
    <a href="{{ url()->previous() }}"><span aria-hidden="true">&laquo;</span> Kembali ke menu kelola Sesi Ujian</a>
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
            <label>Nama Sesi Ujian</label>
            <input type="text" name="sesi_name" class="form-control 
              @error('nm_kelas') is-invalid @enderror"
              @if($isUpdate):
                value="{{ $sesi['sesi_name'] }}" 
              @endif
              value="{{ old('sesi_name') }}" />
              @error('nm_kelas')
                <div class="invalid-feedback">
                    {{ $message }}  
                </div>
              @enderror
          </div>
          <div class="form-group">
            <label>Tanggal</label>
            <input type="text" name="tanggal" id="datepicker" class="form-control 
              @error('tanggal') is-invalid @enderror"
              @if($isUpdate)
                value="{{ $sesi['tanggal'] }}" 
              @endif
              value="{{ old('tanggal') }}" />
              @error('tanggal')
                <div class="invalid-feedback">
                    {{ $message }}  
                </div>
              @enderror
          </div>
          <div class="form-group">
            <label>Waktu</label>
            <input type="text" name="waktu" class="form-control timepicker
              @error('waktu') is-invalid @enderror"
              @if($isUpdate)
                value="{{ $mapel['waktu'] }}" 
              @endif
              value="{{ old('waktu') }}" />
              @error('waktu')
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