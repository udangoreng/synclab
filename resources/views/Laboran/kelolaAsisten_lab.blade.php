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
            <h2>Assistant Management</h2>
            <div class="actions">
                <button class="btn add" onclick="openAdd()">+ Add Asisten</button>
                <input type="text" placeholder="Cari..." id="search">
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Email</th>
                        <th>No HP</th>
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
            <h3 id="modalTitle">Add Asisten</h3>

            <div class="form-box">
                <input id="nama" placeholder="Nama">
                <input id="nip" placeholder="NIP">
                <input id="email" placeholder="Email">
                <input id="hp" placeholder="No HP">
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
        <div class="modal-content">
            <span class="close" onclick="closeDetail()">×</span>
            <h3>Detail Asisten</h3>

            <div class="detail-box">
                <p id="d_nama"></p>
                <p id="d_nip"></p>
                <p id="d_email"></p>
                <p id="d_hp"></p>
                <p id="d_kelas"></p>
                <p id="d_status"></p>
            </div>
        </div>
    </div>

    <script src="{{asset('lab_js/kelolaAsisten_lab.js')}}"></script>
</body>

</html>
