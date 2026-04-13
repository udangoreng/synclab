<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Pretest | Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <style>
        /* style-pretest.css */
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
        }

        .apply-filter-btn:hover {
            background: #2563eb;
            transform: translateY(-2px);
        }

        /* PRETEST GRID */
        .pretest-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 24px;
        }

        .pretest-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        .pretest-card:hover {
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
        }

        .modul-title {
            font-weight: 700;
            font-size: 1rem;
            color: #1e293b;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e2e8f0;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 16px;
        }

        .action-btn {
            flex: 1;
            min-width: 100px;
            padding: 10px 16px;
            border: none;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.8rem;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-absen {
            background: #10b981;
            color: white;
        }

        .btn-absen:hover {
            background: #059669;
        }

        .btn-absen.disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }

        .btn-start {
            background: #f59e0b;
            color: white;
        }

        .btn-start:hover {
            background: #d97706;
        }

        .btn-start.disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }

        .btn-upload {
            background: #8b5cf6;
            color: white;
        }

        .btn-upload:hover {
            background: #7c3aed;
        }

        .btn-upload.disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: 600;
            margin-top: 12px;
        }

        .status-active {
            background: #dcfce7;
            color: #16a34a;
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

        .upload-info {
            background: #f8fafc;
            padding: 12px 16px;
            border-radius: 16px;
            margin-bottom: 20px;
        }

        .upload-info p {
            margin: 4px 0;
            font-size: 0.85rem;
        }

        .upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 20px;
            padding: 32px;
            text-align: center;
            cursor: pointer;
            transition: 0.2s;
            margin-bottom: 16px;
        }

        .upload-area:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .upload-area i {
            font-size: 48px;
            color: #3b82f6;
            margin-bottom: 12px;
        }

        .upload-area p {
            font-size: 0.85rem;
            color: #64748b;
        }

        .upload-area input {
            display: none;
        }

        .file-info {
            display: block;
            font-size: 0.75rem;
            color: #10b981;
            margin-top: 12px;
        }

        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            font-family: inherit;
            font-size: 0.85rem;
            resize: vertical;
        }

        .form-group textarea:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .btn-cancel {
            padding: 8px 20px;
            background: #f1f5f9;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-upload,
        .btn-confirm {
            padding: 8px 20px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-confirm {
            background: #10b981;
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
            }

            .filter-section {
                flex-direction: column;
            }

            .filter-group {
                width: 100%;
            }

            .pretest-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .action-btn {
                width: 100%;
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
        
        <!-- MAIN CONTENT -->
        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title"><i class="fas fa-file-alt"></i> Pretest</h1>
            </div>

            <!-- FILTER SECTION -->
            <div class="filter-section">
                <div class="filter-group">
                    <label><i class="fas fa-flask"></i> Mata Kuliah</label>
                    <select id="filterMatkul">
                        <option value="all">Semua Mata Kuliah</option>
                        <option value="Jaringan Komputer">Jaringan Komputer</option>
                        <option value="Rekayasa Perangkat Lunak (RPL)">Rekayasa Perangkat Lunak (RPL)</option>
                        <option value="Pengolahan Citra Digital">Pengolahan Citra Digital</option>
                        <option value="Basis Data">Basis Data</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label><i class="fas fa-tag"></i> Modul</label>
                    <select id="filterModul">
                        <option value="all">Semua Modul</option>
                    </select>
                </div>
                <button class="apply-filter-btn" id="applyFilter"><i class="fas fa-search"></i> Terapkan</button>
            </div>

            <!-- PRETEST CARDS GRID -->
            <div class="pretest-grid" id="pretestGrid">
                <!-- Cards akan diisi oleh JavaScript -->
            </div>
        </main>
    </div>

    <!-- MODAL UPLOAD LAPORAN -->
    <div class="modal" id="uploadModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-upload"></i> Upload Laporan Praktikum</h3>
                <button class="modal-close" id="closeUploadModal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="upload-info" id="uploadInfo">
                    <p><strong>Mata Kuliah:</strong> <span id="uploadMatkul"></span></p>
                    <p><strong>Modul:</strong> <span id="uploadModul"></span></p>
                </div>
                <div class="upload-area" id="uploadArea">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>Drag & drop file di sini atau klik untuk memilih file</p>
                    <input type="file" id="fileInput" accept=".pdf,.doc,.docx,.zip">
                    <span class="file-info" id="fileInfo">Belum ada file dipilih</span>
                </div>
                <div class="form-group">
                    <label>Keterangan (Opsional)</label>
                    <textarea id="uploadKeterangan" rows="3" placeholder="Tambahkan keterangan untuk laporan Anda..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" id="cancelUploadModal">Batal</button>
                <button class="btn-upload" id="submitUpload">Upload Laporan</button>
            </div>
        </div>
    </div>

    <!-- MODAL KONFIRMASI -->
    <div class="modal" id="confirmModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-check-circle"></i> Konfirmasi</h3>
                <button class="modal-close" id="closeConfirmModal">&times;</button>
            </div>
            <div class="modal-body">
                <p id="confirmMessage"></p>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" id="cancelConfirmModal">Batal</button>
                <button class="btn-confirm" id="submitConfirm">Ya, Lanjutkan</button>
            </div>
        </div>
    </div>
    <script>
        // script-pretest.js
        (function() {
            // Data Pretest (dari pendaftaran yang sudah active)
            let pretestData = [{
                    id: 1,
                    matkul: "Jaringan Komputer",
                    modul: "Modul 1: Pengenalan Jaringan & OSI Layer",
                    kode: "JARKOM-M1",
                    statusAbsen: false,
                    statusPretest: false,
                    statusLaporan: false,
                    fileLaporan: null
                },
                {
                    id: 2,
                    matkul: "Jaringan Komputer",
                    modul: "Modul 2: Subnetting & VLSM",
                    kode: "JARKOM-M2",
                    statusAbsen: false,
                    statusPretest: false,
                    statusLaporan: false,
                    fileLaporan: null
                },
                {
                    id: 3,
                    matkul: "Rekayasa Perangkat Lunak (RPL)",
                    modul: "Modul 1: Pengenalan RPL & Tools",
                    kode: "RPL-M1",
                    statusAbsen: false,
                    statusPretest: false,
                    statusLaporan: false,
                    fileLaporan: null
                },
                {
                    id: 4,
                    matkul: "Rekayasa Perangkat Lunak (RPL)",
                    modul: "Modul 2: Analisis Kebutuhan",
                    kode: "RPL-M2",
                    statusAbsen: false,
                    statusPretest: false,
                    statusLaporan: false,
                    fileLaporan: null
                },
                {
                    id: 5,
                    matkul: "Pengolahan Citra Digital",
                    modul: "Modul 1: Sampling & Kuantisasi",
                    kode: "PCD-M1",
                    statusAbsen: true,
                    statusPretest: true,
                    statusLaporan: true,
                    fileLaporan: "laporan_pcd_modul1.pdf"
                },
                {
                    id: 6,
                    matkul: "Pengolahan Citra Digital",
                    modul: "Modul 2: Operasi Aritmatika Citra",
                    kode: "PCD-M2",
                    statusAbsen: false,
                    statusPretest: false,
                    statusLaporan: false,
                    fileLaporan: null
                }
            ];

            let filteredData = [];
            let currentUploadItem = null;

            // DOM Elements
            const pretestGrid = document.getElementById('pretestGrid');
            const filterMatkul = document.getElementById('filterMatkul');
            const filterModul = document.getElementById('filterModul');
            const applyFilterBtn = document.getElementById('applyFilter');

            // Modal Elements
            const uploadModal = document.getElementById('uploadModal');
            const confirmModal = document.getElementById('confirmModal');
            const uploadMatkulSpan = document.getElementById('uploadMatkul');
            const uploadModulSpan = document.getElementById('uploadModul');
            const fileInput = document.getElementById('fileInput');
            const fileInfo = document.getElementById('fileInfo');
            const uploadArea = document.getElementById('uploadArea');
            const uploadKeterangan = document.getElementById('uploadKeterangan');
            let selectedFile = null;

            // Update filter modul berdasarkan matkul yang dipilih
            function updateModulFilter() {
                const selectedMatkul = filterMatkul.value;
                let moduls = [];

                if (selectedMatkul === 'all') {
                    moduls = [...new Set(pretestData.map(item => item.modul))];
                } else {
                    moduls = pretestData.filter(item => item.matkul === selectedMatkul).map(item => item.modul);
                    moduls = [...new Set(moduls)];
                }

                filterModul.innerHTML = '<option value="all">Semua Modul</option>';
                moduls.forEach(modul => {
                    filterModul.innerHTML += `<option value="${modul}">${modul}</option>`;
                });
            }

            // Render pretest cards
            function renderPretest() {
                const matkul = filterMatkul.value;
                const modul = filterModul.value;

                filteredData = pretestData.filter(item => {
                    if (matkul !== 'all' && item.matkul !== matkul) return false;
                    if (modul !== 'all' && item.modul !== modul) return false;
                    return true;
                });

                if (filteredData.length === 0) {
                    pretestGrid.innerHTML =
                        '<div class="empty-state" style="grid-column:1/-1; text-align:center; padding:40px;">Belum ada pretest yang tersedia</div>';
                    return;
                }

                pretestGrid.innerHTML = '';

                filteredData.forEach(item => {
                    const card = document.createElement('div');
                    card.className = 'pretest-card';
                    card.innerHTML = `
                <div class="card-header">
                    <h3>${item.matkul}</h3>
                    <p>Kode: ${item.kode}</p>
                </div>
                <div class="card-body">
                    <div class="modul-title">${item.modul}</div>
                    <div class="action-buttons">
                        <button class="action-btn btn-absen ${item.statusAbsen ? 'disabled' : ''}" data-id="${item.id}" data-action="absen">
                            <i class="fas fa-fingerprint"></i> ${item.statusAbsen ? 'Sudah Absen' : 'Presensi'}
                        </button>
                        <button class="action-btn btn-start ${item.statusPretest ? 'disabled' : ''}" data-id="${item.id}" data-action="pretest">
                            <i class="fas fa-play"></i> ${item.statusPretest ? 'Sudah Start' : 'Pretest Start'}
                        </button>
                        <button class="action-btn btn-upload ${item.statusLaporan ? 'disabled' : ''}" data-id="${item.id}" data-action="upload">
                            <i class="fas fa-upload"></i> ${item.statusLaporan ? 'Sudah Upload' : 'Upload Laporan'}
                        </button>
                    </div>
                    <span class="status-badge status-active">Active</span>
                </div>
            `;
                    pretestGrid.appendChild(card);
                });

                // Attach event listeners to buttons
                document.querySelectorAll('.btn-absen').forEach(btn => {
                    if (!btn.classList.contains('disabled')) {
                        btn.addEventListener('click', () => handleAbsen(parseInt(btn.dataset.id)));
                    }
                });
                document.querySelectorAll('.btn-start').forEach(btn => {
                    if (!btn.classList.contains('disabled')) {
                        btn.addEventListener('click', () => handlePretestStart(parseInt(btn.dataset.id)));
                    }
                });
                document.querySelectorAll('.btn-upload').forEach(btn => {
                    if (!btn.classList.contains('disabled')) {
                        btn.addEventListener('click', () => openUploadModal(parseInt(btn.dataset.id)));
                    }
                });
            }

            // Handle Absen
            function handleAbsen(id) {
                showConfirm('Konfirmasi Presensi', 'Apakah Anda sudah hadir dalam praktikum ini?', () => {
                    const item = pretestData.find(i => i.id === id);
                    if (item) {
                        item.statusAbsen = true;
                        renderPretest();
                        showAlert('✅ Presensi berhasil dicatat!', 'success');
                    }
                });
            }

            // Handle Pretest Start
            function handlePretestStart(id) {
                showConfirm('Mulai Pretest', 'Apakah Anda siap untuk memulai pretest? Waktu akan berjalan 60 menit.',
                () => {
                        const item = pretestData.find(i => i.id === id);
                        if (item) {
                            item.statusPretest = true;
                            renderPretest();
                            showAlert('📝 Pretest dimulai! Selamat mengerjakan.', 'success');
                            // Bisa redirect ke halaman pretest atau open modal soal
                        }
                    });
            }

            // Open Upload Modal
            function openUploadModal(id) {
                currentUploadItem = pretestData.find(i => i.id === id);
                if (!currentUploadItem) return;

                uploadMatkulSpan.innerText = currentUploadItem.matkul;
                uploadModulSpan.innerText = currentUploadItem.modul;
                selectedFile = null;
                fileInfo.innerText = 'Belum ada file dipilih';
                fileInput.value = '';
                uploadKeterangan.value = '';

                uploadModal.classList.add('active');
            }

            // Handle file selection
            function setupFileUpload() {
                uploadArea.addEventListener('click', () => fileInput.click());

                fileInput.addEventListener('change', (e) => {
                    if (e.target.files.length > 0) {
                        selectedFile = e.target.files[0];
                        fileInfo.innerText =
                            `📄 ${selectedFile.name} (${(selectedFile.size / 1024).toFixed(2)} KB)`;
                    } else {
                        selectedFile = null;
                        fileInfo.innerText = 'Belum ada file dipilih';
                    }
                });

                // Drag and drop
                uploadArea.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    uploadArea.style.borderColor = '#3b82f6';
                    uploadArea.style.background = '#eff6ff';
                });

                uploadArea.addEventListener('dragleave', (e) => {
                    e.preventDefault();
                    uploadArea.style.borderColor = '#cbd5e1';
                    uploadArea.style.background = 'transparent';
                });

                uploadArea.addEventListener('drop', (e) => {
                    e.preventDefault();
                    uploadArea.style.borderColor = '#cbd5e1';
                    uploadArea.style.background = 'transparent';
                    if (e.dataTransfer.files.length > 0) {
                        selectedFile = e.dataTransfer.files[0];
                        fileInfo.innerText =
                            `📄 ${selectedFile.name} (${(selectedFile.size / 1024).toFixed(2)} KB)`;
                        fileInput.files = e.dataTransfer.files;
                    }
                });
            }

            // Submit upload
            function submitUpload() {
                if (!selectedFile) {
                    showAlert('⚠️ Silakan pilih file laporan terlebih dahulu!', 'warning');
                    return;
                }

                // Simulate upload process
                showConfirm('Konfirmasi Upload',
                    `Apakah Anda yakin ingin mengupload laporan "${selectedFile.name}" untuk ${currentUploadItem.modul}?`,
                    () => {
                        // Simulate upload delay
                        const btnSubmit = document.getElementById('submitUpload');
                        btnSubmit.disabled = true;
                        btnSubmit.innerText = 'Mengupload...';

                        setTimeout(() => {
                            currentUploadItem.statusLaporan = true;
                            currentUploadItem.fileLaporan = selectedFile.name;
                            renderPretest();
                            closeUploadModal();
                            showAlert('✅ Laporan berhasil diupload!', 'success');
                            btnSubmit.disabled = false;
                            btnSubmit.innerText = 'Upload Laporan';
                        }, 1500);
                    });
            }

            // Close modals
            function closeUploadModal() {
                uploadModal.classList.remove('active');
                currentUploadItem = null;
                selectedFile = null;
            }

            function closeConfirmModal() {
                confirmModal.classList.remove('active');
            }

            let confirmCallback = null;

            function showConfirm(title, message, callback) {
                document.querySelector('#confirmModal .modal-header h3').innerHTML =
                    `<i class="fas fa-question-circle"></i> ${title}`;
                document.getElementById('confirmMessage').innerText = message;
                confirmCallback = callback;
                confirmModal.classList.add('active');
            }

            function showAlert(message, type = 'info') {
                // Simple alert (bisa diganti dengan toast notification)
                alert(message);
            }

            // Filter and render
            function applyFilter() {
                renderPretest();
            }

            // Event Listeners
            applyFilterBtn.addEventListener('click', applyFilter);
            filterMatkul.addEventListener('change', () => {
                updateModulFilter();
                renderPretest();
            });

            document.getElementById('closeUploadModal').addEventListener('click', closeUploadModal);
            document.getElementById('cancelUploadModal').addEventListener('click', closeUploadModal);
            document.getElementById('submitUpload').addEventListener('click', submitUpload);

            document.getElementById('closeConfirmModal').addEventListener('click', closeConfirmModal);
            document.getElementById('cancelConfirmModal').addEventListener('click', closeConfirmModal);
            document.getElementById('submitConfirm').addEventListener('click', () => {
                if (confirmCallback) {
                    confirmCallback();
                }
                closeConfirmModal();
            });

            window.addEventListener('click', (e) => {
                if (e.target.classList.contains('modal')) {
                    closeUploadModal();
                    closeConfirmModal();
                }
            });

            // Initialize
            updateModulFilter();
            renderPretest();
            setupFileUpload();

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
                    if (item.innerText.includes('Pretest')) return;
                    alert(`🔍 Membuka halaman: ${item.innerText.trim()}`);
                });
            });
        })();
    </script>
</body>

</html>
