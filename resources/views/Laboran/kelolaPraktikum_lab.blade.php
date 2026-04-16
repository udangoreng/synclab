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
            <h2>Practicum Management</h2>
            <div class="actions">
                <button class="btn add" onclick="openAdd()">+ Add Practicum</button>
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
                        <th>Deskripsi</th>
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
            <h3 id="modalTitle">Add Practicum</h3>

            <div class="form-box">
                <input id="mk" placeholder="Mata Kuliah">
                <input id="pertemuan" placeholder="Pertemuan">
                <input id="praktikum" placeholder="Praktikum">
                <textarea id="deskripsi" placeholder="Deskripsi"></textarea>
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
        <div class="modal-content large">
            <span class="close" onclick="closeDetail()">×</span>
            <h3>Detail Practicum</h3>

            <div class="detail-box">
                <p id="d_mk"></p>
                <p id="d_pertemuan"></p>
                <p id="d_praktikum"></p>
                <p id="d_deskripsi"></p>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Jadwal</th>
                        <th>Asisten</th>
                        <th>Mahasiswa</th>
                        <th>Kelas</th>
                    </tr>
                </thead>
                <tbody id="detailTable"></tbody>
            </table>

            <div class="detail-actions">
                <button>Kelola Jadwal</button>
                <button>Alokasi Asisten</button>
                <button>List Mahasiswa</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('lab_js/kelolaPraktikum_lab.js') }}"></script>
</body>

</html>
