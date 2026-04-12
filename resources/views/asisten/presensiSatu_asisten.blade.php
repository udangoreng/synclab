<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Praktikum Asisten</title>
  <link rel="stylesheet" href="presensi_asisten.css">
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
    <h2>Record Attendance</h2>
    <div class="actions">
      <button class="btn history" onclick="goPage('presensiDua_asisten.html')">
        <i class="fas fa-clock"></i> History
      </button>
    </div>
  </div>

  <div class="info-box"></div>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Pertemuan</th>
          <th>Pemrograman Dasar</th>
          <th>Jaringan Komputer</th>
          <th>Rekayasa Perangkat Lunak</th>
          <th>Pengolahan Citra Digital</th>
        </tr>
      </thead>

      <tbody>

      <tr>
        <td>1</td>
        <td><button class="detail-btn pink" onclick="record('Pemrograman Dasar',1)">Record</button></td>
        <td><button class="detail-btn green" onclick="record('Jaringan Komputer',1)">Record</button></td>
        <td><button class="detail-btn orange" onclick="record('Rekayasa Perangkat Lunak',1)">Record</button></td>
        <td><button class="detail-btn purple" onclick="record('Pengolahan Citra Digital',1)">Record</button></td>
      </tr>

      <tr>
        <td>2</td>
        <td><button class="detail-btn pink" onclick="record('Pemrograman Dasar',2)">Record</button></td>
        <td><button class="detail-btn green" onclick="record('Jaringan Komputer',2)">Record</button></td>
        <td><button class="detail-btn orange" onclick="record('Rekayasa Perangkat Lunak',2)">Record</button></td>
        <td><button class="detail-btn purple" onclick="record('Pengolahan Citra Digital',2)">Record</button></td>
      </tr>

      <tr>
        <td>3</td>
        <td><button class="detail-btn pink" onclick="record('Pemrograman Dasar',3)">Record</button></td>
        <td><button class="detail-btn green" onclick="record('Jaringan Komputer',3)">Record</button></td>
        <td><button class="detail-btn orange" onclick="record('Rekayasa Perangkat Lunak',3)">Record</button></td>
        <td><button class="detail-btn purple" onclick="record('Pengolahan Citra Digital',3)">Record</button></td>
      </tr>

      <tr>
        <td>4</td>
        <td><button class="detail-btn pink" onclick="record('Pemrograman Dasar',4)">Record</button></td>
        <td><button class="detail-btn green" onclick="record('Jaringan Komputer',4)">Record</button></td>
        <td><button class="detail-btn orange" onclick="record('Rekayasa Perangkat Lunak',4)">Record</button></td>
        <td><button class="detail-btn purple" onclick="record('Pengolahan Citra Digital',4)">Record</button></td>
      </tr>

      <tr>
        <td>5</td>
        <td><button class="detail-btn pink" onclick="record('Pemrograman Dasar',5)">Record</button></td>
        <td><button class="detail-btn green" onclick="record('Jaringan Komputer',5)">Record</button></td>
        <td><button class="detail-btn orange" onclick="record('Rekayasa Perangkat Lunak',5)">Record</button></td>
        <td><button class="detail-btn purple" onclick="record('Pengolahan Citra Digital',5)">Record</button></td>
      </tr>

      <tr>
        <td>6</td>
        <td><button class="detail-btn pink" onclick="record('Pemrograman Dasar',6)">Record</button></td>
        <td><button class="detail-btn green" onclick="record('Jaringan Komputer',6)">Record</button></td>
        <td><button class="detail-btn orange" onclick="record('Rekayasa Perangkat Lunak',6)">Record</button></td>
        <td><button class="detail-btn purple" onclick="record('Pengolahan Citra Digital',6)">Record</button></td>
      </tr>

      </tbody>
    </table>
  </div>

</main>

<script src="record_asisten.js"></script>
</body>
</html>