<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <h1>EDUTRACK</h1>
    </div>
    
    <ul class="sidebar-menu nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
               href="{{ route('admin.dashboard') }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.absensi') ? 'active' : '' }}" href="{{ route('admin.absensi') }}">
                <i class="fas fa-calendar-check"></i>
                <span>Absensi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.nilai') ? 'active' : '' }}" href="{{route('admin.nilai')}}">
                <i class="fas fa-chart-line"></i>
                <span>Nilai</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.laporan') ? 'active' : '' }}" href="{{route('admin.laporan')}}">
                <i class="fas fa-file-alt"></i>
                <span>Laporan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.data_guru') ? 'active' : '' }}" href="{{route('admin.data_guru')}}">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Data Guru</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.data_orangtua') ? 'active' : '' }}" href="{{route('admin.data_orangtua')}}">
                <i class="fas fa-users"></i>
                <span>Data Orang Tua</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.data_siswa') ? 'active' : '' }}" href="{{route('admin.data_siswa')}}">
                <i class="fas fa-user-graduate"></i>
                <span>Data Siswa</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.data_kelas') ? 'active' : '' }}" href="{{route('admin.data_kelas')}}">
                <i class="fas fa-door-open"></i>
                <span>Data Kelas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.data_mapel') ? 'active' : '' }}" href="{{route('admin.data_mapel')}}">
                <i class="fas fa-book"></i>
                <span>Data Mata Pelajaran</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.data_akademik') ? 'active' : '' }}" href="{{route('admin.data_akademik')}}">
                <i class="fas fa-calendar-alt"></i>
                <span>Data Tahun Akademik</span>
            </a>
        </li>
        <li class="nav-item logout-section">
            <a class="nav-link" href="#" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>