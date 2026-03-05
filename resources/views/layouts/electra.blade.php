<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'eLECTRA Admin')</title>

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
            top: 70px; /* agar tidak menabrak navbar */
            left: 0;
            overflow-y: auto;
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
            z-index: 1050; /* Tambahkan z-index */
        }

        .content {
            margin-left: 260px;
            padding: 100px 30px 30px; /* 70px navbar + 30px padding */
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
    </style>

    @yield('custom_css')
</head>
<body>
    <div class="stars" id="stars"></div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container-fluid">
            <span class="navbar-brand">eLECTRA Admin</span>
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Profil</a></li>
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
        <div class="sidebar">
            <h5 class="mb-4">Menu Admin</h5>
            <a href="{{ route('home') }}" class="{{ request()->is('home') ? 'active' : '' }}">📊 Dashboard</a>
            <a href="{{ route('admin.users') }}" class="{{ request()->is('admin/users') ? 'active' : '' }}">👥 Manajemen Pengguna</a>
            <a href="{{ route('admin.tokens.index') }}" class="{{ request()->is('admin/tokens*') ? 'active' : '' }}">⚡ Token Listrik</a>
            <a href="{{ route('admin.transactions.index') }}" class="{{ request()->is('admin/transactions*') ? 'active' : '' }}">💰 Transaksi</a>
            <!--<a href="{{ route('admin.notifications.index') }}" class="{{ request()->is('admin/notifications*') ? 'active' : '' }}">🔔 Notifikasi & Promo</a>-->
            <a href="{{ route('admin.reports') }}" class="{{ request()->is('admin/reports*') ? 'active' : '' }}">📄 Laporan</a>
            <a href="{{ route('admin.settings') }}" class="{{ request()->is('admin/settings*') ? 'active' : '' }}">⚙️ Pengaturan Sistem</a>
            <a href="{{ route('admin.settings.payment') }}" class="{{ request()->is('admin/settings/payment') ? 'active' : '' }}">💳 Pengaturan Pembayaran</a>
            <a href="{{ route('admin.billing') }}" class="{{ request()->is('admin/billing') ? 'active' : '' }}">📥 Pengelolaan Tagihan Listrik</a>
        </div>

        <!-- CONTENT -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    <script>
        // Generate bintang
        const starCount = 80;
        const stars = document.getElementById('stars');
        for (let i = 0; i < starCount; i++) {
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
