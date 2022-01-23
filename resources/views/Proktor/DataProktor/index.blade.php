@extends('Proktor/Template/main')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Proktor</li>
  </ol>
</nav>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Proktor</h6>
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
    <a href="{{ url('admin/add_proktor') }}" class="btn btn-primary mb-2">Tambah Data</a>
    <div class="table-responsive">
      <table class="table table-bordered table-striped" id="data-master" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Username</th>
            <th>Password</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @php $no = 0; @endphp
          @foreach($data as $row)
            @php $no++; @endphp
            <tr>
              <td>{{ $no }}</td>
              <td>{{ $row->username }}</td>
              <td>{{ $row->password }}</td>
              <td>
                <a href="{{ url('admin/edit_proktor/'.$row->id_proktor) }}" class="btn btn-sm btn-info"><span class="fa fa-edit"></span></a>
                <a href="{{ url('admin/delete_proktor/'.$row->id_proktor) }}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection