@extends('Proktor/Template/main')
@section('content')
@php 
  if($isUpdate){
    $url = url('admin/update_kelas/'.$kelas['id_kelas']);
  }else{
    $url = url('admin/store_kelas');
  }
@endphp
<div class="row justify-content-center">
  <div class="col-md-8"> 
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Proktor</a></li>
        <li class="breadcrumb-item active">Kelola Proktor</li>
      </ol>
    </nav>
    <a href="{{ url()->previous() }}"><span aria-hidden="true">&laquo;</span> Kembali ke menu kelola Kelas</a>
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
            <label>Nama Kelas</label>
            <input type="text" name="nm_kelas" class="form-control 
              @error('nm_kelas') is-invalid @enderror"
              @if($isUpdate):
                value="{{ $kelas['nm_kelas'] }}" 
              @endif
              value="{{ old('nm_kelas') }}" />
              @error('nm_kelas')
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