<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'eLECTRA User')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #1d2b64, #f8cdda, #232526, #414345);
            background-size: 400% 400%;
            animation: gradientBG 18s ease-in-out infinite;
            min-height: 100vh;
        }

        @keyframes gradientBG {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            animation: twinkle 2s infinite alternate;
        }

        @keyframes twinkle {
            from { opacity: 0.3; }
            to { opacity: 1; }
        }

        .stars {
            position: fixed;
            width: 100vw;
            height: 100vh;
            z-index: 0;
            pointer-events: none;
        }

        .main-container {
            display: flex;
            z-index: 1;
            position: relative;
            min-height: 100vh;
        }

        .sidebar {
            background: rgba(30, 30, 40, 0.85);
            width: 260px;
            padding: 20px;
            color: white;
            backdrop-filter: blur(14px);
            border-right: 1px solid rgba(255,255,255,0.2);
            height: 100vh;
            position: fixed;
            top: 70px;
            left: 0;
            overflow-y: auto;
            transition: left 0.3s ease;
        }

        .sidebar a {
            display: block;
            color: #eee;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 6px;
            transition: background 0.2s ease;
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .navbar-custom {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background: rgba(30, 30, 40, 0.9);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(255,255,255,0.15);
            z-index: 999;
        }

        .content {
            margin-left: 260px;
            padding: 100px 30px 30px;
            width: 100%;
            color: white;
        }

        .dropdown-menu {
            background: #1d2b64;
            color: white;
        }

        .dropdown-menu a {
            color: white;
        }

        .dropdown-menu a:hover {
            background-color: rgba(255,255,255,0.1);
        }

        /* Responsif pada sidebar untuk mobile */
        @media (max-width: 991px) {
            .sidebar {
                position: absolute;
                left: -260px;
                transition: left 0.3s ease;
            }

            .sidebar.active {
                left: 0;
            }

            .content {
                margin-left: 0;
                padding-top: 70px;
            }

            /* Tambahkan tombol untuk toggle sidebar */
            .sidebar-toggle {
                position: absolute;
                top: 10px;
                left: 20px;
                z-index: 1000;
                background: #1d2b64;
                color: white;
                border: none;
                font-size: 1.5rem;
                padding: 10px;
                border-radius: 5px;
                cursor: pointer;
            }
        }
    </style>

    @yield('custom_css')
</head>
<body>
    <div class="stars" id="stars"></div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container-fluid">
            <span class="navbar-brand">eLECTRA</span>
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ url('/home/settings') }}">Profil</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- MAIN STRUCTURE -->
    <div class="main-container">
        <!-- SIDEBAR -->
        <div class="sidebar" id="sidebar">
            <h5 class="mb-4">Menu User</h5>
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">🏠 Dashboard</a>
            <a href="{{ route('user.payments') }}" class="{{ request()->routeIs('user.payments') ? 'active' : '' }}">💡 Tagihan Listrik</a>
            <a href="{{ route('user.tokens.index') }}" class="{{ request()->routeIs('user.tokens.index') ? 'active' : '' }}">⚡ Pembelian Token</a>
            <a href="{{ route('user.history') }}" class="{{ request()->routeIs('user.history') ? 'active' : '' }}">📜 Riwayat Pembayaran</a>
            <a href="{{ route('user.invoice.form') }}" class="{{ request()->routeIs('user.invoice.form') ? 'active' : '' }}">📄 Cetak Invoice</a>
            <!--<a href="{{ route('user.notifications.index') }}" class="{{ request()->routeIs('user.notifications.index') ? 'active' : '' }}">🔔 Promo & Notifikasi</a>-->
            <a href="{{ route('user.settings') }}" class="{{ request()->routeIs('user.settings') ? 'active' : '' }}">⚙️ Pengaturan Akun</a>
        </div>

        <!-- CONTENT -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    <!-- JS -->
    <script>
        const stars = document.getElementById('stars');
        for (let i = 0; i < 80; i++) {
            const s = document.createElement('div');
            s.className = 'star';
            const size = Math.random() * 2 + 1;
            s.style.width = `${size}px`;
            s.style.height = `${size}px`;
            s.style.top = `${Math.random() * 100}vh`;
            s.style.left = `${Math.random() * 100}vw`;
            s.style.opacity = 0.5 + Math.random() * 0.5;
            s.style.animationDuration = `${2 + Math.random() * 2}s`;
            stars.appendChild(s);
        }

        // Toggle sidebar for mobile screens
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
