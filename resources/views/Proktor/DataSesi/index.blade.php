@extends('Proktor/Template/main')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Sesi Ujian</li>
  </ol>
</nav>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Sesi Ujian</h6>
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
    <a href="{{ url('admin/add_sesiujian') }}" class="btn btn-primary mb-2">Tambah Data</a>
    <div class="table-responsive">
      <table class="table table-bordered table-striped" id="data-master" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Sesi Ujian</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @php $no = 0; @endphp
          @foreach($sesi as $row)
            @php $no++; @endphp
            <tr>
              <td>{{ $no }}</td>
              <td>{{ $row->sesi_name }}</td>
              <td>{{ $row->tanggal }}</td>
              <td>{{ $row->waktu }}</td>
              <td>
                <a href="{{ url('admin/edit_sesiujian/'.$row->id_sesi) }}" class="btn btn-sm btn-info"><span class="fa fa-edit"></span></a>
                <a onclick="return confirm('Are you sure to delete?')" href="{{ url('admin/del_sesiujian/'.$row->id_sesi) }}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection