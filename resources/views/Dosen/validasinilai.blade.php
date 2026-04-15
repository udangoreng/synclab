<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Validasi Nilai Dosen | Portal Akademik</title>
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
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
            display: inline-block;
        }

        .status-validated {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-pending {
            background: #fef3c7;
            color: #d97706;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-size: 0.7rem;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-edit {
            background: #3b82f6;
            color: white;
        }

        .btn-edit:hover {
            background: #2563eb;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
        }

        .btn-delete:hover {
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

        .modal-info {
            background: #f8fafc;
            padding: 12px 16px;
            border-radius: 16px;
            margin-bottom: 20px;
        }

        .modal-info p {
            margin: 6px 0;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 40px;
            font-size: 0.9rem;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3b82f6;
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

        .btn-save {
            padding: 8px 20px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-save:hover {
            background: #2563eb;
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

            .action-buttons {
                flex-direction: column;
            }

            .modal-content {
                width: 95%;
            }

            .detail-row {
                flex-direction: column;
                gap: 4px;
            }

            .detail-label {
                width: 100%;
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

        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title"><i class="fas fa-check-double"></i> Validasi Nilai</h1>
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
                        <option value="validated">Sudah Tervalidasi</option>
                        <option value="pending">Belum Tervalidasi</option>
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
                        <h3>Total Mahasiswa</h3>
                        <p class="summary-number" id="totalMahasiswa">0</p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-icon" style="background: linear-gradient(135deg, #10b981, #047857);">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="summary-info">
                        <h3>Tervalidasi</h3>
                        <p class="summary-number" id="totalValidated">0</p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-icon" style="background: linear-gradient(135deg, #f59e0b, #b45309);">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="summary-info">
                        <h3>Belum Tervalidasi</h3>
                        <p class="summary-number" id="totalPending">0</p>
                    </div>
                </div>
            </div>

            <div class="data-table-card">
                <div class="table-header">
                    <h3><i class="fas fa-table-list"></i> Daftar Nilai Mahasiswa</h3>
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
                                <th>Pretest</th>
                                <th>Laporan</th>
                                <th>Nilai Akhir</th>
                                <th>Status</th>
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

    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-edit"></i> Edit Nilai Mahasiswa</h3>
                <button class="modal-close" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-info">
                    <p><strong>Nama:</strong> <span id="editNama"></span></p>
                    <p><strong>NIM:</strong> <span id="editNim"></span></p>
                    <p><strong>Mata Kuliah:</strong> <span id="editMatkul"></span></p>
                </div>
                <div class="form-group">
                    <label>Nilai Pretest</label>
                    <input type="number" id="editPretest" min="0" max="100" step="1">
                </div>
                <div class="form-group">
                    <label>Nilai Laporan</label>
                    <input type="number" id="editLaporan" min="0" max="100" step="1">
                </div>
                <div class="form-group">
                    <label>Nilai Akhir (Otomatis)</label>
                    <input type="text" id="editNilaiAkhir" readonly disabled>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" id="cancelModal">Batal</button>
                <button class="btn-save" id="saveModal">Simpan</button>
            </div>
        </div>
    </div>

    <div class="modal" id="detailModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-info-circle"></i> Detail Nilai Mahasiswa</h3>
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
                        <span class="detail-label">Nilai Pretest:</span>
                        <span class="detail-value" id="detailPretest"></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Nilai Laporan:</span>
                        <span class="detail-value" id="detailLaporan"></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Nilai Akhir:</span>
                        <span class="detail-value" id="detailNilaiAkhir"></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Status Validasi:</span>
                        <span class="detail-value" id="detailStatus"></span>
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
            let nilaiData = [{
                    id: 1,
                    nama: 'Ahmad Fauzi',
                    nim: '22060001',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024A',
                    pretest: 85,
                    laporan: 80,
                    validated: true
                },
                {
                    id: 2,
                    nama: 'Siti Rahma',
                    nim: '22060002',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024A',
                    pretest: 78,
                    laporan: 82,
                    validated: true
                },
                {
                    id: 3,
                    nama: 'Budi Wijaya',
                    nim: '22060003',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024A',
                    pretest: 65,
                    laporan: 70,
                    validated: false
                },
                {
                    id: 4,
                    nama: 'Dewi Sartika',
                    nim: '22060004',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024A',
                    pretest: 92,
                    laporan: 88,
                    validated: true
                },
                {
                    id: 5,
                    nama: 'Eko Prasetyo',
                    nim: '22060005',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024A',
                    pretest: 88,
                    laporan: 85,
                    validated: true
                },
                {
                    id: 6,
                    nama: 'Rina Andriani',
                    nim: '22061001',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024B',
                    pretest: 82,
                    laporan: 78,
                    validated: true
                },
                {
                    id: 7,
                    nama: 'Dian Permata',
                    nim: '22061002',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024B',
                    pretest: 70,
                    laporan: 68,
                    validated: false
                },
                {
                    id: 8,
                    nama: 'Andi Saputra',
                    nim: '22061003',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024B',
                    pretest: 75,
                    laporan: 80,
                    validated: true
                },
                {
                    id: 9,
                    nama: 'Nina Amelia',
                    nim: '22062001',
                    matkul: 'Jaringan Komputer',
                    kelas: '2024C',
                    pretest: 70,
                    laporan: 65,
                    validated: false
                },
                {
                    id: 10,
                    nama: 'Fajar Nugroho',
                    nim: '22063001',
                    matkul: 'RPL',
                    kelas: '2024A',
                    pretest: 88,
                    laporan: 85,
                    validated: true
                },
                {
                    id: 11,
                    nama: 'Gina Permata',
                    nim: '22063002',
                    matkul: 'RPL',
                    kelas: '2024A',
                    pretest: 82,
                    laporan: 80,
                    validated: true
                },
                {
                    id: 12,
                    nama: 'Hendra Gunawan',
                    nim: '22063003',
                    matkul: 'RPL',
                    kelas: '2024A',
                    pretest: 70,
                    laporan: 68,
                    validated: false
                },
                {
                    id: 13,
                    nama: 'Kartika Dewi',
                    nim: '22064001',
                    matkul: 'RPL',
                    kelas: '2024B',
                    pretest: 78,
                    laporan: 75,
                    validated: true
                },
                {
                    id: 14,
                    nama: 'Lutfi Hakim',
                    nim: '22064002',
                    matkul: 'RPL',
                    kelas: '2024B',
                    pretest: 75,
                    laporan: 70,
                    validated: false
                },
                {
                    id: 15,
                    nama: 'Putri Amelia',
                    nim: '22065001',
                    matkul: 'RPL',
                    kelas: '2024C',
                    pretest: 72,
                    laporan: 68,
                    validated: false
                }
            ];

            function hitungNilaiAkhir(pretest, laporan) {
                return ((pretest * 0.5) + (laporan * 0.5)).toFixed(1);
            }

            let currentPage = 1;
            let rowsPerPage = 8;
            let filteredData = [];

            let currentEditId = null;

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
                    const nilaiAkhir = hitungNilaiAkhir(item.pretest, item.laporan);
                    const statusText = item.validated ? 'Tervalidasi' : 'Belum Validasi';
                    const statusClass = item.validated ? 'status-validated' : 'status-pending';

                    const row = document.createElement('tr');
                    row.innerHTML = `
                <td>${item.nama}</td>
                <td>${item.nim}</td>
                <td>${item.matkul}</td>
                <td>${item.kelas}</td>
                <td>${item.pretest}</td>
                <td>${item.laporan}</td>
                <td>${nilaiAkhir}</td>
                <td><span class="status-badge ${statusClass}">${statusText}</span></td>
                <td class="action-buttons">
                    <button class="action-btn btn-edit" data-id="${item.id}"><i class="fas fa-edit"></i> Edit</button>
                    <button class="action-btn btn-delete" data-id="${item.id}"><i class="fas fa-trash"></i> Hapus</button>
                    <button class="action-btn btn-detail" data-id="${item.id}"><i class="fas fa-info-circle"></i> Detail</button>
                </td>
            `;
                    tbody.appendChild(row);
                });

                document.querySelectorAll('.btn-edit').forEach(btn => {
                    btn.addEventListener('click', () => openEditModal(parseInt(btn.dataset.id)));
                });
                document.querySelectorAll('.btn-delete').forEach(btn => {
                    btn.addEventListener('click', () => deleteData(parseInt(btn.dataset.id)));
                });
                document.querySelectorAll('.btn-detail').forEach(btn => {
                    btn.addEventListener('click', () => openDetailModal(parseInt(btn.dataset.id)));
                });

                const totalPages = Math.ceil(filtered.length / rowsPerPage);
                document.getElementById('pageInfo').innerText = `Halaman ${currentPage} dari ${totalPages || 1}`;
                document.getElementById('tableInfo').innerText = `Menampilkan ${filtered.length} data mahasiswa`;

                updateSummary();
            }

            function filterData() {
                const matkul = document.getElementById('filterMatkul').value;
                const kelas = document.getElementById('filterKelas').value;
                const status = document.getElementById('filterStatus').value;

                filteredData = nilaiData.filter(item => {
                    if (matkul !== 'all' && item.matkul !== matkul) return false;
                    if (kelas !== 'all' && item.kelas !== kelas) return false;
                    if (status === 'validated' && !item.validated) return false;
                    if (status === 'pending' && item.validated) return false;
                    return true;
                });

                currentPage = 1;
                renderTable();
            }

            function updateSummary() {
                const total = filteredData.length;
                const validated = filteredData.filter(item => item.validated).length;
                const pending = total - validated;

                document.getElementById('totalMahasiswa').innerText = total;
                document.getElementById('totalValidated').innerText = validated;
                document.getElementById('totalPending').innerText = pending;
            }

            function openEditModal(id) {
                const item = nilaiData.find(d => d.id === id);
                if (!item) return;

                currentEditId = id;
                document.getElementById('editNama').innerText = item.nama;
                document.getElementById('editNim').innerText = item.nim;
                document.getElementById('editMatkul').innerText = item.matkul;
                document.getElementById('editPretest').value = item.pretest;
                document.getElementById('editLaporan').value = item.laporan;

                const nilaiAkhir = hitungNilaiAkhir(item.pretest, item.laporan);
                document.getElementById('editNilaiAkhir').value = nilaiAkhir;

                document.getElementById('editModal').classList.add('active');
            }

            function updateNilaiAkhirOtomatis() {
                const pretest = parseFloat(document.getElementById('editPretest').value) || 0;
                const laporan = parseFloat(document.getElementById('editLaporan').value) || 0;
                const nilaiAkhir = hitungNilaiAkhir(pretest, laporan);
                document.getElementById('editNilaiAkhir').value = nilaiAkhir;
            }

            function saveEdit() {
                const pretest = parseInt(document.getElementById('editPretest').value);
                const laporan = parseInt(document.getElementById('editLaporan').value);

                const index = nilaiData.findIndex(d => d.id === currentEditId);
                if (index !== -1) {
                    nilaiData[index].pretest = pretest;
                    nilaiData[index].laporan = laporan;
                    nilaiData[index].validated = true; // Setelah diedit, otomatis tervalidasi
                    filterData();
                }

                closeModal();
            }

            function deleteData(id) {
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    nilaiData = nilaiData.filter(d => d.id !== id);
                    filterData();
                }
            }

            function openDetailModal(id) {
                const item = nilaiData.find(d => d.id === id);
                if (!item) return;

                document.getElementById('detailNama').innerText = item.nama;
                document.getElementById('detailNim').innerText = item.nim;
                document.getElementById('detailMatkul').innerText = item.matkul;
                document.getElementById('detailKelas').innerText = item.kelas;
                document.getElementById('detailPretest').innerText = item.pretest;
                document.getElementById('detailLaporan').innerText = item.laporan;
                document.getElementById('detailNilaiAkhir').innerText = hitungNilaiAkhir(item.pretest, item.laporan);
                document.getElementById('detailStatus').innerHTML = item.validated ?
                    '<span class="status-badge status-validated">Tervalidasi</span>' :
                    '<span class="status-badge status-pending">Belum Tervalidasi</span>';

                document.getElementById('detailModal').classList.add('active');
            }

            function closeModal() {
                document.getElementById('editModal').classList.remove('active');
                document.getElementById('detailModal').classList.remove('active');
                currentEditId = null;
            }

            function exportData() {
                let csvContent = "Nama,NIM,Mata Kuliah,Kelas,Pretest,Laporan,Nilai Akhir,Status\n";
                filteredData.forEach(item => {
                    const nilaiAkhir = hitungNilaiAkhir(item.pretest, item.laporan);
                    const status = item.validated ? 'Tervalidasi' : 'Belum Validasi';
                    csvContent +=
                        `${item.nama},${item.nim},${item.matkul},${item.kelas},${item.pretest},${item.laporan},${nilaiAkhir},${status}\n`;
                });

                const blob = new Blob([csvContent], {
                    type: 'text/csv'
                });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'data_nilai_mahasiswa.csv';
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

            document.getElementById('closeModal').addEventListener('click', closeModal);
            document.getElementById('cancelModal').addEventListener('click', closeModal);
            document.getElementById('saveModal').addEventListener('click', saveEdit);
            document.getElementById('closeDetailModal').addEventListener('click', closeModal);
            document.getElementById('closeDetailModalBtn').addEventListener('click', closeModal);
            document.getElementById('editPretest').addEventListener('input', updateNilaiAkhirOtomatis);
            document.getElementById('editLaporan').addEventListener('input', updateNilaiAkhirOtomatis);

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
                    if (item.innerText.includes('Validasi Nilai')) return;
                });
            });

            filterData();
        })();
    </script>
</body>

</html>
