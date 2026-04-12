<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Monitoring Dosen | Portal Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<style>
    /* style-monitoring.css */
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

/* ========= SIDEBAR ========= */
.sidebar {
    width: 280px;
    background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%);
    color: #e2e8f0;
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
    position: relative;
    z-index: 100;
}

.sidebar-header {
    padding: 28px 20px 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.mobile-menu-toggle {
    display: none;
    background: rgba(255,255,255,0.1);
    border: none;
    color: white;
    font-size: 1.3rem;
    padding: 8px 12px;
    border-radius: 12px;
    cursor: pointer;
    transition: 0.2s;
}

.profile-section {
    text-align: center;
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.avatar-circle {
    width: 88px;
    height: 88px;
    background: linear-gradient(135deg, #818cf8, #c084fc);
    border-radius: 50%;
    margin: 0 auto 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 12px 22px -8px rgba(0, 0, 0, 0.3);
}

.avatar-circle i {
    font-size: 44px;
    color: white;
}

.profile-section h3 {
    font-size: 1.3rem;
    font-weight: 600;
}

.profile-section p {
    font-size: 0.7rem;
    color: #94a3b8;
    margin-top: 4px;
}

.sidebar-nav {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 0 20px 28px 20px;
}

.nav-menu {
    list-style: none;
    margin-top: 20px;
}

.nav-item {
    margin: 8px 0;
    padding: 12px 16px;
    border-radius: 16px;
    font-weight: 500;
    transition: 0.25s;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 12px;
    color: #cbd5e1;
}

.nav-item i {
    width: 24px;
}

.nav-item:hover, .nav-item.active {
    background: rgba(255, 255, 255, 0.1);
    color: white;
}

.logout-btn {
    background: rgba(239, 68, 68, 0.2);
    border: 1px solid rgba(239, 68, 68, 0.4);
    padding: 12px;
    border-radius: 40px;
    text-align: center;
    font-weight: 600;
    margin-top: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    cursor: pointer;
    transition: 0.2s;
    color: #fecaca;
}

.logout-btn:hover {
    background: #ef4444;
    color: white;
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

/* STATS CARDS - 3 KOTAK */
.stats-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 20px;
    margin-bottom: 28px;
}

.stat-card-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 24px;
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 20px;
    color: white;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}

.stat-card-primary .stat-icon {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.2);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

.stat-info h3 {
    font-size: 0.85rem;
    font-weight: 500;
    opacity: 0.9;
    margin-bottom: 4px;
}

.stat-number {
    font-size: 2.2rem;
    font-weight: 700;
}

.stat-desc {
    font-size: 0.7rem;
    opacity: 0.8;
}

/* CHARTS ROW */
.charts-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 24px;
    margin-bottom: 28px;
}

.chart-card {
    background: white;
    border-radius: 24px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    flex-wrap: wrap;
    gap: 12px;
}

.chart-header h3 {
    font-size: 1rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

.chart-kelas-label {
    font-size: 0.75rem;
    background: #eef2ff;
    padding: 4px 12px;
    border-radius: 40px;
    color: #4338ca;
    font-weight: 600;
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
}

.status-badge {
    padding: 4px 12px;
    border-radius: 40px;
    font-size: 0.7rem;
    font-weight: 600;
    display: inline-block;
}

.status-lulus {
    background: #dcfce7;
    color: #16a34a;
}

.status-tidak-lulus {
    background: #fee2e2;
    color: #dc2626;
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
    .charts-row {
        grid-template-columns: 1fr;
    }
    .table-search input {
        width: 100%;
    }
    .table-footer {
        flex-direction: column;
        text-align: center;
    }
    .stats-cards {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .main-content {
        padding: 16px;
    }
    .stat-card-primary {
        padding: 16px;
    }
    .stat-number {
        font-size: 1.6rem;
    }
    .chart-card {
        padding: 16px;
    }
}
</style>
<div class="dashboard-container">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="profile-section">
                <div class="avatar-circle">
                    <i class="fas fa-chalkboard-user"></i>
                </div>
                <div class="profile-info">
                    <h3>Dr. Budi Santoso</h3>
                    <p>Dosen Teknik Informatika</p>
                </div>
            </div>
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <div class="sidebar-nav" id="sidebarNav">
            <ul class="nav-menu">
                <li class="nav-item"><i class="fas fa-chart-line"></i> Dashboard</li>
                <li class="nav-item active"><i class="fas fa-eye"></i> Monitoring</li>
                <li class="nav-item"><i class="fas fa-check-double"></i> Validasi Nilai</li>
                <li class="nav-item"><i class="fas fa-fingerprint"></i> Presensi</li>
                <li class="nav-item"><i class="fas fa-clipboard-list"></i> Status Pendaftaran</li>
            </ul>
            <div class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Log Out
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <div class="page-header">
            <h1 class="page-title"><i class="fas fa-eye"></i> Monitoring Praktikum</h1>
            <div class="header-actions">
                <button class="export-btn"><i class="fas fa-download"></i> Export Data</button>
            </div>
        </div>

        <!-- FILTER SECTION -->
        <div class="filter-section">
            <div class="filter-group">
                <label><i class="fas fa-flask"></i> Praktikum</label>
                <select id="filterPraktikum">
                    <option value="all">Semua Praktikum</option>
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
                <label><i class="fas fa-calendar-week"></i> Pertemuan</label>
                <select id="filterPertemuan">
                    <option value="1">Pertemuan 1</option>
                    <option value="2">Pertemuan 2</option>
                    <option value="3">Pertemuan 3</option>
                    <option value="4">Pertemuan 4</option>
                    <option value="5">Pertemuan 5</option>
                    <option value="6">Pertemuan 6</option>
                </select>
            </div>
            <button class="apply-filter-btn" id="applyFilter"><i class="fas fa-search"></i> Terapkan</button>
        </div>

        <!-- STATS CARDS (3 KOTAK) -->
        <div class="stats-cards">
            <div class="stat-card-primary">
                <div class="stat-icon"><i class="fas fa-user-check"></i></div>
                <div class="stat-info">
                    <h3>Kehadiran</h3>
                    <p class="stat-number" id="kehadiranPercent">80%</p>
                    <span class="stat-desc">dari total mahasiswa</span>
                </div>
            </div>
            <div class="stat-card-primary">
                <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                <div class="stat-info">
                    <h3>Rata-Rata Nilai</h3>
                    <p class="stat-number" id="rataNilai">90</p>
                    <span class="stat-desc">pretest terakhir</span>
                </div>
            </div>
            <div class="stat-card-primary">
                <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
                <div class="stat-info">
                    <h3>Laporan Selesai</h3>
                    <p class="stat-number" id="laporanSelesai">0</p>
                    <span class="stat-desc">dari total mahasiswa</span>
                </div>
            </div>
        </div>

        <!-- CHARTS ROW -->
        <div class="charts-row">
            <div class="chart-card">
                <div class="chart-header">
                    <h3><i class="fas fa-chart-bar"></i> Grafik Kehadiran</h3>
                    <span class="chart-kelas-label" id="kehadiranKelasLabel">Kelas 2024A</span>
                </div>
                <canvas id="kehadiranChart" width="400" height="200" style="width:100%; max-height:200px;"></canvas>
            </div>

            <div class="chart-card">
                <div class="chart-header">
                    <h3><i class="fas fa-chart-line"></i> Grafik Nilai Pretest</h3>
                    <span class="chart-kelas-label" id="nilaiKelasLabel">Kelas 2024A</span>
                </div>
                <canvas id="nilaiChart" width="400" height="200" style="width:100%; max-height:200px;"></canvas>
            </div>
        </div>

        <!-- DETAIL PRAKTIKUM TABLE -->
        <div class="data-table-card">
            <div class="table-header">
                <h3><i class="fas fa-table-list"></i> Detail Praktikum</h3>
                <div class="table-search">
                    <input type="text" id="tableSearch" placeholder="Cari mahasiswa...">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="table-responsive">
                <table class="data-table" id="detailTable">
                    <thead>
                        <tr>
                            <th>Mata Kuliah</th>
                            <th>Kelas</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Kehadiran</th>
                            <th>Nilai Pretest</th>
                            <th>Status</th>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // script-monitoring.js
(function() {
    // Data Mahasiswa lengkap
    const mahasiswaData = {
        'Jaringan Komputer': {
            '2024A': [
                { nim: '22060001', nama: 'Ahmad Fauzi', hadir: true, nilai: 85, laporan: true },
                { nim: '22060002', nama: 'Siti Rahma', hadir: true, nilai: 78, laporan: true },
                { nim: '22060003', nama: 'Budi Wijaya', hadir: false, nilai: 65, laporan: false },
                { nim: '22060004', nama: 'Dewi Sartika', hadir: true, nilai: 92, laporan: true },
                { nim: '22060005', nama: 'Eko Prasetyo', hadir: true, nilai: 88, laporan: true }
            ],
            '2024B': [
                { nim: '22061001', nama: 'Rina Andriani', hadir: true, nilai: 82, laporan: true },
                { nim: '22061002', nama: 'Dian Permata', hadir: false, nilai: 70, laporan: false },
                { nim: '22061003', nama: 'Andi Saputra', hadir: true, nilai: 75, laporan: true },
                { nim: '22061004', nama: 'Lia Anggraini', hadir: true, nilai: 80, laporan: true },
                { nim: '22061005', nama: 'Rizky Febrian', hadir: true, nilai: 86, laporan: false }
            ],
            '2024C': [
                { nim: '22062001', nama: 'Nina Amelia', hadir: true, nilai: 70, laporan: false },
                { nim: '22062002', nama: 'Rudi Hartono', hadir: false, nilai: 60, laporan: false },
                { nim: '22062003', nama: 'Sari Puspita', hadir: true, nilai: 75, laporan: true },
                { nim: '22062004', nama: 'Tono Suprapto', hadir: true, nilai: 68, laporan: false },
                { nim: '22062005', nama: 'Umi Kalsum', hadir: false, nilai: 55, laporan: false }
            ]
        },
        'RPL': {
            '2024A': [
                { nim: '22063001', nama: 'Fajar Nugroho', hadir: true, nilai: 88, laporan: true },
                { nim: '22063002', nama: 'Gina Permata', hadir: true, nilai: 82, laporan: true },
                { nim: '22063003', nama: 'Hendra Gunawan', hadir: false, nilai: 70, laporan: false },
                { nim: '22063004', nama: 'Indah Lestari', hadir: true, nilai: 90, laporan: true },
                { nim: '22063005', nama: 'Joko Susilo', hadir: true, nilai: 85, laporan: true }
            ],
            '2024B': [
                { nim: '22064001', nama: 'Kartika Dewi', hadir: true, nilai: 78, laporan: true },
                { nim: '22064002', nama: 'Lutfi Hakim', hadir: true, nilai: 75, laporan: false },
                { nim: '22064003', nama: 'Maya Sari', hadir: false, nilai: 65, laporan: false },
                { nim: '22064004', nama: 'Nanda Pratama', hadir: true, nilai: 80, laporan: true },
                { nim: '22064005', nama: 'Oka Darmawan', hadir: true, nilai: 82, laporan: true }
            ],
            '2024C': [
                { nim: '22065001', nama: 'Putri Amelia', hadir: true, nilai: 72, laporan: false },
                { nim: '22065002', nama: 'Qori Fadillah', hadir: false, nilai: 60, laporan: false },
                { nim: '22065003', nama: 'Raka Putra', hadir: true, nilai: 68, laporan: true },
                { nim: '22065004', nama: 'Sinta Melati', hadir: true, nilai: 70, laporan: false },
                { nim: '22065005', nama: 'Teguh Wibowo', hadir: true, nilai: 75, laporan: true }
            ]
        }
    };

    // Data grafik per kelas (untuk setiap pertemuan)
    const grafikData = {
        '2024A': {
            kehadiran: [85, 82, 88, 84, 86, 90],
            nilai: [78, 82, 79, 85, 83, 88]
        },
        '2024B': {
            kehadiran: [78, 80, 75, 82, 79, 85],
            nilai: [72, 75, 74, 78, 76, 80]
        },
        '2024C': {
            kehadiran: [70, 72, 68, 74, 71, 76],
            nilai: [68, 70, 72, 74, 73, 76]
        }
    };

    let kehadiranChart, nilaiChart;
    let currentPage = 1;
    let rowsPerPage = 5;
    let filteredData = [];

    // Inisialisasi Chart berdasarkan kelas
    function initCharts(kelas) {
        // Jika kelas 'all', gunakan '2024A' sebagai default
        const kelasKey = (kelas === 'all' || !kelas) ? '2024A' : kelas;
        const data = grafikData[kelasKey];
        
        // Update label kelas di grafik
        document.getElementById('kehadiranKelasLabel').innerText = `Kelas ${kelasKey}`;
        document.getElementById('nilaiKelasLabel').innerText = `Kelas ${kelasKey}`;
        
        // Kehadiran Chart
        const ctxKehadiran = document.getElementById('kehadiranChart').getContext('2d');
        if (kehadiranChart) kehadiranChart.destroy();
        kehadiranChart = new Chart(ctxKehadiran, {
            type: 'bar',
            data: {
                labels: ['Pertemuan 1', 'Pertemuan 2', 'Pertemuan 3', 'Pertemuan 4', 'Pertemuan 5', 'Pertemuan 6'],
                datasets: [{
                    label: `Kehadiran (%)`,
                    data: data.kehadiran,
                    backgroundColor: '#3b82f6',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { position: 'bottom' } },
                scales: { y: { beginAtZero: true, max: 100, title: { display: true, text: 'Persentase' } } }
            }
        });

        // Nilai Chart
        const ctxNilai = document.getElementById('nilaiChart').getContext('2d');
        if (nilaiChart) nilaiChart.destroy();
        nilaiChart = new Chart(ctxNilai, {
            type: 'line',
            data: {
                labels: ['Pretest 1', 'Pretest 2', 'Pretest 3', 'Pretest 4', 'Pretest 5', 'Pretest 6'],
                datasets: [{
                    label: `Rata-rata Nilai`,
                    data: data.nilai,
                    borderColor: '#f59e0b',
                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { position: 'bottom' } },
                scales: { y: { beginAtZero: true, max: 100, title: { display: true, text: 'Nilai' } } }
            }
        });
    }

    // Update statistik berdasarkan filter
    function updateStats(matkul, kelas) {
        let totalHadir = 0;
        let totalMahasiswa = 0;
        let totalNilai = 0;
        let countNilai = 0;
        let totalLaporan = 0;

        if (matkul === 'all') {
            for (let m in mahasiswaData) {
                if (kelas === 'all') {
                    for (let k in mahasiswaData[m]) {
                        mahasiswaData[m][k].forEach(mhs => {
                            totalMahasiswa++;
                            if (mhs.hadir) totalHadir++;
                            if (mhs.nilai) { totalNilai += mhs.nilai; countNilai++; }
                            if (mhs.laporan) totalLaporan++;
                        });
                    }
                } else if (mahasiswaData[m][kelas]) {
                    mahasiswaData[m][kelas].forEach(mhs => {
                        totalMahasiswa++;
                        if (mhs.hadir) totalHadir++;
                        if (mhs.nilai) { totalNilai += mhs.nilai; countNilai++; }
                        if (mhs.laporan) totalLaporan++;
                    });
                }
            }
        } else {
            if (kelas === 'all') {
                for (let k in mahasiswaData[matkul]) {
                    mahasiswaData[matkul][k].forEach(mhs => {
                        totalMahasiswa++;
                        if (mhs.hadir) totalHadir++;
                        if (mhs.nilai) { totalNilai += mhs.nilai; countNilai++; }
                        if (mhs.laporan) totalLaporan++;
                    });
                }
            } else if (mahasiswaData[matkul] && mahasiswaData[matkul][kelas]) {
                mahasiswaData[matkul][kelas].forEach(mhs => {
                    totalMahasiswa++;
                    if (mhs.hadir) totalHadir++;
                    if (mhs.nilai) { totalNilai += mhs.nilai; countNilai++; }
                    if (mhs.laporan) totalLaporan++;
                });
            }
        }

        const kehadiranPercent = totalMahasiswa > 0 ? Math.round((totalHadir / totalMahasiswa) * 100) : 0;
        const rataNilai = countNilai > 0 ? Math.round(totalNilai / countNilai) : 0;
        
        document.getElementById('kehadiranPercent').innerText = `${kehadiranPercent}%`;
        document.getElementById('rataNilai').innerText = rataNilai;
        document.getElementById('laporanSelesai').innerText = totalLaporan;
    }

    // Filter dan render semua (tabel, statistik, grafik)
    function filterAndRender() {
        const matkul = document.getElementById('filterPraktikum').value;
        const kelas = document.getElementById('filterKelas').value;
        const pertemuan = document.getElementById('filterPertemuan').value;
        
        // UPDATE GRAFIK BERDASARKAN KELAS YANG DIPILIH
        // Jika kelas 'all', gunakan '2024A' untuk grafik
        let kelasUntukGrafik = kelas;
        if (kelas === 'all') {
            kelasUntukGrafik = '2024A';
        }
        initCharts(kelasUntukGrafik);
        
        // Kumpulkan data untuk tabel
        let data = [];
        
        if (matkul === 'all') {
            for (let m in mahasiswaData) {
                if (kelas === 'all') {
                    for (let k in mahasiswaData[m]) {
                        mahasiswaData[m][k].forEach(mhs => {
                            data.push({ matkul: m, kelas: k, ...mhs });
                        });
                    }
                } else if (mahasiswaData[m][kelas]) {
                    mahasiswaData[m][kelas].forEach(mhs => {
                        data.push({ matkul: m, kelas: kelas, ...mhs });
                    });
                }
            }
        } else {
            if (kelas === 'all') {
                for (let k in mahasiswaData[matkul]) {
                    mahasiswaData[matkul][k].forEach(mhs => {
                        data.push({ matkul: matkul, kelas: k, ...mhs });
                    });
                }
            } else if (mahasiswaData[matkul] && mahasiswaData[matkul][kelas]) {
                mahasiswaData[matkul][kelas].forEach(mhs => {
                    data.push({ matkul: matkul, kelas: kelas, ...mhs });
                });
            }
        }
        
        filteredData = data;
        currentPage = 1;
        updateStats(matkul, kelas);
        renderTable();
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
            const status = item.nilai >= 75 ? 'Lulus' : 'Tidak Lulus';
            const statusClass = item.nilai >= 75 ? 'status-lulus' : 'status-tidak-lulus';
            const hadirText = item.hadir ? '✓ Hadir' : '✗ Tidak Hadir';
            const hadirColor = item.hadir ? '#16a34a' : '#dc2626';
            
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.matkul}</td>
                <td>${item.kelas}</td>
                <td>${item.nim}</td>
                <td>${item.nama}</td>
                <td style="color: ${hadirColor}; font-weight: 500;">${hadirText}</td>
                <td>${item.nilai}</td>
                <td><span class="status-badge ${statusClass}">${status}</span></td>
            `;
            tbody.appendChild(row);
        });
        
        const totalPages = Math.ceil(filtered.length / rowsPerPage);
        document.getElementById('pageInfo').innerText = `Halaman ${currentPage} dari ${totalPages || 1}`;
        document.getElementById('tableInfo').innerText = `Menampilkan ${filtered.length} data mahasiswa`;
    }

    // Event Listeners
    document.getElementById('applyFilter').addEventListener('click', filterAndRender);
    document.getElementById('tableSearch').addEventListener('input', () => { currentPage = 1; renderTable(); });
    document.getElementById('prevPage').addEventListener('click', () => {
        if (currentPage > 1) { currentPage--; renderTable(); }
    });
    document.getElementById('nextPage').addEventListener('click', () => {
        const totalPages = Math.ceil(filteredData.length / rowsPerPage);
        if (currentPage < totalPages) { currentPage++; renderTable(); }
    });
    
    // Export
    document.querySelector('.export-btn').addEventListener('click', () => {
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
    
    
    // Nav items
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', () => {
            if (item.innerText.includes('Monitoring')) return;
        });
    });
    
    // Inisialisasi awal
    initCharts('2024A');
    filterAndRender();
})();
</script>
</body>
</html>