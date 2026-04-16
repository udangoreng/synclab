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

    <script src="{{ asset('lab_js/kelolaJadwal_lab.js') }}"></script>
</body>

</html>
