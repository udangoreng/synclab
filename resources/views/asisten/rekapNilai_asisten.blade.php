<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Mahasiswa</title>
  <link rel="stylesheet" href="nilai_asisten.css">
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
    <h2>Grade Summary</h2>
  </div>

  <div class="filter-box">

    <select id="filterMatkul">
      <option value="">Mata Kuliah</option>
      <option>RPL</option>
      <option>AI</option>
    </select>

    <select id="filterPraktikum">
      <option value="">Semua Praktikum</option>
      <option>RPL</option>
      <option>AI</option>
    </select>

    <select id="filterKelas">
      <option value="">Semua Kelas</option>
      <option>A</option>
      <option>B</option>
    </select>

    <select id="filterPertemuan">
      <option value="">Semua Pertemuan</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
    </select>

    <input type="text" id="searchInput" placeholder="Cari nama / NIM...">

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
        </tr>
      </thead>

      <tbody id="tableBody">

        <tr>
          <td>Andi</td>
          <td>22001</td>
          <td>80</td>
          <td>85</td>
          <td>82</td>
          <td>A</td>
        </tr>

        <tr>
          <td>Siti</td>
          <td>22002</td>
          <td>75</td>
          <td>90</td>
          <td>83</td>
          <td>B</td>
        </tr>

      </tbody>
    </table>
  </div>

</main>

<script src="nilai_asisten.js"></script>
</body>
</html>