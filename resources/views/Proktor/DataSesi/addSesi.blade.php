@extends('Proktor/Template/main')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8"> 
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Sesi Siswa Ujian</a></li>
          <li class="breadcrumb-item active">Kelola Sesi Siswa Ujian</li>
        </ol>
      </nav>
      <a href="{{ url()->previous() }}"><span aria-hidden="true">&laquo;</span> Kembali ke menu kelola Sesi Ujian</a>
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tambahkan Sesi {{ $sesi['sesi_name'] }}</h6>
        </div>
        <div class="card-body">
            <div class="alert alert-info">Silahkan pilih siswa mana saja yang masuk di sesi ini. Klik tambahkan untuk menambahakan siswa ke sesi ujian.</div>
            <strong><p id="showSelected"></p></strong>
            <label>Daftar Siswa</label>
            <form action="{{ url('admin/store_sesisiswa') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="id_sesi" value="{{ $sesi['id_sesi'] }}">
                    @foreach ($siswa as $data)
                        <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" name="id_siswa[]" onclick="add_selected('{{ $data->id_siswa }}')" class="custom-control-input" id="checkDT{{ $data->id_siswa }}" value="{{ $data->id_siswa }}">
                            <label class="custom-control-label" for="checkDT{{ $data->id_siswa }}">{{ $data->nama }}</label>
                        </div>
                    @endforeach
                </div>
                <button class="btn btn-primary mt-2" type="submit">Tambahkan</button>
            </form>
        </div>
      </div>
</div>
@endsection