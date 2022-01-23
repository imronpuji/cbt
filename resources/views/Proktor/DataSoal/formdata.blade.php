@extends('Proktor/Template/main')
@section('content')
@php 
  if($isUpdate){
    $url = url('admin/update_soal/'.$soal['kd_soal']);
  }else{
    $url = url('admin/store_soal');
  }
@endphp
<div class="row justify-content-center">
  <div class="col-md-8"> 
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Soal</a></li>
        <li class="breadcrumb-item active">Kelola Soal</li>
      </ol>
    </nav>
    <a href="{{ url()->previous() }}"><span aria-hidden="true">&laquo;</span> Kembali ke menu kelola Soal</a>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
      </div>
      <div class="card-body">
        <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
          @if($isUpdate)
            {{ method_field('PUT') }}
          @endif
          @csrf
          <div class="form-group">
            <label>Soal</label>
            <textarea name="soal" class="form-control">@if($isUpdate) {{ $soal['soal'] }} @endif
              {{ old('soal') }}
              </textarea>
              @error('soal')
                <div class="invalid-feedback">
                    {{ $message }}  
                </div>
              @enderror
          </div>
          <div class="form-group">
            <label>File Soal Dapat Berupa Gambar Dengan Format .jpg atau .png Untuk File Audio Dengan Format .mp3 atau .wav<span class="text-danger">*Optional</span></label>
              <div class="custom-file">
                <input type="file" name="soal_file" class="custom-file-input" id="customFile" />
                  <label class="custom-file-label" for="customFile">Pilih Gambar</label>
              </div>
              @if($isUpdate && $soal['soal_file'])
                @if(strpbrk($soal['soal_file'], 'jpg') == 'jpg' || strpbrk($soal['soal_file'], 'JPG') == 'JPG' || strpbrk($soal['soal_file'], 'png') == 'png' || strpbrk($soal['soal_file'], 'PNG') == 'PNG' )
                  <img class="mt-2" src="{{ asset('files/file_soal/'.$soal['soal_file']) }}" width="200px">
                @else
                  <p class="mt-2">File Audio Soal</p> 
                  <audio controls><source src="{{ asset('files/file_soal/'.$soal['soal_file']) }}" /></audio>
                @endif
              @endif
          </div>
          <div class="form-group">
            <label>Tipe Soal</label><br/>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" onclick="pilgan()"
              @if($isUpdate && is_null(($soal['option_1'])) && is_null(($soal['option_1'])) && is_null(($soal['option_1'])) && is_null(($soal['option_1'])) && is_null(($soal['option_1'])))
                  {{ 'disabled' }}
              @endif
              @if($isUpdate && !is_null(($soal['option_1'])) && !is_null(($soal['option_1'])) && !is_null(($soal['option_1'])) && !is_null(($soal['option_1'])) && !is_null(($soal['option_1'])))
                  {{ 'checked' }}
              @endif
              >
              <label class="custom-control-label" for="customRadioInline1">Pilihan Ganda</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" onclick="esay()"
               @if($isUpdate && !is_null(($soal['option_1'])) && !is_null(($soal['option_1'])) && !is_null(($soal['option_1'])) && !is_null(($soal['option_1'])) && !is_null(($soal['option_1'])))
                  {{ 'disabled' }}
               @endif
               @if($isUpdate && is_null(($soal['option_1'])) && is_null(($soal['option_1'])) && is_null(($soal['option_1'])) && is_null(($soal['option_1'])) && is_null(($soal['option_1'])))
                  {{ 'checked' }}
              @endif>
              <label class="custom-control-label" for="customRadioInline2">Esay</label>
            </div>
          </div>
          <div id="pilihan_ganda" style="display: none;">            
            <div class="form-group">
              <label>Jawaban A</label>
              <textarea name="option_1" class="form-control" id="option_1">@if($isUpdate){{ $soal['option_1'] }} @endif
              </textarea>
              <label>Apabila Jawaban Berupa Gambar <span class="text-danger">Pilih Salah Satu Dengan Text atau Gambar</span></label>
              <div class="custom-file">
                  <input type="file" name="option_img1" class="custom-file-input" id="jawabanA" />
                  <label class="custom-file-label" for="jawabanA">Pilih Gambar</label>
              </div>
               @if($isUpdate)
                 @if(strpbrk($soal['option_1'], 'jpg') == 'jpg' || strpbrk($soal['option_1'], 'JPG') == 'JPG' || strpbrk($soal['option_1'], 'png') == 'png' || strpbrk($soal['option_1'], 'PNG') == 'PNG' )
                 <img  class="mt-2" style="width: 100px;" src="{{ asset('files/gambar_jawaban/'.$soal['option_1']) }}" />
                 @endif
              @endif
            </div>
            <div class="form-group">
              <label>Jawaban B</label>
              <textarea name="option_2" class="form-control" id="option_2">@if($isUpdate){{ $soal['option_2'] }} @endif
              </textarea>
              <label>Apabila Jawaban Berupa Gambar <span class="text-danger">Pilih Salah Satu Dengan Text atau Gambar</span></label>
             <div class="custom-file">
                <input type="file" name="option_img2" class="custom-file-input" id="jawabanB" />
                  <label class="custom-file-label" for="jawabanB">Pilih Gambar</label>
              </div>
               @if($isUpdate)
                 @if(strpbrk($soal['option_2'], 'jpg') == 'jpg' || strpbrk($soal['option_2'], 'JPG') == 'JPG' || strpbrk($soal['option_2'], 'png') == 'png' || strpbrk($soal['option_2'], 'PNG') == 'PNG' )
                 <img  class="mt-2" style="width: 100px;" src="{{ asset('files/gambar_jawaban/'.$soal['option_2']) }}" />
                 @endif
              @endif
            </div>
            <div class="form-group">
              <label>Jawaban C</label>
              <textarea name="option_3" class="form-control" id="option_3">@if($isUpdate){{ $soal['option_3'] }}@endif
              </textarea>
              <label>Apabila Jawaban Berupa Gambar <span class="text-danger">Pilih Salah Satu Dengan Text atau Gambar</span></label>
              <div class="custom-file">
                <input type="file" name="option_img3" class="custom-file-input" id="jawabanC" />
                  <label class="custom-file-label" for="jawabanC">Pilih Gambar</label>
              </div>
               @if($isUpdate)
                 @if(strpbrk($soal['option_3'], 'jpg') == 'jpg' || strpbrk($soal['option_3'], 'JPG') == 'JPG' || strpbrk($soal['option_3'], 'png') == 'png' || strpbrk($soal['option_3'], 'PNG') == 'PNG' )
                 <img  class="mt-2" style="width: 100px;" src="{{ asset('files/gambar_jawaban/'.$soal['option_3']) }}" />
                 @endif
              @endif
            </div>
            <div class="form-group">
              <label>Jawaban D</label>
              <textarea name="option_4" class="form-control" id="option_4">@if($isUpdate){{ $soal['option_4'] }}@endif
              </textarea>
              <label>Apabila Jawaban Berupa Gambar <span class="text-danger">Pilih Salah Satu Dengan Text atau Gambar</span></label>
              <div class="custom-file">
                <input type="file" name="option_img4" class="custom-file-input" id="jawabanD" />
                  <label class="custom-file-label" for="jawabanD">Pilih Gambar</label>
              </div>
              @if($isUpdate)
                 @if(strpbrk($soal['option_4'], 'jpg') == 'jpg' || strpbrk($soal['option_4'], 'JPG') == 'JPG' || strpbrk($soal['option_4'], 'png') == 'png' || strpbrk($soal['option_4'], 'PNG') == 'PNG' )
                 <img  class="mt-2" style="width: 100px;" src="{{ asset('files/gambar_jawaban/'.$soal['option_4']) }}" />
                 @endif
              @endif
            </div>
            <div class="form-group">
              <label>Jawaban E</label>
              <textarea name="option_5" class="form-control" id="option_5">@if($isUpdate){{ $soal['option_5'] }}@endif
              </textarea>
              <label>Apabila Jawaban Berupa Gambar <span class="text-danger">Pilih Salah Satu Dengan Text atau Gambar</span></label>
              <div class="custom-file">
                <input type="file" name="option_img5" class="custom-file-input" id="jawabanE" />
                  <label class="custom-file-label" for="jawabanE">Pilih Gambar</label>
              </div>
              @if($isUpdate)
                 @if(strpbrk($soal['option_5'], 'jpg') == 'jpg' || strpbrk($soal['option_5'], 'JPG') == 'JPG' || strpbrk($soal['option_5'], 'png') == 'png' || strpbrk($soal['option_5'], 'PNG') == 'PNG' )
                 <img  class="mt-2" style="width: 100px;" src="{{ asset('files/gambar_jawaban/'.$soal['option_5']) }}" />
                 @endif
              @endif
            </div>
            <div class="form-group">
              <label>Kuci Pilihan Ganda</label>
              <select class="custom-select" name="key_answer">
                <option value="a" @if($isUpdate && $soal['right_answer'] == 'a' )
                  {{ 'selected' }}
                 @endif>Jawaban A</option>
                <option value="b" @if($isUpdate && $soal['right_answer'] == 'b' )
                  {{ 'selected' }}
                 @endif>Jawaban B</option>
                <option value="c" @if($isUpdate && $soal['right_answer'] == 'c' )
                  {{ 'selected' }}
                 @endif>Jawaban C</option>
                <option value="d" @if($isUpdate && $soal['right_answer'] == 'd' )
                  {{ 'selected' }}
                 @endif>Jawaban D</option>
                <option value="e" @if($isUpdate && $soal['right_answer'] == 'e' )
                  {{ 'selected' }}
                 @endif>Jawaban E</option>
              </select>
            </div>
          </div>
          <div id="esay" style="display: none;"> 
            <div class="form-group">
              <label>Jawaban Esay</label>
              <textarea name="esay_answer" id="esay_answer" class="form-control">@if($isUpdate){{ $soal['right_answer'] }}@endif
              </textarea>
            </div>
          </div>
          <div class="form-group">
            <label>Pembahasan</label>
            <textarea name="pembahasan" class="form-control">
              @if($isUpdate){{ $soal['pembahasan'] }}@endif
            </textarea>
          </div>
          <div class="form-group">
            <label>Skor</label>
            <input type="text" name="skor" class="form-control" placeholder="contoh : 1.5 atau 2" 
              @if($isUpdate)
                value="{{ $soal['skor'] }}"
              @endif />
          </div>
          <input type="hidden" name="id_kelas" @if($isUpdate) value="{{ $soal['id_kelas'] }}" @else value="{{ Request::segment(3) }} @endif" />
          <input type="hidden" name="kd_mapel" @if($isUpdate) value="{{ $soal['kd_mapel'] }}" @else value="{{ Request::segment(4) }} @endif" />
          <button type="submit" class="btn btn-primary">Simpan</button>
      </form>  
      </div>
    </div>
  </div>
</div>
@endsection