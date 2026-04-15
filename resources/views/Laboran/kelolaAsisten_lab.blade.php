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
    <h2>Assistant Management</h2>
    <div class="actions">
      <button class="btn add" onclick="openAdd()">+ Add Asisten</button>
      <input type="text" placeholder="Cari..." id="search">
    </div>
  </div>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>NIP</th>
          <th>Email</th>
          <th>No HP</th>
          <th>Jumlah Kelas</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody id="tableBody"></tbody>
    </table>
  </div>

</main>

<div class="modal" id="formModal">
  <div class="modal-content">
    <h3 id="modalTitle">Add Asisten</h3>

    <div class="form-box">
      <input id="nama" placeholder="Nama">
      <input id="nip" placeholder="NIP">
      <input id="email" placeholder="Email">
      <input id="hp" placeholder="No HP">
      <input id="kelas" placeholder="Kelas (pisah koma)">
      <select id="status">
        <option>Active</option>
        <option>Non Active</option>
      </select>
    </div>

    <div class="modal-actions">
      <button onclick="closeModal()">Batal</button>
      <button onclick="saveData()">Simpan</button>
    </div>
  </div>
</div>

<div class="modal" id="detailModal">
  <div class="modal-content">
    <span class="close" onclick="closeDetail()">×</span>
    <h3>Detail Asisten</h3>

    <div class="detail-box">
      <p id="d_nama"></p>
      <p id="d_nip"></p>
      <p id="d_email"></p>
      <p id="d_hp"></p>
      <p id="d_kelas"></p>
      <p id="d_status"></p>
    </div>
  </div>
</div>

<script src="kelolaAsisten_lab.js"></script>
</body>
</html>