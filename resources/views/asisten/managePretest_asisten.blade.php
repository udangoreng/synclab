<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Praktikum Asisten</title>
    <link rel="stylesheet" href="{{ asset('asisten_css/managePretest_asisten.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    @include('asisten/partials/sidebar')

    <main class="main-content">
        <div class="header">
            <h2>Create Test</h2>
            <button class="btn add" onclick="openPopup('add')">
                <i class="fas fa-plus"></i> Add
            </button>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nama Pretest</th>
                        <th>Praktikum</th>
                        <th>Pertemuan</th>
                        <th>Durasi</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Pretest Struktur Kontrol</td>
                        <td>Pemrograman Dasar</td>
                        <td>1</td>
                        <td>30 menit</td>
                        <td>Soal dasar percabangan if dan switch</td>
                        <td class="actions-btn">
                            <button class="edit">✏️</button>
                            <button class="delete">🗑️</button>
                            <button class="detail">🔍</button>
                        </td>
                    </tr>

                    <tr>
                        <td>Pretest Topologi Jaringan</td>
                        <td>Jaringan Komputer</td>
                        <td>2</td>
                        <td>30 menit</td>
                        <td>Pemahaman dasar jenis-jenis topologi jaringan</td>
                        <td class="actions-btn">
                            <button class="edit">✏️</button>
                            <button class="delete">🗑️</button>
                            <button class="detail">🔍</button>
                        </td>
                    </tr>

                    <tr>
                        <td>Pretest UI/UX</td>
                        <td>Rekayasa Perangkat Lunak</td>
                        <td>3</td>
                        <td>45 menit</td>
                        <td>Dasar konsep desain antarmuka pengguna</td>
                        <td class="actions-btn">
                            <button class="edit">✏️</button>
                            <button class="delete">🗑️</button>
                            <button class="detail">🔍</button>
                        </td>
                    </tr>

                    <tr>
                        <td>Pretest Transformasi Citra</td>
                        <td>Pengolahan Citra Digital</td>
                        <td>4</td>
                        <td>45 menit</td>
                        <td>Operasi dasar pengolahan citra digital</td>
                        <td class="actions-btn">
                            <button class="edit">✏️</button>
                            <button class="delete">🗑️</button>
                            <button class="detail">🔍</button>
                        </td>
                    </tr>

                    <tr>
                        <td>Pretest Packet Tracer</td>
                        <td>Jaringan Komputer</td>
                        <td>5</td>
                        <td>40 menit</td>
                        <td>Simulasi konfigurasi jaringan dasar</td>
                        <td class="actions-btn">
                            <button class="edit">✏️</button>
                            <button class="delete">🗑️</button>
                            <button class="detail">🔍</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>

    <div class="popup" id="pretestPopup">
        <div class="popup-content">

            <span class="close-btn" onclick="closePopup()">✖</span>

            <h3 id="popupTitle">Tambah Pretest</h3>

            <div class="form-group">
                <label>Nama Pretest</label>
                <input type="text" id="p_nama" placeholder="Contoh: Pretest HTML">
            </div>

            <div class="form-group">
                <label>Praktikum</label>
                <input type="text" id="p_praktikum" placeholder="Contoh: RPL">
            </div>

            <div class="form-group">
                <label>Pertemuan</label>
                <input type="number" id="p_pertemuan" placeholder="Contoh: 1">
            </div>

            <div class="form-group">
                <label>Jam Mulai</label>
                <input type="time" id="p_mulai">
            </div>

            <div class="form-group">
                <label>Jam Akhir</label>
                <input type="time" id="p_akhir">
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <input type="text" id="p_deskripsi" placeholder="Deskripsi pretest">
            </div>

            <div class="popup-actions">
                <button onclick="closePopup()">Cancel</button>
                <button id="btnSave">Simpan</button>
            </div>

        </div>
    </div>

    <script src="{{asset('asisten_js/managePretest_asisten.js')}}"></script>
</body>

</html>
