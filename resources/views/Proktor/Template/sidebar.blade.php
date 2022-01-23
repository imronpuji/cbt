@php
$kls = \App\kelas::all();
@endphp
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('admin') }}">
    <div class="sidebar-brand-icon">
      <img src="{{ asset('logo/school.png') }}" style="width: 50px;" />
    </div>
    <div class="sidebar-brand-text mx-3">PROKTOR PAGE</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="{{ url('admin') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Data Master
    </div>

    <li class="nav-item">
      <a class="nav-link" href="{{ url('admin/proktor') }}">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Data Proktor</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/kelas') }}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Data Kelas</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/sesi_ujian') }}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Data Sesi Ujian</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/siswa') }}" data-toggle="collapse" data-target="#collapseTwo">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Data Siswa</span></a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Kelas :</h6>
              @foreach($kls as $data)
              <a class="collapse-item" href="{{ url('admin/siswa/'.$data->id_kelas) }}">{{ $data->nm_kelas }}</a>
              @endforeach
            </div>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/siswa') }}" data-toggle="collapse" data-target="#collapseTwoTwo">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Data Sesi Siswa</span></a>
            <div id="collapseTwoTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kelas :</h6>
                @foreach($kls as $data)
                <a class="collapse-item" href="{{ url('admin/sesi_siswa/'.$data->id_kelas) }}">{{ $data->nm_kelas }}</a>
                @endforeach
              </div>
            </div>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseThree">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Data Matapelajaran</span></a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Kelas :</h6>
                @foreach($kls as $data)
                <a class="collapse-item" href="{{ url('admin/mapel/'.$data->id_kelas) }}">{{ $data->nm_kelas }}</a>
                @endforeach
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFour">
              <i class="fas fa-fw fa-chart-area"></i>
              <span>Data Soal</span></a>
              <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Kelas :</h6>
                  @foreach($kls as $data)
                  <a class="collapse-item" href="{{ url('admin/list_mapel/'.$data->id_kelas) }}">{{ $data->nm_kelas }}</a>
                  @endforeach
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFive">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Data Nilai</span></a>
                <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelas :</h6>
                    @foreach($kls as $data)
                    <a class="collapse-item" href="{{ url('admin/list_mapel_nilai/'.$data->id_kelas) }}">{{ $data->nm_kelas }}</a>
                    @endforeach
                  </div>
                </div>
              </li>

              <!-- Divider -->
              <hr class="sidebar-divider d-none d-md-block">

              <!-- Sidebar Toggler (Sidebar) -->
              <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
              </div>

            </ul>
    <!-- End of Sidebar -->