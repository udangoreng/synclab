<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Dashboard Dosen | Portal Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f0f4f8;
            font-family: 'Inter', sans-serif;
            color: #1e293b;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 28px 32px;
            overflow-x: auto;
            transition: all 0.3s ease;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #1e293b;
        }

        .hero-card {
            border-radius: 28px;
            margin-bottom: 32px;
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            background-image: url('https://placehold.co/1200x300/2c3e50/ffffff?text=Lab+Computer+Science');
            background-size: cover;
            background-position: center 30%;
        }

        .hero-overlay {
            background: linear-gradient(95deg, rgba(10, 25, 47, 0.85) 0%, rgba(30, 58, 80, 0.7) 100%);
            backdrop-filter: blur(2px);
            padding: 32px;
        }

        .hero-text h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
        }

        .hero-text p {
            color: #cbd5e6;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .hero-badge {
            background: #facc15;
            color: #1e293b;
            padding: 6px 14px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            border-radius: 24px;
            padding: 20px;
            display: flex;
            gap: 16px;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #818cf8, #c084fc);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            flex-shrink: 0;
        }

        .stat-info h3 {
            font-size: 0.85rem;
            font-weight: 500;
            color: #64748b;
            margin-bottom: 4px;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e293b;
        }

        .stat-trend {
            font-size: 0.7rem;
            color: #10b981;
        }

        /* SECTION HEADER */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .section-header h2 {
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 8px 18px;
            border-radius: 40px;
            border: none;
            background: #e2e8f0;
            cursor: pointer;
            font-weight: 500;
            transition: 0.2s;
        }

        .filter-btn.active,
        .filter-btn:hover {
            background: #3b82f6;
            color: white;
        }

        /* PRAKTIKUM CARDS */
        .praktikum-grid-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .praktikum-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .praktikum-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
        }

        .card-header-bg {
            padding: 20px;
            color: white;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-header-bg i {
            font-size: 32px;
        }

        .card-header-bg h3 {
            font-size: 1.2rem;
        }

        .card-stats {
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
        }

        .stat-label {
            font-size: 0.7rem;
            color: #64748b;
        }

        .stat-value {
            font-size: 1.4rem;
            font-weight: 700;
        }

        .stat-value.success {
            color: #10b981;
        }

        .stat-value.warning {
            color: #f59e0b;
        }

        .stat-value.danger {
            color: #ef4444;
        }

        .detail-btn {
            width: calc(100% - 40px);
            margin: 0 20px 20px 20px;
            padding: 10px;
            background: #f1f5f9;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.2s;
        }

        .detail-btn:hover {
            background: #3b82f6;
            color: white;
        }

        .two-columns-dosen {
            display: flex;
            gap: 28px;
            flex-wrap: wrap;
        }

        .left-col-dosen {
            flex: 1.2;
            min-width: 280px;
        }

        .right-col-dosen {
            flex: 1;
            min-width: 280px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            border-radius: 24px;
            padding: 22px;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        .card-title-icon {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .card-title-icon i {
            font-size: 1.3rem;
            color: #3b82f6;
        }

        .card-title-icon h3 {
            font-size: 1.1rem;
            flex: 1;
        }

        .badge-pending {
            background: #f59e0b;
            color: white;
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
        }

        .registration-list {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .reg-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .reg-info {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
        }

        .reg-name {
            font-weight: 600;
        }

        .reg-desc {
            font-size: 0.75rem;
            color: #64748b;
        }

        .progress-bar-container {
            background: #e2e8f0;
            border-radius: 40px;
            height: 8px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            border-radius: 40px;
            transition: width 0.3s;
        }

        .reg-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 4px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .reg-status {
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 20px;
            background: #e2e8f0;
        }

        .reg-status.success {
            background: #dcfce7;
            color: #16a34a;
        }

        .reg-status.warning {
            background: #fef3c7;
            color: #d97706;
        }

        .detail-small-btn {
            padding: 4px 12px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-size: 0.7rem;
            transition: 0.2s;
        }

        .detail-small-btn:hover {
            background: #2563eb;
            transform: scale(1.02);
        }

        .validation-summary {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .validation-course-card {
            background: #f8fafc;
            border-radius: 16px;
            padding: 14px;
        }

        .course-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            font-size: 0.95rem;
            flex-wrap: wrap;
        }

        .validation-stats {
            display: flex;
            gap: 20px;
            margin-bottom: 12px;
            font-size: 0.8rem;
            flex-wrap: wrap;
        }

        .validation-stats .validated {
            color: #10b981;
        }

        .validation-stats .pending {
            color: #f59e0b;
        }

        .filter-group {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-group select {
            padding: 8px 12px;
            border-radius: 40px;
            border: 1px solid #e2e8f0;
            background: white;
            cursor: pointer;
            font-size: 0.8rem;
            flex: 1;
            min-width: 120px;
        }

        .attendance-stats {
            display: flex;
            gap: 24px;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .attendance-circle {
            position: relative;
            width: 120px;
            flex-shrink: 0;
        }

        .attendance-circle svg {
            width: 120px;
            height: 120px;
        }

        .circle-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .circle-text .percent {
            font-size: 1.4rem;
            font-weight: 700;
        }

        .circle-text .label {
            font-size: 0.6rem;
            color: #64748b;
            display: block;
        }

        .attendance-breakdown {
            flex: 1;
        }

        .break-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            font-size: 0.85rem;
            flex-wrap: wrap;
        }

        .break-color {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            flex-shrink: 0;
        }

        .card-footer-btn {
            margin-top: 16px;
            text-align: right;
        }

        #performanceClassFilter {
            padding: 6px 12px;
            border-radius: 40px;
            border: 1px solid #e2e8f0;
            background: white;
            cursor: pointer;
            font-size: 0.8rem;
        }


        /* Tablet (768px - 1024px) */
        @media (max-width: 1024px) {
            .main-content {
                padding: 24px;
            }

            .page-title {
                font-size: 1.6rem;
            }

            .hero-text h2 {
                font-size: 1.5rem;
            }

            .stats-row {
                gap: 16px;
            }

            .stat-number {
                font-size: 1.5rem;
            }

            .glass-card {
                padding: 18px;
            }
        }

        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding-bottom: 0;
            }

            .sidebar-header {
                padding: 16px 20px;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .sidebar-nav {
                display: none;
                padding: 0 20px 20px 20px;
            }

            .sidebar-nav.active {
                display: flex;
            }

            .profile-section {
                flex-direction: row;
                text-align: left;
                gap: 16px;
                margin-bottom: 0;
            }

            .avatar-circle {
                width: 60px;
                height: 60px;
                margin: 0;
            }

            .avatar-circle i {
                font-size: 30px;
            }

            .profile-info h3 {
                font-size: 1.1rem;
            }

            .profile-info p {
                font-size: 0.65rem;
            }

            .nav-menu {
                margin-top: 20px;
            }

            .main-content {
                padding: 20px;
            }

            .page-title {
                font-size: 1.4rem;
                margin-bottom: 16px;
            }

            .hero-card {
                margin-bottom: 24px;
            }

            .hero-overlay {
                padding: 24px;
            }

            .hero-text h2 {
                font-size: 1.2rem;
            }

            .hero-text p {
                font-size: 0.75rem;
            }

            .stats-row {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 12px;
            }

            .stat-card {
                padding: 16px;
            }

            .stat-icon {
                width: 48px;
                height: 48px;
                font-size: 24px;
            }

            .stat-number {
                font-size: 1.3rem;
            }

            .section-header h2 {
                font-size: 1.1rem;
            }

            .filter-btn {
                padding: 6px 14px;
                font-size: 0.8rem;
            }

            .two-columns-dosen {
                gap: 20px;
            }

            .glass-card {
                padding: 16px;
                margin-bottom: 20px;
            }

            .card-title-icon h3 {
                font-size: 1rem;
            }

            .attendance-stats {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .attendance-breakdown {
                width: 100%;
            }

            .break-item {
                justify-content: center;
            }
        }

        @media (max-width: 600px) {
            .main-content {
                padding: 16px;
            }

            .page-title {
                font-size: 1.3rem;
            }

            .hero-overlay {
                padding: 20px;
            }

            .hero-text h2 {
                font-size: 1rem;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .praktikum-grid-cards {
                grid-template-columns: 1fr;
            }

            .card-stats {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
                padding: 16px;
            }

            .stat-value {
                font-size: 1.2rem;
            }

            .filter-group {
                flex-direction: column;
            }

            .filter-group select {
                width: 100%;
            }

            .validation-stats {
                flex-direction: column;
                gap: 8px;
            }

            .reg-footer {
                flex-direction: column;
                align-items: flex-start;
            }

            .card-footer-btn {
                text-align: center;
            }

            .detail-small-btn {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .card-header-bg {
                padding: 16px;
            }

            .card-header-bg i {
                font-size: 24px;
            }

            .card-header-bg h3 {
                font-size: 1rem;
            }

            .stat-label {
                font-size: 0.65rem;
            }

            .card-title-icon {
                flex-direction: column;
                align-items: flex-start;
            }

            .badge-pending {
                margin-left: 0;
            }

            .course-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (hover: none) and (pointer: coarse) {

            .nav-item,
            .stat-card,
            .detail-btn,
            .filter-btn,
            .detail-small-btn,
            .logout-btn,
            .course-card {
                cursor: pointer;
                -webkit-tap-highlight-color: transparent;
            }

            .nav-item:active,
            .stat-card:active,
            .detail-btn:active {
                transform: scale(0.98);
                transition: 0.05s;
            }
        }
    </style>
    <div class="dashboard-container">
        @include('dosen/partials/sidebar')

        <main class="main-content">
            <h1 class="page-title"><i class="fas fa-chalkboard-user"></i> Dashboard Dosen</h1>

            <!-- HERO BOX -->
            <div class="hero-card">
                <div class="hero-overlay">
                    <div class="hero-text">
                        <h2 id="topGreetingText">Selamat Siang, Dr. Budi Santoso! 👋</h2>
                        <p>
                            <span id="fullDateDisplay"></span>
                            <span class="hero-badge"><i class="fas fa-chalkboard"></i> Semester Genap 2025/2026</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-info">
                        <h3>Total Mahasiswa</h3>
                        <p class="stat-number">112</p>
                        <span class="stat-trend">3 Kelas (2024A,2024B,2024C)</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-flask"></i></div>
                    <div class="stat-info">
                        <h3>Praktikum Aktif</h3>
                        <p class="stat-number">2</p>
                        <span class="stat-trend">RPL & Jaringan</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
                    <div class="stat-info">
                        <h3>Menunggu Validasi</h3>
                        <p class="stat-number">27</p>
                        <span class="stat-trend">Nilai perlu divalidasi</span>
                    </div>
                </div>
            </div>

            <div class="section-header">
                <h2><i class="fas fa-desktop"></i> Monitoring Praktikum</h2>
                <div class="filter-buttons">
                    <button class="filter-btn active">Semua</button>
                    <button class="filter-btn">Jaringan Komputer</button>
                    <button class="filter-btn">RPL</button>
                </div>
            </div>

            <div class="praktikum-grid-cards">
                <div class="praktikum-card">
                    <div class="card-header-bg" style="background: linear-gradient(135deg, #10b981, #047857);">
                        <i class="fas fa-network-wired"></i>
                        <h3>Jaringan Komputer</h3>
                    </div>
                    <div class="card-stats">
                        <div class="stat-item"><span class="stat-label">Total Mahasiswa</span><span
                                class="stat-value">58</span></div>
                        <div class="stat-item"><span class="stat-label">Hadir Hari Ini</span><span
                                class="stat-value success">52</span></div>
                        <div class="stat-item"><span class="stat-label">Izin</span><span
                                class="stat-value warning">4</span></div>
                        <div class="stat-item"><span class="stat-label">Tanpa Keterangan</span><span
                                class="stat-value danger">2</span></div>
                    </div>
                    <button class="detail-btn">Detail <i class="fas fa-arrow-right"></i></button>
                </div>
                <div class="praktikum-card">
                    <div class="card-header-bg" style="background: linear-gradient(135deg, #f59e0b, #b45309);">
                        <i class="fas fa-code-branch"></i>
                        <h3>RPL</h3>
                    </div>
                    <div class="card-stats">
                        <div class="stat-item"><span class="stat-label">Total Mahasiswa</span><span
                                class="stat-value">54</span></div>
                        <div class="stat-item"><span class="stat-label">Hadir Hari Ini</span><span
                                class="stat-value success">48</span></div>
                        <div class="stat-item"><span class="stat-label">Izin</span><span
                                class="stat-value warning">4</span></div>
                        <div class="stat-item"><span class="stat-label">Tanpa Keterangan</span><span
                                class="stat-value danger">2</span></div>
                    </div>
                    <button class="detail-btn">Detail <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="two-columns-dosen">
                <div class="left-col-dosen">
                    <!-- Status Pendaftaran -->
                    <div class="glass-card">
                        <div class="card-title-icon"><i class="fas fa-clipboard-list"></i>
                            <h3>Status Pendaftaran Praktikum</h3>
                        </div>
                        <div class="registration-list">
                            <div class="reg-item">
                                <div class="reg-info"><span class="reg-name">Jaringan Komputer</span><span
                                        class="reg-desc">Pendaftar: 58/100</span></div>
                                <div class="progress-bar-container">
                                    <div class="progress-bar" style="width: 58%; background: #10b981;"></div>
                                </div>
                                <div class="reg-footer"><span class="reg-status success">Aktif</span><button
                                        class="detail-small-btn" data-course="Jaringan Komputer">Detail <i
                                            class="fas fa-chevron-right"></i></button></div>
                            </div>
                            <div class="reg-item">
                                <div class="reg-info"><span class="reg-name">RPL</span><span
                                        class="reg-desc">Pendaftar: 54/100</span></div>
                                <div class="progress-bar-container">
                                    <div class="progress-bar" style="width: 54%; background: #f59e0b;"></div>
                                </div>
                                <div class="reg-footer"><span class="reg-status warning">Tersedia</span><button
                                        class="detail-small-btn" data-course="RPL">Detail <i
                                            class="fas fa-chevron-right"></i></button></div>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card">
                        <div class="card-title-icon"><i class="fas fa-check-double"></i>
                            <h3>Validasi Nilai</h3><span class="badge-pending">27 Pending</span>
                        </div>
                        <div class="validation-summary">
                            <div class="validation-course-card">
                                <div class="course-header"><i class="fas fa-network-wired"></i><strong>Jaringan
                                        Komputer</strong></div>
                                <div class="validation-stats"><span class="validated">✓ Tervalidasi: 42</span><span
                                        class="pending">⏳ Belum: 16</span></div>
                                <button class="detail-small-btn view-course-valid"
                                    data-course="Jaringan Komputer">Lihat Detail</button>
                            </div>
                            <div class="validation-course-card">
                                <div class="course-header"><i class="fas fa-code-branch"></i><strong>RPL</strong>
                                </div>
                                <div class="validation-stats"><span class="validated">✓ Tervalidasi: 31</span><span
                                        class="pending">⏳ Belum: 11</span></div>
                                <button class="detail-small-btn view-course-valid" data-course="RPL">Lihat
                                    Detail</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="right-col-dosen">
                    <!-- Rekap Presensi -->
                    <div class="glass-card">
                        <div class="card-title-icon"><i class="fas fa-calendar-check"></i>
                            <h3>Rekap Presensi</h3>
                        </div>
                        <div class="filter-group">
                            <select id="presenceClassFilter">
                                <option value="2024A">Kelas 2024A</option>
                                <option value="2024B">Kelas 2024B</option>
                                <option value="2024C">Kelas 2024C</option>
                            </select>
                            <select id="presenceCourseFilter">
                                <option value="Jaringan Komputer">Jaringan Komputer</option>
                                <option value="RPL">RPL</option>
                            </select>
                        </div>
                        <div class="attendance-stats" id="attendanceStats">
                            <div class="attendance-circle">
                                <svg viewBox="0 0 100 100">
                                    <circle cx="50" cy="50" r="45" fill="none" stroke="#e2e8f0"
                                        stroke-width="8" />
                                    <circle cx="50" cy="50" r="45" fill="none" stroke="#3b82f6"
                                        stroke-width="8" stroke-dasharray="283" stroke-dashoffset="85"
                                        stroke-linecap="round" transform="rotate(-90 50 50)" />
                                </svg>
                                <div class="circle-text"><span class="percent" id="attendancePercent">0%</span><span
                                        class="label">Kehadiran</span></div>
                            </div>
                            <div class="attendance-breakdown" id="attendanceBreakdown"></div>
                        </div>
                        <div class="card-footer-btn"><button class="detail-small-btn" id="attendanceDetailBtn">Detail
                                Presensi <i class="fas fa-arrow-right"></i></button></div>
                    </div>

                    <div class="glass-card">
                        <div class="card-title-icon">
                            <i class="fas fa-chart-line"></i>
                            <h3>Performa Kelas (Rata-rata Nilai Pretest)</h3>
                        </div>
                        <div class="filter-group">
                            <select id="performanceClassFilter">
                                <option value="2024A">Kelas 2024A</option>
                                <option value="2024B">Kelas 2024B</option>
                                <option value="2024C">Kelas 2024C</option>
                            </select>
                            <select id="performanceCourseFilter">
                                <option value="Jaringan Komputer">Jaringan Komputer</option>
                                <option value="RPL">RPL</option>
                            </select>
                        </div>
                        <canvas id="performanceChart" width="400" height="200"
                            style="width:100%; max-height:200px;"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // script-dosen.js
        (function() {
            const now = new Date();
            const hour = now.getHours();
            let greetingTime = "Selamat pagi";
            if (hour >= 12 && hour < 18) greetingTime = "Selamat siang";
            else if (hour >= 18) greetingTime = "Selamat malam";

            const topGreetingSpan = document.getElementById("topGreetingText");
            if (topGreetingSpan) topGreetingSpan.innerText = `${greetingTime}, Dr. Budi Santoso! 👋`;

            const optionsDate = {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            const formattedDate = now.toLocaleDateString('id-ID', optionsDate);
            const fullDateSpan = document.getElementById("fullDateDisplay");
            if (fullDateSpan) fullDateSpan.innerHTML = `<i class="far fa-calendar-alt"></i> ${formattedDate}`;

            const presenceData = {
                '2024A': {
                    'Jaringan Komputer': {
                        hadir: 19,
                        izin: 2,
                        sakit: 1,
                        alpha: 1,
                        total: 23,
                        percent: 83
                    },
                    'RPL': {
                        hadir: 17,
                        izin: 2,
                        sakit: 1,
                        alpha: 1,
                        total: 21,
                        percent: 81
                    }
                },
                '2024B': {
                    'Jaringan Komputer': {
                        hadir: 18,
                        izin: 1,
                        sakit: 1,
                        alpha: 2,
                        total: 22,
                        percent: 82
                    },
                    'RPL': {
                        hadir: 16,
                        izin: 2,
                        sakit: 1,
                        alpha: 1,
                        total: 20,
                        percent: 80
                    }
                },
                '2024C': {
                    'Jaringan Komputer': {
                        hadir: 15,
                        izin: 3,
                        sakit: 2,
                        alpha: 1,
                        total: 21,
                        percent: 71
                    },
                    'RPL': {
                        hadir: 15,
                        izin: 2,
                        sakit: 1,
                        alpha: 2,
                        total: 20,
                        percent: 75
                    }
                }
            };

            function updateAttendanceDisplay() {
                const kelas = document.getElementById('presenceClassFilter').value;
                const matkul = document.getElementById('presenceCourseFilter').value;
                const data = presenceData[kelas]?.[matkul];
                if (!data) return;

                document.getElementById('attendancePercent').innerText = `${data.percent}%`;

                const circle = document.querySelector('#attendanceStats svg circle:last-child');
                if (circle) {
                    const circumference = 2 * Math.PI * 45;
                    const offset = circumference - (data.percent / 100) * circumference;
                    circle.style.strokeDasharray = circumference;
                    circle.style.strokeDashoffset = offset;
                }

                document.getElementById('attendanceBreakdown').innerHTML = `
            <div class="break-item"><span class="break-color" style="background: #3b82f6;"></span><span>Hadir: ${data.hadir}</span></div>
            <div class="break-item"><span class="break-color" style="background: #f59e0b;"></span><span>Izin: ${data.izin}</span></div>
            <div class="break-item"><span class="break-color" style="background: #10b981;"></span><span>Sakit: ${data.sakit}</span></div>
            <div class="break-item"><span class="break-color" style="background: #ef4444;"></span><span>Alpha: ${data.alpha}</span></div>
            <div class="break-item"><span class="break-color" style="background: #64748b;"></span><span>Total: ${data.total}</span></div>
        `;
            }

            document.getElementById('presenceClassFilter').addEventListener('change', updateAttendanceDisplay);
            document.getElementById('presenceCourseFilter').addEventListener('change', updateAttendanceDisplay);
            updateAttendanceDisplay();

            let performanceChart;

            const pretestData = {
                '2024A': {
                    'Jaringan Komputer': [78, 82, 79, 85, 83, 88],
                    'RPL': [75, 80, 78, 82, 81, 85]
                },
                '2024B': {
                    'Jaringan Komputer': [72, 75, 74, 78, 76, 80],
                    'RPL': [70, 74, 73, 76, 75, 78]
                },
                '2024C': {
                    'Jaringan Komputer': [68, 70, 72, 74, 73, 76],
                    'RPL': [65, 68, 70, 72, 71, 74]
                }
            };

            const pretestLabels = ['Pretest 1', 'Pretest 2', 'Pretest 3', 'Pretest 4', 'Pretest 5', 'Pretest 6'];

            function initChart() {
                const kelas = document.getElementById('performanceClassFilter').value;
                const matkul = document.getElementById('performanceCourseFilter').value;
                const data = pretestData[kelas]?.[matkul] || [70, 72, 74, 76, 75, 78];

                const ctx = document.getElementById('performanceChart').getContext('2d');
                if (performanceChart) performanceChart.destroy();

                // Warna berbeda untuk setiap mata kuliah
                const chartColor = matkul === 'Jaringan Komputer' ? '#10b981' : '#f59e0b';
                const chartBgColor = matkul === 'Jaringan Komputer' ? 'rgba(16, 185, 129, 0.1)' :
                    'rgba(245, 158, 11, 0.1)';

                performanceChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: pretestLabels,
                        datasets: [{
                            label: `${matkul} - Rata-rata Nilai Pretest`,
                            data: data,
                            borderColor: chartColor,
                            backgroundColor: chartBgColor,
                            tension: 0.3,
                            fill: true,
                            pointBackgroundColor: chartColor,
                            pointBorderColor: 'white',
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: (ctx) => `Nilai Rata-rata: ${ctx.raw}`
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,
                                title: {
                                    display: true,
                                    text: 'Nilai',
                                    font: {
                                        size: 10
                                    }
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Pretest ke-',
                                    font: {
                                        size: 10
                                    }
                                }
                            }
                        }
                    }
                });
            }

            const perfClassFilter = document.getElementById('performanceClassFilter');
            const perfCourseFilter = document.getElementById('performanceCourseFilter');

            if (perfClassFilter) {
                perfClassFilter.addEventListener('change', () => initChart());
            }
            if (perfCourseFilter) {
                perfCourseFilter.addEventListener('change', () => initChart());
            }
            initChart();

            const mobileToggle = document.getElementById("mobileMenuToggle");
            const sidebarNav = document.getElementById("sidebarNav");

            if (mobileToggle && sidebarNav) {
                mobileToggle.addEventListener("click", () => {
                    sidebarNav.classList.toggle("active");
                    const icon = mobileToggle.querySelector("i");
                    if (sidebarNav.classList.contains("active")) {
                        icon.classList.remove("fa-bars");
                        icon.classList.add("fa-times");
                    } else {
                        icon.classList.remove("fa-times");
                        icon.classList.add("fa-bars");
                    }
                });
            }

            const filterBtns = document.querySelectorAll('.filter-btn');
            const praktikumCards = document.querySelectorAll('.praktikum-card');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    filterBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    const filterText = btn.innerText;
                    praktikumCards.forEach(card => {
                        const cardTitle = card.querySelector('.card-header-bg h3')?.innerText ||
                            '';
                        if (filterText === 'Semua' || cardTitle === filterText) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });

            document.querySelectorAll('.detail-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const card = btn.closest('.praktikum-card');
                    const title = card.querySelector('.card-header-bg h3')?.innerText || 'Praktikum';
                });
            });

            document.querySelectorAll('.detail-small-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    if (btn.getAttribute('data-course')) {} else if (btn.id === 'attendanceDetailBtn') {
                        const kelas = document.getElementById('presenceClassFilter').value;
                        const matkul = document.getElementById('presenceCourseFilter').value;
                    } else if (btn.id === 'performanceDetailBtn') {
                        const kelas = document.getElementById('performanceClassFilter').value;
                        const matkul = document.getElementById('performanceCourseFilter').value;
                    } else if (btn.classList.contains('view-course-valid')) {}
                });
            });

            document.querySelectorAll('.view-course-valid').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const course = btn.getAttribute('data-course');
                });
            });

  
            const logoutBtn = document.querySelector('.logout-btn');

            document.querySelectorAll('.nav-item').forEach(item => {
                item.addEventListener('click', () => {
                    document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove(
                        'active'));
                    item.classList.add('active');
                    if (window.innerWidth <= 768 && sidebarNav.classList.contains('active')) {
                        sidebarNav.classList.remove('active');
                        const icon = mobileToggle?.querySelector("i");
                        if (icon) {
                            icon.classList.remove("fa-times");
                            icon.classList.add("fa-bars");
                        }
                    }
                });
            });

            document.querySelectorAll('.stat-card').forEach(card => {
                card.addEventListener('click', () => {
                    const title = card.querySelector('h3')?.innerText || '';
                });
            });
        })();
    </script>
</body>

</html>
