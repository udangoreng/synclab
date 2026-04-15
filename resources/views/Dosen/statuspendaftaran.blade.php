<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Status Pendaftaran Dosen | Portal Akademik</title>
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

        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
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

        .status-badge {
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
            display: inline-block;
        }

        .status-disetujui {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-pending {
            background: #fef3c7;
            color: #d97706;
        }

        .status-ditolak {
            background: #fee2e2;
            color: #dc2626;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: nowrap;
        }

        .action-btn {
            padding: 6px 14px;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-size: 0.7rem;
            font-weight: 500;
            transition: 0.2s;
            white-space: nowrap;
        }

        .btn-terima {
            background: #10b981;
            color: white;
        }

        .btn-terima:hover {
            background: #059669;
        }

        .btn-tolak {
            background: #ef4444;
            color: white;
        }

        .btn-tolak:hover {
            background: #dc2626;
        }

        .btn-detail {
            background: #64748b;
            color: white;
        }

        .btn-detail:hover {
            background: #475569;
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

        .detail-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .detail-row {
            display: flex;
            padding: 8px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .detail-label {
            width: 140px;
            font-weight: 600;
            color: #64748b;
        }

        .detail-value {
            flex: 1;
            color: #1e293b;
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
                grid-template-columns: repeat(2, 1fr);
            }

            .table-search input {
                width: 100%;
            }

            .table-footer {
                flex-direction: column;
                text-align: center;
            }

            .action-buttons {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .action-btn {
                padding: 4px 10px;
                font-size: 0.65rem;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 16px;
            }

            .summary-cards {
                grid-template-columns: 1fr;
            }

            .data-table th,
            .data-table td {
                padding: 8px;
                font-size: 0.75rem;
            }

            .detail-row {
                flex-direction: column;
                gap: 4px;
            }

            .detail-label {
                width: 100%;
            }

            .action-buttons {
                flex-direction: column;
                gap: 4px;
            }

            .action-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
    <div class="dashboard-container">
        @include('dosen/partials/sidebar')

        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title"><i class="fas fa-clipboard-list"></i> Status Pendaftaran</h1>
                <div class="header-actions">
                    <button class="export-btn" id="exportBtn"><i class="fas fa-download"></i> Export Data</button>
                </div>
            </div>

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
                <div class="filter-group">
                    <label><i class="fas fa-flag-checkered"></i> Status</label>
                    <select id="filterStatus">
                        <option value="all">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
                <button class="apply-filter-btn" id="applyFilter"><i class="fas fa-search"></i> Terapkan</button>
            </div>

            <div class="summary-cards">
                <div class="summary-card">
                    <div class="summary-icon" style="background: linear-gradient(135deg, #3b82f6, #1e40af);">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="summary-info">
                        <h3>Total Pendaftar</h3>
                        <p class="summary-number" id="totalPendaftar">0</p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-icon" style="background: linear-gradient(135deg, #10b981, #047857);">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="summary-info">
                        <h3>Disetujui</h3>
                        <p class="summary-number" id="totalDisetujui">0</p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-icon" style="background: linear-gradient(135deg, #f59e0b, #b45309);">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="summary-info">
                        <h3>Pending</h3>
                        <p class="summary-number" id="totalPending">0</p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-icon" style="background: linear-gradient(135deg, #ef4444, #b91c1c);">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="summary-info">
                        <h3>Ditolak</h3>
                        <p class="summary-number" id="totalDitolak">0</p>
                    </div>
                </div>
            </div>

            <div class="data-table-card">
                <div class="table-header">
                    <h3><i class="fas fa-table-list"></i> Daftar Pendaftaran Praktikum</h3>
                    <div class="table-search">
                        <input type="text" id="tableSearch" placeholder="Cari nama atau NIM...">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Mata Kuliah</th>
                                <th>Kelas</th>
                                <th>Praktikum</th>
                                <th>Tgl Daftar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
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

    <div class="modal" id="detailModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-info-circle"></i> Detail Pendaftaran</h3>
                <button class="modal-close" id="closeDetailModal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="detail-info">
                    <div class="detail-row">
                        <span class="detail-label">Nama Lengkap:</span>
                        <span class="detail-value" id="detailNama"></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">NIM:</span>
                        <span class="detail-value" id="detailNim"></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Mata Kuliah:</span>
                        <span class="detail-value" id="detailMatkul"></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Kelas:</span>
                        <span class="detail-value" id="detailKelas"></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Praktikum:</span>
                        <span class="detail-value" id="detailPraktikum"></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Tanggal Daftar:</span>
                        <span class="detail-value" id="detailTglDaftar"></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status:</span>
                        <span class="detail-value" id="detailStatus"></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Keterangan:</span>
                        <span class="detail-value" id="detailKeterangan"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" id="closeDetailModalBtn">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        (function() {
            let pendaftaranData = [{
                    id: 1,
                    nama: 'Ahmad Fauzi',
                    nim: '22060001',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024A',
                    praktikum: 'Praktikum Jaringan Komputer - Modul 1',
                    tglDaftar: '2026-03-10',
                    status: 'disetujui',
                    keterangan: 'Disetujui oleh dosen'
                },
                {
                    id: 2,
                    nama: 'Siti Rahma',
                    nim: '22060002',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024A',
                    praktikum: 'Praktikum Jaringan Komputer - Modul 1',
                    tglDaftar: '2026-03-10',
                    status: 'pending',
                    keterangan: 'Menunggu persetujuan'
                },
                {
                    id: 3,
                    nama: 'Budi Wijaya',
                    nim: '22060003',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024A',
                    praktikum: 'Praktikum Jaringan Komputer - Modul 2',
                    tglDaftar: '2026-03-15',
                    status: 'ditolak',
                    keterangan: 'Melebihi kuota kelas'
                },
                {
                    id: 4,
                    nama: 'Dewi Sartika',
                    nim: '22060004',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024A',
                    praktikum: 'Praktikum Jaringan Komputer - Modul 2',
                    tglDaftar: '2026-03-15',
                    status: 'disetujui',
                    keterangan: 'Disetujui oleh dosen'
                },
                {
                    id: 5,
                    nama: 'Eko Prasetyo',
                    nim: '22060005',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024A',
                    praktikum: 'Praktikum Jaringan Komputer - Modul 3',
                    tglDaftar: '2026-03-20',
                    status: 'pending',
                    keterangan: 'Menunggu persetujuan'
                },
                {
                    id: 6,
                    nama: 'Rina Andriani',
                    nim: '22061001',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024B',
                    praktikum: 'Praktikum Jaringan Komputer - Modul 1',
                    tglDaftar: '2026-03-10',
                    status: 'disetujui',
                    keterangan: 'Disetujui oleh dosen'
                },
                {
                    id: 7,
                    nama: 'Dian Permata',
                    nim: '22061002',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024B',
                    praktikum: 'Praktikum Jaringan Komputer - Modul 1',
                    tglDaftar: '2026-03-10',
                    status: 'pending',
                    keterangan: 'Menunggu persetujuan'
                },
                {
                    id: 8,
                    nama: 'Fajar Nugroho',
                    nim: '22063001',
                    matkul: 'RPL',
                    kelas: '2024A',
                    praktikum: 'Praktikum RPL - Modul 1',
                    tglDaftar: '2026-03-11',
                    status: 'disetujui',
                    keterangan: 'Disetujui oleh dosen'
                },
                {
                    id: 9,
                    nama: 'Gina Permata',
                    nim: '22063002',
                    matkul: 'RPL',
                    kelas: '2024A',
                    praktikum: 'Praktikum RPL - Modul 1',
                    tglDaftar: '2026-03-11',
                    status: 'disetujui',
                    keterangan: 'Disetujui oleh dosen'
                },
                {
                    id: 10,
                    nama: 'Hendra Gunawan',
                    nim: '22063003',
                    matkul: 'RPL',
                    kelas: '2024A',
                    praktikum: 'Praktikum RPL - Modul 2',
                    tglDaftar: '2026-03-16',
                    status: 'pending',
                    keterangan: 'Menunggu persetujuan'
                },
                {
                    id: 11,
                    nama: 'Kartika Dewi',
                    nim: '22064001',
                    matkul: 'RPL',
                    kelas: '2024B',
                    praktikum: 'Praktikum RPL - Modul 1',
                    tglDaftar: '2026-03-11',
                    status: 'disetujui',
                    keterangan: 'Disetujui oleh dosen'
                },
                {
                    id: 12,
                    nama: 'Lutfi Hakim',
                    nim: '22064002',
                    matkul: 'RPL',
                    kelas: '2024B',
                    praktikum: 'Praktikum RPL - Modul 2',
                    tglDaftar: '2026-03-16',
                    status: 'ditolak',
                    keterangan: 'Tidak memenuhi syarat'
                },
                {
                    id: 13,
                    nama: 'Putri Amelia',
                    nim: '22065001',
                    matkul: 'RPL',
                    kelas: '2024C',
                    praktikum: 'Praktikum RPL - Modul 1',
                    tglDaftar: '2026-03-11',
                    status: 'pending',
                    keterangan: 'Menunggu persetujuan'
                }
            ];

            let currentPage = 1;
            let rowsPerPage = 8;
            let filteredData = [];

            function formatTanggal(tanggal) {
                const tgl = new Date(tanggal);
                return tgl.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
            }

            function renderTable() {
                const searchTerm = document.getElementById('tableSearch').value.toLowerCase();
                let filtered = filteredData.filter(item =>
                    item.nama.toLowerCase().includes(searchTerm) ||
                    item.nim.includes(searchTerm)
                );

                const start = (currentPage - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                const pageData = filtered.slice(start, end);

                const tbody = document.getElementById('tableBody');
                tbody.innerHTML = '';

                pageData.forEach(item => {
                    let statusClass = '';
                    let statusText = '';
                    if (item.status === 'disetujui') {
                        statusClass = 'status-disetujui';
                        statusText = 'Disetujui';
                    } else if (item.status === 'pending') {
                        statusClass = 'status-pending';
                        statusText = 'Pending';
                    } else {
                        statusClass = 'status-ditolak';
                        statusText = 'Ditolak';
                    }

                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td data-label="Nama">${item.nama}</td>
                <td data-label="NIM">${item.nim}</td>
                <td data-label="Mata Kuliah">${item.matkul}</td>
                <td data-label="Kelas">${item.kelas}</td>
                <td data-label="Praktikum">${item.praktikum}</td>
                <td data-label="Tgl Daftar">${formatTanggal(item.tglDaftar)}</td>
                <td data-label="Status"><span class="status-badge ${statusClass}">${statusText}</span></td>
                <td data-label="Aksi" class="action-buttons">
                    ${item.status === 'pending' ? `
                            <button class="action-btn btn-terima" data-id="${item.id}"><i class="fas fa-check"></i> Terima</button>
                            <button class="action-btn btn-tolak" data-id="${item.id}"><i class="fas fa-times"></i> Tolak</button>
                        ` : ''}
                    <button class="action-btn btn-detail" data-id="${item.id}"><i class="fas fa-info-circle"></i> Detail</button>
                </td>
            `;
                    tbody.appendChild(row);
                });

                document.querySelectorAll('.btn-terima').forEach(btn => {
                    btn.addEventListener('click', () => updateStatus(parseInt(btn.dataset.id), 'disetujui'));
                });
                document.querySelectorAll('.btn-tolak').forEach(btn => {
                    btn.addEventListener('click', () => updateStatus(parseInt(btn.dataset.id), 'ditolak'));
                });
                document.querySelectorAll('.btn-detail').forEach(btn => {
                    btn.addEventListener('click', () => openDetailModal(parseInt(btn.dataset.id)));
                });

                const totalPages = Math.ceil(filtered.length / rowsPerPage);
                document.getElementById('pageInfo').innerText = `Halaman ${currentPage} dari ${totalPages || 1}`;
                document.getElementById('tableInfo').innerText = `Menampilkan ${filtered.length} data pendaftaran`;

                updateSummary();
            }

            function updateStatus(id, newStatus) {
                const index = pendaftaranData.findIndex(d => d.id === id);
                if (index !== -1) {
                    pendaftaranData[index].status = newStatus;
                    pendaftaranData[index].keterangan = newStatus === 'disetujui' ? 'Disetujui oleh dosen' :
                        'Ditolak oleh dosen';
                    filterData();
                }
            }

            function filterData() {
                const matkul = document.getElementById('filterMatkul').value;
                const kelas = document.getElementById('filterKelas').value;
                const status = document.getElementById('filterStatus').value;

                filteredData = pendaftaranData.filter(item => {
                    if (matkul !== 'all' && item.matkul !== matkul) return false;
                    if (kelas !== 'all' && item.kelas !== kelas) return false;
                    if (status !== 'all' && item.status !== status) return false;
                    return true;
                });

                currentPage = 1;
                renderTable();
            }

            function updateSummary() {
                const total = filteredData.length;
                const disetujui = filteredData.filter(item => item.status === 'disetujui').length;
                const pending = filteredData.filter(item => item.status === 'pending').length;
                const ditolak = filteredData.filter(item => item.status === 'ditolak').length;

                document.getElementById('totalPendaftar').innerText = total;
                document.getElementById('totalDisetujui').innerText = disetujui;
                document.getElementById('totalPending').innerText = pending;
                document.getElementById('totalDitolak').innerText = ditolak;
            }

            function openDetailModal(id) {
                const item = pendaftaranData.find(d => d.id === id);
                if (!item) return;

                let statusText = '';
                if (item.status === 'disetujui') {
                    statusText = '<span class="status-badge status-disetujui">Disetujui</span>';
                } else if (item.status === 'pending') {
                    statusText = '<span class="status-badge status-pending">Pending</span>';
                } else {
                    statusText = '<span class="status-badge status-ditolak">Ditolak</span>';
                }

                document.getElementById('detailNama').innerText = item.nama;
                document.getElementById('detailNim').innerText = item.nim;
                document.getElementById('detailMatkul').innerText = item.matkul;
                document.getElementById('detailKelas').innerText = item.kelas;
                document.getElementById('detailPraktikum').innerText = item.praktikum;
                document.getElementById('detailTglDaftar').innerText = formatTanggal(item.tglDaftar);
                document.getElementById('detailStatus').innerHTML = statusText;
                document.getElementById('detailKeterangan').innerText = item.keterangan;

                document.getElementById('detailModal').classList.add('active');
            }

            function closeModal() {
                document.getElementById('detailModal').classList.remove('active');
            }

            function exportData() {
                let csvContent = "Nama,NIM,Mata Kuliah,Kelas,Praktikum,Tanggal Daftar,Status,Keterangan\n";
                filteredData.forEach(item => {
                    let statusText = '';
                    if (item.status === 'disetujui') statusText = 'Disetujui';
                    else if (item.status === 'pending') statusText = 'Pending';
                    else statusText = 'Ditolak';
                    csvContent +=
                        `${item.nama},${item.nim},${item.matkul},${item.kelas},${item.praktikum},${formatTanggal(item.tglDaftar)},${statusText},${item.keterangan}\n`;
                });

                const blob = new Blob([csvContent], {
                    type: 'text/csv'
                });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'status_pendaftaran.csv';
                a.click();
                URL.revokeObjectURL(url);
            }

            document.getElementById('applyFilter').addEventListener('click', filterData);
            document.getElementById('tableSearch').addEventListener('input', () => {
                currentPage = 1;
                renderTable();
            });
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


            document.querySelectorAll('.nav-item').forEach(item => {
                item.addEventListener('click', () => {
                    if (item.innerText.includes('Status Pendaftaran')) return;
                });
            });

            filterData();
        })();
    </script>
</body>

</html>
