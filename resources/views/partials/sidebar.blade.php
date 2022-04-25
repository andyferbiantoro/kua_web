 <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">

          @if(Auth::user()->role == 'admin')
          <li class="nav-item {{(request()->is('admin')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('admin') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          

           <li class="nav-item {{(request()->is('calon_pengantin')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('calon_pengantin') }}">
              <i class="icon-file menu-icon"></i>
              <span class="menu-title">Data Catin</span>
            </a>
          </li>

           <li class="nav-item {{(request()->is('wali_nikah')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('wali_nikah') }}">
              <i class="icon-file menu-icon"></i>
              <span class="menu-title">Data Wali NIkah</span>
            </a>
          </li>

           <li class="nav-item {{(request()->is('kelola_penyuluh')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('kelola_penyuluh') }}">
              <i class="icon-file menu-icon"></i>
              <span class="menu-title">Data Penyuluh</span>
            </a>
          </li>
         


          <li class="nav-item {{(request()->is('jadwal')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('jadwal') }}">
              <i class="icon-file menu-icon"></i>
              <span class="menu-title">Jadwal Pra-Nikah</span>
            </a>
          </li>


          <li class="nav-item {{(request()->is('sertifikat')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('sertifikat') }}">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Sertifikasi</span>
            </a>
          </li>


          <li class="nav-item {{(request()->is('laporan')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('laporan') }}">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Laporan</span>
            </a>
          </li>


          <li class="nav-item {{(request()->is('materi')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('materi') }}">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Materi</span>
            </a>
          </li>
    @endif      


    @if(Auth::user()->role == 'penyuluh')
          <li class="nav-item {{(request()->is('penyuluh')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('penyuluh') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>


          <li class="nav-item {{(request()->is('lihat_jadwal')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('lihat_jadwal') }}">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Lihat Jadwal</span>
            </a>
          </li>
    @endif 


      @if(Auth::user()->role == 'calon_pengantin')
      <li class="nav-item {{(request()->is('catin_lihat_jadwal')) ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('catin_lihat_jadwal') }}">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Lihat Jadwal Pra-Nikah</span>
        </a>
      </li>


      <li class="nav-item {{(request()->is('sertifikat_catin_suami')) ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('sertifikat_catin_suami') }}">
          <i class="icon-file menu-icon"></i>
          <span class="menu-title">Lihat Sertifikat Suami</span>
        </a>
      </li>


      <li class="nav-item {{(request()->is('sertifikat_catin_istri')) ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('sertifikat_catin_istri') }}">
          <i class="icon-file menu-icon"></i>
          <span class="menu-title">Lihat Sertifikat Istri</span>
        </a>
      </li>

     

      @endif 


    @if(Auth::user()->role == 'kepala_kua')
          <li class="nav-item {{(request()->is('kepala_kua_lihat_sertifikat')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('kepala_kua_lihat_sertifikat') }}">
              <i class="icon-file menu-icon"></i>
              <span class="menu-title">Verifikasi Sertifikat</span>
            </a>
          </li>


           <li class="nav-item {{(request()->is('lihat_laporan')) ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('lihat_laporan') }}">
              <i class="icon-file menu-icon"></i>
              <span class="menu-title">Lihat Laporan</span>
            </a>
          </li>
  
    @endif 

        </ul>
      </nav>