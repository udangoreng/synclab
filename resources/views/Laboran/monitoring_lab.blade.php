<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Praktikum</title>
  <link rel="stylesheet" href="kelolaPraktikum_lab.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="menu-toggle" onclick="toggleSidebar()">☰</div>

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
      <div class="dropdown-btn" onclick="toggleDropdown('dropdown')">
        <span><i class="fas fa-folder"></i>Management</span>
        <span><i class="fas fa-chevron-down"></i></span>
      </div>

      <ul class="dropdown-menu" id="dropdown">
        <li><i class="fas fa-flask"></i> Practicum Management</li>
        <li><i class="fas fa-calendar"></i>Schedule Management</li>
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

<main class="main-content">
  <div class="header">
    <h2> System Monitoring </h2>

    <div class="actions">
      <select>
        <option>Semua Praktikum</option>
      </select>

      <select>
        <option>Semua Pertemuan</option>
      </select>

      <button class="btn-refresh">Refresh</button>
    </div>
  </div>

  <div class="monitor-summary">
    <div class="monitor-card c1">
      <p>Pendaftaran</p>
      <h3>120 / 150</h3>
    </div>

    <div class="monitor-card c2">
      <p>Presensi</p>
      <h3>80%</h3>
    </div>

    <div class="monitor-card c3">
      <p>Nilai</p>
      <h3>70%</h3>
    </div>

    <div class="monitor-card c4">
      <p>Jadwal</p>
      <h3>1 Bentrok</h3>
    </div>

    <div class="monitor-card c5">
      <p>Asisten</p>
      <h3>1 Overload</h3>
    </div>
  </div>

  <div class="monitor-grid">
    <div class="monitor-left">
      <div class="notif-box">
        <h3>Selamat siang, Caca 👋</h3>

        <div class="notif-item info">
          📅 Sesi praktikum berikutnya akan dimulai sebentar lagi.
        </div>

        <div class="notif-item warning">
          ⚠ Silakan upload materi untuk pertemuan berikutnya.
        </div>

        <div class="notif-item success">
          ✅ Input nilai praktikum Pemrograman Dasar belum selesai.
        </div>
      </div>

      <div class="monitor-bottom">
        <div class="monitor-card-box">
          <h3>⚡ Detail Cepat</h3>

          <div class="quick-item">
            <span>Pendaftaran</span>
            <small>🟢 Aktif</small>
          </div>

          <div class="quick-item">
            <span>Presensi</span>
            <div class="progress yellow">
              <div class="bar" style="width:80%"></div>
            </div>
            <small>2/10 kelas belum</small>
          </div>

          <div class="quick-item">
            <span>Nilai</span>
            <div class="progress blue">
              <div class="bar" style="width:70%"></div>
            </div>
            <small>30% belum</small>
          </div>
        </div>

        <div class="monitor-card-box">
          <h3>📊 Progress Praktikum</h3>

          <div class="praktikum-item">
            <div class="praktikum-header">
              <span>📘 Pemrograman Dasar</span>
              <b>85%</b>
            </div>
            <div class="progress blue">
              <div class="bar" style="width:85%"></div>
            </div>
          </div>

          <div class="praktikum-item">
            <div class="praktikum-header">
              <span>📗 Jaringan Komputer</span>
              <b>90%</b>
            </div>
            <div class="progress green">
              <div class="bar" style="width:90%"></div>
            </div>
          </div>

        </div>

      </div>
    </div>

    <div class="monitor-right">
      <div class="monitor-card-box">

        <h3>📅 Jadwal & Status</h3>

        <div class="summary">
          <p><strong>Hari Ini:</strong> 3 kelas | 2 asisten | ⚠ 1 bentrok</p>

          <div class="filter-jadwal">
            <button>Hari Ini</button>
            <button>Semua Jadwal</button>
          </div>
        </div>

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

        </div>

        <div class="warning">
          ⚠ Lab 1 digunakan 2 kelas di jam yang sama
        </div>

      </div>
    </div>

  </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="laporan_lab.js"></script>
<script src="monitoring_lab.js"></script>
</body>
</html>