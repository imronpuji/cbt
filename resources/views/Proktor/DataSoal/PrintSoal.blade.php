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
<div class="card-body">
    <table>
      <tr>
        <td>Matapelajaran</td>
        <td>:</td>
        <td>{{ $mapel['nm_mapel'] }}</td>
      </tr>
      <tr>
        <td>Semester</td>
        <td>:</td>
        <td>{{ $mapel['semester'] }}</td>
      </tr>
      <tr>
        <td>Kelas</td>
        <td>:</td>
        <td>{{ $mapel['nm_kelas'] }}</td>
      </tr>
    </table>
    <h5>Soal</h5><hr/>
    <ol>
      @foreach($soal as $data)
          <li>{{ $data->soal }}
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
                    <img class="mb-3"  style="width: 100px;" src="files/gambar_jawaban/{{$data->option_1}}" />
                  @else
                    {{ $data->option_1 }}
                  @endif
              </li>
              <li class="{{ CekPengerjaan('b',$data->your_answer,$data->right_answer) }}">
                @if(strpbrk($data->option_2, 'jpg') == 'jpg' || strpbrk($data->option_2, 'JPG') == 'JPG' || strpbrk($data->option_2, 'png') == 'png' || strpbrk($data->option_2, 'PNG') == 'PNG' )
                    <img class="mb-3" style="width: 100px;" src="files/gambar_jawaban/{{$data->option_2}}" />
                  @else
                    {{ $data->option_2 }}
                  @endif
              </li>
              <li class="{{ CekPengerjaan('c',$data->your_answer,$data->right_answer) }}">
                @if(strpbrk($data->option_3, 'jpg') == 'jpg' || strpbrk($data->option_3, 'JPG') == 'JPG' || strpbrk($data->option_3, 'png') == 'png' || strpbrk($data->option_3, 'PNG') == 'PNG' )
                    <img class="mb-3" style="width: 100px;" src="files/gambar_jawaban/{{$data->option_3}}" />
                  @else
                    {{ $data->option_3 }}
                  @endif
              </li>
              <li class="{{ CekPengerjaan('d',$data->your_answer,$data->right_answer) }}">@if(strpbrk($data->option_4, 'jpg') == 'jpg' || strpbrk($data->option_4, 'JPG') == 'JPG' || strpbrk($data->option_4, 'png') == 'png' || strpbrk($data->option_4, 'PNG') == 'PNG' )
                    <img class="mb-3" style="width: 100px;" src="files/gambar_jawaban/{{$data->option_4}}" />
                  @else
                    {{ $data->option_4 }}
                  @endif
              </li>
              <li class="{{ CekPengerjaan('e',$data->your_answer,$data->right_answer) }}">
                @if(strpbrk($data->option_5, 'jpg') == 'jpg' || strpbrk($data->option_5, 'JPG') == 'JPG' || strpbrk($data->option_5, 'png') == 'png' || strpbrk($data->option_5, 'PNG') == 'PNG' )
                    <img class="mb-3" style="width: 100px;" src="files/gambar_jawaban/{{$data->option_5}}" />
                  @else
                    {{ $data->option_5 }}       
                  @endif
              </li>
            </ul>
            @endif
          </li>

      @endforeach
    </ol>
    <hr/>
    <div class="text-center">
      <strong>Jawaban & Pembahasan</strong>
    </div>
    <ol>
      @foreach($soal as $data)
      <li>
        <strong>Jawaban : </strong>
        <p>{{ $data->right_answer }}</p>
      </li>
      <strong>Pembahasan : </strong>
      <p>{{ $data->pembahasan }}</p> 
      @endforeach
    </ol>
  </div>