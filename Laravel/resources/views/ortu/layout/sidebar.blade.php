<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <h1>EDUTRACK</h1>
    </div>
    
    <ul class="sidebar-menu nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('ortu.dashboard') ? 'active' : '' }}" href="{{ route('ortu.dashboard') }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('ortu.absensi') ? 'active' : '' }}" href="{{ route('ortu.absensi') }}">
                <i class="fas fa-calendar-check"></i>
                <span>Absensi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('ortu.nilai') ? 'active' : '' }}" href="{{route('ortu.nilai')}}">
                <i class="fas fa-chart-line"></i>
                <span>Nilai</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('ortu.laporan') ? 'active' : '' }}" href="{{route('ortu.laporan')}}">
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
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>