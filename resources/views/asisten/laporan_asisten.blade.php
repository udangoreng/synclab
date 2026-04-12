<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Mahasiswa</title>
  <link rel="stylesheet" href="laporan_asisten.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<button onclick="toggleSidebar()" class="menu-toggle">☰</button>

<aside class="sidebar" id="sidebar">
  <div class="profile">
    <div class="avatar">
      <i class="fas fa-user-graduate"></i>
    </div>
    <h4>Caca</h4>
    <span>Asisten</span>
    <small>NIP 24051204204</small>
  </div>

  <ul class="menu">
    <li class="active" onclick="goPage('dashboard_asistent.html')">
      <i class="fas fa-home"></i> Dashboard
    </li>

    <li onclick="goPage('praktikum_asisten.html')">
      <i class="fas fa-laptop-code"></i> Practicum
    </li>

    <li class="dropdown">
      <div onclick="toggleDropdown('presensi')">
        <i class="fas fa-calendar-check"></i> Attendance
        <i class="fas fa-chevron-down right"></i>
      </div>

      <ul id="presensi">
        <li onclick="goPage('presensiSatu_asisten.html')">Record Attendance</li>
        <li onclick="goPage('presensiDua_asisten.html')">Attendance History</li>
      </ul>
    </li>

    <li class="dropdown">
      <div onclick="toggleDropdown('modul')">
        <i class="fas fa-book"></i> Resource & Test
        <i class="fas fa-chevron-down right"></i>
      </div>

      <ul id="modul">
        <li onclick="goPage('manageModules_asisten.html')">Add Resource</li>
        <li onclick="goPage('managePretest_asisten.html')">Create Test</li>
      </ul>
    </li>

    <li onclick="goPage('laporan_asisten.html')">
      <i class="fas fa-file"></i> Reports
    </li>

    <li class="dropdown">
      <div onclick="toggleDropdown('nilai')">
        <i class="fas fa-chart-line"></i> Grades
        <i class="fas fa-chevron-down right"></i>
      </div>

      <ul id="nilai">
        <li onclick="goPage('nilai_asisten.html')">Record Grades</li>
        <li onclick="goPage('rekapNilai_asisten.html')">Grade Summary</li>
      </ul>
    </li>

    <li onclick="goPage('mahasiswa_asisten.html')">
      <i class="fas fa-users"></i> Students</li>
  </ul>
  
  <button class="logout" onclick="logout()">
    <i class="fas fa-sign-out-alt"></i> Logout
  </button>
</aside>

<main class="main-content">
  <div class="header">
    <h2>Reports</h2>
  </div>

  <div class="filter-box">

    <select id="filterMatkul">
      <option value="">Mata Kuliah</option>
      <option>Pemrograman Dasar</option>
      <option>Jaringan Komputer</option>
      <option>Rekayasa Perangkat Lunak</option>
      <option>Pengolahan Citra Digital</option>
    </select>

    <select id="filterPraktikum">
      <option value="">Semua Praktikum</option>
      <option>Pemrograman Dasar</option>
      <option>Jaringan Komputer</option>
      <option>Rekayasa Perangkat Lunak</option>
      <option>Pengolahan Citra Digital</option>
    </select>

    <select id="filterPertemuan">
      <option value="">Semua Pertemuan</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
    </select>

    <select id="filterStatus">
      <option value="">Semua Status</option>
      <option value="diterima">Diterima</option>
      <option value="revisi">Revisi</option>
    </select>

    <input type="text" id="searchInput" placeholder="Cari nama / NIM...">

  </div>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>NIM</th>
          <th>Praktikum</th>
          <th>Pertemuan</th>
          <th>Tanggal</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody id="tableBody">

        <tr>
          <td>Andi Saputra</td>
          <td>22001</td>
          <td>RPL</td>
          <td>1</td>
          <td>10-03-2026</td>
          <td>
            <button class="status diterima" disabled>Diterima</button>
          </td>
          <td class="actions-btn">
            <button class="detail">Detail</button>
          </td>
        </tr>

        <tr>
          <td>Siti Rahma</td>
          <td>22002</td>
          <td>AI</td>
          <td>2</td>
          <td>11-03-2026</td>
          <td>
            <button class="status revisi" disabled>Revisi</button>
          </td>
          <td class="actions-btn">
            <button class="detail">Detail</button>
          </td>
        </tr>

      </tbody>
    </table>
  </div>

</main>

<div class="modal" id="reviewModal">
  <div class="modal-content">

    <h2>Review Laporan</h2>
    <div class="info-box">
      <p><b>Nama:</b> <span id="mNama">-</span></p>
      <p><b>NIM:</b> <span id="mNim">-</span></p>
      <p><b>Praktikum:</b> <span id="mPraktikum">-</span></p>
      <p><b>Pertemuan:</b> <span id="mPertemuan">-</span></p>
      <p><b>Tanggal:</b> <span id="mTanggal">-</span></p>

      <p><b>File Laporan:</b> 
        <a href="#" id="mFile" download>Download / Preview</a>
      </p>
    </div>

    <div class="form-group">
      <label>Komentar</label>
      <textarea id="komentar" rows="3"></textarea>
    </div>

    <div class="form-group">
      <label>Input Nilai</label>
      <input type="number" id="nilai" min="0" max="100">
    </div>

    <div class="form-group">
      <label>Status</label>
      <select id="status">
        <option value="diterima">Diterima</option>
        <option value="revisi">Revisi</option>
      </select>
    </div>

    <div class="modal-actions">
      <button class="btn-cancel" onclick="closeModal()">Batal</button>
      <button class="btn-save">Simpan</button>
    </div>

  </div>
</div>

<script src="laporan_asisten.js"></script>
</body>
</html>