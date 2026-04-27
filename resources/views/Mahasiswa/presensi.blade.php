<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Presensi | Mahasiswa</title>
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
            width: 100%;
        }

        .main-content {
            flex: 1;
            width: 100%;
            display: flex;
            flex-direction: column;
            padding: 28px 32px;
            min-width: 0;
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

        .filter-section {
            background: white;
            border-radius: 24px;
            padding: 20px 24px;
            margin-bottom: 28px;
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
            min-width: 200px;
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
        }

        .apply-filter-btn:hover {
            background: #2563eb;
            transform: translateY(-2px);
        }

        .presensi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 24px;
            width: 100%;
        }

        .presensi-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .presensi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            padding: 20px;
            color: white;
        }

        .card-header h3 {
            font-size: 1.1rem;
            margin-bottom: 4px;
        }

        .card-header p {
            font-size: 0.75rem;
            opacity: 0.9;
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        .kehadiran-circle {
            position: relative;
            width: 140px;
            height: 140px;
            margin: 0 auto 16px;
        }

        .kehadiran-circle svg {
            width: 140px;
            height: 140px;
            transform: rotate(-90deg);
        }

        .kehadiran-circle circle {
            fill: none;
            stroke-width: 10;
        }

        .circle-bg {
            stroke: #e2e8f0;
        }

        .circle-progress {
            stroke: #10b981;
            stroke-linecap: round;
            transition: stroke-dasharray 0.5s ease;
        }

        .circle-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .circle-text .percent {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1e293b;
        }

        .circle-text .label {
            font-size: 0.7rem;
            color: #64748b;
        }

        .kehadiran-stats {
            display: flex;
            justify-content: space-around;
            margin: 16px 0;
            flex-wrap: wrap;
            gap: 12px;
        }

        .stat-item {
            text-align: center;
            flex: 1;
        }

        .stat-value {
            font-size: 1.2rem;
            font-weight: 700;
        }

        .stat-label {
            font-size: 0.7rem;
            color: #64748b;
        }

        .stat-hadir .stat-value {
            color: #10b981;
        }

        .stat-izin .stat-value {
            color: #f59e0b;
        }

        .stat-sakit .stat-value {
            color: #8b5cf6;
        }

        .stat-alpha .stat-value {
            color: #ef4444;
        }

        .btn-lihat {
            width: 100%;
            padding: 10px;
            background: #f1f5f9;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.85rem;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-lihat:hover {
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
            max-width: 550px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalFadeIn 0.3s ease;
        }

        .modal-large {
            max-width: 600px;
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

        .detail-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .detail-header h2 {
            font-size: 1.3rem;
            margin-bottom: 4px;
        }

        .detail-header p {
            font-size: 0.85rem;
            color: #64748b;
        }

        .detail-summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 24px;
        }

        .summary-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 12px;
            text-align: center;
        }

        .summary-box .summary-label {
            font-size: 0.7rem;
            color: #64748b;
            margin-bottom: 4px;
        }

        .summary-box .summary-number {
            font-size: 1.3rem;
            font-weight: 700;
        }

        .summary-box.hadir .summary-number {
            color: #10b981;
        }

        .summary-box.izin .summary-number {
            color: #f59e0b;
        }

        .summary-box.sakit .summary-number {
            color: #8b5cf6;
        }

        .summary-box.alpha .summary-number {
            color: #ef4444;
        }

        .pertemuan-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .pertemuan-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            background: #f8fafc;
            border-radius: 16px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .pertemuan-info {
            flex: 1;
        }

        .pertemuan-title {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .pertemuan-date {
            font-size: 0.7rem;
            color: #64748b;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .status-hadir {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-izin {
            background: #fef3c7;
            color: #d97706;
        }

        .status-sakit {
            background: #e9d5ff;
            color: #7c3aed;
        }

        .status-alpha {
            background: #fee2e2;
            color: #dc2626;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #64748b;
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

            .main-content {
                padding: 20px;
            }

            .page-title {
                font-size: 1.4rem;
                margin-bottom: 16px;
                justify-content: center;
                width: 100%;
                text-align: center;
            }

            .filter-section {
                flex-direction: column;
            }

            .filter-group {
                width: 100%;
            }

            .presensi-grid {
                grid-template-columns: 1fr;
            }

            .detail-summary {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 16px;
            }

            .kehadiran-circle {
                width: 120px;
                height: 120px;
            }

            .kehadiran-circle svg {
                width: 120px;
                height: 120px;
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
                <h1 class="page-title"><i class="fas fa-fingerprint"></i> My Presensi</h1>
            </div>

            <div class="filter-section">
                <div class="filter-group">
                    <label><i class="fas fa-flask"></i> Mata Kuliah</label>
                    <select id="filterMatkul">
                        <option value="all">Semua Mata Kuliah</option>
                    </select>
                </div>
                <button class="apply-filter-btn" id="applyFilter"><i class="fas fa-search"></i> Terapkan</button>
            </div>

            <div class="presensi-grid" id="presensiGrid"></div>
        </main>
    </div>

    <div class="modal" id="detailModal">
        <div class="modal-content modal-large">
            <div class="modal-header">
                <h3><i class="fas fa-calendar-check"></i> Detail Presensi</h3>
                <button class="modal-close" id="closeDetailModal">&times;</button>
            </div>
            <div class="modal-body" id="detailModalBody"></div>
            <div class="modal-footer">
                <button class="btn-cancel" id="closeDetailModalBtn">Tutup</button>
            </div>
        </div>
    </div>
    <script>
        (function() {
            const presensiData = {
                "Jaringan Komputer": {
                    totalPertemuan: 14,
                    pertemuan: [{
                            pertemuan: 1,
                            tanggal: "1 April 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 2,
                            tanggal: "8 April 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 3,
                            tanggal: "15 April 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 4,
                            tanggal: "22 April 2026",
                            status: "Izin"
                        },
                        {
                            pertemuan: 5,
                            tanggal: "29 April 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 6,
                            tanggal: "6 Mei 2026",
                            status: "Sakit"
                        },
                        {
                            pertemuan: 7,
                            tanggal: "13 Mei 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 8,
                            tanggal: "20 Mei 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 9,
                            tanggal: "27 Mei 2026",
                            status: "Alpha"
                        },
                        {
                            pertemuan: 10,
                            tanggal: "3 Juni 2026",
                            status: "Hadir"
                        }
                    ]
                },
                "Rekayasa Perangkat Lunak (RPL)": {
                    totalPertemuan: 14,
                    pertemuan: [{
                            pertemuan: 1,
                            tanggal: "2 April 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 2,
                            tanggal: "9 April 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 3,
                            tanggal: "16 April 2026",
                            status: "Izin"
                        },
                        {
                            pertemuan: 4,
                            tanggal: "23 April 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 5,
                            tanggal: "30 April 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 6,
                            tanggal: "7 Mei 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 7,
                            tanggal: "14 Mei 2026",
                            status: "Sakit"
                        },
                        {
                            pertemuan: 8,
                            tanggal: "21 Mei 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 9,
                            tanggal: "28 Mei 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 10,
                            tanggal: "4 Juni 2026",
                            status: "Hadir"
                        }
                    ]
                },
                "Pengolahan Citra Digital": {
                    totalPertemuan: 14,
                    pertemuan: [{
                            pertemuan: 1,
                            tanggal: "3 April 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 2,
                            tanggal: "10 April 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 3,
                            tanggal: "17 April 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 4,
                            tanggal: "24 April 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 5,
                            tanggal: "1 Mei 2026",
                            status: "Izin"
                        },
                        {
                            pertemuan: 6,
                            tanggal: "8 Mei 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 7,
                            tanggal: "15 Mei 2026",
                            status: "Alpha"
                        },
                        {
                            pertemuan: 8,
                            tanggal: "22 Mei 2026",
                            status: "Sakit"
                        },
                        {
                            pertemuan: 9,
                            tanggal: "29 Mei 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 10,
                            tanggal: "5 Juni 2026",
                            status: "Hadir"
                        }
                    ]
                },
                "Basis Data": {
                    totalPertemuan: 14,
                    pertemuan: [{
                            pertemuan: 1,
                            tanggal: "4 April 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 2,
                            tanggal: "11 April 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 3,
                            tanggal: "18 April 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 4,
                            tanggal: "25 April 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 5,
                            tanggal: "2 Mei 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 6,
                            tanggal: "9 Mei 2026",
                            status: "Izin"
                        },
                        {
                            pertemuan: 7,
                            tanggal: "16 Mei 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 8,
                            tanggal: "23 Mei 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 9,
                            tanggal: "30 Mei 2026",
                            status: "Hadir"
                        },
                        {
                            pertemuan: 10,
                            tanggal: "6 Juni 2026",
                            status: "Alpha"
                        }
                    ]
                }
            };

            let filteredData = [];

            function updateDropdown() {
                const matkuls = Object.keys(presensiData);
                const select = document.getElementById('filterMatkul');
                select.innerHTML = '<option value="all">Semua Mata Kuliah</option>' +
                    matkuls.map(m => `<option value="${m}">${m}</option>`).join('');
            }

            function hitungPersentase(pertemuan) {
                const hadir = pertemuan.filter(p => p.status === "Hadir").length;
                const total = pertemuan.length;
                return Math.round((hadir / total) * 100);
            }

            function hitungStatistik(pertemuan) {
                const hadir = pertemuan.filter(p => p.status === "Hadir").length;
                const izin = pertemuan.filter(p => p.status === "Izin").length;
                const sakit = pertemuan.filter(p => p.status === "Sakit").length;
                const alpha = pertemuan.filter(p => p.status === "Alpha").length;
                return {
                    hadir,
                    izin,
                    sakit,
                    alpha,
                    total: pertemuan.length
                };
            }

            function renderPresensi() {
                const selectedMatkul = document.getElementById('filterMatkul').value;

                filteredData = selectedMatkul === 'all' ? Object.keys(presensiData) : [selectedMatkul];
                filteredData = filteredData.filter(m => presensiData[m]);

                const container = document.getElementById('presensiGrid');

                if (filteredData.length === 0) {
                    container.innerHTML = '<div class="empty-state">Belum ada data presensi</div>';
                    return;
                }

                container.innerHTML = '';

                filteredData.forEach(matkul => {
                    const data = presensiData[matkul];
                    const persentase = hitungPersentase(data.pertemuan);
                    const stats = hitungStatistik(data.pertemuan);
                    const circumference = 2 * Math.PI * 60;
                    const offset = circumference - (persentase / 100) * circumference;

                    const card = document.createElement('div');
                    card.className = 'presensi-card';
                    card.innerHTML = `
                <div class="card-header">
                    <h3>${matkul}</h3>
                </div>
                <div class="card-body">
                    <div class="kehadiran-circle">
                        <svg viewBox="0 0 140 140">
                            <circle cx="70" cy="70" r="60" class="circle-bg"></circle>
                            <circle cx="70" cy="70" r="60" class="circle-progress" style="stroke-dasharray: ${circumference}; stroke-dashoffset: ${offset}; stroke: #10b981;"></circle>
                        </svg>
                        <div class="circle-text">
                            <span class="percent">${persentase}%</span>
                            <span class="label">Kehadiran</span>
                        </div>
                    </div>
                    <div class="kehadiran-stats">
                        <div class="stat-item stat-hadir">
                            <div class="stat-value">${stats.hadir}</div>
                            <div class="stat-label">Hadir</div>
                        </div>
                        <div class="stat-item stat-izin">
                            <div class="stat-value">${stats.izin}</div>
                            <div class="stat-label">Izin</div>
                        </div>
                        <div class="stat-item stat-sakit">
                            <div class="stat-value">${stats.sakit}</div>
                            <div class="stat-label">Sakit</div>
                        </div>
                        <div class="stat-item stat-alpha">
                            <div class="stat-value">${stats.alpha}</div>
                            <div class="stat-label">Alpha</div>
                        </div>
                    </div>
                    <button class="btn-lihat" data-matkul="${matkul}">
                        <i class="fas fa-eye"></i> Lihat Kehadiran
                    </button>
                </div>
            `;
                    container.appendChild(card);
                });

                document.querySelectorAll('.btn-lihat').forEach(btn => {
                    btn.addEventListener('click', () => openDetailModal(btn.dataset.matkul));
                });
            }

            function openDetailModal(matkul) {
                const data = presensiData[matkul];
                if (!data) return;

                const persentase = hitungPersentase(data.pertemuan);
                const stats = hitungStatistik(data.pertemuan);

                const pertemuanListHtml = data.pertemuan.map(p => {
                    let statusClass = '';
                    if (p.status === 'Hadir') statusClass = 'status-hadir';
                    else if (p.status === 'Izin') statusClass = 'status-izin';
                    else if (p.status === 'Sakit') statusClass = 'status-sakit';
                    else statusClass = 'status-alpha';

                    return `
                <div class="pertemuan-item">
                    <div class="pertemuan-info">
                        <div class="pertemuan-title">Pertemuan ${p.pertemuan}</div>
                        <div class="pertemuan-date">${p.tanggal}</div>
                    </div>
                    <span class="status-badge ${statusClass}">${p.status}</span>
                </div>
            `;
                }).join('');

                const modalBody = document.getElementById('detailModalBody');
                modalBody.innerHTML = `
            <div class="detail-header">
                <h2>${matkul}</h2>
                <p>Kelas: ${data.kelas} | Total Pertemuan: ${data.pertemuan.length} dari ${data.totalPertemuan}</p>
            </div>
            <div class="detail-summary">
                <div class="summary-box hadir">
                    <div class="summary-label">Hadir</div>
                    <div class="summary-number">${stats.hadir}</div>
                </div>
                <div class="summary-box izin">
                    <div class="summary-label">Izin</div>
                    <div class="summary-number">${stats.izin}</div>
                </div>
                <div class="summary-box sakit">
                    <div class="summary-label">Sakit</div>
                    <div class="summary-number">${stats.sakit}</div>
                </div>
                <div class="summary-box alpha">
                    <div class="summary-label">Alpha</div>
                    <div class="summary-number">${stats.alpha}</div>
                </div>
            </div>
            <div class="detail-header">
                <h4>Persentase Kehadiran: ${persentase}%</h4>
            </div>
            <div class="pertemuan-list">
                ${pertemuanListHtml}
            </div>
        `;

                document.getElementById('detailModal').classList.add('active');
            }

            function closeModal() {
                document.getElementById('detailModal').classList.remove('active');
            }

            document.getElementById('applyFilter').addEventListener('click', renderPresensi);
            document.getElementById('closeDetailModal').addEventListener('click', closeModal);
            document.getElementById('closeDetailModalBtn').addEventListener('click', closeModal);
            window.addEventListener('click', (e) => {
                if (e.target.classList.contains('modal')) closeModal();
            });

            updateDropdown();
            renderPresensi();

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

            document.querySelectorAll('.submenu li').forEach(item => {
                item.addEventListener('click', () => {
                    if (item.innerText.includes('Presensi')) return;
                });
            });
        })();
    </script>
</body>

</html>
