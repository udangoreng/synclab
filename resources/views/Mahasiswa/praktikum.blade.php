<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Pendaftaran Praktikum | Mahasiswa</title>
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
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #1e293b;
        }

        .tab-navigation {
            display: flex;
            gap: 12px;
            margin-bottom: 28px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 12px;
            flex-wrap: wrap;
        }

        .tab-btn {
            padding: 8px 24px;
            background: transparent;
            border: none;
            font-size: 0.95rem;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            transition: 0.2s;
            border-radius: 40px;
        }

        .tab-btn:hover {
            color: #3b82f6;
            background: #eff6ff;
        }

        .tab-btn.active {
            color: #3b82f6;
            background: #eff6ff;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }

        .course-card {
            background: white;
            border-radius: 24px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .course-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
        }

        .course-icon {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
            flex-shrink: 0;
        }

        .course-info {
            flex: 1;
        }

        .course-info h3 {
            font-size: 1rem;
            margin-bottom: 4px;
        }

        .course-info p {
            font-size: 0.7rem;
            color: #64748b;
        }

        .btn-more {
            padding: 8px 16px;
            background: #f1f5f9;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.8rem;
            transition: 0.2s;
            white-space: nowrap;
        }

        .btn-more:hover {
            background: #3b82f6;
            color: white;
        }

        .modul-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .modul-item {
            background: #f8fafc;
            border-radius: 20px;
            padding: 16px;
        }

        .modul-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .modul-title {
            font-weight: 700;
            font-size: 1rem;
            color: #1e293b;
        }

        .modul-badge {
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .modul-badge.available {
            background: #dcfce7;
            color: #16a34a;
        }

        .modul-badge.upcoming {
            background: #fef3c7;
            color: #d97706;
        }

        .modul-badge.completed {
            background: #e2e8f0;
            color: #64748b;
        }

        .modul-materi {
            font-size: 0.85rem;
            color: #475569;
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .modul-footer {
            display: flex;
            justify-content: flex-end;
        }

        .btn-daftar {
            padding: 8px 20px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.8rem;
            transition: 0.2s;
        }

        .btn-daftar:hover {
            background: #2563eb;
        }

        .btn-daftar:disabled {
            background: #cbd5e1;
            cursor: not-allowed;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 40px;
            font-size: 0.9rem;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .schedule-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 20px;
            transition: 0.2s;
            cursor: pointer;
        }

        .schedule-card:hover {
            border-color: #3b82f6;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
            transform: translateY(-2px);
        }

        .schedule-lab {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .schedule-lab i {
            margin-right: 8px;
            color: #3b82f6;
        }

        .schedule-time {
            font-size: 0.85rem;
            color: #475569;
            margin-bottom: 8px;
        }

        .schedule-date {
            font-size: 0.8rem;
            color: #64748b;
            margin-bottom: 8px;
        }

        .schedule-lecturer {
            font-size: 0.8rem;
            color: #64748b;
            margin-bottom: 8px;
        }

        .schedule-quota {
            font-size: 0.75rem;
            color: #10b981;
            margin-top: 8px;
        }

        .btn-pilih {
            width: 100%;
            margin-top: 12px;
            padding: 8px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-pilih:hover {
            background: #2563eb;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 28px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s ease;
        }

        .modal-large {
            max-width: 800px;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            border-bottom: 1px solid #e2e8f0;
        }

        .modal-header h3 {
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #94a3b8;
            transition: 0.2s;
        }

        .modal-close:hover {
            color: #ef4444;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding: 16px 24px;
            border-top: 1px solid #e2e8f0;
        }

        .btn-cancel {
            padding: 8px 20px;
            background: #f1f5f9;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-next {
            padding: 8px 20px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
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
                gap: 16px;
                text-align: left;
            }

            .avatar-circle {
                width: 60px;
                height: 60px;
                margin: 0;
            }

            .avatar-circle i {
                font-size: 30px;
            }

            .main-content {
                padding: 20px;
            }

            .courses-grid {
                grid-template-columns: 1fr;
            }

            .course-card {
                flex-wrap: wrap;
            }

            .btn-more {
                width: 100%;
                text-align: center;
                margin-top: 8px;
            }

            .schedule-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 16px;
            }

            .modal-content {
                width: 95%;
            }
        }
    </style>
    <div class="dashboard-container">
        @include('mahasiswa/partials/sidebar')

        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title"><i class="fas fa-flask"></i> My Praktikum</h1>
            </div>

            <div class="tab-navigation">
                <button class="tab-btn active" data-tab="active">Active</button>
                <button class="tab-btn" data-tab="upcoming">Upcoming</button>
                <button class="tab-btn" data-tab="completed">Completed</button>
            </div>

            <div id="tab-all" class="tab-content active">
                <div class="courses-grid">
                    <div class="course-card" data-course="pemrograman-dasar">
                        <div class="course-icon" style="background: linear-gradient(135deg, #3b82f6, #1e40af);"><i
                                class="fas fa-code"></i></div>
                        <div class="course-info">
                            <h3>Pemrograman Dasar</h3>
                            <p>Kode: PD2401 | SKS: 2 | Dosen: Dr. Anita Wijaya, M.Kom.</p>
                        </div>
                        <button class="btn-more" data-course="pemrograman-dasar" data-type="all">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="struktur-data">
                        <div class="course-icon" style="background: linear-gradient(135deg, #14b8a6, #0f766e);"><i
                                class="fas fa-layer-group"></i></div>
                        <div class="course-info">
                            <h3>Struktur Data</h3>
                            <p>Kode: SD2402 | SKS: 3 | Dosen: Dr. Bambang Prasetyo, M.T.</p>
                        </div>
                        <button class="btn-more" data-course="struktur-data" data-type="all">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="basis-data">
                        <div class="course-icon" style="background: linear-gradient(135deg, #3b82f6, #1e40af);"><i
                                class="fas fa-database"></i></div>
                        <div class="course-info">
                            <h3>Basis Data</h3>
                            <p>Kode: BD2403 | SKS: 3 | Dosen: Dr. Citra Dewi, S.Si., M.Kom.</p>
                        </div>
                        <button class="btn-more" data-course="basis-data" data-type="all">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="jarkom">
                        <div class="course-icon" style="background: linear-gradient(135deg, #10b981, #047857);"><i
                                class="fas fa-network-wired"></i></div>
                        <div class="course-info">
                            <h3>Jaringan Komputer</h3>
                            <p>Kode: JARKOM2404 | SKS: 3 | Dosen: Dr. Budi Santoso, M.Kom.</p>
                        </div>
                        <button class="btn-more" data-course="jarkom" data-type="all">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="sistem-operasi">
                        <div class="course-icon" style="background: linear-gradient(135deg, #ef4444, #b91c1c);"><i
                                class="fas fa-desktop"></i></div>
                        <div class="course-info">
                            <h3>Sistem Operasi</h3>
                            <p>Kode: SO2405 | SKS: 3 | Dosen: Dr. Deni Setiawan, M.Cs.</p>
                        </div>
                        <button class="btn-more" data-course="sistem-operasi" data-type="all">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="pcd">
                        <div class="course-icon" style="background: linear-gradient(135deg, #8b5cf6, #5b21b6);"><i
                                class="fas fa-image"></i></div>
                        <div class="course-info">
                            <h3>Pengolahan Citra Digital</h3>
                            <p>Kode: PCD2406 | SKS: 2 | Dosen: Dr. Eka Permata, M.T.</p>
                        </div>
                        <button class="btn-more" data-course="pcd" data-type="all">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="iot">
                        <div class="course-icon" style="background: linear-gradient(135deg, #ec489a, #be185d);"><i
                                class="fas fa-microchip"></i></div>
                        <div class="course-info">
                            <h3>Internet of Things (IoT)</h3>
                            <p>Kode: IOT2407 | SKS: 2 | Dosen: Dr. Fajar Nugroho, S.T., M.Eng.</p>
                        </div>
                        <button class="btn-more" data-course="iot" data-type="all">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="rpl">
                        <div class="course-icon" style="background: linear-gradient(135deg, #f59e0b, #b45309);"><i
                                class="fas fa-code-branch"></i></div>
                        <div class="course-info">
                            <h3>Rekayasa Perangkat Lunak (RPL)</h3>
                            <p>Kode: RPL2408 | SKS: 3 | Dosen: Dr. Budi Santoso, M.Kom.</p>
                        </div>
                        <button class="btn-more" data-course="rpl" data-type="all">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <div id="tab-upcoming" class="tab-content">
                <div class="courses-grid">
                    <!-- Sama seperti all tapi dengan data-type="upcoming" -->
                    <div class="course-card" data-course="pemrograman-dasar-upcoming">
                        <div class="course-icon" style="background: linear-gradient(135deg, #9ca3af, #6b7280);"><i
                                class="fas fa-code"></i></div>
                        <div class="course-info">
                            <h3>Pemrograman Dasar</h3>
                            <p>Kode: PD2401 | SKS: 2 | Dosen: Dr. Anita Wijaya, M.Kom.</p>
                        </div>
                        <button class="btn-more" data-course="pemrograman-dasar" data-type="upcoming">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="struktur-data-upcoming">
                        <div class="course-icon" style="background: linear-gradient(135deg, #9ca3af, #6b7280);"><i
                                class="fas fa-layer-group"></i></div>
                        <div class="course-info">
                            <h3>Struktur Data</h3>
                            <p>Kode: SD2402 | SKS: 3 | Dosen: Dr. Bambang Prasetyo, M.T.</p>
                        </div>
                        <button class="btn-more" data-course="struktur-data" data-type="upcoming">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="basis-data-upcoming">
                        <div class="course-icon" style="background: linear-gradient(135deg, #9ca3af, #6b7280);"><i
                                class="fas fa-database"></i></div>
                        <div class="course-info">
                            <h3>Basis Data</h3>
                            <p>Kode: BD2403 | SKS: 3 | Dosen: Dr. Citra Dewi, S.Si., M.Kom.</p>
                        </div>
                        <button class="btn-more" data-course="basis-data" data-type="upcoming">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="jarkom-upcoming">
                        <div class="course-icon" style="background: linear-gradient(135deg, #9ca3af, #6b7280);"><i
                                class="fas fa-network-wired"></i></div>
                        <div class="course-info">
                            <h3>Jaringan Komputer</h3>
                            <p>Kode: JARKOM2404 | SKS: 3 | Dosen: Dr. Budi Santoso, M.Kom.</p>
                        </div>
                        <button class="btn-more" data-course="jarkom" data-type="upcoming">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="sistem-operasi-upcoming">
                        <div class="course-icon" style="background: linear-gradient(135deg, #9ca3af, #6b7280);"><i
                                class="fas fa-desktop"></i></div>
                        <div class="course-info">
                            <h3>Sistem Operasi</h3>
                            <p>Kode: SO2405 | SKS: 3 | Dosen: Dr. Deni Setiawan, M.Cs.</p>
                        </div>
                        <button class="btn-more" data-course="sistem-operasi" data-type="upcoming">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="pcd-upcoming">
                        <div class="course-icon" style="background: linear-gradient(135deg, #9ca3af, #6b7280);"><i
                                class="fas fa-image"></i></div>
                        <div class="course-info">
                            <h3>Pengolahan Citra Digital</h3>
                            <p>Kode: PCD2406 | SKS: 2 | Dosen: Dr. Eka Permata, M.T.</p>
                        </div>
                        <button class="btn-more" data-course="pcd" data-type="upcoming">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="iot-upcoming">
                        <div class="course-icon" style="background: linear-gradient(135deg, #9ca3af, #6b7280);"><i
                                class="fas fa-microchip"></i></div>
                        <div class="course-info">
                            <h3>Internet of Things (IoT)</h3>
                            <p>Kode: IOT2407 | SKS: 2 | Dosen: Dr. Fajar Nugroho, S.T., M.Eng.</p>
                        </div>
                        <button class="btn-more" data-course="iot" data-type="upcoming">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="rpl-upcoming">
                        <div class="course-icon" style="background: linear-gradient(135deg, #9ca3af, #6b7280);"><i
                                class="fas fa-code-branch"></i></div>
                        <div class="course-info">
                            <h3>Rekayasa Perangkat Lunak (RPL)</h3>
                            <p>Kode: RPL2408 | SKS: 3 | Dosen: Dr. Budi Santoso, M.Kom.</p>
                        </div>
                        <button class="btn-more" data-course="rpl" data-type="upcoming">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <div id="tab-completed" class="tab-content">
                <div class="courses-grid">
                    <div class="course-card" data-course="pemrograman-dasar-completed">
                        <div class="course-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);"><i
                                class="fas fa-code"></i></div>
                        <div class="course-info">
                            <h3>Pemrograman Dasar</h3>
                            <p>Kode: PD2401 | SKS: 2 | Dosen: Dr. Anita Wijaya, M.Kom.</p>
                        </div>
                        <button class="btn-more" data-course="pemrograman-dasar" data-type="completed">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="struktur-data-completed">
                        <div class="course-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);"><i
                                class="fas fa-layer-group"></i></div>
                        <div class="course-info">
                            <h3>Struktur Data</h3>
                            <p>Kode: SD2402 | SKS: 3 | Dosen: Dr. Bambang Prasetyo, M.T.</p>
                        </div>
                        <button class="btn-more" data-course="struktur-data" data-type="completed">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="basis-data-completed">
                        <div class="course-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);"><i
                                class="fas fa-database"></i></div>
                        <div class="course-info">
                            <h3>Basis Data</h3>
                            <p>Kode: BD2403 | SKS: 3 | Dosen: Dr. Citra Dewi, S.Si., M.Kom.</p>
                        </div>
                        <button class="btn-more" data-course="basis-data" data-type="completed">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="jarkom-completed">
                        <div class="course-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);"><i
                                class="fas fa-network-wired"></i></div>
                        <div class="course-info">
                            <h3>Jaringan Komputer</h3>
                            <p>Kode: JARKOM2404 | SKS: 3 | Dosen: Dr. Budi Santoso, M.Kom.</p>
                        </div>
                        <button class="btn-more" data-course="jarkom" data-type="completed">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="sistem-operasi-completed">
                        <div class="course-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);"><i
                                class="fas fa-desktop"></i></div>
                        <div class="course-info">
                            <h3>Sistem Operasi</h3>
                            <p>Kode: SO2405 | SKS: 3 | Dosen: Dr. Deni Setiawan, M.Cs.</p>
                        </div>
                        <button class="btn-more" data-course="sistem-operasi" data-type="completed">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="pcd-completed">
                        <div class="course-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);"><i
                                class="fas fa-image"></i></div>
                        <div class="course-info">
                            <h3>Pengolahan Citra Digital</h3>
                            <p>Kode: PCD2406 | SKS: 2 | Dosen: Dr. Eka Permata, M.T.</p>
                        </div>
                        <button class="btn-more" data-course="pcd" data-type="completed">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="iot-completed">
                        <div class="course-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);"><i
                                class="fas fa-microchip"></i></div>
                        <div class="course-info">
                            <h3>Internet of Things (IoT)</h3>
                            <p>Kode: IOT2407 | SKS: 2 | Dosen: Dr. Fajar Nugroho, S.T., M.Eng.</p>
                        </div>
                        <button class="btn-more" data-course="iot" data-type="completed">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="course-card" data-course="rpl-completed">
                        <div class="course-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);"><i
                                class="fas fa-code-branch"></i></div>
                        <div class="course-info">
                            <h3>Rekayasa Perangkat Lunak (RPL)</h3>
                            <p>Kode: RPL2408 | SKS: 3 | Dosen: Dr. Budi Santoso, M.Kom.</p>
                        </div>
                        <button class="btn-more" data-course="rpl" data-type="completed">More <i
                                class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div class="modal" id="modalModul">
        <div class="modal-content modal-large">
            <div class="modal-header">
                <h3 id="modalModulTitle"><i class="fas fa-book-open"></i> Detail Praktikum</h3>
                <button class="modal-close" id="closeModulModal">&times;</button>
            </div>
            <div class="modal-body" id="modalModulBody"></div>
        </div>
    </div>

    <div class="modal" id="modalFormDiri">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-user-edit"></i> Pendaftaran Praktikum</h3>
                <button class="modal-close" id="closeFormModal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group"><label>Nama Lengkap</label><input type="text" id="formNama"
                        value="Caca Mahasiswa"></div>
                <div class="form-group"><label>NIM</label><input type="text" id="formNim" value="24051204194">
                </div>
                <div class="form-group"><label>Email</label><input type="email" id="formEmail"
                        value="caca@student.ac.id"></div>
                <div class="form-group"><label>Kelas</label><select id="formKelas">
                        <option>2024A</option>
                        <option>2024B</option>
                        <option>2024C</option>
                    </select></div>
                <input type="hidden" id="selectedCourseName"><input type="hidden" id="selectedModulTitle"><input
                    type="hidden" id="selectedTabType">
            </div>
            <div class="modal-footer"><button class="btn-cancel" id="cancelFormModal">Batal</button><button
                    class="btn-next" id="nextToSchedule">Next <i class="fas fa-arrow-right"></i></button></div>
        </div>
    </div>

    <div class="modal" id="modalSchedule">
        <div class="modal-content modal-large">
            <div class="modal-header">
                <h3><i class="fas fa-calendar-alt"></i> Pilih Jadwal Praktikum</h3><button class="modal-close"
                    id="closeScheduleModal">&times;</button>
            </div>
            <div class="modal-body" id="modalScheduleBody"></div>
        </div>
    </div>
    <script>
        (function() {
            const modulDataAll = {
                'pemrograman-dasar': {
                    name: "Pemrograman Dasar",
                    moduls: [{
                            title: "Modul 1: Algoritma & Flowchart",
                            materi: "Pengenalan algoritma, flowchart, dan pseudocode.",
                            status: "available"
                        },
                        {
                            title: "Modul 2: Variabel & Tipe Data",
                            materi: "Pengertian variabel, tipe data (int, float, char, boolean).",
                            status: "available"
                        },
                        {
                            title: "Modul 3: Percabangan (If-Else, Switch)",
                            materi: "Struktur kontrol percabangan untuk pengambilan keputusan.",
                            status: "available"
                        },
                        {
                            title: "Modul 4: Perulangan (Looping)",
                            materi: "Perulangan for, while, do-while untuk mengulang eksekusi kode.",
                            status: "available"
                        }
                    ]
                },
                'struktur-data': {
                    name: "Struktur Data",
                    moduls: [{
                            title: "Modul 1: Array & Linked List",
                            materi: "Implementasi array dan single linked list.",
                            status: "available"
                        },
                        {
                            title: "Modul 2: Stack & Queue",
                            materi: "Konsep LIFO (Stack) dan FIFO (Queue).",
                            status: "available"
                        },
                        {
                            title: "Modul 3: Tree & Binary Search Tree",
                            materi: "Struktur pohon, BST, dan operasi traversal.",
                            status: "available"
                        },
                        {
                            title: "Modul 4: Sorting & Searching",
                            materi: "Algoritma sorting dan searching.",
                            status: "available"
                        }
                    ]
                },
                'basis-data': {
                    name: "Basis Data",
                    moduls: [{
                            title: "Modul 1: Pengenalan Basis Data & SQL",
                            materi: "Konsep basis data, DBMS, dan perintah dasar SQL.",
                            status: "available"
                        },
                        {
                            title: "Modul 2: Normalisasi & ERD",
                            materi: "Teknik normalisasi dan pembuatan ERD.",
                            status: "available"
                        },
                        {
                            title: "Modul 3: Join & Subquery",
                            materi: "Penggunaan INNER JOIN, LEFT JOIN, dan subquery.",
                            status: "available"
                        },
                        {
                            title: "Modul 4: Transaction & Stored Procedure",
                            materi: "Konsep transaction dan stored procedure.",
                            status: "available"
                        }
                    ]
                },
                'jarkom': {
                    name: "Jaringan Komputer",
                    moduls: [{
                            title: "Modul 1: Pengenalan Jaringan & OSI Layer",
                            materi: "Konsep dasar jaringan, model OSI/TCP/IP.",
                            status: "available"
                        },
                        {
                            title: "Modul 2: Subnetting & VLSM",
                            materi: "Teknik subnetting IP address dan VLSM.",
                            status: "available"
                        },
                        {
                            title: "Modul 3: Routing Statis & Dinamis",
                            materi: "Konfigurasi routing statis dan dinamis.",
                            status: "available"
                        },
                        {
                            title: "Modul 4: VLAN & Inter-VLAN Routing",
                            materi: "Pembuatan VLAN dan konfigurasi inter-VLAN routing.",
                            status: "available"
                        }
                    ]
                },
                'sistem-operasi': {
                    name: "Sistem Operasi",
                    moduls: [{
                            title: "Modul 1: Pengenalan Sistem Operasi",
                            materi: "Sejarah, jenis, dan arsitektur sistem operasi.",
                            status: "available"
                        },
                        {
                            title: "Modul 2: Manajemen Proses",
                            materi: "Konsep proses, thread, dan scheduling algoritma.",
                            status: "available"
                        },
                        {
                            title: "Modul 3: Manajemen Memori",
                            materi: "Alokasi memori, swapping, paging, segmentation.",
                            status: "available"
                        },
                        {
                            title: "Modul 4: File System & Keamanan",
                            materi: "Struktur file system dan keamanan sistem operasi.",
                            status: "available"
                        }
                    ]
                },
                'pcd': {
                    name: "Pengolahan Citra Digital",
                    moduls: [{
                            title: "Modul 1: Sampling & Kuantisasi",
                            materi: "Konsep sampling dan kuantisasi pada citra digital.",
                            status: "available"
                        },
                        {
                            title: "Modul 2: Operasi Aritmatika Citra",
                            materi: "Operasi penjumlahan, pengurangan pada citra.",
                            status: "available"
                        },
                        {
                            title: "Modul 3: Filtering & Edge Detection",
                            materi: "Low-pass filter, high-pass filter, deteksi tepi.",
                            status: "available"
                        },
                        {
                            title: "Modul 4: Segmentasi Citra",
                            materi: "Metode thresholding dan region growing.",
                            status: "available"
                        }
                    ]
                },
                'iot': {
                    name: "Internet of Things (IoT)",
                    moduls: [{
                            title: "Modul 1: Pengenalan IoT & Arduino",
                            materi: "Konsep IoT, arsitektur, pengenalan Arduino.",
                            status: "available"
                        },
                        {
                            title: "Modul 2: Sensor & Aktuator",
                            materi: "Penggunaan sensor dan aktuator.",
                            status: "available"
                        },
                        {
                            title: "Modul 3: Komunikasi Data (MQTT, HTTP)",
                            materi: "Protokol MQTT, HTTP, dan konektivitas cloud.",
                            status: "available"
                        },
                        {
                            title: "Modul 4: Proyek IoT",
                            materi: "Implementasi proyek IoT end-to-end.",
                            status: "available"
                        }
                    ]
                },
                'rpl': {
                    name: "Rekayasa Perangkat Lunak (RPL)",
                    moduls: [{
                            title: "Modul 1: Pengenalan RPL & Tools",
                            materi: "Konsep RPL, metodologi, dan tools pendukung.",
                            status: "available"
                        },
                        {
                            title: "Modul 2: Analisis Kebutuhan",
                            materi: "Teknik pengumpulan kebutuhan dan use case diagram.",
                            status: "available"
                        },
                        {
                            title: "Modul 3: Perancangan Sistem (UML)",
                            materi: "Class diagram, sequence diagram, activity diagram.",
                            status: "available"
                        },
                        {
                            title: "Modul 4: Implementasi & Pengujian",
                            materi: "Implementasi kode, unit testing, debugging.",
                            status: "available"
                        }
                    ]
                }
            };

            const modulDataUpcoming = {
                'pemrograman-dasar': {
                    name: "Pemrograman Dasar",
                    moduls: [{
                            title: "Modul 5: Fungsi & Prosedur",
                            materi: "Pengertian fungsi, prosedur, parameter, dan return value.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 6: Array & String",
                            materi: "Pengertian array satu dimensi, multi dimensi, dan operasi string.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 7: Pointer & Dynamic Memory",
                            materi: "Konsep pointer, alokasi memori dinamis, dan penggunaannya.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 8: File Handling",
                            materi: "Operasi membaca dan menulis file dalam pemrograman.",
                            status: "upcoming"
                        }
                    ]
                },
                'struktur-data': {
                    name: "Struktur Data",
                    moduls: [{
                            title: "Modul 5: Hash Table",
                            materi: "Konsep hash table, fungsi hash, dan collision handling.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 6: Graph",
                            materi: "Representasi graph, BFS, DFS, dan shortest path.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 7: Heap & Priority Queue",
                            materi: "Struktur heap dan implementasi priority queue.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 8: Advanced Sorting",
                            materi: "Algoritma sorting lanjutan (heap sort, radix sort).",
                            status: "upcoming"
                        }
                    ]
                },
                'basis-data': {
                    name: "Basis Data",
                    moduls: [{
                            title: "Modul 5: Indexing & View",
                            materi: "Konsep indexing, view, dan penggunaannya dalam database.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 6: Trigger & Event",
                            materi: "Pembuatan trigger dan event untuk otomatisasi.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 7: Backup & Recovery",
                            materi: "Teknik backup dan recovery database.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 8: Database Security",
                            materi: "Manajemen user, privilege, dan keamanan database.",
                            status: "upcoming"
                        }
                    ]
                },
                'jarkom': {
                    name: "Jaringan Komputer",
                    moduls: [{
                            title: "Modul 5: DHCP & DNS Server",
                            materi: "Konfigurasi DHCP server dan DNS server.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 6: Firewall & NAT",
                            materi: "Konfigurasi firewall dan Network Address Translation.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 7: VPN & Tunneling",
                            materi: "Konsep VPN dan teknik tunneling.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 8: Network Monitoring",
                            materi: "Monitoring jaringan menggunakan tools seperti Wireshark.",
                            status: "upcoming"
                        }
                    ]
                },
                'sistem-operasi': {
                    name: "Sistem Operasi",
                    moduls: [{
                            title: "Modul 5: Deadlock",
                            materi: "Konsep deadlock, avoidance, detection, dan recovery.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 6: Virtual Memory",
                            materi: "Implementasi virtual memory dan page replacement.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 7: I/O Systems",
                            materi: "Manajemen input/output dan device driver.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 8: Distributed Systems",
                            materi: "Konsep sistem terdistribusi dan komunikasi.",
                            status: "upcoming"
                        }
                    ]
                },
                'pcd': {
                    name: "Pengolahan Citra Digital",
                    moduls: [{
                            title: "Modul 5: Morfologi Citra",
                            materi: "Operasi morfologi seperti erosi, dilasi, opening, closing.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 6: Ekstraksi Fitur",
                            materi: "Teknik ekstraksi fitur untuk pengenalan objek.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 7: Kompresi Citra",
                            materi: "Teknik kompresi citra (lossy dan lossless).",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 8: Pengenalan Pola",
                            materi: "Pengenalan pola menggunakan machine learning.",
                            status: "upcoming"
                        }
                    ]
                },
                'iot': {
                    name: "Internet of Things (IoT)",
                    moduls: [{
                            title: "Modul 5: ESP8266/ESP32",
                            materi: "Penggunaan ESP8266/ESP32 untuk konektivitas WiFi.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 6: MQTT Protocol",
                            materi: "Implementasi protokol MQTT untuk komunikasi IoT.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 7: Cloud Platform",
                            materi: "Integrasi dengan platform cloud (ThingSpeak, Blynk).",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 8: Proyek IoT Lanjutan",
                            materi: "Implementasi proyek IoT dengan multiple sensor.",
                            status: "upcoming"
                        }
                    ]
                },
                'rpl': {
                    name: "Rekayasa Perangkat Lunak (RPL)",
                    moduls: [{
                            title: "Modul 5: Software Testing",
                            materi: "Teknik pengujian perangkat lunak (black box, white box).",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 6: Software Metrics",
                            materi: "Pengukuran kualitas perangkat lunak.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 7: Software Maintenance",
                            materi: "Pemeliharaan dan evolusi perangkat lunak.",
                            status: "upcoming"
                        },
                        {
                            title: "Modul 8: Project Management",
                            materi: "Manajemen proyek perangkat lunak (agile, scrum).",
                            status: "upcoming"
                        }
                    ]
                }
            };

            const modulDataCompleted = {
                'pemrograman-dasar': {
                    name: "Pemrograman Dasar",
                    moduls: [{
                            title: "Modul 1: Algoritma & Flowchart",
                            materi: "Pengenalan algoritma, flowchart, dan pseudocode.",
                            status: "completed",
                            nilai: "A (92)"
                        },
                        {
                            title: "Modul 2: Variabel & Tipe Data",
                            materi: "Pengertian variabel, tipe data (int, float, char, boolean).",
                            status: "completed",
                            nilai: "A- (88)"
                        },
                        {
                            title: "Modul 3: Percabangan (If-Else, Switch)",
                            materi: "Struktur kontrol percabangan.",
                            status: "completed",
                            nilai: "B+ (85)"
                        },
                        {
                            title: "Modul 4: Perulangan (Looping)",
                            materi: "Perulangan for, while, do-while.",
                            status: "completed",
                            nilai: "A (90)"
                        }
                    ]
                },
                'struktur-data': {
                    name: "Struktur Data",
                    moduls: [{
                            title: "Modul 1: Array & Linked List",
                            materi: "Implementasi array dan single linked list.",
                            status: "completed",
                            nilai: "A (95)"
                        },
                        {
                            title: "Modul 2: Stack & Queue",
                            materi: "Konsep LIFO (Stack) dan FIFO (Queue).",
                            status: "completed",
                            nilai: "A- (89)"
                        },
                        {
                            title: "Modul 3: Tree & Binary Search Tree",
                            materi: "Struktur pohon, BST, dan operasi traversal.",
                            status: "completed",
                            nilai: "B+ (86)"
                        },
                        {
                            title: "Modul 4: Sorting & Searching",
                            materi: "Algoritma sorting dan searching.",
                            status: "completed",
                            nilai: "A (93)"
                        }
                    ]
                },
                'basis-data': {
                    name: "Basis Data",
                    moduls: [{
                            title: "Modul 1: Pengenalan Basis Data & SQL",
                            materi: "Konsep basis data, DBMS, dan perintah dasar SQL.",
                            status: "completed",
                            nilai: "A (91)"
                        },
                        {
                            title: "Modul 2: Normalisasi & ERD",
                            materi: "Teknik normalisasi dan pembuatan ERD.",
                            status: "completed",
                            nilai: "A- (87)"
                        },
                        {
                            title: "Modul 3: Join & Subquery",
                            materi: "Penggunaan INNER JOIN, LEFT JOIN, dan subquery.",
                            status: "completed",
                            nilai: "B+ (84)"
                        },
                        {
                            title: "Modul 4: Transaction & Stored Procedure",
                            materi: "Konsep transaction dan stored procedure.",
                            status: "completed",
                            nilai: "A (90)"
                        }
                    ]
                },
                'jarkom': {
                    name: "Jaringan Komputer",
                    moduls: [{
                            title: "Modul 1: Pengenalan Jaringan & OSI Layer",
                            materi: "Konsep dasar jaringan, model OSI/TCP/IP.",
                            status: "completed",
                            nilai: "A (94)"
                        },
                        {
                            title: "Modul 2: Subnetting & VLSM",
                            materi: "Teknik subnetting IP address dan VLSM.",
                            status: "completed",
                            nilai: "A (92)"
                        },
                        {
                            title: "Modul 3: Routing Statis & Dinamis",
                            materi: "Konfigurasi routing statis dan dinamis.",
                            status: "completed",
                            nilai: "A- (88)"
                        },
                        {
                            title: "Modul 4: VLAN & Inter-VLAN Routing",
                            materi: "Pembuatan VLAN dan konfigurasi inter-VLAN routing.",
                            status: "completed",
                            nilai: "B+ (86)"
                        }
                    ]
                },
                'sistem-operasi': {
                    name: "Sistem Operasi",
                    moduls: [{
                            title: "Modul 1: Pengenalan Sistem Operasi",
                            materi: "Sejarah, jenis, dan arsitektur sistem operasi.",
                            status: "completed",
                            nilai: "A (90)"
                        },
                        {
                            title: "Modul 2: Manajemen Proses",
                            materi: "Konsep proses, thread, dan scheduling algoritma.",
                            status: "completed",
                            nilai: "A- (87)"
                        },
                        {
                            title: "Modul 3: Manajemen Memori",
                            materi: "Alokasi memori, swapping, paging, segmentation.",
                            status: "completed",
                            nilai: "B+ (85)"
                        },
                        {
                            title: "Modul 4: File System & Keamanan",
                            materi: "Struktur file system dan keamanan sistem operasi.",
                            status: "completed",
                            nilai: "A (91)"
                        }
                    ]
                },
                'pcd': {
                    name: "Pengolahan Citra Digital",
                    moduls: [{
                            title: "Modul 1: Sampling & Kuantisasi",
                            materi: "Konsep sampling dan kuantisasi pada citra digital.",
                            status: "completed",
                            nilai: "A (93)"
                        },
                        {
                            title: "Modul 2: Operasi Aritmatika Citra",
                            materi: "Operasi penjumlahan, pengurangan pada citra.",
                            status: "completed",
                            nilai: "A- (89)"
                        },
                        {
                            title: "Modul 3: Filtering & Edge Detection",
                            materi: "Low-pass filter, high-pass filter, deteksi tepi.",
                            status: "completed",
                            nilai: "B+ (86)"
                        },
                        {
                            title: "Modul 4: Segmentasi Citra",
                            materi: "Metode thresholding dan region growing.",
                            status: "completed",
                            nilai: "A (92)"
                        }
                    ]
                },
                'iot': {
                    name: "Internet of Things (IoT)",
                    moduls: [{
                            title: "Modul 1: Pengenalan IoT & Arduino",
                            materi: "Konsep IoT, arsitektur, pengenalan Arduino.",
                            status: "completed",
                            nilai: "A (91)"
                        },
                        {
                            title: "Modul 2: Sensor & Aktuator",
                            materi: "Penggunaan sensor dan aktuator.",
                            status: "completed",
                            nilai: "A- (88)"
                        },
                        {
                            title: "Modul 3: Komunikasi Data (MQTT, HTTP)",
                            materi: "Protokol MQTT, HTTP, dan konektivitas cloud.",
                            status: "completed",
                            nilai: "B+ (85)"
                        },
                        {
                            title: "Modul 4: Proyek IoT",
                            materi: "Implementasi proyek IoT end-to-end.",
                            status: "completed",
                            nilai: "A (94)"
                        }
                    ]
                },
                'rpl': {
                    name: "Rekayasa Perangkat Lunak (RPL)",
                    moduls: [{
                            title: "Modul 1: Pengenalan RPL & Tools",
                            materi: "Konsep RPL, metodologi, dan tools pendukung.",
                            status: "completed",
                            nilai: "A (95)"
                        },
                        {
                            title: "Modul 2: Analisis Kebutuhan",
                            materi: "Teknik pengumpulan kebutuhan dan use case diagram.",
                            status: "completed",
                            nilai: "A (93)"
                        },
                        {
                            title: "Modul 3: Perancangan Sistem (UML)",
                            materi: "Class diagram, sequence diagram, activity diagram.",
                            status: "completed",
                            nilai: "A- (89)"
                        },
                        {
                            title: "Modul 4: Implementasi & Pengujian",
                            materi: "Implementasi kode, unit testing, debugging.",
                            status: "completed",
                            nilai: "B+ (87)"
                        }
                    ]
                }
            };


            const scheduleData = {
                'pemrograman-dasar': [{
                        lab: "Lab Multimedia Lt.3",
                        day: "Senin",
                        date: "14 April 2026",
                        time: "08:00 - 10:30",
                        lecturer: "Dr. Anita Wijaya, M.Kom.",
                        quota: "30/35"
                    },
                    {
                        lab: "Lab Multimedia Lt.3",
                        day: "Selasa",
                        date: "15 April 2026",
                        time: "10:00 - 12:30",
                        lecturer: "Dr. Anita Wijaya, M.Kom.",
                        quota: "28/35"
                    },
                    {
                        lab: "Lab Multimedia Lt.3",
                        day: "Rabu",
                        date: "16 April 2026",
                        time: "13:00 - 15:30",
                        lecturer: "Dr. Anita Wijaya, M.Kom.",
                        quota: "25/35"
                    }
                ],
                'struktur-data': [{
                        lab: "Lab Multimedia Lt.3",
                        day: "Senin",
                        date: "14 April 2026",
                        time: "13:00 - 15:30",
                        lecturer: "Dr. Bambang Prasetyo, M.T.",
                        quota: "30/35"
                    },
                    {
                        lab: "Lab Multimedia Lt.3",
                        day: "Selasa",
                        date: "15 April 2026",
                        time: "08:00 - 10:30",
                        lecturer: "Dr. Bambang Prasetyo, M.T.",
                        quota: "28/35"
                    },
                    {
                        lab: "Lab Multimedia Lt.3",
                        day: "Kamis",
                        date: "17 April 2026",
                        time: "10:00 - 12:30",
                        lecturer: "Dr. Bambang Prasetyo, M.T.",
                        quota: "26/35"
                    }
                ],
                'basis-data': [{
                        lab: "Lab Sistem Informasi Lt.3",
                        day: "Senin",
                        date: "14 April 2026",
                        time: "10:00 - 12:30",
                        lecturer: "Dr. Citra Dewi, S.Si., M.Kom.",
                        quota: "32/35"
                    },
                    {
                        lab: "Lab Sistem Informasi Lt.3",
                        day: "Rabu",
                        date: "16 April 2026",
                        time: "08:00 - 10:30",
                        lecturer: "Dr. Citra Dewi, S.Si., M.Kom.",
                        quota: "30/35"
                    },
                    {
                        lab: "Lab Sistem Informasi Lt.3",
                        day: "Jumat",
                        date: "18 April 2026",
                        time: "13:00 - 15:30",
                        lecturer: "Dr. Citra Dewi, S.Si., M.Kom.",
                        quota: "28/35"
                    }
                ],
                'jarkom': [{
                        lab: "Lab Jaringan Lt.3",
                        day: "Senin",
                        date: "14 April 2026",
                        time: "13:00 - 15:30",
                        lecturer: "Dr. Budi Santoso, M.Kom.",
                        quota: "30/35"
                    },
                    {
                        lab: "Lab Jaringan Lt.3",
                        day: "Rabu",
                        date: "16 April 2026",
                        time: "10:00 - 12:30",
                        lecturer: "Dr. Budi Santoso, M.Kom.",
                        quota: "28/35"
                    },
                    {
                        lab: "Lab Jaringan Lt.3",
                        day: "Kamis",
                        date: "17 April 2026",
                        time: "08:00 - 10:30",
                        lecturer: "Dr. Budi Santoso, M.Kom.",
                        quota: "25/35"
                    }
                ],
                'sistem-operasi': [{
                        lab: "Lab Sistem Informasi Lt.3",
                        day: "Selasa",
                        date: "15 April 2026",
                        time: "13:00 - 15:30",
                        lecturer: "Dr. Deni Setiawan, M.Cs.",
                        quota: "25/35"
                    },
                    {
                        lab: "Lab Sistem Informasi Lt.3",
                        day: "Kamis",
                        date: "17 April 2026",
                        time: "10:00 - 12:30",
                        lecturer: "Dr. Deni Setiawan, M.Cs.",
                        quota: "23/35"
                    },
                    {
                        lab: "Lab Sistem Informasi Lt.3",
                        day: "Jumat",
                        date: "18 April 2026",
                        time: "08:00 - 10:30",
                        lecturer: "Dr. Deni Setiawan, M.Cs.",
                        quota: "20/35"
                    }
                ],
                'pcd': [{
                        lab: "Lab Multimedia Lt.3",
                        day: "Selasa",
                        date: "15 April 2026",
                        time: "13:00 - 15:30",
                        lecturer: "Dr. Eka Permata, M.T.",
                        quota: "27/35"
                    },
                    {
                        lab: "Lab Multimedia Lt.3",
                        day: "Kamis",
                        date: "17 April 2026",
                        time: "08:00 - 10:30",
                        lecturer: "Dr. Eka Permata, M.T.",
                        quota: "25/35"
                    },
                    {
                        lab: "Lab Multimedia Lt.3",
                        day: "Jumat",
                        date: "18 April 2026",
                        time: "10:00 - 12:30",
                        lecturer: "Dr. Eka Permata, M.T.",
                        quota: "22/35"
                    }
                ],
                'iot': [{
                        lab: "Lab Jaringan Lt.3",
                        day: "Selasa",
                        date: "15 April 2026",
                        time: "08:00 - 10:30",
                        lecturer: "Dr. Fajar Nugroho, S.T., M.Eng.",
                        quota: "30/35"
                    },
                    {
                        lab: "Lab Jaringan Lt.3",
                        day: "Kamis",
                        date: "17 April 2026",
                        time: "13:00 - 15:30",
                        lecturer: "Dr. Fajar Nugroho, S.T., M.Eng.",
                        quota: "28/35"
                    },
                    {
                        lab: "Lab Jaringan Lt.3",
                        day: "Jumat",
                        date: "18 April 2026",
                        time: "08:00 - 10:30",
                        lecturer: "Dr. Fajar Nugroho, S.T., M.Eng.",
                        quota: "25/35"
                    }
                ],
                'rpl': [{
                        lab: "Lab RPL Lt.3",
                        day: "Senin",
                        date: "14 April 2026",
                        time: "08:00 - 10:30",
                        lecturer: "Dr. Budi Santoso, M.Kom.",
                        quota: "28/35"
                    },
                    {
                        lab: "Lab RPL Lt.3",
                        day: "Rabu",
                        date: "16 April 2026",
                        time: "13:00 - 15:30",
                        lecturer: "Dr. Budi Santoso, M.Kom.",
                        quota: "26/35"
                    },
                    {
                        lab: "Lab RPL Lt.3",
                        day: "Kamis",
                        date: "17 April 2026",
                        time: "10:00 - 12:30",
                        lecturer: "Dr. Budi Santoso, M.Kom.",
                        quota: "24/35"
                    }
                ]
            };

            function openScheduleModal() {
                const schedules = scheduleData[selectedCourse] || [];

                if (schedules.length === 0) {
                    modalScheduleBody.innerHTML =
                        '<p class="empty-state">Belum ada jadwal tersedia untuk mata kuliah ini.</p>';
                    modalSchedule.classList.add('active');
                    return;
                }

                let html = '<div class="schedule-grid">';
                schedules.forEach((sch, idx) => {
                    const quotaNumber = parseInt(sch.quota.split('/')[0]);
                    const maxQuota = parseInt(sch.quota.split('/')[1]);
                    const isFull = quotaNumber >= maxQuota;

                    html += `<div class="schedule-card" data-schedule-index="${idx}">
                    <div class="schedule-lab"><i class="fas fa-flask"></i> ${sch.lab}</div>
                    <div class="schedule-date"><i class="far fa-calendar-alt"></i> ${sch.day}, ${sch.date}</div>
                    <div class="schedule-time"><i class="far fa-clock"></i> ${sch.time}</div>
                    <div class="schedule-lecturer"><i class="fas fa-user-tie"></i> ${sch.lecturer}</div>
                    <div class="schedule-quota ${isFull ? 'full' : ''}"><i class="fas fa-users"></i> Kuota: ${sch.quota}</div>
                    <button class="btn-pilih" data-schedule-index="${idx}" ${isFull ? 'disabled' : ''}>
                        ${isFull ? 'Kuota Penuh' : 'Pilih Jadwal Ini'}
                    </button>
                </div>`;
                });
                html += '</div>';

                modalScheduleBody.innerHTML = html;
                modalSchedule.classList.add('active');

                document.querySelectorAll('#modalScheduleBody .btn-pilih:not(:disabled)').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const scheduleIndex = btn.dataset.scheduleIndex;
                        selectedSchedule = schedules[scheduleIndex];

                        // Tampilkan konfirmasi pendaftaran
                        alert(
                            `✅ Pendaftaran berhasil!\n\n📚 Mata Kuliah: ${modulDataAll[selectedCourse]?.name || selectedCourse}\n📖 Modul: ${selectedModul?.title || 'Praktikum'}\n📅 Jadwal: ${selectedSchedule.day}, ${selectedSchedule.date}\n⏰ Waktu: ${selectedSchedule.time}\n📍 Lokasi: ${selectedSchedule.lab}\n👨‍🏫 Dosen: ${selectedSchedule.lecturer}\n\nTerima kasih telah mendaftar!`
                            );

                        closeAllModals();
                        selectedCourse = null;
                        selectedModul = null;
                        selectedSchedule = null;
                    });
                });
            }

            let selectedCourse = null;
            let selectedModul = null;
            let selectedSchedule = null;
            let currentTabType = 'all';

            const modalModul = document.getElementById('modalModul');
            const modalFormDiri = document.getElementById('modalFormDiri');
            const modalSchedule = document.getElementById('modalSchedule');
            const modalModulBody = document.getElementById('modalModulBody');
            const modalModulTitle = document.getElementById('modalModulTitle');
            const modalScheduleBody = document.getElementById('modalScheduleBody');
            const selectedTabTypeInput = document.getElementById('selectedTabType');

            function closeAllModals() {
                modalModul.classList.remove('active');
                modalFormDiri.classList.remove('active');
                modalSchedule.classList.remove('active');
            }

            function openModulModal(courseKey, tabType) {
                selectedCourse = courseKey;
                currentTabType = tabType;

                let course, badgeText, canRegister = false;

                if (tabType === 'all') {
                    course = modulDataAll[courseKey];
                    badgeText = 'Tersedia';
                    canRegister = true;
                } else if (tabType === 'upcoming') {
                    course = modulDataUpcoming[courseKey];
                    badgeText = 'Belum Tersedia';
                    canRegister = false;
                } else {
                    course = modulDataCompleted[courseKey];
                    badgeText = 'Selesai';
                    canRegister = false;
                }

                if (!course) return;

                modalModulTitle.innerHTML =
                    `<i class="fas fa-book-open"></i> ${course.name} - ${tabType === 'all' ? 'Modul Tersedia' : (tabType === 'upcoming' ? 'Modul Akan Datang' : 'Riwayat Modul')}`;

                let html = '<div class="modul-list">';
                course.moduls.forEach((modul, idx) => {
                    let statusClass = '';
                    let statusText = '';
                    let nilaiHtml = '';

                    if (tabType === 'all') {
                        statusClass = 'available';
                        statusText = 'Tersedia';
                    } else if (tabType === 'upcoming') {
                        statusClass = 'upcoming';
                        statusText = 'Belum Tersedia';
                    } else {
                        statusClass = 'completed';
                        statusText = 'Selesai';
                        nilaiHtml =
                            `<div style="margin-top: 8px; font-size: 0.75rem; color: #f59e0b;"><i class="fas fa-star"></i> Nilai: ${modul.nilai || '-'}</div>`;
                    }

                    html += `<div class="modul-item">
                        <div class="modul-header">
                            <span class="modul-title">${modul.title}</span>
                            <span class="modul-badge ${statusClass}">${statusText}</span>
                        </div>
                        <div class="modul-materi">${modul.materi}</div>
                        ${nilaiHtml}
                        <div class="modul-footer">
                            ${canRegister ? `<button class="btn-daftar" data-modul-index="${idx}">Daftar <i class="fas fa-arrow-right"></i></button>` : ''}
                        </div>
                    </div>`;
                });
                html += '</div>';
                modalModulBody.innerHTML = html;
                modalModul.classList.add('active');

                if (canRegister) {
                    document.querySelectorAll('#modalModulBody .btn-daftar').forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            e.stopPropagation();
                            const modulIndex = btn.dataset.modulIndex;
                            selectedModul = course.moduls[modulIndex];
                            selectedTabTypeInput.value = currentTabType;
                            modalModul.classList.remove('active');
                            modalFormDiri.classList.add('active');
                        });
                    });
                }
            }

            function openScheduleModal() {
                const schedules = scheduleData[selectedCourse] || [];
                let html = '<div class="schedule-grid">';
                schedules.forEach((sch, idx) => {
                    html += `<div class="schedule-card" data-schedule-index="${idx}">
                        <div class="schedule-lab"><i class="fas fa-flask"></i> ${sch.lab}</div>
                        <div class="schedule-date"><i class="far fa-calendar-alt"></i> ${sch.day}, ${sch.date}</div>
                        <div class="schedule-time"><i class="far fa-clock"></i> ${sch.time}</div>
                        <div class="schedule-lecturer"><i class="fas fa-user-tie"></i> ${sch.lecturer}</div>
                        <div class="schedule-quota"><i class="fas fa-users"></i> Kuota: ${sch.quota}</div>
                        <button class="btn-pilih" data-schedule-index="${idx}">Pilih Jadwal Ini</button>
                    </div>`;
                });
                html += '</div>';
                modalScheduleBody.innerHTML = html;
                modalSchedule.classList.add('active');

                document.querySelectorAll('#modalScheduleBody .btn-pilih').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const scheduleIndex = btn.dataset.scheduleIndex;
                        selectedSchedule = schedules[scheduleIndex];
                        alert(
                            `✅ Pendaftaran berhasil!\n\nMata Kuliah: ${modulDataAll[selectedCourse]?.name || selectedCourse}\nModul: ${selectedModul?.title || 'Praktikum'}\nJadwal: ${selectedSchedule.day}, ${selectedSchedule.date} ${selectedSchedule.time}\nLokasi: ${selectedSchedule.lab}\nDosen: ${selectedSchedule.lecturer}\n\nTerima kasih telah mendaftar!`
                            );
                        closeAllModals();
                        selectedCourse = null;
                        selectedModul = null;
                        selectedSchedule = null;
                    });
                });
            }

            document.querySelectorAll('.btn-more').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const courseCard = btn.closest('.course-card');
                    const courseKey = btn.dataset.course;
                    const tabType = btn.dataset.type;
                    openModulModal(courseKey, tabType);
                });
            });

            document.getElementById('nextToSchedule').addEventListener('click', () => {
                const nama = document.getElementById('formNama').value.trim();
                const nim = document.getElementById('formNim').value.trim();
                const email = document.getElementById('formEmail').value.trim();
                if (!nama || !nim || !email) return alert('Harap isi semua data diri!');
                modalFormDiri.classList.remove('active');
                openScheduleModal();
            });

            document.getElementById('closeModulModal').addEventListener('click', closeAllModals);
            document.getElementById('closeFormModal').addEventListener('click', closeAllModals);
            document.getElementById('closeScheduleModal').addEventListener('click', closeAllModals);
            document.getElementById('cancelFormModal').addEventListener('click', closeAllModals);
            window.addEventListener('click', (e) => {
                if (e.target.classList.contains('modal')) closeAllModals();
            });

            // TAB NAVIGATION
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabs = {
                all: 'tab-all',
                upcoming: 'tab-upcoming',
                completed: 'tab-completed'
            };

            function switchTab(tabId) {
                Object.values(tabs).forEach(id => document.getElementById(id).classList.remove('active'));
                document.getElementById(tabs[tabId]).classList.add('active');
                tabBtns.forEach(btn => btn.dataset.tab === tabId ? btn.classList.add('active') : btn.classList.remove(
                    'active'));
            }
            tabBtns.forEach(btn => btn.addEventListener('click', () => switchTab(btn.dataset.tab)));

            const mobileToggle = document.getElementById('mobileMenuToggle');
            const sidebarNav = document.getElementById('sidebarNav');
            if (mobileToggle && sidebarNav) {
                mobileToggle.addEventListener('click', () => {
                    sidebarNav.classList.toggle('active');
                    const icon = mobileToggle.querySelector('i');
                    icon.classList.toggle('fa-bars');
                    icon.classList.toggle('fa-times');
                });
            }

            document.querySelectorAll('.has-sub .sub-trigger').forEach(trigger => {
                trigger.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const sub = trigger.parentElement.querySelector('.submenu');
                    if (sub) sub.style.display = sub.style.display === 'none' ? 'block' : 'none';
                });
            });

        })();
    </script>
</body>

</html>
