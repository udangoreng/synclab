<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Praktikum Asisten</title>
  <link rel="stylesheet" href="{{asset('asisten_css/presensi_asisten.css')}}">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

@include('asisten/partials/sidebar')

<main class="main-content">

  <div class="header">
    <h2>Attendance History</h2>
    <div class="actions">
      <button class="btn history" onclick="goPage('presensiDua_asisten.html')">
        <i class="fas fa-clock"></i> History
      </button>
    </div>
  </div>

  <div class="info-box"></div>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Pertemuan</th>
          <th>Pemrograman Dasar</th>
          <th>Jaringan Komputer</th>
          <th>Rekayasa Perangkat Lunak</th>
          <th>Pengolahan Citra Digital</th>
        </tr>
      </thead>

      <tbody>
      <tr>
        <td>1</td>
        <td><button class="detail-btn pink" onclick="goDetail('Pemrograman Dasar', 1)">Lihat Detail</button></td>
        <td><button class="detail-btn green" onclick="goDetail('Jaringan Komputer', 1)">Lihat Detail</button></td>
        <td><button class="detail-btn orange" onclick="goDetail('Rekayasa Perangkat Lunak', 1)">Lihat Detail</button></td>
        <td><button class="detail-btn purple" onclick="goDetail('Pengolahan Citra Digital', 1)">Lihat Detail</button></td>
      </tr>

      <tr>
        <td>2</td>
        <td><button class="detail-btn pink" onclick="goDetail('Pemrograman Dasar', 2)">Lihat Detail</button></td>
        <td><button class="detail-btn green" onclick="goDetail('Jaringan Komputer', 2)">Lihat Detail</button></td>
        <td><button class="detail-btn orange" onclick="goDetail('Rekayasa Perangkat Lunak', 2)">Lihat Detail</button></td>
        <td><button class="detail-btn purple" onclick="goDetail('Pengolahan Citra Digital', 2)">Lihat Detail</button></td>
      </tr>

      <tr>
        <td>3</td>
        <td><button class="detail-btn pink" onclick="goDetail('Pemrograman Dasar', 3)">Lihat Detail</button></td>
        <td><button class="detail-btn green" onclick="goDetail('Jaringan Komputer', 3)">Lihat Detail</button></td>
        <td><button class="detail-btn orange" onclick="goDetail('Rekayasa Perangkat Lunak', 3)">Lihat Detail</button></td>
        <td><button class="detail-btn purple" onclick="goDetail('Pengolahan Citra Digital', 3)">Lihat Detail</button></td>
      </tr>

      <tr>
        <td>4</td>
        <td><button class="detail-btn pink" onclick="goDetail('Pemrograman Dasar', 4)">Lihat Detail</button></td>
        <td><button class="detail-btn green" onclick="goDetail('Jaringan Komputer', 4)">Lihat Detail</button></td>
        <td><button class="detail-btn orange" onclick="goDetail('Rekayasa Perangkat Lunak', 4)">Lihat Detail</button></td>
        <td><button class="detail-btn purple" onclick="goDetail('Pengolahan Citra Digital', 4)">Lihat Detail</button></td>
      </tr>

      <tr>
        <td>5</td>
        <td><button class="detail-btn pink" onclick="goDetail('Pemrograman Dasar', 5)">Lihat Detail</button></td>
        <td><button class="detail-btn green" onclick="goDetail('Jaringan Komputer', 5)">Lihat Detail</button></td>
        <td><button class="detail-btn orange" onclick="goDetail('Rekayasa Perangkat Lunak', 5)">Lihat Detail</button></td>
        <td><button class="detail-btn purple" onclick="goDetail('Pengolahan Citra Digital', 5)">Lihat Detail</button></td>
      </tr>

      <tr>
        <td>6</td>
        <td><button class="detail-btn pink" onclick="goDetail('Pemrograman Dasar', 6)">Lihat Detail</button></td>
        <td><button class="detail-btn green" onclick="goDetail('Jaringan Komputer', 6)">Lihat Detail</button></td>
        <td><button class="detail-btn orange" onclick="goDetail('Rekayasa Perangkat Lunak', 6)">Lihat Detail</button></td>
        <td><button class="detail-btn purple" onclick="goDetail('Pengolahan Citra Digital', 6)">Lihat Detail</button></td>
      </tr>
    </tbody>
    </table>
  </div>

</main>

<script src="{{asset('asisten_js/presensiDua_asisten.js')}}"></script>
</body>
</html>