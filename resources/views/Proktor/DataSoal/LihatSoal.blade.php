@extends('Proktor/Template/main')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Soal</a></li>
    <li class="breadcrumb-item">{{ $mapel['nm_mapel'] }}</li>
  </ol>
</nav>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Soal {{ $mapel['nm_mapel'] }}</h6>
  </div>
  <div class="card-body">
    <a href="{{ url('admin/print_soal/'.$mapel['kd_mapel']) }}" class="btn btn-sm btn-success mb-2">Export Pdf</a><hr/>
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
              @if(strpbrk($data->soal_file, 'png') == 'png' || 
						    strpbrk($data->soal_file, 'jpg') == 'jpg')
					     <img class="mb-3" src="{{ asset('files/file_soal/'.$data->soal_file) }}" />
              @elseif(strpbrk($data->soal_file, 'mp3') == 'mp3' || 
                strpbrk($data->soal_file, 'wav') == 'wav')
                <audio controls><source src="{{ asset('files/file_soal/'.$data->soal_file) }}" type="audio/mpeg"></audio>
              @endif
            @endif
            @if(
              $data->option_1 != null && $data->option_2 != null &&  $data->option_3 != null &&  $data->option_4 != null &&  $data->option_5 != null
            )
            <ul class="option_test">
              <li class="{{ CekPengerjaan('a',$data->your_answer,$data->right_answer) }}">
                  @if(strpbrk($data->option_1, 'jpg') == 'jpg' || strpbrk($data->option_1, 'JPG') == 'JPG' || strpbrk($data->option_1, 'png') == 'png' || strpbrk($data->option_1, 'PNG') == 'PNG' )
                    <img class="mb-3"  style="width: 100px;" src="{{ asset('files/gambar_jawaban/'.$data->option_2) }}" />
                  @else
                    {{ $data->option_1 }}
                  @endif
              </li>
              <li class="{{ CekPengerjaan('b',$data->your_answer,$data->right_answer) }}">
                @if(strpbrk($data->option_2, 'jpg') == 'jpg' || strpbrk($data->option_2, 'JPG') == 'JPG' || strpbrk($data->option_2, 'png') == 'png' || strpbrk($data->option_2, 'PNG') == 'PNG' )
                    <img class="mb-3" style="width: 100px;" src="{{ asset('files/gambar_jawaban/'.$data->option_2) }}" />
                  @else
                    {{ $data->option_2 }}
                  @endif
              </li>
              <li class="{{ CekPengerjaan('c',$data->your_answer,$data->right_answer) }}">
                @if(strpbrk($data->option_3, 'jpg') == 'jpg' || strpbrk($data->option_3, 'JPG') == 'JPG' || strpbrk($data->option_3, 'png') == 'png' || strpbrk($data->option_3, 'PNG') == 'PNG' )
                    <img class="mb-3" style="width: 100px;" src="{{ asset('files/gambar_jawaban/'.$data->option_3) }}" />
                  @else
                    {{ $data->option_3 }}
                  @endif
              </li>
              <li class="{{ CekPengerjaan('d',$data->your_answer,$data->right_answer) }}">@if(strpbrk($data->option_4, 'jpg') == 'jpg' || strpbrk($data->option_4, 'JPG') == 'JPG' || strpbrk($data->option_4, 'png') == 'png' || strpbrk($data->option_4, 'PNG') == 'PNG' )
                    <img class="mb-3" style="width: 100px;" src="{{ asset('files/gambar_jawaban/'.$data->option_4) }}" />
                  @else
                    {{ $data->option_4 }}
                  @endif
              </li>
              <li class="{{ CekPengerjaan('e',$data->your_answer,$data->right_answer) }}">
                @if(strpbrk($data->option_5, 'jpg') == 'jpg' || strpbrk($data->option_5, 'JPG') == 'JPG' || strpbrk($data->option_5, 'png') == 'png' || strpbrk($data->option_5, 'PNG') == 'PNG' )
                    <img class="mb-3" style="width: 100px;" src="{{ asset('files/gambar_jawaban/'.$data->option_5) }}" />
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
</div>
@endsection