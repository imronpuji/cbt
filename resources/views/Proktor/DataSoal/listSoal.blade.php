@extends('Proktor/Template/main')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Soal</li>
  </ol>
</nav>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Mapel Kelas {{ $kls['nm_kelas'] }}</h6>
  </div>
  <div class="card-body">
    @if(Session::has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
   <div class="table-responsive">
      <table class="table table-bordered table-striped" id="data-master" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Matapelajaran</th>
            <th>Semester</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @php $no = 0; @endphp
          @foreach($mapel as $row)
            @php $no++; @endphp
            <tr>
              <td>{{ $no }}</td>
              <td>{{ $row->nm_mapel }}</td>
              <td>{{ $row->semester }}</td>
              <td>
                <a href="{{ url('admin/kelola_soal/'.$row->id_kelas.'/'.$row->kd_mapel) }}" class="btn btn-sm btn-info">Kelola Soal</a>
                <a href="{{ url('admin/lihat_soal/'.$row->kd_mapel) }}" class="btn btn-sm btn-primary">Lihat Soal</a>
                <a href="{{ url('admin/del_soal/'.$row->kd_mapel) }}" class="btn btn-sm btn-danger">Hapus Semua Soal</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection