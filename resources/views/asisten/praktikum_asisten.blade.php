<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Praktikum Asisten</title>
    <link rel="stylesheet" href="{{asset('asisten_css/praktikum_asisten.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    @include('asisten/partials/sidebar')
    <main class="main">
        <h2 class="title">Practicum & Schedule Management</h2>
        <div class="content">
            <div class="left">
                <h3>List Practicum</h3>

                <div class="filter-box">
                    <input type="text" id="search" placeholder="Cari praktikum...">
                    <select id="filter">
                        <option value="all">Semua</option>
                        <option value="jaringan">Jaringan Komputer</option>
                        <option value="pemrograman">Pemrograman Dasar</option>
                        <option value="pcd">Pengolahan Citra Digital</option>
                        <option value="rpl">Rekayasan Perangkat Lunak</option>
                    </select>
                </div>

                <div class="grid">

                    <div class="card" data-kategori="pemrograman">
                        <div class="thumb icon">
                            <i class="fas fa-code fa-3x"></i>
                        </div>
                        <div class="info">
                            <h4>Pemrograman Dasar</h4>
                            <p class="praktikum">Praktikum : Struktur Kontrol (If, Switch)</p>
                            <p>Kelas : 2024F</p>
                            <p>Jumlah : 33</p>
                            <p>Hari : 2 Januari 2026</p>
                            <p>Jam : 15.00-16.45</p>
                            <p>Ruang : Lab RPL</p>
                        </div>
                    </div>

                    <div class="card" data-kategori="jaringan">
                        <div class="thumb icon">
                            <i class="fas fa-network-wired fa-3x"></i>
                        </div>
                        <div class="info">
                            <h4>Jaringan Komputer</h4>
                            <p class="praktikum">Praktikum : Pengenalan Topologi Jaringan</p>
                            <p>Kelas : 2024F</p>
                            <p>Jumlah : 33</p>
                            <p>Hari : 2 Januari 2026</p>
                            <p>Jam : 15.00-16.45</p>
                            <p>Ruang : Lab Jaringan</p>
                        </div>
                    </div>

                    <div class="card" data-kategori="rpl">
                        <div class="thumb icon">
                            <i class="fas fa-code-branch fa-3x"></i>
                        </div>
                        <div class="info">
                            <h4>Rekayasa Perangkat Lunak</h4>
                            <p class="praktikum">Praktikum : Desain Antarmuka (UI/UX)</p>
                            <p>Kelas : 2024F</p>
                            <p>Jumlah : 33</p>
                            <p>Hari : 2 Januari 2026</p>
                            <p>Jam : 15.00-16.45</p>
                            <p>Ruang : Lab RPL</p>
                        </div>
                    </div>

                    <div class="card" data-kategori="pcd">
                        <div class="thumb icon">
                            <i class="fas fa-image fa-3x"></i>
                        </div>
                        <div class="info">
                            <h4>Pengolahan Citra Digital</h4>
                            <p class="praktikum">Praktikum: Transformasi Citra</p>
                            <p>Kelas : 2024F</p>
                            <p>Jumlah : 33</p>
                            <p>Hari : 2 Januari 2026</p>
                            <p>Jam : 15.00-16.45</p>
                            <p>Ruang : Lab Multimedia</p>
                        </div>
                    </div>

                    <div class="card" data-kategori="jaringan">
                        <div class="thumb icon">
                            <i class="fas fa-network-wired fa-3x"></i>
                        </div>
                        <div class="info">
                            <h4>Jaringan Komputer</h4>
                            <p class="praktikum">Praktikum : Packet Tracer</p>
                            <p>Kelas : 2024F</p>
                            <p>Jumlah : 33</p>
                            <p>Hari : 2 Januari 2026</p>
                            <p>Jam : 15.00-16.45</p>
                            <p>Ruang : Lab Jaringan</p>
                        </div>
                    </div>

                    <div class="card" data-kategori="pemrograman">
                        <div class="thumb icon">
                            <i class="fas fa-code fa-3x"></i>
                        </div>
                        <div class="info">
                            <h4>Pemrograman Dasar</h4>
                            <p class="praktikum">Praktikum: Array dan String</p>
                            <p>Kelas : 2024F</p>
                            <p>Jumlah : 33</p>
                            <p>Hari : 2 Januari 2026</p>
                            <p>Jam : 15.00-16.45</p>
                            <p>Ruang : Lab SI</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="right">
                <h3>📅 Today Schedule</h3>

                <div class="timeline">
                    <h4 style="margin:10px 0;"></h4>

                    <div class="timeline-item">
                        <div class="time">08:00</div>
                        <div class="schedule-card">
                            <h4>Pemrograman Dasar</h4>
                            <p class="praktikum">
                                <i class="fas fa-code"></i> Praktikum : Struktur Kontrol (If, Loop)
                            </p>
                            <p><i class="fas fa-clock"></i> 08:00 - 10:00</p>
                            <p><i class="fas fa-map-marker-alt"></i> Lab SI • 30 Mahasiswa</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="time">10:00</div>
                        <div class="schedule-card">
                            <h4>Rekayasa Perangkat Lunak</h4>
                            <p class="praktikum">
                                <i class="fas fa-laptop-code"></i> Praktikum : Desain UI/UX
                            </p>
                            <p><i class="fas fa-clock"></i> 10:00 - 12:00</p>
                            <p><i class="fas fa-map-marker-alt"></i> Lab RPL • 28 Mahasiswa</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="time">13:00</div>
                        <div class="schedule-card">
                            <h4>Pengolahan Citra Digital</h4>
                            <p class="praktikum">
                                <i class="fas fa-image"></i> Praktikum : Sampling & Kuantisasi
                            </p>
                            <p><i class="fas fa-clock"></i> 13:00 - 15:00</p>
                            <p><i class="fas fa-map-marker-alt"></i> Lab Multimedia • 25 Mahasiswa</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="time">15:00</div>
                        <div class="schedule-card">
                            <h4>Jaringan Komputer</h4>
                            <p class="praktikum">
                                <i class="fas fa-network-wired"></i> Praktikum : Topologi Jaringan
                            </p>
                            <p><i class="fas fa-clock"></i> 15:00 - 17:00</p>
                            <p><i class="fas fa-map-marker-alt"></i> Lab Jaringan • 27 Mahasiswa</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <script src="{{asset('asisten_js/praktikum_asisten.js')}}"></script>
</body>

</html>
