<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Praktikum</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        a {
            all: unset;
        }

        .menu-toggle {
            display: none;
        }

        @media (max-width: 1023px) {
            .menu-toggle {
                display: block;
                position: fixed;
                top: 15px;
                left: 15px;
                z-index: 2000;
                background: #111827;
                color: white;
                border: none;
                padding: 8px 10px;
                border-radius: 6px;
                cursor: pointer;
                font-size: 24px;
            }
        }

        .sidebar {
            width: 250px;
            background: #1e1e2f;
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 30px;
        }

        .avatar {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #a78bfa, #6366f1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }

        .avatar i {
            font-size: 28px;
            color: white;
        }

        .profile h4 {
            margin: 5px 0 2px;
            font-size: 16px;
        }

        .profile span {
            font-size: 13px;
            color: #cbd5f5;
        }

        .profile small {
            font-size: 12px;
            color: #94a3b8;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin: 10px 0;
            cursor: pointer;
            opacity: 0.8;
        }

        .menu li:hover {
            opacity: 1;
        }

        .menu .active {
            font-weight: 600;
            opacity: 1;
        }

        .dropdown-menu {
            display: none;
            margin-left: 15px;
            margin-top: 5px;
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        .dropdown-menu li {
            font-size: 14px;
            padding-left: 20px;
        }

        .menu-item i {
            width: 20px;
            text-align: center;
        }

        .dropdown-menu li i {
            width: 20px;
            margin-right: 8px;
        }

        .avatar i {
            font-size: 22px;
        }

        .logout {
            margin-top: auto;
            padding: 10px;
            background: #ff4d4d;
            border: none;
            border-radius: 8px;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="toggle menu-toggle" onclick="toggleSidebar()">☰</div>

    <aside class="sidebar" id="sidebar">
        <div class="profile">
            <div class="avatar">
                <i class="fas fa-user-graduate"></i>
            </div>

            <h4>{{ Auth::user()->nama }}</h4>
            <span>{{ Auth::user()->role }}</span>
            <small>NIP {{ Auth::user()->nomor_induk }}</small>
        </div>

        <ul class="menu">
            <li class="menu-item {{ request()->routeIs('admin') ? 'active' : '' }}"><a href="{{ route('admin') }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>

            <li class="menu-item dropdown">
                <div class="dropdown-btn" onclick="toggleDropdown()">
                    <span><i class="fas fa-folder"></i> Manajemen Sistem</span>
                    <span><i class="fas fa-chevron-down"></i></span>
                </div>

                <ul class="dropdown-menu" id="dropdown">
                    <li class="{{ request()->routeIs('masterPraktikum') ? 'active' : '' }}"><a
                            href="{{ route('masterPraktikum') }}"><i class="fas fa-flask"></i> Kelola Praktikum </a>
                    </li>
                    <li class="{{ request()->routeIs('masterJadwal') ? 'active' : '' }}"><a
                            href="{{ route('masterJadwal') }}"><i class="fas fa-calendar"></i>Kelola Jadwal</a>
                    </li>
                    <li class="{{ request()->routeIs('masterUser') ? 'active' : '' }}"><a
                            href="{{ route('masterUser') }}"><i class="fas fa-users"></i> Kelola Pengguna</a>
                    </li>
                </ul>
            </li>

            <li class="menu-item {{ request()->routeIs('masterMonitoring') ? 'active' : '' }}"><a
                    href="{{ route('masterMonitoring') }}">
                    <i class="fas fa-chart-line"></i> Monitoring Sistem</a>
            </li>

            <li class="menu-item {{ request()->routeIs('masterLaporan') ? 'active' : '' }}"><a
                    href="{{ route('masterLaporan') }}">
                    <i class="fas fa-file-alt"></i> Rekap Praktikum</a>
            </li>
        </ul>

        <button class="logout"><a href="{{ route('logout') }}">
                <i class="fas fa-sign-out-alt"></i> Logout</a>
        </button>
    </aside>
</body>
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('active');
    }

    function toggleDropdown() {
        const dropdown = document.getElementById('dropdown');
        dropdown.style.display =
            dropdown.style.display === 'block' ? 'none' : 'block';
        console.log(dropdown.style.display);
    }

    document.addEventListener("click", function(e) {
        const sidebar = document.getElementById("sidebar");
        const toggle = document.querySelector(".toggle");

        if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
            sidebar.classList.remove("active");
        }
    });
</script>
