function toggleSidebar() {
  document.getElementById("sidebar").classList.toggle("show");
}

document.addEventListener("click", function(e) {
  const sidebar = document.getElementById("sidebar");
  const toggle = document.querySelector(".toggle");

  if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
    sidebar.classList.remove("active");
  }
});

const data = [
  { nama: "Andi", nim: "001", pretest: 80, laporan: 85 },
  { nama: "Siti", nim: "002", pretest: 60, laporan: 65 },
  { nama: "Budi", nim: "003", pretest: 90, laporan: 88 },
  { nama: "Rina", nim: "004", pretest: 50, laporan: 55 },
  { nama: "Dewi", nim: "005", pretest: 75, laporan: 70 }
];

function hitungNilai(d) {
  return Math.round((d.pretest + d.laporan) / 2);
}

function getGrade(nilai) {
  if (nilai >= 85) return "A";
  if (nilai >= 75) return "B";
  if (nilai >= 65) return "C";
  return "D";
}

function getStatus(nilai) {
  if (nilai >= 75) return "lulus";
  if (nilai >= 60) return "revisi";
  return "tidak-lulus";
}

function renderTable() {
  const tbody = document.getElementById("tableBody");
  tbody.innerHTML = "";

  data.forEach(d => {
    const nilai = hitungNilai(d);
    const grade = getGrade(nilai);
    const status = getStatus(nilai);

    tbody.innerHTML += `
      <tr>
        <td>${d.nama}</td>
        <td>${d.nim}</td>
        <td>${d.pretest}</td>
        <td>${d.laporan}</td>
        <td>${nilai}</td>
        <td>${grade}</td>
        <td>
        <span class="status-laporan ${status}">
            ${status.replace("-", " ")}
        </span>
        </td>
      </tr>
    `;
  });
}

let chartInstance = null;

function renderStats() {
  let tinggi = 0, rendah = 0, totalNilai = 0;

  data.forEach(d => {
    const nilai = hitungNilai(d);
    totalNilai += nilai;

    if (nilai >= 75) tinggi++;
    else rendah++;
  });

  const rata = Math.round(totalNilai / data.length);

  // masukin ke legend
  document.getElementById("valTinggi").innerText = tinggi;
  document.getElementById("valRendah").innerText = rendah;
  document.getElementById("valRata").innerText = rata;

  const ctx = document.getElementById("chart");
  if (!ctx) return;

  if (chartInstance) chartInstance.destroy();

  chartInstance = new Chart(ctx, {
    type: "doughnut",
    data: {
      labels: ["Tinggi", "Rendah"],
      datasets: [{
        data: [tinggi, rendah],
        backgroundColor: [
          "#86efac", 
          "#fca5a5"  
        ],
        borderWidth: 0
      }]
    },
    options: {
      cutout: "65%",
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });
}

document.addEventListener("DOMContentLoaded", function () {
  renderTable();
  renderStats();

  document.getElementById("export").addEventListener("change", function () {
    if (this.value === "pdf") {
      alert("Export PDF");
    } else if (this.value === "excel") {
      alert("Export Excel");
    }
    this.value = "";
  });
});