<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Praktikum</title>
    <link rel="stylesheet" href="{{asset('lab_css/dashboard.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
  @include('laboran/partials/sidebar')
    <main class="main">
        <section class="card">
            <h2>Dashboard</h2>
            <div class="feature-box">
                <div style="padding: 20px; width: 100%;"></div>
            </div>
            
            <div class="stats-section">
                <div class="stat-card">
                    <h4>Total Praktikum</h4>
                    <p style="color: #4CAF50;">{{ $totalPraktikum }}</p>
                </div>
                <div class="stat-card">
                    <h4>Total Asisten</h4>
                    <p style="color: #2196F3;">{{ $totalAsisten }}</p>
                </div>
                <div class="stat-card">
                    <h4>Total Praktikan</h4>
                    <p style="color: #FF9800;">{{ $totalPraktikan }}</p>
                </div>
                <div class="stat-card">
                    <h4>Jadwal Hari Ini</h4>
                    <p style="color: #9C27B0;">{{ $jadwalHariIni }}</p>
                </div>
            </div>
        </section>

        <div class="grid">
            <div>

                <section class="card">
                    <h3>Kelola Praktikum</h3>
                    <input type="text" class="search" placeholder="🔍 Cari praktikum..." id="searchPraktikum">
                    <div class="praktikum-grid">
                        @forelse ($praktikums as $praktikum)
                            <div class="praktikum-card" data-nama="{{ $praktikum->nama_praktikum }}" data-id="{{ $praktikum->id }}" data-kode="{{ $praktikum->kode_praktikum }}">
                                <h4>📘 {{ $praktikum->nama_praktikum }}</h4>
                                <p>{{ $praktikum->kode_praktikum }}</p>
                                <span class="status praktikum aktif">🟢 Aktif</span>

                                <div class="actions">
                                    <button class="btn-edit" data-praktikum='{{ json_encode($praktikum) }}'>Edit</button>
                                    <button class="btn-delete" data-id="{{ $praktikum->id }}" data-nama="{{ $praktikum->nama_praktikum }}">Hapus</button>
                                    <button class="btn-detail" data-praktikum='{{ json_encode($praktikum) }}'>Detail</button>
                                </div>
                            </div>
                        @empty
                            <p style="grid-column: 1/-1; text-align: center; padding: 20px; color: #999;">Tidak ada praktikum</p>
                        @endforelse
                    </div>
                </section>

                <section class="card">
                    <h3>Monitoring Sistem</h3>
                    <div class="monitor-cards">
                        <div class="monitor-item pendaftaran">
                            <p>Pendaftaran</p>
                            <span class="monitor status active">Aktif</span>
                        </div>

                        <div class="monitor-item presensi">
                            <p>Presensi</p>
                            <h4>{{ round($presensiHariIniPersen) }}%</h4>
                        </div>

                        <div class="monitor-item nilai">
                            <p>Nilai</p>
                            <h4>{{ round($rataNilai, 1) }}</h4>
                        </div>
                    </div>

                    <div class="monitor-box">
                        <h4>Presensi Hari Ini</h4>
                        <div class="progress-bar">
                            <div class="fill" style="width: {{ $presensiHariIniPersen }}%"></div>
                        </div>
                        <p>{{ $presensiHadir }}/{{ $totalPraktikanHariIni }} mahasiswa sudah hadir</p>
                        <span class="status monitor warning-text">{{ $presensiHariIniPersen >= 80 ? '🟢 Baik' : '🟡 Belum lengkap' }}</span>
                    </div>

                    <div class="monitor-box">
                        <h4>Nilai</h4>
                        <div class="progress-bar">
                            <div class="fill yellow" style="width: {{ ($rataNilai / 100) * 100 }}%"></div>
                        </div>
                        <p>Rata-rata: {{ round($rataNilai, 2) }} | Tertinggi: {{ $nilaiTertinggi }} | Terendah: {{ $nilaiTerendah }}</p>
                        <span class="status monitor warning-text">🟡 Masih proses</span>
                    </div>

                    <div class="monitor-warning">
                        @forelse ($warnings as $warning)
                            <p>⚠ {{ $warning }}</p>
                        @empty
                            <p>✅ Tidak ada peringatan</p>
                        @endforelse
                    </div>

                    <div class="monitor-footer">
                        <span>Last update: {{ $lastUpdate }}</span>
                    </div>
                </section>

                <section class="card">
                    <h3>Laporan</h3>

                    <div class="filter-bar">
                        <select>
                            <option>Semua Praktikum</option>
                        </select>

                        <select>
                            <option>Semester</option>
                        </select>

                        <select>
                            <option>Tanggal</option>
                        </select>
                    </div>

                    <div class="laporan-grid">
                        <div class="laporan-card">
                            <h4>📊 Rekap Nilai</h4>

                            <div class="stats">
                                <div><strong>{{ round($rataNilai, 2) }}</strong><span>Rata-rata</span></div>
                                <div><strong>{{ $nilaiTertinggi }}</strong><span>Tertinggi</span></div>
                                <div><strong>{{ $nilaiTerendah }}</strong><span>Terendah</span></div>
                            </div>

                            <div class="actions">
                                <button class="btn-detail">Detail</button>
                                <button class="btn-pdf">PDF</button>
                                <button class="btn-excel">Excel</button>
                            </div>
                        </div>

                        <div class="laporan-card">
                            <h4>📊 Rekap Laporan</h4>

                            <div class="stats">
                                <div><strong>{{ round($rataPengumpulan, 1) }}%</strong><span>Terkumpul</span></div>
                                <div><strong>{{ $laporanTerkumpul }}</strong><span>dari {{ $totalLaporan }}</span></div>
                                <div><strong>{{ $laporanTerlambat }}</strong><span>Terlambat</span></div>
                            </div>

                            <div class="actions">
                                <button class="btn-detail">Detail</button>
                                <button class="btn-pdf">PDF</button>
                                <button class="btn-excel">Excel</button>
                            </div>
                        </div>
                    </div>

                    <div class="riwayat">
                        <h4>Riwayat Export</h4>
                        <ul>
                            <li>Rekap Nilai - 3 Apr 2026</li>
                            <li>Presensi - 2 Apr 2026</li>
                        </ul>
                    </div>
                </section>

            </div>

            <div>
                <section class="card">
                    <h3>📅 Jadwal & Status</h3>
                    <div class="summary">
                        <p><strong>Hari Ini ({{ ucfirst($hariIni) }}):</strong> {{ $jadwalHariIni }} kelas | {{ $asistenMengajar }} asisten | {{ $bentrokCount > 0 ? '⚠ ' . $bentrokCount . ' bentrok' : '✅ Tidak ada bentrok' }}</p>

                        <div class="filter-jadwal">
                            <form method="GET" action="{{ route('admin') }}" style="display: flex; gap: 10px;">
                                <button type="submit" name="jadwal_filter" value="hari_ini" class="btn" {{ $jadwalFilter == 'hari_ini' ? 'style=background-color:#4CAF50;color:white' : '' }}>Hari Ini</button>
                                <button type="submit" name="jadwal_filter" value="semua" class="btn" {{ $jadwalFilter == 'semua' ? 'style=background-color:#4CAF50;color:white' : '' }}>Semua Jadwal</button>
                            </form>
                        </div>
                    </div>

                    @forelse ($jadwalGrouped as $hari => $jadwalList)
                        <div class="jadwal-hari">
                            <h4>{{ ucfirst($hari) }}</h4>

                            <div class="timeline">
                                @foreach ($jadwalList as $jadwal)
                                    <div class="timeline-item {{ $jadwal->bentrok ? 'bentrok' : '' }}" data-jadwal='{{ json_encode($jadwal) }}'>
                                        <div class="time">{{ $jadwal->jam_mulai }}</div>

                                        <div class="line"></div>

                                        <div class="content">
                                            <h5>📘 {{ $jadwal->praktikum->nama_praktikum ?? 'Unknown' }}</h5>
                                            <p>{{ $jadwal->laboratorium->nama_laboratorium ?? 'Lab Unknown' }}</p>
                                            <span class="status jadwal {{ $jadwal->bentrok ? 'bentrok' : ($jadwal->status == 'Penuh' ? 'penuh' : 'berjalan') }}">
                                                {{ $jadwal->bentrok ? '❌ Bentrok' : ($jadwal->status == 'Penuh' ? '🔴 Penuh' : '🟢 Berjalan') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="timeline-item last">
                                    <div class="time">{{ $jadwalList->last()->jam_selesai ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p style="padding: 20px; text-align: center; color: #999;">Tidak ada jadwal untuk filter ini</p>
                    @endforelse

                    @if ($warningsJadwal)
                        <div class="warning">
                            ⚠ {{ $warningsJadwal }}
                        </div>
                    @endif
                </section>

                <section class="card">
                    <h3>Asisten Aktif</h3>
                    <p class="asisten-summary">
                        {{ $totalAsisten }} asisten | {{ $asistenMengajar }} mengajar hari ini
                    </p>

                    @forelse ($asistenAktif as $asisten)
                        <div class="asisten" data-asisten='{{ json_encode($asisten) }}'>
                            <div class="left">
                                <img src="https://i.pravatar.cc/100?img={{ $loop->index }}" class="avatar small">

                                <div>
                                    <strong>{{ $asisten->nama }}</strong>
                                    <p>{{ $asisten->jadwals_count }} kelas</p>
                                    <span class="status asisten {{ $asisten->jadwals->where('hari', $hariIni)->count() > 0 ? 'aktif' : 'upcoming' }}">
                                        {{ $asisten->jadwals->where('hari', $hariIni)->count() > 0 ? '🟢 Sedang mengajar' : '⏳ Tidak mengajar hari ini' }}
                                    </span>
                                </div>
                            </div>

                            <span class="badge">{{ $asisten->jadwals_count > 2 ? 'overload' : 'active' }}</span>

                            <div class="actions bawah">
                                <button class="btn-detail-asisten" data-id="{{ $asisten->id }}" data-nama="{{ $asisten->nama }}" data-email="{{ $asisten->email }}" data-nohp="{{ $asisten->nohp }}" data-kelas="{{ $asisten->jadwals_count }}">Detail</button>
                                <button class="btn-jadwal-asisten" data-id="{{ $asisten->id }}" data-nama="{{ $asisten->nama }}">Jadwal</button>
                            </div>
                        </div>
                    @empty
                        <p style="padding: 20px; text-align: center; color: #999;">Tidak ada asisten</p>
                    @endforelse
                </section>
            </div>
        </div>
    </main>

    <!-- Modal Praktikum Detail -->
    <div id="modalPraktikumDetail" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modalPraktikumDetail')">&times;</span>
            <h2>Detail Praktikum</h2>
            <div id="praktikumDetailContent">
                <p><strong>Nama:</strong> <span id="detailNama"></span></p>
                <p><strong>Kode:</strong> <span id="detailKode"></span></p>
                <p><strong>Angkatan:</strong> <span id="detailAngkatan"></span></p>
                <p><strong>Semester:</strong> <span id="detailSemester"></span></p>
            </div>
        </div>
    </div>

    <!-- Modal Praktikum Edit -->
    <div id="modalPraktikumEdit" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modalPraktikumEdit')">&times;</span>
            <h2>Edit Praktikum</h2>
            <form id="formEditPraktikum" style="margin: 2rem;">
                <div style="margin-bottom: 15px;">
                    <label>Nama Praktikum:</label>
                    <input type="text" id="editNama" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label>Kode Praktikum:</label>
                    <input type="text" id="editKode" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label>Angkatan:</label>
                    <input type="text" id="editAngkatan" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label>Semester:</label>
                    <input type="text" id="editSemester" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
                <div style="display: flex; gap: 10px; justify-content: flex-end;">
                    <button type="button" onclick="closeModal('modalPraktikumEdit')" style="padding: 8px 16px; background-color: #999; color: white; border: none; border-radius: 4px; cursor: pointer;">Batal</button>
                    <button type="submit" style="padding: 8px 16px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Praktikum Delete -->
    <div id="modalPraktikumDelete" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modalPraktikumDelete')">&times;</span>
            <h2>Konfirmasi Hapus</h2>
            <p>Apakah Anda yakin ingin menghapus praktikum <strong id="deletePraktikumNama"></strong>?</p>
            <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px;">
                <button onclick="closeModal('modalPraktikumDelete')" style="padding: 8px 16px; background-color: #999; color: white; border: none; border-radius: 4px; cursor: pointer;">Batal</button>
                <button id="confirmDeleteBtn" style="padding: 8px 16px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;">Hapus</button>
            </div>
        </div>
    </div>

    <!-- Modal Asisten Detail -->
    <div id="modalAsisteDetail" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modalAsisteDetail')">&times;</span>
            <h2>Detail Asisten</h2>
            <div style="padding: 20px;">
                <p><strong>Nama:</strong> <span id="asistenNamaDetail"></span></p>
                <p><strong>Email:</strong> <span id="asistenEmailDetail"></span></p>
                <p><strong>No HP:</strong> <span id="asistenNohpDetail"></span></p>
                <p><strong>Jumlah Kelas:</strong> <span id="asistenKelasDetail"></span></p>
                <p><strong>Status:</strong> <span id="asistenStatusDetail"></span></p>
            </div>
        </div>
    </div>

    <!-- Modal Asisten Jadwal -->
    <div id="modalAsisteJadwal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modalAsisteJadwal')">&times;</span>
            <h2>Jadwal Mengajar - <span id="asistenNamaJadwal"></span></h2>
            <div id="asistenJadwalContent" style="padding: 20px;">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>

    <!-- Modal Jadwal Detail -->
    <div id="modalJadwalDetail" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modalJadwalDetail')">&times;</span>
            <h2>Detail Jadwal</h2>
            <div style="padding: 20px;">
                <p><strong>Praktikum:</strong> <span id="jadwalPraktikum"></span></p>
                <p><strong>Hari:</strong> <span id="jadwalHari"></span></p>
                <p><strong>Jam:</strong> <span id="jadwalJam"></span></p>
                <p><strong>Laboratorium:</strong> <span id="jadwalLab"></span></p>
                <p><strong>Dosen:</strong> <span id="jadwalDosen"></span></p>
                <p><strong>Max Peserta:</strong> <span id="jadwalMaxPeserta"></span></p>
                <p><strong>Status:</strong> <span id="jadwalStatus"></span></p>
            </div>
        </div>
    </div>

    <!-- Modal Laporan PDF/Excel -->
    <div id="modalLaporanExport" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('modalLaporanExport')">&times;</span>
            <h2>Export Laporan</h2>
            <div style="padding: 20px;">
                <p>Tipe: <strong id="laporanType"></strong></p>
                <p>Format ekspor:</p>
                <div style="display: flex; gap: 10px; margin-top: 15px;">
                    <button id="exportPdfBtn" style="padding: 10px 20px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;">📄 PDF</button>
                    <button id="exportExcelBtn" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">📊 Excel</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            animation: fadeIn 0.3s ease;
            backdrop-filter: blur(4px);
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            padding: 0;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            max-width: 550px;
            width: 90%;
            max-height: 85vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease;
            position: relative;
        }

        .modal-content h2 {
            background: linear-gradient(135deg, #4a6cf7, #34d399);
            color: white;
            padding: 24px;
            margin: 0;
            border-radius: 16px 16px 0 0;
            font-size: 22px;
            font-weight: 600;
        }

        .modal-content > div:not(h2) {
            padding: 24px;
        }

        .modal-content form > div {
            margin-bottom: 16px;
        }

        .modal-content label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #1f2937;
            font-size: 14px;
        }

        .modal-content input[type="text"],
        .modal-content input[type="email"],
        .modal-content input[type="number"],
        .modal-content select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .modal-content input[type="text"]:focus,
        .modal-content input[type="email"]:focus,
        .modal-content input[type="number"]:focus,
        .modal-content select:focus {
            outline: none;
            border-color: #4a6cf7;
            box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.1);
            background-color: #f8faff;
        }

        .modal-content p {
            margin: 12px 0;
            line-height: 1.6;
            color: #374151;
            font-size: 14px;
        }

        .modal-content p strong {
            color: #1f2937;
            font-weight: 600;
        }

        .close {
            position: absolute;
            top: 16px;
            right: 20px;
            color: white;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            z-index: 10;
        }

        .close:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .modal-content button {
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .modal-content button[type="submit"] {
            background: linear-gradient(135deg, #4a6cf7, #34d399);
            color: white;
        }

        .modal-content button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(74, 108, 247, 0.3);
        }

        .modal-content button[type="button"] {
            background: #e5e7eb;
            color: #374151;
        }

        .modal-content button[type="button"]:hover {
            background: #d1d5db;
        }

        .modal-content #confirmDeleteBtn {
            background: linear-gradient(135deg, #f43f5e, #e11d48);
            color: white;
        }

        .modal-content #confirmDeleteBtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(244, 63, 94, 0.3);
        }

        #exportPdfBtn {
            background: linear-gradient(135deg, #f43f5e, #e11d48) !important;
            color: white !important;
        }

        #exportPdfBtn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 20px rgba(244, 63, 94, 0.3) !important;
        }

        #exportExcelBtn {
            background: linear-gradient(135deg, #34d399, #10b981) !important;
            color: white !important;
        }

        #exportExcelBtn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 20px rgba(52, 211, 153, 0.3) !important;
        }

        .modal-content > div > div {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid #e5e7eb;
        }

        @keyframes fadeIn {
            from { 
                opacity: 0;
            }
            to { 
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Modal */
        @media (max-width: 600px) {
            .modal-content {
                width: 95%;
                max-height: 90vh;
            }

            .modal-content h2 {
                font-size: 18px;
                padding: 16px;
            }

            .modal-content > div:not(h2) {
                padding: 16px;
            }

            .close {
                top: 12px;
                right: 12px;
            }
        }
    </style>

    <script src="{{asset('lab_js/dashboard_lab.js')}}"></script>
</body>

</html>
