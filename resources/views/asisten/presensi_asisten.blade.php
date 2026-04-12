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
    <h2>Student Attendance</h2>
    <div class="actions">
      <button class="btn history" onclick="goPage('presensiDua_asisten.html')">
        <i class="fas fa-clock"></i> History
      </button>
    </div>
  </div>

  <div class="info-box">
    <div>
      <p><b>Mata Kuliah :</b> Pemrograman Web</p>
      <p><b>Pertemuan :</b> 5</p>
    </div>
    <div>
      <p><b>Praktikum :</b> RPL</p>
      <p><b>Hari/Tanggal :</b> Senin, 10 Maret 2026</p>
    </div>
  </div>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>NIM</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Attendance</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>22001</td>
          <td>Andi Saputra</td>
          <td>A</td>
          <td class="status-btn">
            <button class="hadir" onclick="setStatus(this, 'hadir')">✔</button>
            <button class="izin" onclick="setStatus(this, 'izin')">I</button>
            <button class="alpha" onclick="setStatus(this, 'alpha')">✖</button>
          </td>
        </tr>

        <tr>
          <td>22002</td>
          <td>Siti Rahma</td>
          <td>A</td>
          <td class="status-btn">
            <button class="hadir" onclick="setStatus(this, 'hadir')">✔</button>
            <button class="izin" onclick="setStatus(this, 'izin')">I</button>
            <button class="alpha" onclick="setStatus(this, 'alpha')">✖</button>
          </td>
        </tr>

        <tr>
          <td>22002</td>
          <td>Siti Rahma</td>
          <td>A</td>
          <td class="status-btn">
            <button class="hadir" onclick="setStatus(this, 'hadir')">✔</button>
            <button class="izin" onclick="setStatus(this, 'izin')">I</button>
            <button class="alpha" onclick="setStatus(this, 'alpha')">✖</button>
          </td>
        </tr>

        <tr>
          <td>22002</td>
          <td>Siti Rahma</td>
          <td>A</td>
          <td class="status-btn">
            <button class="hadir" onclick="setStatus(this, 'hadir')">✔</button>
            <button class="izin" onclick="setStatus(this, 'izin')">I</button>
            <button class="alpha" onclick="setStatus(this, 'alpha')">✖</button>
          </td>
        </tr>

        <tr>
          <td>22002</td>
          <td>Siti Rahma</td>
          <td>A</td>
          <td class="status-btn">
            <button class="hadir" onclick="setStatus(this, 'hadir')">✔</button>
            <button class="izin" onclick="setStatus(this, 'izin')">I</button>
            <button class="alpha" onclick="setStatus(this, 'alpha')">✖</button>
          </td>
        </tr>

        <tr>
          <td>22002</td>
          <td>Siti Rahma</td>
          <td>A</td>
          <td class="status-btn">
            <button class="hadir" onclick="setStatus(this, 'hadir')">✔</button>
            <button class="izin" onclick="setStatus(this, 'izin')">I</button>
            <button class="alpha" onclick="setStatus(this, 'alpha')">✖</button>
          </td>
        </tr>

        <tr>
          <td>22002</td>
          <td>Siti Rahma</td>
          <td>A</td>
          <td class="status-btn">
            <button class="hadir" onclick="setStatus(this, 'hadir')">✔</button>
            <button class="izin" onclick="setStatus(this, 'izin')">I</button>
            <button class="alpha" onclick="setStatus(this, 'alpha')">✖</button>
          </td>
        </tr>

        <tr>
          <td>22002</td>
          <td>Siti Rahma</td>
          <td>A</td>
          <td class="status-btn">
            <button class="hadir" onclick="setStatus(this, 'hadir')">✔</button>
            <button class="izin" onclick="setStatus(this, 'izin')">I</button>
            <button class="alpha" onclick="setStatus(this, 'alpha')">✖</button>
          </td>
        </tr>

        <tr>
          <td>22002</td>
          <td>Siti Rahma</td>
          <td>A</td>
          <td class="status-btn">
            <button class="hadir" onclick="setStatus(this, 'hadir')">✔</button>
            <button class="izin" onclick="setStatus(this, 'izin')">I</button>
            <button class="alpha" onclick="setStatus(this, 'alpha')">✖</button>
          </td>
        </tr>

        <tr>
          <td>22002</td>
          <td>Siti Rahma</td>
          <td>A</td>
          <td class="status-btn">
            <button class="hadir" onclick="setStatus(this, 'hadir')">✔</button>
            <button class="izin" onclick="setStatus(this, 'izin')">I</button>
            <button class="alpha" onclick="setStatus(this, 'alpha')">✖</button>
          </td>
        </tr>

        <tr>
          <td>22002</td>
          <td>Siti Rahma</td>
          <td>A</td>
          <td class="status-btn">
            <button class="hadir" onclick="setStatus(this, 'hadir')">✔</button>
            <button class="izin" onclick="setStatus(this, 'izin')">I</button>
            <button class="alpha" onclick="setStatus(this, 'alpha')">✖</button>
          </td>
        </tr>

        <tr>
          <td>22002</td>
          <td>Siti Rahma</td>
          <td>A</td>
          <td class="status-btn">
            <button class="hadir" onclick="setStatus(this, 'hadir')">✔</button>
            <button class="izin" onclick="setStatus(this, 'izin')">I</button>
            <button class="alpha" onclick="setStatus(this, 'alpha')">✖</button>
          </td>
        </tr>

      </tbody>
    </table>

    <div class="save-container">
      <button onclick="saveAttendance()" class="btn-save">
        💾 Simpan
      </button>
    </div>
  </div>

</main>

<script src="presensi_asisten.js"></script>
</body>
</html>