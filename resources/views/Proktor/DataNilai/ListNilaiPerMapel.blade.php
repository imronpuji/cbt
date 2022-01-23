@extends('Proktor/Template/main')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Nilai per Mapel</a></li>
    <li class="breadcrumb-item active">{{ $mapel['nm_mapel'] }}</li>
  </ol>
</nav>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Nilai Kelas {{ $kls['nm_kelas'] }}</h6>
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
    <a href="{{ url('admin/export_nilai/'.$mapel['kd_mapel']) }}" class="btn btn-sm btn-success mb-2">Export Excel</a>
    <div class="table-responsive">
      <table class="table table-bordered table-striped" id="data-master" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Jumlah Soal Benar</th>
            <th>Jumlah Soal Salah</th>
            <th>Mulai Ujian</th>
            <th>Ujian Berakhir</th>
            <th>Skor Ujian</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @php $no = 0; @endphp
          @foreach($nilai as $row)
            @php $no++; @endphp
            <tr>
              <td>{{ $no }}</td>
              <td>{{ $row->nama }}</td>
              <td>{{ $row->jumlah_jawaban_benar }}</td>
              <td>{{ $row->jumlah_jawaban_salah }}</td>
              <td>{{ $row->waktu_mulai }}</td>
              <td>{{ $row->waktu_akhir }}</td>
              <td>{{ $row->nilai }}</td>
              <td>
                <a href="{{ url('admin/pengerjaan_ujian/'.$row->kd_mapel.'/'.$row->id_siswa) }}" class="btn btn-sm btn-info">Detail Pengerjaan Soal</a>
                <a href="{{ url('admin/del_nilai/'.$row->kd_mapel.'/'.
                $row->id_siswa) }}" class="btn btn-sm btn-primary">Hapus Nilai</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection