@extends('Proktor/Template/main')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Siswa</li>
  </ol>
</nav>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Siswa Kelas {{ $kls['nm_kelas'] }}</h6>
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
    @if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ Session::get('error') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif   
    <a href="{{ url('admin/add_siswa/'.$kls['id_kelas']) }}" class="btn btn-primary mb-2">Tambah Data</a>
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModal">
      Import Data Siswa
    </button>
    <a href="{{ url('admin/export_siswa/'.$kls['id_kelas']) }}" class="btn btn-info mb-2">Export Data Siswa </a>
    <a href="{{ url('admin/cetak_kartu_ujian/'.$kls['id_kelas']) }}" class="btn btn-info mb-2">Cetak Kartu Ujian</a>
    <a href="{{ url('admin/clear_siswa/'.$kls['id_kelas']) }}" class="btn btn-danger mb-2">Kosongkan Data Siswa</a>
    <div class="table-responsive">
      <table class="table table-bordered table-striped" id="data-master" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Password</th>
            <th>Sesi</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @php $no = 0; @endphp
          @foreach($siswa as $row)
          @php $no++; @endphp
          <tr>
            <td>{{ $no }}</td>
            <td>{{ $row->nis }}</td>
            <td>{{ $row->nama }}</td>
            <td>{{ $row->nm_kelas }}</td>
            <td>{{ $row->password }}</td>
            <td>{{ $row->sesi_name }}</td>
            <td>
              @if(!empty($row->id_siswa))
                <a href="{{ url('admin/edit_siswa/'.$row->id_siswa) }}" class="btn btn-sm btn-info"><span class="fa fa-edit"></span></a>
                <a onclick="return confirm('Are you sure to delete?')" href="{{ url('admin/delete_siswa/'.$row->id_siswa.'/'.$row->id_kelas) }}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a> 
              @else 
                <strong>Tambahkan sesi siswa terlebih dahulu, Untuk melakukan perubahan data siswa!</strong>
              @endif            
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Data Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6>Download Panduan Import Data Siswa Via Excel Pada Tombol Dibawah Ini!</h6>
        <a href="{{ asset('panduan_import_excel/Panduan Import Data Via Excel.docx') }}" class="btn btn-info">Download Panduan</a>
        <hr/>
        <h6>Lakukan Import Data Siswa Dengan Excel Pada Form Dibawah Ini.</h6>
        <form action="{{ url('admin/import_siswa') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <div class="custom-file">
              <input type="file" name="siswa_import" class="custom-file-input" id="customFile">
              <label class="custom-file-label" for="customFile">Masukan file excell</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Import Data Siswa</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection