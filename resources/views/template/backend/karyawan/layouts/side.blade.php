    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-heading">Dashboard</li>

      <li class="nav-item {{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}">
        <a class="nav-link " href="{{route('daftar-hadir')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->
      <li class="nav-heading">Pages</li>
      <li class="nav-item {{ $type === 'component' ? 'active' : '' }}">
        <a class="nav-link collapsed " data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('jadwal.user')}}">
              <i class="bi bi-circle"></i><span>Jadwal Jaga</span>
            </a>
          </li>
          <li>
            <a href="{{route('riwayat.daftar-hadir')}}">
              <i class="bi bi-circle"></i><span>Riwayat Presensi</span>
            </a>
          </li>
          <li>
            <a href="{{ route('permohonan.jadwal.user') }}">
              <i class="bi bi-circle"></i><span>Riwayat Perubahan Jaga</span>
            </a>
          </li>
          <li class="{{ Route::currentRouteName() === 'index.izin.user' ? 'active' : '' }}">
            <a href="{{route('index.izin.user')}}">
              <i class="bi bi-circle"></i><span>Riwayat izin & cuti</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Components Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('pengajuan.create')}}">
              <i class="bi bi-circle"></i><span>Form Izin</span>
            </a>
          </li>
          <li>
            <a href="{{route('permohonan.create')}}">
              <i class="bi bi-circle"></i><span>Form Perubahan Jaga</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#insentif-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Insentif & Gaji</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="insentif-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('gaji.pegawai')}}">
              <i class="bi bi-circle"></i><span>Slip Gaji</span>
            </a>
          </li>
          <li>
            <a href="{{route('insentif.pegawai')}}">
              <i class="bi bi-circle"></i><span>Slip Insentif</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-heading">Layanan Jasa Medis / Tindakan</li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#layanan-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Layanan Medis</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="layanan-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('daftar.pasien')}}">
              <i class="bi bi-circle"></i><span>Daftar Pasien</span>
            </a>
          </li>
          <li>
            <a href="{{route('daftar.tugas')}}">
              <i class="bi bi-circle"></i><span>Daftar Tugas Layanan</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Forms Nav -->
      <li class="nav-heading">Support System</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-code"></i>
          <span>Docs API</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-headset"></i>
          <span>IT Support</span>
        </a>
      </li>

    </ul>