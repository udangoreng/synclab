<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Presensi Dosen | Portal Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <style>
        /* style-presensi.css */
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

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            padding: 28px 32px;
            overflow-x: auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #1e293b;
        }

        .export-btn {
            padding: 10px 20px;
            background: linear-gradient(135deg, #10b981, #047857);
            border: none;
            border-radius: 40px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .export-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        /* FILTER SECTION */
        .filter-section {
            background: white;
            border-radius: 24px;
            padding: 20px 24px;
            margin-bottom: 24px;
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            align-items: flex-end;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex: 1;
            min-width: 150px;
        }

        .filter-group label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
        }

        .filter-group select {
            padding: 10px 14px;
            border-radius: 40px;
            border: 1px solid #e2e8f0;
            background: white;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .apply-filter-btn {
            padding: 10px 24px;
            background: #3b82f6;
            border: none;
            border-radius: 40px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
        }

        .apply-filter-btn:hover {
            background: #2563eb;
            transform: translateY(-2px);
        }

        /* SUMMARY CARDS */
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 28px;
        }

        .summary-card {
            background: white;
            border-radius: 24px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .summary-icon {
            width: 60px;
            height: 60px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: white;
        }

        .summary-info h3 {
            font-size: 0.8rem;
            font-weight: 500;
            color: #64748b;
            margin-bottom: 4px;
        }

        .summary-number {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
        }

        /* DATA TABLE */
        .data-table-card {
            background: white;
            border-radius: 24px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .table-header h3 {
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .table-search {
            position: relative;
        }

        .table-search input {
            padding: 8px 16px 8px 40px;
            border-radius: 40px;
            border: 1px solid #e2e8f0;
            width: 250px;
            font-size: 0.85rem;
        }

        .table-search i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            text-align: left;
            padding: 12px 12px;
            background: #f8fafc;
            font-weight: 600;
            font-size: 0.8rem;
            color: #64748b;
            border-bottom: 2px solid #e2e8f0;
        }

        .data-table td {
            padding: 12px 12px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.85rem;
            vertical-align: middle;
        }

        .detail-btn {
            padding: 6px 16px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-size: 0.75rem;
            transition: 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .detail-btn:hover {
            background: #2563eb;
        }

        .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pagination {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .page-btn {
            padding: 6px 12px;
            background: #f1f5f9;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            transition: 0.2s;
        }

        .page-btn:hover {
            background: #3b82f6;
            color: white;
        }

        /* MODAL */
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
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s ease;
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

        .detail-header {
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #e2e8f0;
        }

        .detail-header h4 {
            font-size: 1.2rem;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .detail-header p {
            font-size: 0.85rem;
            color: #64748b;
        }

        .detail-summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .detail-summary-item {
            background: #f8fafc;
            border-radius: 16px;
            padding: 12px;
            text-align: center;
        }

        .detail-summary-item .summary-label {
            display: block;
            font-size: 0.7rem;
            color: #64748b;
            margin-bottom: 4px;
        }

        .detail-summary-item .summary-value {
            display: block;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .detail-table-container {
            overflow-x: auto;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail-table th {
            text-align: left;
            padding: 10px 12px;
            background: #f1f5f9;
            font-weight: 600;
            font-size: 0.75rem;
            color: #64748b;
        }

        .detail-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.8rem;
        }

        .status-hadir {
            color: #16a34a;
            font-weight: 600;
        }

        .status-izin {
            color: #f59e0b;
            font-weight: 600;
        }

        .status-sakit {
            color: #8b5cf6;
            font-weight: 600;
        }

        .status-alpha {
            color: #dc2626;
            font-weight: 600;
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

        /* RESPONSIVE */
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

            .page-title {
                font-size: 1.4rem;
            }

            .filter-section {
                flex-direction: column;
            }

            .filter-group {
                width: 100%;
            }

            .summary-cards {
                grid-template-columns: 1fr;
            }

            .table-search input {
                width: 100%;
            }

            .table-footer {
                flex-direction: column;
                text-align: center;
            }

            .detail-summary {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 16px;
            }

            .data-table th,
            .data-table td {
                padding: 8px;
                font-size: 0.75rem;
            }
        }
    </style>
    <div class="dashboard-container">
        @include('dosen/partials/sidebar')

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title"><i class="fas fa-fingerprint"></i> Presensi Praktikum</h1>
                <div class="header-actions">
                    <button class="export-btn" id="exportBtn"><i class="fas fa-download"></i> Export Data</button>
                </div>
            </div>

            <!-- FILTER SECTION -->
            <div class="filter-section">
                <div class="filter-group">
                    <label><i class="fas fa-flask"></i> Mata Kuliah</label>
                    <select id="filterMatkul">
                        <option value="all">Semua Mata Kuliah</option>
                        <option value="Jaringan Komputer">Jaringan Komputer</option>
                        <option value="RPL">RPL</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label><i class="fas fa-users"></i> Kelas</label>
                    <select id="filterKelas">
                        <option value="all">Semua Kelas</option>
                        <option value="2024A">Kelas 2024A</option>
                        <option value="2024B">Kelas 2024B</option>
                        <option value="2024C">Kelas 2024C</option>
                    </select>
                </div>
                <button class="apply-filter-btn" id="applyFilter"><i class="fas fa-search"></i> Terapkan</button>
            </div>

            <!-- SUMMARY CARDS -->
            <div class="summary-cards">
                <div class="summary-card">
                    <div class="summary-icon" style="background: linear-gradient(135deg, #3b82f6, #1e40af);">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="summary-info">
                        <h3>Total Mahasiswa</h3>
                        <p class="summary-number" id="totalMahasiswa">0</p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-icon" style="background: linear-gradient(135deg, #10b981, #047857);">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="summary-info">
                        <h3>Rata-rata Kehadiran</h3>
                        <p class="summary-number" id="rataKehadiran">0%</p>
                    </div>
                </div>
            </div>

            <!-- DATA TABLE PRESENSI -->
            <div class="data-table-card">
                <div class="table-header">
                    <h3><i class="fas fa-calendar-alt"></i> Rekap Presensi per Pertemuan</h3>
                </div>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Pertemuan</th>
                                <th>Hadir</th>
                                <th>Izin</th>
                                <th>Sakit</th>
                                <th>Alpha</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <!-- Data akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
                <div class="table-footer">
                    <span id="tableInfo">Menampilkan data</span>
                    <div class="pagination">
                        <button class="page-btn" id="prevPage"><i class="fas fa-chevron-left"></i></button>
                        <span id="pageInfo">Halaman 1</span>
                        <button class="page-btn" id="nextPage"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Detail Presensi -->
    <div class="modal" id="detailModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-calendar-check"></i> Detail Presensi</h3>
                <button class="modal-close" id="closeDetailModal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="detail-header">
                    <h4 id="detailTanggal">12 Juni 2026</h4>
                    <p id="detailPertemuan">Pertemuan 1 - Jaringan Komputer Kelas 2024A</p>
                </div>
                <div class="detail-summary">
                    <div class="detail-summary-item">
                        <span class="summary-label">Hadir</span>
                        <span class="summary-value" id="detailHadir">0</span>
                    </div>
                    <div class="detail-summary-item">
                        <span class="summary-label">Izin</span>
                        <span class="summary-value" id="detailIzin">0</span>
                    </div>
                    <div class="detail-summary-item">
                        <span class="summary-label">Sakit</span>
                        <span class="summary-value" id="detailSakit">0</span>
                    </div>
                    <div class="detail-summary-item">
                        <span class="summary-label">Alpha</span>
                        <span class="summary-value" id="detailAlpha">0</span>
                    </div>
                </div>
                <div class="detail-table-container">
                    <table class="detail-table">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="detailTableBody">
                            <!-- Data detail akan diisi -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" id="closeDetailModalBtn">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        // script-presensi.js
        (function() {
            // Data Presensi per pertemuan
            let presensiData = [{
                    id: 1,
                    tanggal: '2026-03-10',
                    pertemuan: 'Pertemuan 1',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024A',
                    hadir: 19,
                    izin: 2,
                    sakit: 1,
                    alpha: 1,
                    total: 23
                },
                {
                    id: 2,
                    tanggal: '2026-03-17',
                    pertemuan: 'Pertemuan 2',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024A',
                    hadir: 18,
                    izin: 2,
                    sakit: 1,
                    alpha: 2,
                    total: 23
                },
                {
                    id: 3,
                    tanggal: '2026-03-24',
                    pertemuan: 'Pertemuan 3',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024A',
                    hadir: 20,
                    izin: 1,
                    sakit: 1,
                    alpha: 1,
                    total: 23
                },
                {
                    id: 4,
                    tanggal: '2026-03-10',
                    pertemuan: 'Pertemuan 1',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024B',
                    hadir: 18,
                    izin: 1,
                    sakit: 1,
                    alpha: 2,
                    total: 22
                },
                {
                    id: 5,
                    tanggal: '2026-03-17',
                    pertemuan: 'Pertemuan 2',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024B',
                    hadir: 19,
                    izin: 1,
                    sakit: 1,
                    alpha: 1,
                    total: 22
                },
                {
                    id: 6,
                    tanggal: '2026-03-11',
                    pertemuan: 'Pertemuan 1',
                    matkul: 'RPL',
                    kelas: '2024A',
                    hadir: 17,
                    izin: 2,
                    sakit: 1,
                    alpha: 1,
                    total: 21
                },
                {
                    id: 7,
                    tanggal: '2026-03-18',
                    pertemuan: 'Pertemuan 2',
                    matkul: 'RPL',
                    kelas: '2024A',
                    hadir: 18,
                    izin: 1,
                    sakit: 1,
                    alpha: 1,
                    total: 21
                },
                {
                    id: 8,
                    tanggal: '2026-03-11',
                    pertemuan: 'Pertemuan 1',
                    matkul: 'RPL',
                    kelas: '2024B',
                    hadir: 16,
                    izin: 2,
                    sakit: 1,
                    alpha: 1,
                    total: 20
                },
                {
                    id: 9,
                    tanggal: '2026-03-18',
                    pertemuan: 'Pertemuan 2',
                    matkul: 'RPL',
                    kelas: '2024B',
                    hadir: 15,
                    izin: 2,
                    sakit: 1,
                    alpha: 2,
                    total: 20
                }
            ];

            // Data detail presensi per mahasiswa (LENGKAP untuk semua pertemuan)
            const detailPresensiData = {
                // ========== JARINGAN KOMPUTER KELAS 2024A ==========
                '2024A_Jaringan Komputer_Pertemuan 1': [{
                        nim: '22060001',
                        nama: 'Ahmad Fauzi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060002',
                        nama: 'Siti Rahma',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060003',
                        nama: 'Budi Wijaya',
                        status: 'Izin'
                    },
                    {
                        nim: '22060004',
                        nama: 'Dewi Sartika',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060005',
                        nama: 'Eko Prasetyo',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060006',
                        nama: 'Fajar Nugroho',
                        status: 'Sakit'
                    },
                    {
                        nim: '22060007',
                        nama: 'Gina Permata',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060008',
                        nama: 'Hendra Gunawan',
                        status: 'Alpha'
                    },
                    {
                        nim: '22060009',
                        nama: 'Indah Lestari',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060010',
                        nama: 'Joko Susilo',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060011',
                        nama: 'Kartika Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060012',
                        nama: 'Lukman Hakim',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060013',
                        nama: 'Maya Sari',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060014',
                        nama: 'Nugroho',
                        status: 'Izin'
                    },
                    {
                        nim: '22060015',
                        nama: 'Oktavia',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060016',
                        nama: 'Putra Wijaya',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060017',
                        nama: 'Qonita',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060018',
                        nama: 'Rizki Fauzi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060019',
                        nama: 'Sinta Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060020',
                        nama: 'Teguh Pratama',
                        status: 'Sakit'
                    },
                    {
                        nim: '22060021',
                        nama: 'Umar Hadi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060022',
                        nama: 'Vina Anggraini',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060023',
                        nama: 'Wahyu Setiawan',
                        status: 'Hadir'
                    }
                ],
                '2024A_Jaringan Komputer_Pertemuan 2': [{
                        nim: '22060001',
                        nama: 'Ahmad Fauzi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060002',
                        nama: 'Siti Rahma',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060003',
                        nama: 'Budi Wijaya',
                        status: 'Alpha'
                    },
                    {
                        nim: '22060004',
                        nama: 'Dewi Sartika',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060005',
                        nama: 'Eko Prasetyo',
                        status: 'Izin'
                    },
                    {
                        nim: '22060006',
                        nama: 'Fajar Nugroho',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060007',
                        nama: 'Gina Permata',
                        status: 'Sakit'
                    },
                    {
                        nim: '22060008',
                        nama: 'Hendra Gunawan',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060009',
                        nama: 'Indah Lestari',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060010',
                        nama: 'Joko Susilo',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060011',
                        nama: 'Kartika Dewi',
                        status: 'Alpha'
                    },
                    {
                        nim: '22060012',
                        nama: 'Lukman Hakim',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060013',
                        nama: 'Maya Sari',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060014',
                        nama: 'Nugroho',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060015',
                        nama: 'Oktavia',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060016',
                        nama: 'Putra Wijaya',
                        status: 'Izin'
                    },
                    {
                        nim: '22060017',
                        nama: 'Qonita',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060018',
                        nama: 'Rizki Fauzi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060019',
                        nama: 'Sinta Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060020',
                        nama: 'Teguh Pratama',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060021',
                        nama: 'Umar Hadi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060022',
                        nama: 'Vina Anggraini',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060023',
                        nama: 'Wahyu Setiawan',
                        status: 'Hadir'
                    }
                ],
                '2024A_Jaringan Komputer_Pertemuan 3': [{
                        nim: '22060001',
                        nama: 'Ahmad Fauzi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060002',
                        nama: 'Siti Rahma',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060003',
                        nama: 'Budi Wijaya',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060004',
                        nama: 'Dewi Sartika',
                        status: 'Izin'
                    },
                    {
                        nim: '22060005',
                        nama: 'Eko Prasetyo',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060006',
                        nama: 'Fajar Nugroho',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060007',
                        nama: 'Gina Permata',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060008',
                        nama: 'Hendra Gunawan',
                        status: 'Sakit'
                    },
                    {
                        nim: '22060009',
                        nama: 'Indah Lestari',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060010',
                        nama: 'Joko Susilo',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060011',
                        nama: 'Kartika Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060012',
                        nama: 'Lukman Hakim',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060013',
                        nama: 'Maya Sari',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060014',
                        nama: 'Nugroho',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060015',
                        nama: 'Oktavia',
                        status: 'Izin'
                    },
                    {
                        nim: '22060016',
                        nama: 'Putra Wijaya',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060017',
                        nama: 'Qonita',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060018',
                        nama: 'Rizki Fauzi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060019',
                        nama: 'Sinta Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060020',
                        nama: 'Teguh Pratama',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060021',
                        nama: 'Umar Hadi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22060022',
                        nama: 'Vina Anggraini',
                        status: 'Sakit'
                    },
                    {
                        nim: '22060023',
                        nama: 'Wahyu Setiawan',
                        status: 'Hadir'
                    }
                ],

                // ========== JARINGAN KOMPUTER KELAS 2024B ==========
                '2024B_Jaringan Komputer_Pertemuan 1': [{
                        nim: '22061001',
                        nama: 'Andi Saputra',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061002',
                        nama: 'Bunga Citra',
                        status: 'Izin'
                    },
                    {
                        nim: '22061003',
                        nama: 'Citra Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061004',
                        nama: 'Dimas Aditya',
                        status: 'Alpha'
                    },
                    {
                        nim: '22061005',
                        nama: 'Eka Putri',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061006',
                        nama: 'Farhan Kurniawan',
                        status: 'Sakit'
                    },
                    {
                        nim: '22061007',
                        nama: 'Gita Puspita',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061008',
                        nama: 'Herman Saputra',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061009',
                        nama: 'Intan Permata',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061010',
                        nama: 'Johan Setiawan',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061011',
                        nama: 'Karina Maharani',
                        status: 'Izin'
                    },
                    {
                        nim: '22061012',
                        nama: 'Lia Anggraini',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061013',
                        nama: 'M. Rizky',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061014',
                        nama: 'Nadia Putri',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061015',
                        nama: 'Oscar Pratama',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061016',
                        nama: 'Putri Amelia',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061017',
                        nama: 'Rahmat Hidayat',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061018',
                        nama: 'Sari Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061019',
                        nama: 'Taufik Hidayat',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061020',
                        nama: 'Umi Kalsum',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061021',
                        nama: 'Vega Ardiansyah',
                        status: 'Alpha'
                    },
                    {
                        nim: '22061022',
                        nama: 'Winda Lestari',
                        status: 'Hadir'
                    }
                ],
                '2024B_Jaringan Komputer_Pertemuan 2': [{
                        nim: '22061001',
                        nama: 'Andi Saputra',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061002',
                        nama: 'Bunga Citra',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061003',
                        nama: 'Citra Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061004',
                        nama: 'Dimas Aditya',
                        status: 'Izin'
                    },
                    {
                        nim: '22061005',
                        nama: 'Eka Putri',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061006',
                        nama: 'Farhan Kurniawan',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061007',
                        nama: 'Gita Puspita',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061008',
                        nama: 'Herman Saputra',
                        status: 'Izin'
                    },
                    {
                        nim: '22061009',
                        nama: 'Intan Permata',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061010',
                        nama: 'Johan Setiawan',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061011',
                        nama: 'Karina Maharani',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061012',
                        nama: 'Lia Anggraini',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061013',
                        nama: 'M. Rizky',
                        status: 'Sakit'
                    },
                    {
                        nim: '22061014',
                        nama: 'Nadia Putri',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061015',
                        nama: 'Oscar Pratama',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061016',
                        nama: 'Putri Amelia',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061017',
                        nama: 'Rahmat Hidayat',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061018',
                        nama: 'Sari Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061019',
                        nama: 'Taufik Hidayat',
                        status: 'Alpha'
                    },
                    {
                        nim: '22061020',
                        nama: 'Umi Kalsum',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061021',
                        nama: 'Vega Ardiansyah',
                        status: 'Hadir'
                    },
                    {
                        nim: '22061022',
                        nama: 'Winda Lestari',
                        status: 'Hadir'
                    }
                ],

                // ========== RPL KELAS 2024A ==========
                '2024A_RPL_Pertemuan 1': [{
                        nim: '22063001',
                        nama: 'Fajar Nugroho',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063002',
                        nama: 'Gina Permata',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063003',
                        nama: 'Hendra Gunawan',
                        status: 'Izin'
                    },
                    {
                        nim: '22063004',
                        nama: 'Indah Lestari',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063005',
                        nama: 'Joko Susilo',
                        status: 'Sakit'
                    },
                    {
                        nim: '22063006',
                        nama: 'Kurniawan',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063007',
                        nama: 'Lestari Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063008',
                        nama: 'M. Rizki',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063009',
                        nama: 'Nadia Putri',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063010',
                        nama: 'Oscar Pratama',
                        status: 'Alpha'
                    },
                    {
                        nim: '22063011',
                        nama: 'Putri Amelia',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063012',
                        nama: 'Rahmat Hidayat',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063013',
                        nama: 'Sari Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063014',
                        nama: 'Taufik Hidayat',
                        status: 'Izin'
                    },
                    {
                        nim: '22063015',
                        nama: 'Umi Kalsum',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063016',
                        nama: 'Vega Ardiansyah',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063017',
                        nama: 'Winda Lestari',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063018',
                        nama: 'Xavier Putra',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063019',
                        nama: 'Yuni Anggraini',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063020',
                        nama: 'Zaki Firmansyah',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063021',
                        nama: 'Agus Salim',
                        status: 'Sakit'
                    }
                ],
                '2024A_RPL_Pertemuan 2': [{
                        nim: '22063001',
                        nama: 'Fajar Nugroho',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063002',
                        nama: 'Gina Permata',
                        status: 'Izin'
                    },
                    {
                        nim: '22063003',
                        nama: 'Hendra Gunawan',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063004',
                        nama: 'Indah Lestari',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063005',
                        nama: 'Joko Susilo',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063006',
                        nama: 'Kurniawan',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063007',
                        nama: 'Lestari Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063008',
                        nama: 'M. Rizki',
                        status: 'Alpha'
                    },
                    {
                        nim: '22063009',
                        nama: 'Nadia Putri',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063010',
                        nama: 'Oscar Pratama',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063011',
                        nama: 'Putri Amelia',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063012',
                        nama: 'Rahmat Hidayat',
                        status: 'Sakit'
                    },
                    {
                        nim: '22063013',
                        nama: 'Sari Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063014',
                        nama: 'Taufik Hidayat',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063015',
                        nama: 'Umi Kalsum',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063016',
                        nama: 'Vega Ardiansyah',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063017',
                        nama: 'Winda Lestari',
                        status: 'Izin'
                    },
                    {
                        nim: '22063018',
                        nama: 'Xavier Putra',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063019',
                        nama: 'Yuni Anggraini',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063020',
                        nama: 'Zaki Firmansyah',
                        status: 'Hadir'
                    },
                    {
                        nim: '22063021',
                        nama: 'Agus Salim',
                        status: 'Hadir'
                    }
                ],

                // ========== RPL KELAS 2024B ==========
                '2024B_RPL_Pertemuan 1': [{
                        nim: '22064001',
                        nama: 'Lestari Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064002',
                        nama: 'M. Rizki',
                        status: 'Izin'
                    },
                    {
                        nim: '22064003',
                        nama: 'Nadia Putri',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064004',
                        nama: 'Oscar Pratama',
                        status: 'Alpha'
                    },
                    {
                        nim: '22064005',
                        nama: 'Putri Amelia',
                        status: 'Sakit'
                    },
                    {
                        nim: '22064006',
                        nama: 'Rahmat Hidayat',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064007',
                        nama: 'Sari Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064008',
                        nama: 'Taufik Hidayat',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064009',
                        nama: 'Umi Kalsum',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064010',
                        nama: 'Vega Ardiansyah',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064011',
                        nama: 'Winda Lestari',
                        status: 'Izin'
                    },
                    {
                        nim: '22064012',
                        nama: 'Xavier Putra',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064013',
                        nama: 'Yuni Anggraini',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064014',
                        nama: 'Zaki Firmansyah',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064015',
                        nama: 'Agus Salim',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064016',
                        nama: 'Budi Santoso',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064017',
                        nama: 'Citra Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064018',
                        nama: 'Dimas Aditya',
                        status: 'Alpha'
                    },
                    {
                        nim: '22064019',
                        nama: 'Eka Putri',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064020',
                        nama: 'Farhan Kurniawan',
                        status: 'Hadir'
                    }
                ],
                '2024B_RPL_Pertemuan 2': [{
                        nim: '22064001',
                        nama: 'Lestari Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064002',
                        nama: 'M. Rizki',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064003',
                        nama: 'Nadia Putri',
                        status: 'Izin'
                    },
                    {
                        nim: '22064004',
                        nama: 'Oscar Pratama',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064005',
                        nama: 'Putri Amelia',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064006',
                        nama: 'Rahmat Hidayat',
                        status: 'Alpha'
                    },
                    {
                        nim: '22064007',
                        nama: 'Sari Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064008',
                        nama: 'Taufik Hidayat',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064009',
                        nama: 'Umi Kalsum',
                        status: 'Sakit'
                    },
                    {
                        nim: '22064010',
                        nama: 'Vega Ardiansyah',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064011',
                        nama: 'Winda Lestari',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064012',
                        nama: 'Xavier Putra',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064013',
                        nama: 'Yuni Anggraini',
                        status: 'Izin'
                    },
                    {
                        nim: '22064014',
                        nama: 'Zaki Firmansyah',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064015',
                        nama: 'Agus Salim',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064016',
                        nama: 'Budi Santoso',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064017',
                        nama: 'Citra Dewi',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064018',
                        nama: 'Dimas Aditya',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064019',
                        nama: 'Eka Putri',
                        status: 'Hadir'
                    },
                    {
                        nim: '22064020',
                        nama: 'Farhan Kurniawan',
                        status: 'Hadir'
                    }
                ]
            };

            let currentPage = 1;
            let rowsPerPage = 8;
            let filteredData = [];

            function getDetailKey(item) {
                return `${item.kelas}_${item.matkul}_${item.pertemuan}`;
            }

            function getDetailPresensi(item) {
                const key = getDetailKey(item);
                const data = detailPresensiData[key] || [];

                // Hitung ulang statistik dari data detail agar sesuai
                let hitungHadir = 0,
                    hitungIzin = 0,
                    hitungSakit = 0,
                    hitungAlpha = 0;
                data.forEach(mhs => {
                    if (mhs.status === 'Hadir') hitungHadir++;
                    else if (mhs.status === 'Izin') hitungIzin++;
                    else if (mhs.status === 'Sakit') hitungSakit++;
                    else if (mhs.status === 'Alpha') hitungAlpha++;
                });

                // Update item dengan data dari detail
                if (data.length > 0) {
                    item.hadir = hitungHadir;
                    item.izin = hitungIzin;
                    item.sakit = hitungSakit;
                    item.alpha = hitungAlpha;
                    item.total = hitungHadir + hitungIzin + hitungSakit + hitungAlpha;
                }

                return data;
            }

            function formatTanggal(tanggal) {
                const tgl = new Date(tanggal);
                return tgl.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
            }

            function renderTable() {
                let filtered = filteredData;

                const start = (currentPage - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                const pageData = filtered.slice(start, end);

                const tbody = document.getElementById('tableBody');
                tbody.innerHTML = '';

                pageData.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td>${formatTanggal(item.tanggal)}</td>
                <td>${item.pertemuan}</td>
                <td>${item.hadir}</td>
                <td>${item.izin}</td>
                <td>${item.sakit}</td>
                <td>${item.alpha}</td>
                <td>${item.total}</td>
                <td><button class="detail-btn" data-id="${item.id}"><i class="fas fa-eye"></i> Detail</button></td>
            `;
                    tbody.appendChild(row);
                });

                document.querySelectorAll('.detail-btn').forEach(btn => {
                    btn.addEventListener('click', () => openDetailModal(parseInt(btn.dataset.id)));
                });

                const totalPages = Math.ceil(filtered.length / rowsPerPage);
                document.getElementById('pageInfo').innerText = `Halaman ${currentPage} dari ${totalPages || 1}`;
                document.getElementById('tableInfo').innerText = `Menampilkan ${filtered.length} data presensi`;

                updateSummary();
            }

            function updateSummary() {
                let totalHadir = 0;
                let totalMahasiswa = 0;

                filteredData.forEach(item => {
                    totalHadir += item.hadir;
                    totalMahasiswa += item.total;
                });

                const avgKehadiran = totalMahasiswa > 0 ? Math.round((totalHadir / totalMahasiswa) * 100) : 0;

                document.getElementById('totalMahasiswa').innerText = totalMahasiswa;
                document.getElementById('rataKehadiran').innerText = `${avgKehadiran}%`;
            }

            function filterData() {
                const matkul = document.getElementById('filterMatkul').value;
                const kelas = document.getElementById('filterKelas').value;

                filteredData = presensiData.filter(item => {
                    if (matkul !== 'all' && item.matkul !== matkul) return false;
                    if (kelas !== 'all' && item.kelas !== kelas) return false;
                    return true;
                });

                // Update data dengan detail presensi
                filteredData.forEach(item => {
                    getDetailPresensi(item);
                });

                currentPage = 1;
                renderTable();
            }

            function openDetailModal(id) {
                const item = filteredData.find(d => d.id === id);
                if (!item) return;

                const detailData = getDetailPresensi(item);

                document.getElementById('detailTanggal').innerText = formatTanggal(item.tanggal);
                document.getElementById('detailPertemuan').innerText =
                    `${item.pertemuan} - ${item.matkul} Kelas ${item.kelas}`;
                document.getElementById('detailHadir').innerText = item.hadir;
                document.getElementById('detailIzin').innerText = item.izin;
                document.getElementById('detailSakit').innerText = item.sakit;
                document.getElementById('detailAlpha').innerText = item.alpha;

                const detailBody = document.getElementById('detailTableBody');
                detailBody.innerHTML = '';

                detailData.forEach(mhs => {
                    let statusClass = '';
                    if (mhs.status === 'Hadir') statusClass = 'status-hadir';
                    else if (mhs.status === 'Izin') statusClass = 'status-izin';
                    else if (mhs.status === 'Sakit') statusClass = 'status-sakit';
                    else statusClass = 'status-alpha';

                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td>${mhs.nim}</td>
                <td>${mhs.nama}</td>
                <td class="${statusClass}">${mhs.status}</td>
            `;
                    detailBody.appendChild(row);
                });

                document.getElementById('detailModal').classList.add('active');
            }

            function closeModal() {
                document.getElementById('detailModal').classList.remove('active');
            }

            function exportData() {
                let csvContent = "Tanggal,Pertemuan,Mata Kuliah,Kelas,Hadir,Izin,Sakit,Alpha,Total\n";
                filteredData.forEach(item => {
                    csvContent +=
                        `${formatTanggal(item.tanggal)},${item.pertemuan},${item.matkul},${item.kelas},${item.hadir},${item.izin},${item.sakit},${item.alpha},${item.total}\n`;
                });

                const blob = new Blob([csvContent], {
                    type: 'text/csv'
                });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'data_presensi.csv';
                a.click();
                URL.revokeObjectURL(url);
            }

            // Event Listeners
            document.getElementById('applyFilter').addEventListener('click', filterData);
            document.getElementById('prevPage').addEventListener('click', () => {
                const totalPages = Math.ceil(filteredData.length / rowsPerPage);
                if (currentPage > 1) {
                    currentPage--;
                    renderTable();
                }
            });
            document.getElementById('nextPage').addEventListener('click', () => {
                const totalPages = Math.ceil(filteredData.length / rowsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    renderTable();
                }
            });
            document.getElementById('exportBtn').addEventListener('click', exportData);

            document.getElementById('closeDetailModal').addEventListener('click', closeModal);
            document.getElementById('closeDetailModalBtn').addEventListener('click', closeModal);

            window.addEventListener('click', (e) => {
                if (e.target.classList.contains('modal')) {
                    closeModal();
                }
            });

            // Mobile menu
            const mobileToggle = document.getElementById('mobileMenuToggle');
            const sidebarNav = document.getElementById('sidebarNav');
            if (mobileToggle && sidebarNav) {
                mobileToggle.addEventListener('click', () => {
                    sidebarNav.classList.toggle('active');
                    const icon = mobileToggle.querySelector('i');
                    if (sidebarNav.classList.contains('active')) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
            }


            // Hapus event listener search yang tidak perlu
            // Hapus juga HTML search box jika ingin

            filterData();
        })();
    </script>
</body>

</html>
