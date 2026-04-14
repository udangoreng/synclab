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
    <h2>Record Attendance</h2>
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
        <td><button class="detail-btn pink" onclick="record('Pemrograman Dasar',1)">Record</button></td>
        <td><button class="detail-btn green" onclick="record('Jaringan Komputer',1)">Record</button></td>
        <td><button class="detail-btn orange" onclick="record('Rekayasa Perangkat Lunak',1)">Record</button></td>
        <td><button class="detail-btn purple" onclick="record('Pengolahan Citra Digital',1)">Record</button></td>
      </tr>

      <tr>
        <td>2</td>
        <td><button class="detail-btn pink" onclick="record('Pemrograman Dasar',2)">Record</button></td>
        <td><button class="detail-btn green" onclick="record('Jaringan Komputer',2)">Record</button></td>
        <td><button class="detail-btn orange" onclick="record('Rekayasa Perangkat Lunak',2)">Record</button></td>
        <td><button class="detail-btn purple" onclick="record('Pengolahan Citra Digital',2)">Record</button></td>
      </tr>

      <tr>
        <td>3</td>
        <td><button class="detail-btn pink" onclick="record('Pemrograman Dasar',3)">Record</button></td>
        <td><button class="detail-btn green" onclick="record('Jaringan Komputer',3)">Record</button></td>
        <td><button class="detail-btn orange" onclick="record('Rekayasa Perangkat Lunak',3)">Record</button></td>
        <td><button class="detail-btn purple" onclick="record('Pengolahan Citra Digital',3)">Record</button></td>
      </tr>

      <tr>
        <td>4</td>
        <td><button class="detail-btn pink" onclick="record('Pemrograman Dasar',4)">Record</button></td>
        <td><button class="detail-btn green" onclick="record('Jaringan Komputer',4)">Record</button></td>
        <td><button class="detail-btn orange" onclick="record('Rekayasa Perangkat Lunak',4)">Record</button></td>
        <td><button class="detail-btn purple" onclick="record('Pengolahan Citra Digital',4)">Record</button></td>
      </tr>

      <tr>
        <td>5</td>
        <td><button class="detail-btn pink" onclick="record('Pemrograman Dasar',5)">Record</button></td>
        <td><button class="detail-btn green" onclick="record('Jaringan Komputer',5)">Record</button></td>
        <td><button class="detail-btn orange" onclick="record('Rekayasa Perangkat Lunak',5)">Record</button></td>
        <td><button class="detail-btn purple" onclick="record('Pengolahan Citra Digital',5)">Record</button></td>
      </tr>

      <tr>
        <td>6</td>
        <td><button class="detail-btn pink" onclick="record('Pemrograman Dasar',6)">Record</button></td>
        <td><button class="detail-btn green" onclick="record('Jaringan Komputer',6)">Record</button></td>
        <td><button class="detail-btn orange" onclick="record('Rekayasa Perangkat Lunak',6)">Record</button></td>
        <td><button class="detail-btn purple" onclick="record('Pengolahan Citra Digital',6)">Record</button></td>
      </tr>

      </tbody>
    </table>
  </div>

</main>

<script src="{{asset("asisten_js/record_asisten.js")}}"></script>
</body>
</html>