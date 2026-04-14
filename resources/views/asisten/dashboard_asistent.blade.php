<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Asisten</title>
    <link rel="stylesheet" href="{{ asset('asisten_css/dashboard_asisten.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    @include('Asisten/partials/sidebar')

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
                        <div class="bar">
                            <div style="width:80%"></div>
                        </div>
                        <small>80% (24/30)</small>
                    </div>

                    <div class="progress">
                        <span>Nilai</span>
                        <div class="bar">
                            <div style="width:60%"></div>
                        </div>
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
                        <div class="bar">
                            <div style="width:70%"></div>
                        </div>
                        <small>70% (18/25)</small>
                    </div>

                    <div class="progress">
                        <span>Nilai</span>
                        <div class="bar">
                            <div style="width:40%"></div>
                        </div>
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
                        <div class="bar">
                            <div style="width:80%"></div>
                        </div>
                        <small>80% (24/30)</small>
                    </div>

                    <div class="progress">
                        <span>Nilai</span>
                        <div class="bar">
                            <div style="width:60%"></div>
                        </div>
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
                        <div class="bar">
                            <div style="width:70%"></div>
                        </div>
                        <small>70% (18/25)</small>
                    </div>

                    <div class="progress">
                        <span>Nilai</span>
                        <div class="bar">
                            <div style="width:40%"></div>
                        </div>
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
                        <div class="pill active">Pemrograman Dasar</div>
                        <div class="pill">Rekayasa Perangkat Lunak</div>
                        <div class="pill">Pengolahan Citra Digital</div>
                        <div class="pill">Jaringan Komputer</div>
                    </div>

                    <div class="attendance-detail" id="detailBox"></div>
                </div>
            </div>
        </section>

    </main>

    <script>
        let currentDate = new Date();

        function renderCalendar() {
            const monthYear = document.getElementById("monthYear");
            const calendarDates = document.getElementById("calendarDates");

            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            const firstDay = new Date(year, month, 1).getDay();
            const lastDate = new Date(year, month + 1, 0).getDate();

            const monthNames = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            monthYear.innerText = `${monthNames[month]} ${year}`;
            calendarDates.innerHTML = "";

            let start = firstDay === 0 ? 6 : firstDay - 1;

            for (let i = 0; i < start; i++) {
                calendarDates.innerHTML += `<div></div>`;
            }

            const today = new Date();

            for (let i = 1; i <= lastDate; i++) {
                let isToday =
                    i === today.getDate() &&
                    month === today.getMonth() &&
                    year === today.getFullYear();

                calendarDates.innerHTML += `
      <div class="${isToday ? "today" : ""}">
        ${i}
      </div>
    `;
            }
        }

        function prevMonth() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        }

        function nextMonth() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        }

        const data = [{
                title: "Pemrograman Dasar",
                practicum: "Struktur Kontrol (If, Switch)",
                room: "Lab RPL",
                date: "2 January 2026",
                time: "09.00 - 11.00",
                total: "33 mhs"
            },
            {
                title: "Rekayasa Perangkat Lunak",
                practicum: "Pengujian Perangkat Lunak",
                room: "Lab RPL",
                date: "9 January 2026",
                time: "09.00 - 11.00",
                total: "30 mhs"
            },
            {
                title: "Pengolahan Citra Digital",
                practicum: "Transformasi Citra (Negatif, Thresholding)",
                room: "Lab Multimedia",
                date: "16 January 2026",
                time: "09.00 - 11.00",
                total: "28 mhs"
            },
            {
                title: "Jaringan Komputer",
                practicum: "Simulasi Jaringan (Packet Tracer)",
                room: "Lab Jaringan",
                date: "23 January 2026",
                time: "09.00 - 11.00",
                total: "32 mhs"
            }
        ];

        const colors = ["pink", "blue", "green", "yellow"];

        function showDetail(index) {
            const pills = document.querySelectorAll(".pill");
            pills.forEach(p => p.classList.remove("active"));
            pills[index].classList.add("active");

            const box = document.getElementById("detailBox");
            box.className = "attendance-detail " + colors[index];

            const d = data[index];

            box.innerHTML = `
    <div class="detail-title">${d.title}</div>
    <div class="detail-item"><b>Practicum:</b> ${d.practicum}</div>
    <div class="detail-item"><b>Ruangan:</b> ${d.room}</div>
    <div class="detail-item"><b>Hari/Tgl:</b> ${d.date}</div>
    <div class="detail-item"><b>Jam:</b> ${d.time}</div>
    <div class="detail-item"><b>Jumlah:</b> ${d.total}</div>
    <div class="input-btn" onclick="goPage('presensi_asisten.html')">Input</div>
  `;
        }

        document.addEventListener("DOMContentLoaded", function() {
            renderCalendar();
            showDetail(0);
        });
    </script>
</body>

</html>
