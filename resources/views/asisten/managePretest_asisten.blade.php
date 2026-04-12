<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Praktikum Asisten</title>
  <link rel="stylesheet" href="managePretest_asisten.css">
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
    <h2>Create Test</h2>
    <button class="btn add" onclick="openPopup('add')">
      <i class="fas fa-plus"></i> Add
    </button>
  </div>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Nama Pretest</th>
          <th>Praktikum</th>
          <th>Pertemuan</th>
          <th>Durasi</th>
          <th>Deskripsi</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>Pretest Struktur Kontrol</td>
          <td>Pemrograman Dasar</td>
          <td>1</td>
          <td>30 menit</td>
          <td>Soal dasar percabangan if dan switch</td>
          <td class="actions-btn">
            <button class="edit">✏️</button>
            <button class="delete">🗑️</button>
            <button class="detail">🔍</button>
          </td>
        </tr>

        <tr>
          <td>Pretest Topologi Jaringan</td>
          <td>Jaringan Komputer</td>
          <td>2</td>
          <td>30 menit</td>
          <td>Pemahaman dasar jenis-jenis topologi jaringan</td>
          <td class="actions-btn">
            <button class="edit">✏️</button>
            <button class="delete">🗑️</button>
            <button class="detail">🔍</button>
          </td>
        </tr>

        <tr>
          <td>Pretest UI/UX</td>
          <td>Rekayasa Perangkat Lunak</td>
          <td>3</td>
          <td>45 menit</td>
          <td>Dasar konsep desain antarmuka pengguna</td>
          <td class="actions-btn">
            <button class="edit">✏️</button>
            <button class="delete">🗑️</button>
            <button class="detail">🔍</button>
          </td>
        </tr>

        <tr>
          <td>Pretest Transformasi Citra</td>
          <td>Pengolahan Citra Digital</td>
          <td>4</td>
          <td>45 menit</td>
          <td>Operasi dasar pengolahan citra digital</td>
          <td class="actions-btn">
            <button class="edit">✏️</button>
            <button class="delete">🗑️</button>
            <button class="detail">🔍</button>
          </td>
        </tr>

        <tr>
          <td>Pretest Packet Tracer</td>
          <td>Jaringan Komputer</td>
          <td>5</td>
          <td>40 menit</td>
          <td>Simulasi konfigurasi jaringan dasar</td>
          <td class="actions-btn">
            <button class="edit">✏️</button>
            <button class="delete">🗑️</button>
            <button class="detail">🔍</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

</main>

<div class="popup" id="pretestPopup">
  <div class="popup-content">

    <span class="close-btn" onclick="closePopup()">✖</span>

    <h3 id="popupTitle">Tambah Pretest</h3>

    <div class="form-group">
      <label>Nama Pretest</label>
      <input type="text" id="p_nama" placeholder="Contoh: Pretest HTML">
    </div>

    <div class="form-group">
      <label>Praktikum</label>
      <input type="text" id="p_praktikum" placeholder="Contoh: RPL">
    </div>

    <div class="form-group">
      <label>Pertemuan</label>
      <input type="number" id="p_pertemuan" placeholder="Contoh: 1">
    </div>

    <div class="form-group">
      <label>Jam Mulai</label>
      <input type="time" id="p_mulai">
    </div>

    <div class="form-group">
      <label>Jam Akhir</label>
      <input type="time" id="p_akhir">
    </div>

    <div class="form-group">
      <label>Deskripsi</label>
      <input type="text" id="p_deskripsi" placeholder="Deskripsi pretest">
    </div>

    <div class="popup-actions">
      <button onclick="closePopup()">Cancel</button>
      <button id="btnSave">Simpan</button>
    </div>

  </div>
</div>

<script src="managePretest_asisten.js"></script>
</body>
</html>