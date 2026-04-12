<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Praktikum Asisten</title>
  <link rel="stylesheet" href="manageModules.css">
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
    <h2>Add Resources</h2>
    <div class="actions">
      <button class="btn add" onclick="openPopup('add')">
        <i class="fas fa-plus"></i> Add
      </button>
    </div>
  </div>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Pertemuan</th>
          <th>Praktikum</th>
          <th>Deskripsi</th>
          <th>Modul</th>
          <th>Deskripsi Modul</th>
          <th>File</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>1</td>
          <td>Pemrograman Dasar</td>
          <td>Percabangan dalam Pemrograman Dasar</td>
          <td>Struktur Kontrol (If, Switch)</td>
          <td>Mempelajari penggunaan if dan switch untuk pengambilan keputusan dalam program</td>
          <td>
            <a href="file/modul1.pdf" target="_blank" class="view">Lihat</a>
            <a href="file/modul1.pdf" download class="download">Download</a>
          </td>
          <td class="actions-btn">
            <button class="edit">✏️</button>
            <button class="delete">🗑️</button>
            <button class="detail">🔍</button>
          </td>
        </tr>

        <tr>
          <td>2</td>
          <td>Jaringan Komputer</td>
          <td>Dasar Topologi Jaringan</td>
          <td>Pengenalan Topologi Jaringan</td>
          <td>Mengenal jenis topologi seperti star, bus, dan ring</td>
          <td>
            <a href="file/modul1.pdf" target="_blank" class="view">Lihat</a>
            <a href="file/modul1.pdf" download class="download">Download</a>
          </td>
          <td class="actions-btn">
            <button class="edit">✏️</button>
            <button class="delete">🗑️</button>
            <button class="detail">🔍</button>
          </td>
        </tr>

        <tr>
          <td>3</td>
          <td>Rekayasa Perangkat Lunak</td>
          <td>Perancangan UI/UX</td>
          <td>Desain Antarmuka (UI/UX)</td>
          <td>Mempelajari prinsip desain tampilan aplikasi yang user-friendly</td>
          <td>
            <a href="file/modul1.pdf" target="_blank" class="view">Lihat</a>
            <a href="file/modul1.pdf" download class="download">Download</a>
          </td>
          <td class="actions-btn">
            <button class="edit">✏️</button>
            <button class="delete">🗑️</button>
            <button class="detail">🔍</button>
          </td>
        </tr>

        <tr>
          <td>4</td>
          <td>Pengolahan Citra Digital</td>
          <td>Transformasi Citra Digital</td>
          <td>Transformasi Citra</td>
          <td>Mempelajari operasi seperti rotasi, scaling, dan translasi pada gambar</td>
          <td>
            <a href="file/modul1.pdf" target="_blank" class="view">Lihat</a>
            <a href="file/modul1.pdf" download class="download">Download</a>
          </td>
          <td class="actions-btn">
            <button class="edit">✏️</button>
            <button class="delete">🗑️</button>
            <button class="detail">🔍</button>
          </td>
        </tr>

        <tr>
          <td>5</td>
          <td>Jaringan Komputer</td>
          <td>Simulasi Packet Tracer</td>
          <td>Packet Tracer</td>
          <td>Mempelajari simulasi konfigurasi dan topologi jaringan</td>
          <td>
            <a href="file/modul1.pdf" target="_blank" class="view">Lihat</a>
            <a href="file/modul1.pdf" download class="download">Download</a>
          </td>
          <td class="actions-btn">
            <button class="edit">✏️</button>
            <button class="delete">🗑️</button>
            <button class="detail">🔍</button>
          </td>
        </tr>

        <tr>
          <td>6</td>
          <td>Pemrograman Dasar</td>
          <td>Pengolahan Data Array & String</td>
          <td>Array dan String</td>
          <td>Mempelajari manipulasi data menggunakan array dan string dalam pemrograman</td>
          <td>
            <a href="file/modul1.pdf" target="_blank" class="view">Lihat</a>
            <a href="file/modul1.pdf" download class="download">Download</a>
          </td>
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

<div class="popup" id="modulePopup">
  <div class="popup-content">

    <span class="close-btn" onclick="closePopup()">✖</span>

    <h3 id="popupTitle">Tambah Modul</h3>

    <div class="form-group">
      <label>Pertemuan</label>
      <input type="text" id="p_pertemuan" placeholder="Contoh: 1">
    </div>

    <div class="form-group">
      <label>Praktikum</label>
      <input type="text" id="p_praktikum" placeholder="Contoh: RPL">
    </div>

    <div class="form-group">
      <label>Deskripsi</label>
      <input type="text" id="p_deskripsi" placeholder="Contoh: Pengenalan Web">
    </div>

    <div class="form-group">
      <label>Modul</label>
      <input type="text" id="p_modul" placeholder="Contoh: HTML Dasar">
    </div>

    <div class="form-group">
      <label>Deskripsi Modul</label>
      <input type="text" id="p_descModul" placeholder="Contoh: Belajar struktur HTML">
    </div>

    <div class="form-group">
      <label>Upload File</label>
      <input type="file" id="p_file">
    </div>

    <div class="popup-actions">
        <button class="btn-cancel" onclick="closePopup()">Cancel</button>
        <button id="btnEdit">Edit</button>
        <button id="btnSave">Simpan</button>
    </div>

  </div>
</div>

<script src="manageModules.js"></script>
</body>
</html>