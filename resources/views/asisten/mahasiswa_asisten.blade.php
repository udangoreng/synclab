<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Mahasiswa</title>
    <link rel="stylesheet" href="{{ asset('asisten_css/nilai_asisten.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    @include('asisten/partials/sidebar')

    <main class="main-content">

        <div class="header">
            <h2>Students</h2>
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
                        <th>Praktikum</th>
                        <th>Pertemuan</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody id="tableBody">

                    <tr>
                        <td>Andi</td>
                        <td>22001</td>
                        <td>Sampling</td>
                        <td>1</td>
                        <td>2 Januari 2026</td>
                    </tr>

                    <tr>
                        <td>Siti</td>
                        <td>22002</td>
                        <td>Sampling</td>
                        <td>1</td>
                        <td>2 Januari 2026</td>
                    </tr>

                </tbody>
            </table>
        </div>

    </main>

    <script src="{{ asset('asisten_js/nilai_asisten.js') }}"></script>
</body>

</html>
