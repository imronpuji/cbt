<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Proktor - Dashboard</title>
  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="css/styles.css" />
  <!-- Custom styles for this template-->
  <link href="sb-admin2/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
<div class="card-body">
  <h4>Detail Pengerjaan Ujian</h4>
    <table>
      <tbody>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td>{{ $siswakelas['nama'] }}</td>
        </tr>
        <tr>
          <td>Kelas</td>
          <td>:</td>
          <td>{{ $siswakelas['nm_kelas'] }}</td>
        </tr>
        <tr>
          <td>Matapelajaran</td>
          <td>:</td>
          <td>{{ $mapel['nm_mapel'] }}</td>
        </tr>
        <tr>
          <td>Jumlah Jawaban Benar</td>
          <td>:</td>
          <td>{{ $nilai['jumlah_jawaban_benar'] }}</td>
        </tr>
        <tr>
          <td>Jumlah Jawaban Salah</td>
          <td>:</td>
          <td>{{ $nilai['jumlah_jawaban_salah'] }}</td>
        </tr>
        <tr>
          <td>Jumlah Jawaban Salah</td>
          <td>:</td>
          <td>{{ $nilai['jumlah_jawaban_salah'] }}</td>
        </tr>
        <tr>
          <td>Waktu Mulai Ujian</td>
          <td>:</td>
          <td>{{ $nilai['waktu_mulai'] }}</td>
        </tr>
        <tr>
          <td>Skor Ujian</td>
          <td>:</td>
          <td>{{ $nilai['nilai'] }}</td>
        </tr>
        <tr>
          <td>Tanggal Ujian</td>
          <td>:</td>
          <td>{{ $nilai['created_at'] }}</td>
        </tr>
        <tr>
          <td>Waktu Mulai Ujian</td>
          <td>:</td>
          <td>{{ $nilai['waktu_mulai'] }}</td>
        </tr>
      </tbody>
    </table>
    <hr/>
    <h5>Pengerjaan Anda</h5>
    <ol>
      @foreach($pengerjaan as $data)
          <li>{{ $data->soal }}<br/>
            @if($data->soal_file != NULL)
              <br/>
              <img class="mb-5 mt-3" src="files/file_soal/{{$data->soal_file}}" alt="File is Audio {{ $data->soal_file }}"/>
            @endif
            @if(
              $data->option_1 != null && $data->option_2 != null &&  $data->option_3 != null &&  $data->option_4 != null &&  $data->option_5 != null
            )
            <ul class="option_test">
              <li class="{{ CekPengerjaan('a',$data->your_answer,$data->right_answer) }}">
                  @if(strpbrk($data->option_1, 'jpg') == 'jpg' || strpbrk($data->option_1, 'JPG') == 'JPG' || strpbrk($data->option_1, 'png') == 'png' || strpbrk($data->option_1, 'PNG') == 'PNG' )
                    <img class="mb-3" style="width: 100px;" src="files/gambar_jawaban/{{ $data->option_1 }}" />
                  @else
                    {{ $data->option_1 }}
                  @endif
              </li>
              <li class="{{ CekPengerjaan('b',$data->your_answer,$data->right_answer) }}">
                @if(strpbrk($data->option_2, 'jpg') == 'jpg' || strpbrk($data->option_2, 'JPG') == 'JPG' || strpbrk($data->option_2, 'png') == 'png' || strpbrk($data->option_2, 'PNG') == 'PNG' )
                    <img class="mb-3" style="width: 100px;" src="files/gambar_jawaban/{{ $data->option_2 }}" />
                  @else
                    {{ $data->option_2 }}
                  @endif
              </li>
              <li class="{{ CekPengerjaan('c',$data->your_answer,$data->right_answer) }}">
                @if(strpbrk($data->option_3, 'jpg') == 'jpg' || strpbrk($data->option_3, 'JPG') == 'JPG' || strpbrk($data->option_3, 'png') == 'png' || strpbrk($data->option_3, 'PNG') == 'PNG' )
                    <img class="mb-3" style="width: 100px;" src="files/gambar_jawaban/{{ $data->option_3 }}" />
                  @else
                    {{ $data->option_3 }}
                  @endif
              </li>
              <li class="{{ CekPengerjaan('d',$data->your_answer,$data->right_answer) }}">@if(strpbrk($data->option_4, 'jpg') == 'jpg' || strpbrk($data->option_4, 'JPG') == 'JPG' || strpbrk($data->option_4, 'png') == 'png' || strpbrk($data->option_4, 'PNG') == 'PNG' )
                    <img class="mb-3" style="width: 100px;" src="files/gambar_jawaban/{{ $data->option_4 }}" />
                  @else
                    {{ $data->option_4 }}
                  @endif
              </li>
              <li class="{{ CekPengerjaan('e',$data->your_answer,$data->right_answer) }}">
                @if(strpbrk($data->option_5, 'jpg') == 'jpg' || strpbrk($data->option_5, 'JPG') == 'JPG' || strpbrk($data->option_5, 'png') == 'png' || strpbrk($data->option_5, 'PNG') == 'PNG' )
                    <img class="mb-3" style="width: 100px;" src="files/gambar_jawaban/{{ $data->option_5 }}" />
                  @else
                    {{ $data->option_5 }}
                  @endif
              </li>
            </ul>
            @else
              <br/>
              <strong>Jawaban Anda : </strong>
              <span class="{{ CekPengerjaan($data->your_answer,$data->your_answer,$data->right_answer) }}">{{ $data->your_answer }}</span>
            @endif
          </li>

      @endforeach
    </ol>
    <hr/>
    <div class="text-center">
      <strong>Jawaban Benar</strong>
    </div>
    <ol>
      @foreach($pengerjaan as $data)
      <li>
        <strong>Jawaban : </strong>
        <p>{{ $data->right_answer }}</p>
      </li>
      <strong>Pembahasan : </strong>
      <p>{{ $data->pembahasan }}</p> 
      @endforeach
    </ol>
  </div>
</div>
</body>
</html>
