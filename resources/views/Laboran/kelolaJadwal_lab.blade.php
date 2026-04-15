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

<main class="main-content">

  <div class="header">
    <h2>Schedule Management</h2>
    <div class="actions">
      <button class="btn add" onclick="openAdd()">+ Add Jadwal</button>

      <select id="filterPraktikum">
        <option value="">Semua Praktikum</option>
      </select>

      <select id="filterHari">
        <option value="">Semua Hari</option>
        <option>Senin</option>
        <option>Selasa</option>
        <option>Rabu</option>
        <option>Kamis</option>
        <option>Jumat</option>
      </select>

      <input type="text" placeholder="Cari..." id="search">
    </div>
  </div>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Mata Kuliah</th>
          <th>Pertemuan</th>
          <th>Praktikum</th>
          <th>Kelas</th>
          <th>Hari</th>
          <th>Jam</th>
          <th>Ruangan</th>
          <th>Asisten</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody id="tableBody"></tbody>
    </table>
  </div>

</main>

<div class="modal" id="formModal">
  <div class="modal-content">
    <h3 id="modalTitle">Add Jadwal</h3>

    <div class="form-box">
      <input id="mk" placeholder="Mata Kuliah">
      <input id="pertemuan" placeholder="Pertemuan">
      <input id="praktikum" placeholder="Praktikum">
      <input id="kelas" placeholder="Kelas">
      <input id="hari" placeholder="Hari">
      <input id="jam" placeholder="Jam (contoh 10.00-12.00)">
      <input id="ruangan" placeholder="Ruangan">
      <input id="asisten" placeholder="Asisten">
    </div>

    <div class="modal-actions">
      <button onclick="closeModal()">Batal</button>
      <button onclick="saveData()">Simpan</button>
    </div>
  </div>
</div>

<script src="kelolaJadwal_lab.js"></script>
</body>
</html>