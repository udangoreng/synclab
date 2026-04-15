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
        <span><i class="fas fa-folder"></i> Management </span>
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
    <h2> Reports </h2>

    <div class="actions">
      <select id="filterPertemuan">
        <option>Semua Pertemuan</option>
      </select>

      <select id="filterKelas">
        <option>Semua Kelas</option>
      </select>

      <select id="filterPraktikum">
        <option>Semua Praktikum</option>
      </select>

      <select id="export">
        <option value="">Export</option>
        <option value="pdf">PDF</option>
        <option value="excel">Excel</option>
      </select>

      <input type="text" placeholder="Cari..." id="search">
    </div>
  </div>

  <div class="top-section">
    
    <div class="summary-box">
        <div class="card summary-1">
            <p>Pendaftaran</p>
            <h3>120 / 150</h3>
        </div>

        <div class="card summary-2">
            <p>Presensi</p>
            <h3>80%</h3>
        </div>

        <div class="card summary-3">
            <p>Nilai</p>
            <h3>70%</h3>
        </div>

        <div class="card summary-4">
            <p>Jadwal</p>
            <h3>1 Bentrok</h3>
        </div>
    </div>

    <div class="chart-box">
        <h3 class="chart-title">Statistik</h3>

        <div class="chart-content">
            <canvas id="chart"></canvas>

            <div class="chart-legend">
            <div><span class="dot tinggi"></span> Nilai Tinggi</div>
            <div><span class="dot rendah"></span> Nilai Rendah</div>
            <div><span class="dot rata"></span> Rata-rata</div>

            <div class="legend-value">
                <p>Tinggi: <b id="valTinggi">0</b></p>
                <p>Rendah: <b id="valRendah">0</b></p>
                <p>Rata-rata: <b id="valRata">0</b></p>
            </div>
            </div>
        </div>
    </div>
  </div>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>NIM</th>
          <th>Pretest</th>
          <th>Laporan</th>
          <th>Nilai Akhir</th>
          <th>Grade</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody id="tableBody"></tbody>
    </table>
  </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="laporan_lab.js"></script>
</body>
</html>