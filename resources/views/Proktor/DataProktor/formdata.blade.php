@extends('Proktor/Template/main')
@section('content')
@php 
  if($isUpdate){
    $url = url('admin/update_proktor/'.$proktor['id_proktor']);
  }else{
    $url = url('admin/store_proktor');
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
    <a href="{{ url()->previous() }}"><span aria-hidden="true">&laquo;</span> Kembali ke menu kelola Proktor</a>
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
          <input type="hidden" name="kd_proktor" >
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control 
              @error('username') is-invalid @enderror"
              @if($isUpdate):
                value="{{ $proktor['username'] }}" 
              @endif
              value="{{ old('username') }}" />
              @error('username')
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
                value="{{ $proktor['password'] }}" 
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