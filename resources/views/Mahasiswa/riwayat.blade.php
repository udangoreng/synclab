<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Riwayat | Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <style>
        /* style-riwayat.css */
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

/* SIDEBAR */
.sidebar {
    width: 280px;
    background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%);
    color: #e2e8f0;
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
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

.avatar-circle i { font-size: 44px; color: white; }
.profile-section h3 { font-size: 1.3rem; font-weight: 600; }
.profile-section p { font-size: 0.7rem; color: #94a3b8; margin-top: 4px; }

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

.nav-item i { width: 24px; }
.nav-item:hover, .nav-item.active { background: rgba(255,255,255,0.1); color: white; }

.has-sub { flex-direction: column; align-items: flex-start; padding-bottom: 6px; }
.sub-trigger { display: flex; align-items: center; gap: 12px; width: 100%; cursor: pointer; }
.submenu { list-style: none; padding-left: 44px; margin-top: 8px; width: 100%; display: block; }
.submenu li { margin: 8px 0; font-size: 0.85rem; display: flex; align-items: center; gap: 8px; color: #b9c7d9; cursor: pointer; }
.submenu li:hover, .submenu li.active { color: white; transform: translateX(5px); }

.logout-btn {
    background: rgba(239,68,68,0.2);
    border: 1px solid rgba(239,68,68,0.4);
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
.logout-btn:hover { background: #ef4444; color: white; }

/* MAIN CONTENT */
.main-content { flex: 1; padding: 28px 32px; overflow-x: auto; }
.page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px; }
.page-title { font-size: 1.8rem; font-weight: 700; display: flex; align-items: center; gap: 12px; color: #1e293b; }
.export-btn {
    padding: 10px 20px;
    background: linear-gradient(135deg, #10b981, #047857);
    border: none;
    border-radius: 40px;
    color: white;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
}
.export-btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(16,185,129,0.3); }

/* FILTER SECTION */
.filter-section {
    background: white;
    border-radius: 24px;
    padding: 20px 24px;
    margin-bottom: 28px;
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    align-items: flex-end;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
.filter-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
    flex: 1;
    min-width: 200px;
}
.filter-group label { font-size: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; }
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
}
.apply-filter-btn:hover { background: #2563eb; transform: translateY(-2px); }

/* RIWAYAT GRID */
.riwayat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 24px;
}

.riwayat-card {
    background: white;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: 0.3s;
}
.riwayat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 28px rgba(0,0,0,0.12); }

.card-header {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    padding: 20px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 8px;
}
.card-header h3 { font-size: 1.1rem; margin-bottom: 4px; }
.card-header p { font-size: 0.7rem; opacity: 0.9; }
.status-badge {
    padding: 4px 12px;
    border-radius: 40px;
    font-size: 0.7rem;
    font-weight: 600;
    background: #10b981;
    color: white;
}
.status-completed { background: #10b981; }

.card-body { padding: 20px; }

.riwayat-table {
    width: 100%;
    border-collapse: collapse;
}
.riwayat-table td {
    padding: 10px 8px;
    border-bottom: 1px solid #f1f5f9;
    font-size: 0.85rem;
}
.riwayat-table td:first-child { font-weight: 600; color: #64748b; width: 40%; }
.riwayat-table td:last-child { font-weight: 700; color: #1e293b; }
.riwayat-table tr:last-child td { border-bottom: none; }

.nilai-akhir {
    margin-top: 16px;
    padding-top: 12px;
    border-top: 2px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 700;
}
.nilai-akhir span:first-child { color: #64748b; }
.nilai-akhir span:last-child { font-size: 1.2rem; color: #10b981; }

.btn-detail {
    width: 100%;
    margin-top: 16px;
    padding: 10px;
    background: #f1f5f9;
    border: none;
    border-radius: 40px;
    cursor: pointer;
    font-weight: 600;
    font-size: 0.8rem;
    transition: 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.btn-detail:hover { background: #3b82f6; color: white; }

.empty-state { text-align: center; padding: 40px; color: #64748b; grid-column: 1/-1; }

/* MODAL */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
}
.modal.active { display: flex; }
.modal-content {
    background: white;
    border-radius: 28px;
    width: 90%;
    max-width: 450px;
    max-height: 90vh;
    overflow-y: auto;
    animation: modalFadeIn 0.3s ease;
}
@keyframes modalFadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 24px;
    border-bottom: 1px solid #e2e8f0;
}
.modal-header h3 { font-size: 1.2rem; display: flex; align-items: center; gap: 8px; }
.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #94a3b8;
}
.modal-close:hover { color: #ef4444; }
.modal-body { padding: 24px; }
.modal-footer {
    display: flex;
    justify-content: flex-end;
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

.detail-row {
    display: flex;
    padding: 10px 0;
    border-bottom: 1px solid #f1f5f9;
}
.detail-label { width: 120px; font-weight: 600; color: #64748b; }
.detail-value { flex: 1; color: #1e293b; }

/* RESPONSIVE */
@media (max-width: 768px) {
    .dashboard-container { flex-direction: column; }
    .sidebar { width: 100%; }
    .mobile-menu-toggle { display: block; }
    .sidebar-nav { display: none; padding: 0 20px 20px 20px; }
    .sidebar-nav.active { display: flex; }
    .profile-section { flex-direction: row; gap: 16px; text-align: left; }
    .avatar-circle { width: 60px; height: 60px; margin: 0; }
    .main-content { padding: 20px; }
    .page-title { font-size: 1.4rem; }
    .filter-section { flex-direction: column; }
    .filter-group { width: 100%; }
    .riwayat-grid { grid-template-columns: 1fr; }
}

@media (max-width: 480px) {
    .main-content { padding: 16px; }
    .card-header { flex-direction: column; text-align: center; }
    .modal-content { width: 95%; }
}
    </style>

<div class="dashboard-container">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="profile-section">
                <div class="avatar-circle">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="profile-info">
                    <h3>Caca Mahasiswa</h3>
                    <p>NIM 24051204194 · Teknik Informatika</p>
                </div>
            </div>
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <div class="sidebar-nav" id="sidebarNav">
            <ul class="nav-menu">
                <li class="nav-item"><i class="fas fa-chalkboard-user"></i> Dashboard</li>
                <li class="nav-item has-sub">
                    <div class="sub-trigger"><i class="fas fa-flask"></i> Praktikum <i class="fas fa-chevron-down"></i></div>
                    <ul class="submenu">
                        <li><i class="fas fa-list-ul"></i> Daftar Praktikum</li>
                        <li><i class="fas fa-pen-ruler"></i> Pendaftaran Saya</li>
                    </ul>
                </li>
                <li class="nav-item"><i class="fas fa-file-alt"></i> Pretest</li>
                <li class="nav-item has-sub">
                    <div class="sub-trigger"><i class="fas fa-chart-line"></i> Nilai dan Presensi <i class="fas fa-chevron-down"></i></div>
                    <ul class="submenu">
                        <li><i class="fas fa-star"></i> Nilai</li>
                        <li><i class="fas fa-fingerprint"></i> Presensi</li>
                    </ul>
                </li>
                <li class="nav-item active"><i class="fas fa-history"></i> Riwayat</li>
            </ul>

            <div class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> LogOut
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <div class="page-header">
            <h1 class="page-title"><i class="fas fa-history"></i> Activity History</h1>
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
                </select>
            </div>
            <button class="apply-filter-btn" id="applyFilter"><i class="fas fa-search"></i> Terapkan</button>
        </div>

        <!-- RIWAYAT GRID -->
        <div class="riwayat-grid" id="riwayatGrid"></div>
    </main>
</div>

<!-- MODAL DETAIL RIWAYAT -->
<div class="modal" id="detailModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-info-circle"></i> Detail Riwayat</h3>
            <button class="modal-close" id="closeDetailModal">&times;</button>
        </div>
        <div class="modal-body" id="detailModalBody"></div>
        <div class="modal-footer">
            <button class="btn-cancel" id="closeDetailModalBtn">Tutup</button>
        </div>
    </div>
</div>
<script>
    // script-riwayat.js
(function() {
    // Data Riwayat Nilai Mahasiswa (Modul yang sudah selesai)
    const riwayatData = [
        {
            id: 1,
            matkul: "Pemrograman Dasar",
            modul: "Modul 1: Algoritma & Flowchart",
            pretest: 85,
            laporan: 82,
            nilaiAkhir: 83.5,
            tanggalSelesai: "15 Maret 2026",
            status: "Completed"
        },
        {
            id: 2,
            matkul: "Pemrograman Dasar",
            modul: "Modul 2: Variabel & Tipe Data",
            pretest: 88,
            laporan: 85,
            nilaiAkhir: 86.5,
            tanggalSelesai: "22 Maret 2026",
            status: "Completed"
        },
        {
            id: 3,
            matkul: "Struktur Data",
            modul: "Modul 1: Array & Linked List",
            pretest: 90,
            laporan: 88,
            nilaiAkhir: 89,
            tanggalSelesai: "10 April 2026",
            status: "Completed"
        },
        {
            id: 4,
            matkul: "Struktur Data",
            modul: "Modul 2: Stack & Queue",
            pretest: 85,
            laporan: 82,
            nilaiAkhir: 83.5,
            tanggalSelesai: "17 April 2026",
            status: "Completed"
        },
        {
            id: 5,
            matkul: "Basis Data",
            modul: "Modul 1: Pengenalan Basis Data & SQL",
            pretest: 88,
            laporan: 85,
            nilaiAkhir: 86.5,
            tanggalSelesai: "5 Mei 2026",
            status: "Completed"
        },
        {
            id: 6,
            matkul: "Jaringan Komputer",
            modul: "Modul 1: Pengenalan Jaringan & OSI Layer",
            pretest: 90,
            laporan: 88,
            nilaiAkhir: 89,
            tanggalSelesai: "20 Mei 2026",
            status: "Completed"
        },
        {
            id: 7,
            matkul: "Jaringan Komputer",
            modul: "Modul 2: Subnetting & VLSM",
            pretest: 85,
            laporan: 82,
            nilaiAkhir: 83.5,
            tanggalSelesai: "27 Mei 2026",
            status: "Completed"
        },
        {
            id: 8,
            matkul: "Rekayasa Perangkat Lunak (RPL)",
            modul: "Modul 1: Pengenalan RPL & Tools",
            pretest: 88,
            laporan: 90,
            nilaiAkhir: 89,
            tanggalSelesai: "3 Juni 2026",
            status: "Completed"
        },
        {
            id: 9,
            matkul: "Rekayasa Perangkat Lunak (RPL)",
            modul: "Modul 2: Analisis Kebutuhan",
            pretest: 85,
            laporan: 88,
            nilaiAkhir: 86.5,
            tanggalSelesai: "10 Juni 2026",
            status: "Completed"
        },
        {
            id: 10,
            matkul: "Pengolahan Citra Digital",
            modul: "Modul 1: Sampling & Kuantisasi",
            pretest: 92,
            laporan: 88,
            nilaiAkhir: 90,
            tanggalSelesai: "15 Juni 2026",
            status: "Completed"
        },
        {
            id: 11,
            matkul: "Pengolahan Citra Digital",
            modul: "Modul 2: Operasi Aritmatika Citra",
            pretest: 88,
            laporan: 85,
            nilaiAkhir: 86.5,
            tanggalSelesai: "22 Juni 2026",
            status: "Completed"
        }
    ];

    let filteredData = [];

    // Update dropdown filter mata kuliah
    function updateDropdown() {
        const matkuls = [...new Set(riwayatData.map(item => item.matkul))];
        const select = document.getElementById('filterMatkul');
        select.innerHTML = '<option value="all">Semua Mata Kuliah</option>' + 
            matkuls.map(m => `<option value="${m}">${m}</option>`).join('');
    }

    // Render riwayat cards
    function renderRiwayat() {
        const selectedMatkul = document.getElementById('filterMatkul').value;
        
        filteredData = riwayatData.filter(item => {
            if (selectedMatkul !== 'all' && item.matkul !== selectedMatkul) return false;
            return true;
        });
        
        const container = document.getElementById('riwayatGrid');
        
        if (filteredData.length === 0) {
            container.innerHTML = '<div class="empty-state">Belum ada riwayat praktikum</div>';
            return;
        }
        
        container.innerHTML = '';
        
        // Kelompokkan berdasarkan mata kuliah dan modul
        filteredData.forEach(item => {
            const card = document.createElement('div');
            card.className = 'riwayat-card';
            card.innerHTML = `
                <div class="card-header">
                    <div>
                        <h3>${item.matkul}</h3>
                        <p>${item.modul}</p>
                    </div>
                    <span class="status-badge status-completed">${item.status}</span>
                </div>
                <div class="card-body">
                    <table class="riwayat-table">
                        <tr>
                            <td>Pretest</td>
                            <td>${item.pretest}/100</td>
                        </tr>
                        <tr>
                            <td>Laporan</td>
                            <td>${item.laporan}/100</td>
                        </tr>
                    </table>
                    <div class="nilai-akhir">
                        <span>Nilai Akhir</span>
                        <span>${item.nilaiAkhir}/100</span>
                    </div>
                    <button class="btn-detail" data-id="${item.id}">
                        <i class="fas fa-info-circle"></i> Detail
                    </button>
                </div>
            `;
            container.appendChild(card);
        });
        
        // Attach event listeners to detail buttons
        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.addEventListener('click', () => openDetailModal(parseInt(btn.dataset.id)));
        });
    }

    // Open detail modal
    function openDetailModal(id) {
        const item = riwayatData.find(i => i.id === id);
        if (!item) return;
        
        const modalBody = document.getElementById('detailModalBody');
        modalBody.innerHTML = `
            <div class="detail-row">
                <span class="detail-label">Mata Kuliah</span>
                <span class="detail-value">${item.matkul}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Modul</span>
                <span class="detail-value">${item.modul}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Pretest</span>
                <span class="detail-value">${item.pretest}/100</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Laporan</span>
                <span class="detail-value">${item.laporan}/100</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Nilai Akhir</span>
                <span class="detail-value"><strong>${item.nilaiAkhir}/100</strong></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Tanggal Selesai </span>
                <span class="detail-value">${item.tanggalSelesai}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value"><span class="status-badge status-completed" style="display:inline-block;">${item.status}</span></span>
            </div>
        `;
        
        document.getElementById('detailModal').classList.add('active');
    }

    function closeModal() {
        document.getElementById('detailModal').classList.remove('active');
    }

    // Export data to CSV
    function exportData() {
        let csvContent = "Mata Kuliah,Modul,Pretest,Laporan,Nilai Akhir,Tanggal Selesai ,Semester,Status\n";
        filteredData.forEach(item => {
            const semesterText = item.semester === '2025' ? 'Semester Genap 2024/2025' : (item.semester === '2026' ? 'Semester Genap 2025/2026' : 'Semester Ganjil 2025/2026');
            csvContent += `"${item.matkul}","${item.modul}",${item.pretest},${item.laporan},${item.nilaiAkhir},"${item.tanggalSelesai}","${semesterText}","${item.status}"\n`;
        });
        
        const blob = new Blob([csvContent], { type: 'text/csv' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'riwayat_praktikum.csv';
        a.click();
        URL.revokeObjectURL(url);
        alert('📥 Data berhasil diekspor!');
    }

    // Event Listeners
    document.getElementById('applyFilter').addEventListener('click', renderRiwayat);
    document.getElementById('exportBtn').addEventListener('click', exportData);
    document.getElementById('closeDetailModal').addEventListener('click', closeModal);
    document.getElementById('closeDetailModalBtn').addEventListener('click', closeModal);
    window.addEventListener('click', (e) => { if (e.target.classList.contains('modal')) closeModal(); });
    
    // Initialize
    updateDropdown();
    renderRiwayat();

    // MOBILE MENU TOGGLE
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
    
    // SIDEBAR DROPDOWN
    document.querySelectorAll('.has-sub .sub-trigger').forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            const sub = trigger.parentElement.querySelector('.submenu');
            if (sub) sub.style.display = sub.style.display === 'none' ? 'block' : 'none';
        });
    });
    
    // LOGOUT
    document.querySelector('.logout-btn').addEventListener('click', () => alert('Anda telah logout.'));
    
    // SUBMENU NAVIGATION
    document.querySelectorAll('.submenu li').forEach(item => {
        item.addEventListener('click', () => {
            if (item.innerText.includes('Riwayat')) return;
        });
    });
})();
</script>
</body>
</html>