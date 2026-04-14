<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Asisten</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        a {
            all: unset;
        }

        .dropdown ul {
            display: none;
            list-style: none;
            padding-left: 20px;
        }

        .dropdown ul.open {
            display: block;
            max-height: 200px;
        }

        .dropdown ul li {
            font-size: 14px;
            padding: 6px;
        }

        .right {
            float: right !important;
            transition: transform 0.2s;
            display: flex !important;
            justify-content: end !important;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1500;
        }

        .overlay.active {
            display: block;
        }

        @media (min-width: 1200px) {
            .sidebar {
                width: 280px;
            }
        }

        @media (max-width: 1199px) and (min-width: 769px) {
            .sidebar {
                width: 240px;
                padding: 16px;
            }

            .profile h4 {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block !important;
            }

            aside.sidebar#sidebar {
                position: fixed !important;
                top: 0 !important;
                transform: translateX(-100%) !important;
                left: 0 !important;
                width: 280px !important;
                max-width: 85vw !important;
                height: 100vh !important;
                z-index: 2000 !important;
                transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
                overflow-y: auto !important;
                background: #0f172a !important;
            }

            aside.sidebar#sidebar.show {
                transform: translateX(0) !important;
            }

            .profile {
                margin-bottom: 20px;
            }

            .avatar {
                width: 60px;
                height: 60px;
            }

            .avatar i {
                font-size: 24px;
            }

            .profile h4 {
                font-size: 1rem;
                margin: 8px 0;
            }

            .profile span,
            .profile small {
                font-size: 11px;
            }

            .menu li {
                padding: 14px 12px;
                font-size: 15px;
            }

            .dropdown ul {
                padding-left: 16px;
                max-height: 300px;
                overflow: hidden;
                transition: max-height 0.3s ease;
            }

            .dropdown ul.open {
                max-height: 400px;
            }

            .dropdown ul li {
                padding: 10px 12px;
                font-size: 14px;
            }

            .logout {
                padding: 14px;
                font-size: 15px;
                margin-top: 10px;
            }
        }

        @media (max-width: 480px) {
            .menu-toggle {
                padding: 10px 12px;
                top: 10px;
                left: 10px;
            }

            .sidebar {
                width: 90vw;
            }

            .menu li,
            .logout {
                font-size: 16px;
                padding: 16px 14px;
            }
        }

        @media (hover: none) and (pointer: coarse) {
            .menu li:active {
                background: rgba(255, 255, 255, 0.2) !important;
            }
        }

        body.sidebar-open {
            overflow: hidden;
        }
    </style>
</head>

<body>

    <button onclick="toggleSidebar()" class="menu-toggle">☰</button>

    <div class="overlay" id="overlay" onclick="closeSidebar()"></div>

    <aside class="sidebar" id="sidebar">
        <div class="profile">
            <div class="avatar">
                <i class="fas fa-user-graduate"></i>
            </div>
            <h4>{{ Auth::user()->nama }}</h4>
            <span>{{ Auth::user()->role }}</span>
            <small>NIM {{ Auth::user()->nomor_induk }}</small>
        </div>

        <ul class="menu">
            <li class="{{ request()->routeIs('asisten') ? 'active' : '' }}"><a href="{{ route('asisten') }}">
                    <i class="fas fa-home"></i> Dashboard</a>
            </li>

            <li class="{{ request()->routeIs('asistensi') ? 'active' : '' }}"><a href="{{ route('asistensi') }}">
                    <i class="fas fa-laptop-code"></i> Practicum</a>
            </li>

            <li class="dropdown">
                <div onclick="toggleDropdown('presensi')">
                    <i class="fas fa-calendar-check"></i> Attendance
                    <i class="fas fa-chevron-down right sb-right"></i>
                </div>

                <ul id="presensi">
                    <li class="{{ request()->routeIs('konfirmasiPresensi') ? 'active' : '' }}"><a
                            href="{{ route('konfirmasiPresensi') }}">Record Attendance</a></li>
                    <li class="{{ request()->routeIs('riwayatPresensi') ? 'active' : '' }}"><a
                            href="{{ route('riwayatPresensi') }}">Attendance History</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <div onclick="toggleDropdown('modul')">
                    <i class="fas fa-book"></i> Resource & Test
                    <i class="fas fa-chevron-down right sb-right"></i>
                </div>

                <ul id="modul">
                    <li class="{{ request()->routeIs('addModul') ? 'active' : '' }}"><a
                            href="{{ route('addModul') }}">Add Resource</a></li>
                    <li class="{{ request()->routeIs('addPretest') ? 'active' : '' }}"><a
                            href="{{ route('addPretest') }}">Create Test</a></li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('nilaiLaporan') ? 'active' : '' }}"><a href="{{route('nilaiLaporan')}}">
                <i class="fas fa-file"></i>Reports</a>
            </li>

            <li class="dropdown">
                <div onclick="toggleDropdown('nilai')">
                    <i class="fas fa-chart-line"></i>Grades
                    <i class="fas fa-chevron-down right sb-right"></i>
                </div>

                <ul id="nilai">
                    <li class="{{ request()->routeIs('addMilai') ? 'active' : '' }}"><a
                            href="{{ route('addNilai') }}">Record Grades</a></li>  
                    <li class="{{ request()->routeIs('rekapNilai') ? 'active' : '' }}"><a
                            href="{{ route('rekapNilai') }}">Grade Summary</a></li>  
                </ul>
            </li>

            <li class="{{ request()->routeIs('seeMahasiswa') ? 'active' : '' }}"><a href="{{route('seeMahasiswa')}}">
                <i class="fas fa-users"></i>Students
            </a>
            </li>
        </ul>

        <button class="logout">
            <a href="{{ route('logout') }}">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </button>
    </aside>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");

            sidebar.classList.toggle("show");
            overlay.classList.toggle("active");

            if (sidebar.classList.contains("show")) {
                document.body.classList.add("sidebar-open");
            } else {
                document.body.classList.remove("sidebar-open");
            }
        }

        function closeSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            sidebar.classList.remove("show");
            overlay.classList.remove("active");
            document.body.classList.remove("sidebar-open");
        }

        function toggleDropdown(id) {
            const menu = document.getElementById(id);
            menu.classList.toggle("open");
        }

        document.addEventListener("click", function(e) {
            const sidebar = document.getElementById("sidebar");
            const toggle = document.querySelector(".menu-toggle");
            const overlay = document.getElementById("overlay");

            if (overlay && overlay.contains(e.target)) {
                closeSidebar();
                return;
            }

            if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
                closeSidebar();
            }
        });
    </script>
</body>
