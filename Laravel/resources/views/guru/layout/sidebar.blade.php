<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <h1>EDUTRACK</h1>
    </div>
    
    <ul class="sidebar-menu nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}" href="{{ route('guru.dashboard') }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('guru.absensi') ? 'active' : '' }}" href="{{ route('guru.absensi') }}">
                <i class="fas fa-calendar-check"></i>
                <span>Input Absensi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('guru.nilai') ? 'active' : '' }}" href="{{route('guru.nilai')}}">
                <i class="fas fa-chart-line"></i>
                <span>Input Nilai</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('guru.laporan') ? 'active' : '' }}" href="{{route('guru.laporan')}}">
                <i class="fas fa-file-alt"></i>
                <span>Laporan</span>
            </a>
        </li>
        <li class="nav-item logout-section">
            <a class="nav-link" href="#" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" action="#" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>