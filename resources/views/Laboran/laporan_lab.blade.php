<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Praktikum</title>
    <link rel="stylesheet" href="{{ asset('lab_css/kelolaPraktikum.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    @include('laboran/partials/sidebar')

    <main class="main-content">

        <div class="header">
            <h2> Reports </h2>

            <div class="actions">
                <select id="filterPertemuan">
                    <option>Semua Pertemuan</option>
                </select>

                <select id="filterKelas">
                    <option>Semua Kelas</option>
                </select>

                <select id="filterPraktikum">
                    <option>Semua Praktikum</option>
                </select>

                <select id="export">
                    <option value="">Export</option>
                    <option value="pdf">PDF</option>
                    <option value="excel">Excel</option>
                </select>

                <input type="text" placeholder="Cari..." id="search">
            </div>
        </div>

        <div class="top-section">

            <div class="summary-box">
                <div class="card summary-1">
                    <p>Pendaftaran</p>
                    <h3>120 / 150</h3>
                </div>

                <div class="card summary-2">
                    <p>Presensi</p>
                    <h3>80%</h3>
                </div>

                <div class="card summary-3">
                    <p>Nilai</p>
                    <h3>70%</h3>
                </div>

                <div class="card summary-4">
                    <p>Jadwal</p>
                    <h3>1 Bentrok</h3>
                </div>
            </div>

            <div class="chart-box">
                <h3 class="chart-title">Statistik</h3>

                <div class="chart-content">
                    <canvas id="chart"></canvas>

                    <div class="chart-legend">
                        <div><span class="dot tinggi"></span> Nilai Tinggi</div>
                        <div><span class="dot rendah"></span> Nilai Rendah</div>
                        <div><span class="dot rata"></span> Rata-rata</div>

                        <div class="legend-value">
                            <p>Tinggi: <b id="valTinggi">0</b></p>
                            <p>Rendah: <b id="valRendah">0</b></p>
                            <p>Rata-rata: <b id="valRata">0</b></p>
                        </div>
                    </div>
                </div>
            </div>
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
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('lab_js/laporan_lab.js') }}"></script>
</body>

</html>
