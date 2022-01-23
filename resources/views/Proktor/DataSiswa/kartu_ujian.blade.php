<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Proktor - Dashboard</title>
  <style>
      html { margin-bottom: 0px }
  </style>
  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="css/styles.css" />
  <!-- Custom styles for this template-->
  <link href="sb-admin2/css/sb-admin-2.min.css" rel="stylesheet">
</head>
    <div class="box">
    @foreach ($siswa as $data)
            <div class="box-kartu mb-4">
                <table>
                    <tr>
                        <td>
                            <img class="ml-3 mt-3" src="files/kartu_ujian/tut-wuri-handayani.png" style="width: 40px" />
                        </td>
                        <td width="200">
                            <div class="text-center">
                                <h6>Kartu Peserta Ujian</h6>
                            </div>
                        </td>
                    </tr>
                </table>
                <hr>
                    <table class="text-table ml-3">
                        <tr>
                            <td width="100"><strong>Nama</strong></td>
                            <td width="10">:</td>
                            <td>{{ $data->nama }}</td>
                        </tr>
                        <tr>
                            <td><strong>Kelas</strong></td>
                            <td>:</td>
                            <td>{{ $data->nm_kelas }}</td>
                        </tr>
                        <tr>
                            <td><strong>Username / NIS</strong></td>
                            <td>:</td>
                            <td>{{ $data->nis }}</td>
                    </tr>
                    <tr>
                        <td><strong>Password</strong></td>
                        <td>:</td>
                        <td>{{ $data->password }}</td>
                    </tr>
                </table>
                <div class="box-info">
                    <div class="divtable ">
                        <table class="mapel-table" border="1" cellpadding="3">
                            <thead>
                                <tr>
                                    <th>Hari</th>
                                    <th>Tanggal</th>
                                    <th>Sesi</th>
                                    <th>Mapel</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 0;  @endphp
                                @foreach ($mapel as $row) 
                                @if($data->id_siswa == $row->id_siswa)
                                @php $no++; @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->date_ujian)->format('d M Y')  }}</td>
                                        <td>{{ $row->sesi_name }}</td>
                                        <td>{{ $row->nm_mapel }}</td>
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="box-foto ml-3">
                        <div class="item-foto">
                            <div class="text-center"><h4>2x3</h4></div>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
    </div>
</head>
</body>
</html>