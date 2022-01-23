@extends('Proktor/Template/main')
@section('content')
@php 
  if($isUpdate){
    $url = url('admin/update_siswa/'.$siswa['id_siswa']);
  }else{
    $url = url('admin/store_siswa');
  }
@endphp
<div class="row justify-content-center">
  <div class="col-md-8"> 
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Siswa</a></li>
        <li class="breadcrumb-item active">Kelola Siswa</li>
      </ol>
    </nav>
    <a href="{{ url()->previous() }}"><span aria-hidden="true">&laquo;</span> Kembali ke menu kelola Siswa</a>
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
            <label>NIS</label>
            <input type="text" name="nis" class="form-control 
              @error('nis') is-invalid @enderror"
              @if($isUpdate)
                value="{{ $siswa['nis'] }}" 
              @endif
              value="{{ old('nis') }}" />
              @error('nis')
                <div class="invalid-feedback">
                    {{ $message }}  
                </div>
              @enderror
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control 
              @error('nama') is-invalid @enderror"
              @if($isUpdate)
                value="{{ $siswa['nama'] }}" 
              @endif
              value="{{ old('nama') }}" />
              @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}  
                </div>
              @enderror
          </div>
          <div class="form-group">
            <label>Kelas</label>
            <select name="id_kelas" class="custom-select  @error('id_kelas') is-invalid @enderror">
              @foreach($allKls as $data)
              <option value="{{ $data->id_kelas }}"  @if($isUpdate) @if($data->id_kelas == $siswa['id_kelas']): @php echo 'selected' @endphp @endif @endif >{{ $data->nm_kelas }}</option>
              @endforeach
            </select>
            @error('id_kelas')
            <div class="invalid-feedback">
                {{ $message }}  
            </div>
            @enderror
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="text" name="password" class="form-control 
              @error('password') is-invalid @enderror"
              @if($isUpdate):
                value="{{ $siswa['password'] }}" 
              @endif
              value="{{ old('password') }}" />
              @error('password')
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