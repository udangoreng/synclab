<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Asisten</title>
  <link rel="stylesheet" href="dashboard_asisten.css">
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

<main class="main">
  <section class="hero">
    <h2 class="page-title">Dashboard</h2>
    <div class="hero-image"></div>
  </section>

  <section class="top-section">
    <div class="notifikasi">
      <h3>Selamat siang, Caca 👋</h3>
      <div class="notif blue">
        <i class="fas fa-calendar"></i>
        Sesi praktikum berikutnya akan dimulai sebentar lagi.
      </div>

      <div class="notif yellow">
        <i class="fas fa-exclamation-triangle"></i>
        Silakan upload materi untuk pertemuan berikutnya.
      </div>

      <div class="notif green">
        <i class="fas fa-check-circle"></i>
        Input nilai untuk praktikum Pemrograman Dasar belum selesai.
      </div>
    </div>

    <div class="calendar">
        <div class="calendar-header">
            <button onclick="prevMonth()">❮</button>
            <h4 id="monthYear"></h4>
            <button onclick="nextMonth()">❯</button>
        </div>

        <div class="calendar-days">
            <span>Mo</span><span>Tu</span><span>We</span>
            <span>Th</span><span>Fr</span><span>Sa</span><span>Su</span>
        </div>

        <div class="calendar-dates" id="calendarDates"></div>
    </div>

  </section>

  <section class="practicum">
    <h4>My Practicum</h4>
    <div class="practicum-list">
        <div class="prac-card">
        <h5>📘 Rekayasan Perangkat Lunak</h5>
        <p>Senin, 10:00 - 12:00</p>
        <p>30 Mahasiswa • 5 Kelompok</p>

        <div class="progress">
            <span>Presensi</span>
            <div class="bar"><div style="width:80%"></div></div>
            <small>80% (24/30)</small>
        </div>

        <div class="progress">
            <span>Nilai</span>
            <div class="bar"><div style="width:60%"></div></div>
            <small>60% (18/30)</small>
        </div>

        <p class="warning">⚠ 5 laporan belum direview</p>
        <p class="status active">🟢 Aktif</p>

        <div class="btn-group">
          <button onclick="goToPresensi()">Presensi</button>
          <button onclick="goToNilai()">Nilai</button>
          <a class="view" onclick="goToPracticum()">View</a>
        </div>
        </div>

        <div class="prac-card">
        <h5>📗 Jaringan Komputer</h5>
        <p>Selasa, 09:00 - 11:00</p>
        <p>25 Mahasiswa</p>

        <div class="progress">
            <span>Presensi</span>
            <div class="bar"><div style="width:70%"></div></div>
            <small>70% (18/25)</small>
        </div>

        <div class="progress">
            <span>Nilai</span>
            <div class="bar"><div style="width:40%"></div></div>
            <small>40% (10/25)</small>
        </div>

        <p class="warning">⚠ Nilai belum lengkap</p>
        <p class="status pending">⏳ Akan datang</p>

        <div class="btn-group">
            <button onclick="goToPresensi()">Presensi</button>
            <button onclick="goToNilai()">Nilai</button>
            <a class="view" onclick="goToPracticum()">View</a>
        </div>
        </div>

        <div class="prac-card">
        <h5>📘 Pemrograman Dasar</h5>
        <p>Senin, 10:00 - 12:00</p>
        <p>30 Mahasiswa • 5 Kelompok</p>

        <div class="progress">
            <span>Presensi</span>
            <div class="bar"><div style="width:80%"></div></div>
            <small>80% (24/30)</small>
        </div>

        <div class="progress">
            <span>Nilai</span>
            <div class="bar"><div style="width:60%"></div></div>
            <small>60% (18/30)</small>
        </div>

        <p class="warning">⚠ 5 laporan belum direview</p>
        <p class="status active">🟢 Aktif</p>

        <div class="btn-group">
            <button onclick="goToPresensi()">Presensi</button>
            <button onclick="goToNilai()">Nilai</button>
            <a class="view" onclick="goToPracticum()">View</a>
        </div>
        </div>

        <div class="prac-card">
        <h5>📗 Pengolahan Citra Digital</h5>
        <p>Selasa, 09:00 - 11:00</p>
        <p>25 Mahasiswa</p>

        <div class="progress">
            <span>Presensi</span>
            <div class="bar"><div style="width:70%"></div></div>
            <small>70% (18/25)</small>
        </div>

        <div class="progress">
            <span>Nilai</span>
            <div class="bar"><div style="width:40%"></div></div>
            <small>40% (10/25)</small>
        </div>

        <p class="warning">⚠ Nilai belum lengkap</p>
        <p class="status pending">⏳ Akan datang</p>

        <div class="btn-group">
            <button onclick="goToPresensi()">Presensi</button>
            <button onclick="goToNilai()">Nilai</button>
            <a class="view" onclick="goToPracticum()">View</a>
        </div>
        </div>
    </div>
  </section>

  <section class="card">
    <h3>📅 Today Schedule</h3>

    <div class="summary">
        <p><strong>Hari Ini:</strong> 2 kelas | 1 berlangsung | 1 akan datang</p>

        <div class="filter-jadwal">
        <button>Hari Ini</button>
        <button>Semua Jadwal</button>
        </div>
    </div>

    <div class="jadwal-hari">
        <h4>Senin</h4>

        <div class="timeline">
        <div class="timeline-item">
            <div class="time">10:00</div>

            <div class="line"></div>

            <div class="content">
            <h5>📘 Basis Data</h5>
            <p>🕒 10:00 - 12:00</p>
            <p>📍 Lab 1 • 30 Mahasiswa</p>

            <span class="status jadwal berjalan">🟢 Sedang berlangsung</span>

            <p>Presensi : 25/30 (83%)</p>

            <p class="warning-text">⚠ 5 laporan belum dicek</p>

            <div class="actions">
                <button class="btn primary" onclick="goToPresensi()">Input Presensi</button>
                <button class="btn pink" onclick="goToLaporan()">Review Laporan</button>
            </div>
            </div>
        </div>

        <div class="timeline-item">
            <div class="time">12:00</div>

            <div class="line"></div>

            <div class="content">
            <p style="color:#999; font-size:13px;">Tidak ada jadwal</p>
            </div>
        </div>

        <div class="timeline-item">
            <div class="time">13:00</div>

            <div class="line"></div>

            <div class="content">
            <h5>📗 Jaringan</h5>
            <p>🕒 13:00 - 15:00</p>
            <p>📍 Lab 2 • 25 Mahasiswa</p>

            <span class="status jadwal upcoming">⏳ Akan datang</span>

            <div class="actions">
                <button class="btn green" onclick="goToPracticum()">Lihat Detail</button>
            </div>
            </div>
        </div>

        <div class="timeline-item last">
            <div class="time">15:00</div>
        </div>

        </div>
    </div>
  </section>

  <section class="bottom-section">

    <div class="attendance">
        <h4>Attendance</h4>

    <div class="attendance-container">

        <div class="attendance-list">
        <div class="pill active" onclick="showDetail(0)">Pemrograman Dasar</div>
        <div class="pill" onclick="showDetail(1)">Rekayasa Perangkat Lunak</div>
        <div class="pill" onclick="showDetail(2)">Pengolahan Citra Digital</div>
        <div class="pill" onclick="showDetail(3)">Jaringan Komputer</div>
        </div>

        <div class="attendance-detail" id="detailBox"></div>
       </div>
     </div>
  </section>

</main>

<script src="dashboard_asisten.js"></script>
</body>
</html>