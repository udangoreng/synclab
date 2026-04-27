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
            <h2>Manajemen Pertemuan</h2>
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
            <div class="modal-header">
                <h3 id="modalTitle">Tambah Pertemuan Baru</h3>
            </div>

            <form id="practicumForm" onsubmit="saveData(event)">
                <div class="form-group">
                    <label for="mk">Mata Kuliah</label>
                    <input type="text" id="mk" name="mk" placeholder="e.g., Struktur Data" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="pertemuan">Pertemuan</label>
                        <input type="text" id="pertemuan" name="pertemuan" placeholder="e.g., Pertemuan 1" required>
                    </div>

                    <div class="form-group">
                        <label for="praktikum">Praktikum</label>
                        <input type="text" id="praktikum" name="praktikum" placeholder="Nama Praktikum" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi..." rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="kelas">Kelas (Dipisah koma)</label>
                    <input type="text" id="kelas" name="kelas" placeholder="e.g., A, B, C">
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="active">Active</option>
                        <option value="non_active">Non Active</option>
                    </select>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-secondary" onclick="closeModal()">Batalkan</button>
                    <button type="submit" class="btn-primary">Simpan</button>
                </div>
            </form>
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
