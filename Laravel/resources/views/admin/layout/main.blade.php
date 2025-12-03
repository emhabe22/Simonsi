<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EDUTRACK')</title>
    <link rel="icon" href="{{ asset('images/eduttrack_icon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="m-0 p-0">

    {{-- Sidebar --}}
    @include('admin.layout.sidebar')

    {{-- Overlay untuk HP --}}
    <div class="sidebar-overlay"></div>

    {{-- Main Content --}}
    <div class="main-content">
        <div class="topbar">
            <button class="menu-toggle" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <h2 class="page-title">@yield('page_title')</h2>
        </div>

        @yield('content')
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    {{-- Script Toggle Sidebar --}}
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        const mainContent = document.querySelector('.main-content');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            mainContent.classList.toggle('shifted');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            mainContent.classList.remove('shifted');
        });
    </script>

    @stack('scripts')
</body>
</html>
