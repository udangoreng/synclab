<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Praktikum</title>
  <link rel="stylesheet" href="dashboard_lab.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="toggle" onclick="toggleSidebar()">☰</div>

<aside class="sidebar" id="sidebar">
  <div class="profile">
    <div class="avatar">
        <i class="fas fa-user-graduate"></i>
    </div>

    <h4>Caca</h4>
    <span>Koordinator</span>
    <small>NIP 24051204204</small>
  </div>

  <ul class="menu">
    <li class="menu-item active">
      <i class="fas fa-home"></i> Dashboard
    </li>

    <li class="menu-item dropdown">
      <div class="dropdown-btn" onclick="toggleDropdown()">
        <span><i class="fas fa-folder"></i>  Management</span>
        <span><i class="fas fa-chevron-down"></i></span>
      </div>

      <ul class="dropdown-menu" id="dropdown">
        <li><i class="fas fa-flask"></i>  Practicum Management </li>
        <li><i class="fas fa-calendar"></i> Schedule Management</li>
        <li><i class="fas fa-users"></i> Assistant Management</li>
      </ul>
    </li>

    <li class="menu-item">
      <i class="fas fa-chart-line"></i> System Monitoring
    </li>

    <li class="menu-item">
      <i class="fas fa-file-alt"></i> Reports
    </li>
  </ul>

  <button class="logout">
    <i class="fas fa-sign-out-alt"></i> Logout
  </button>
</aside>

<main class="main">
  <section class="card">
    <h2>Dashboard</h2>
    <div class="feature-box"></div>
  </section>

  <div class="grid">
    <div>

      <section class="card">
        <h3>Kelola Praktikum</h3>
        <input type="text" class="search" placeholder="🔍 Cari praktikum...">
        <div class="praktikum-grid">
            <div class="praktikum-card">
            <h4>📘 Basis Data</h4>
            <p>120 mhs • 3 asisten • 6 pertemuan</p>
            <span class="status praktikum aktif">🟢 Aktif</span>

            <div class="actions">
                <button class="btn-edit">Edit</button>
                <button class="btn-delete">Hapus</button>
                <button class="btn-detail">Detail</button>
            </div>
            </div>

            <div class="praktikum-card">
            <h4>📗 Jaringan</h4>
            <p>80 mhs • 2 asisten</p>
            <span class="status praktikum belum">🟡 Belum aktif</span>

            <div class="actions">
                <button class="btn-edit">Edit</button>
                <button class="btn-delete">Hapus</button>
                <button class="btn-detail">Detail</button>
            </div>
            </div>
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
            <h4>80%</h4>
            </div>

            <div class="monitor-item nilai">
            <p>Nilai</p>
            <h4>70%</h4>
            </div>
        </div>

        <div class="monitor-box">
            <h4>Presensi</h4>
            <div class="progress-bar">
            <div class="fill" style="width: 80%"></div>
            </div>
            <p>120/150 mahasiswa sudah absen</p>
            <span class="status monitor warning-text">🟡 Belum lengkap</span>
        </div>

        <div class="monitor-box">
            <h4>Nilai</h4>
            <div class="progress-bar">
            <div class="fill yellow" style="width: 70%"></div>
            </div>
            <p>10/14 kelas selesai</p>
            <span class="status monitor warning-text">🟡 Masih proses</span>
        </div>

        <div class="monitor-warning">
            <p>⚠ 2 kelas belum input nilai</p>
            <p>⚠ 1 praktikum belum presensi</p>
        </div>

        <div class="monitor-footer">
            <span>Last update: 10:32 WIB</span>
            <button class="btn-detail">Detail</button>
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
                <div><strong>82</strong><span>Rata-rata</span></div>
                <div><strong>95</strong><span>Tertinggi</span></div>
                <div><strong>60</strong><span>Terendah</span></div>
            </div>

            <div class="actions">
                <button class="btn-detail">Detail</button>
                <button class="btn-pdf">PDF</button>
                <button class="btn-excel">Excel</button>
            </div>
            </div>

            <div class="laporan-card">
            <h4>📊 Rekap Presensi</h4>

            <div class="stats">
                <div><strong>85%</strong><span>Hadir</span></div>
                <div><strong>15%</strong><span>Tidak Hadir</span></div>
                <div><strong></strong><span></span></div>
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
            <p><strong>Hari Ini:</strong> 3 kelas | 2 asisten | ⚠ 1 bentrok</p>

            <div class="filter-jadwal">
            <button>Hari Ini</button>
            <button>Semua Jadwal</button>
            </div>
        </div>

        <div class="jadwal-hari">
            <h4>Senin</h4>

            <div class="timeline">

            <div class="timeline-item">
                <div class="time">08:00</div>

                <div class="line"></div>

                <div class="content">
                <h5>📘 Basis Data</h5>
                <p>Lab 1</p>
                <span class="status jadwal berjalan">🟢 Berjalan</span>
                </div>
            </div>

            <div class="timeline-item">
                <div class="time">10:00</div>

                <div class="line"></div>

                <div class="content">
                <h5>📗 Jaringan</h5>
                <p>Lab 2</p>
                <span class="status jadwal upcoming">⏳ Akan datang</span>
                </div>
            </div>

            <div class="timeline-item bentrok">
                <div class="time">13:00</div>

                <div class="line"></div>

                <div class="content">
                <h5>📕 Web</h5>
                <p>Lab 1</p>
                <span class="status jadwal bentrok">❌ Bentrok</span>
                </div>
            </div>

            <div class="timeline-item last">
                <div class="time">15:00</div>
            </div>

            </div>
        </div>

        <div class="warning">
            ⚠ Lab 1 digunakan 2 kelas di jam yang sama
        </div>
      </section>

      <section class="card">
        <h3>Asisten Aktif</h3>
        <p class="asisten-summary">
            3 asisten | 1 mengajar | 1 overload
        </p>

        <div class="asisten">
            <div class="left">
            <img src="https://i.pravatar.cc/100?img=12" class="avatar small">

            <div>
                <strong>Andi</strong>
                <p>2 kelas • 80% presensi • 90% nilai</p>
                <span class="status asisten aktif">🟢 Sedang mengajar</span>
            </div>
            </div>

            <span class="badge">active</span>

            <div class="actions bawah">
            <button class="btn-detail">Detail</button>
            <button class="btn-jadwal">Jadwal</button>
            </div>
        </div>

        <div class="asisten">
            <div class="left">
            <img src="https://i.pravatar.cc/100?img=5" class="avatar small">

            <div>
                <strong>Citra</strong>
                <p>1 kelas • 70% presensi • 60% nilai</p>
                <span class="status asisten upcoming">⏳ Mengajar pukul 13:00</span>
            </div>
            </div>

            <span class="badge">active</span>

            <div class="actions bawah">
            <button class="btn-detail">Detail</button>
            <button class="btn-jadwal">Jadwal</button>
            </div>
        </div>
      </section>
    </div>
  </div>
</main>

<script src="dashboard_lab.js"></script>
</body>
</html>