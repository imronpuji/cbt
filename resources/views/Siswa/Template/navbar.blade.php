<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow p-0">
  <div class="container">
   <a class="navbar-brand" href="#">
    <img src="{{ asset('logo/school.png') }}" class="logo-header" />
    CBT TEST
   </a>
   <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link active dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Data Siswa 
      </a>
      <div class="dropdown-menu animated--grow-in shadow dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a href="#" class="dropdown-item">NIS : {{ Session::get('nis') }} </a>
        <a href="#" class="dropdown-item">NAMA : {{ Session::get('nama') }} </a>
        <a href="#" class="dropdown-item">KELAS : {{ Session::get('kelas') }} </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ url('test/logout') }}">Logout <span class="fa fa-sign-out-alt"></span></a>
      </div>
    </li>
  </ul>
</div>
</nav>