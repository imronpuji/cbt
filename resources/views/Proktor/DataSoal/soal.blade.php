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
    <h6 class="m-0 font-weight-bold text-primary">Data Soal Kelas {{ $kls['nm_kelas'] }}</h6>
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
    <a href="{{ url('admin/add_soal/'.$kls['id_kelas'].'/'.Request::segment(4)) }}" class="btn btn-primary mb-2">Tambah Data</a>
    <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModal">
      Import Data Soal
    </button>
    <div class="table-responsive">
      <table class="table table-bordered table-striped" id="data-master" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Soal</th>
            <th>Pilihan Jawaban a/b/c/d/e</th>
            <th>Kunci Jawaban</th>
            <th>Pembahasan</th>
            <th>Skor</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @php $no = 0; @endphp
          @foreach($soal as $row)
            @php $no++; @endphp
            <tr>
              <td>{{ $no }}</td>
              <td>
                {{ $row->soal }}
                @if($row->soal_file != null)
                  @if(strpbrk($row->soal_file, 'jpg') == 'jpg' ||
                     (strpbrk($row->soal_file, 'png') == 'png' ))
                    <img style="width: 100%;" src="{{ asset('files/file_soal/'.$row->soal_file) }}" />      
                  @elseif(strpbrk($row->soal_file, 'mp3') == 'mp3' || 
                    strpbrk($row->soal_file, 'wav') == 'wav')
                    <audio controls><source src="{{ asset('files/file_soal/'.$row->soal_file) }}" type="audio/mpeg"></audio>
                  @endif
                @endif
              </td>
              <td>
                @if(!empty($row->option_1) && !empty($row->option_2) && !empty($row->option_3) && !empty($row->option_4) && !empty($row->option_5))
                <ul class="option_test">
                  <li>{{ $row->option_1 }}</li>
                  <li>{{ $row->option_2 }}</li>
                  <li>{{ $row->option_3 }}</li>
                  <li>{{ $row->option_4 }}</li>
                  <li>{{ $row->option_5 }}</li>
                </ol>
                @else
                  <span>-</span>
                @endif
              </td>
              <td>{{ $row->right_answer }}</td>
              <td>{{ $row->pembahasan }}</td>
              <td>{{ $row->skor }}</td>
              <td>
                <a href="{{ url('admin/edit_soal/'.$row->kd_soal) }}" class="btn btn-sm btn-info"><span class="fa fa-edit"></span></a>
                <a onclick="return confirm('Are you sure to delete?')" href="{{ url('admin/delete_soal/'.$row->kd_soal) }}" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
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
        <h5 class="modal-title" id="exampleModalLabel">Import Data Soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6>Download Panduan Import Data Soal Via Excel Pada Tombol Dibawah Ini!</h6>
        <a href="{{ asset('panduan_import_excel/Panduan Import Data Via Excel.docx') }}" class="btn btn-info">Download Panduan</a>
        <hr/>
        <h6>Lakukan Import Data Soal Dengan Excel Pada Form Dibawah Ini.</h6>
        <form action="{{ url('admin/import_soal') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <div class="custom-file">
              <input type="file" name="soal_import" class="custom-file-input" id="customFile">
              <label class="custom-file-label" for="customFile">Masukan file excell</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Import Data Soal</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection