let data = [];
let editIndex = null;

function goPage(page) {
  window.location.href = page;
}

function toggleSidebar() {
  document.getElementById("sidebar").classList.toggle("show");
}

function toggleDropdown(id) {
  document.getElementById(id).classList.toggle("open");
}

function logout() {
  localStorage.removeItem("token");
  sessionStorage.clear();
  window.location.href = "login.html";
}

document.addEventListener("click", function(e) {
  const sidebar = document.getElementById("sidebar");
  const toggle = document.querySelector(".toggle");

  if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
    sidebar.classList.remove("active");
  }
});

function renderTable() {
  const tbody = document.getElementById("tableBody");
  tbody.innerHTML = "";

  data.forEach((d, i) => {
    tbody.innerHTML += `
      <tr>
        <td>${d.mk}</td>
        <td>${d.pertemuan}</td>
        <td>${d.praktikum}</td>
        <td>${d.deskripsi}</td>
        <td>${d.kelas.length}</td>
        <td>
          <span class="status ${d.status === 'Active' ? 'active' : 'non'}">
            ${d.status}
          </span>
        </td>
        <td>
          <button class="edit" onclick="editData(${i})">Edit</button>
          <button class="delete" onclick="deleteData(${i})">Hapus</button>
          <button class="detail" onclick="showDetail(${i})">Detail</button>
        </td>
      </tr>
    `;
  });
}

function openAdd() {
  document.getElementById("formModal").style.display = "flex";
  document.getElementById("modalTitle").innerText = "Add Practicum";

  clearForm();
  editIndex = null;
}

function closeModal() {
  document.getElementById("formModal").style.display = "none";
}

function clearForm() {
  document.getElementById("mk").value = "";
  document.getElementById("pertemuan").value = "";
  document.getElementById("praktikum").value = "";
  document.getElementById("deskripsi").value = "";
  document.getElementById("kelas").value = "";
  document.getElementById("status").value = "Active";
}

function saveData() {
  const mk = document.getElementById("mk").value.trim();
  const pertemuan = document.getElementById("pertemuan").value.trim();
  const praktikum = document.getElementById("praktikum").value.trim();
  const deskripsi = document.getElementById("deskripsi").value.trim();
  const kelas = document
    .getElementById("kelas")
    .value.split(",")
    .map(k => k.trim())
    .filter(k => k !== "");
  const status = document.getElementById("status").value;

  const obj = { mk, pertemuan, praktikum, deskripsi, kelas, status };

  if (editIndex === null) {
    data.push(obj);
  } else {
    data[editIndex] = obj;
  }

  closeModal();
  renderTable();
}

function editData(i) {
  const d = data[i];

  document.getElementById("mk").value = d.mk;
  document.getElementById("pertemuan").value = d.pertemuan;
  document.getElementById("praktikum").value = d.praktikum;
  document.getElementById("deskripsi").value = d.deskripsi;
  document.getElementById("kelas").value = d.kelas.join(",");
  document.getElementById("status").value = d.status;

  document.getElementById("modalTitle").innerText = "Edit Practicum";

  editIndex = i;
  document.getElementById("formModal").style.display = "flex";
}

function deleteData(i) {
  const yakin = confirm("Yakin mau hapus data ini?");

  if (yakin) {
    data.splice(i, 1);
    renderTable();
  }
}

function showDetail(i) {
  const d = data[i];

  document.getElementById("d_mk").innerText = "Mata Kuliah: " + d.mk;
  document.getElementById("d_pertemuan").innerText = "Pertemuan: " + d.pertemuan;
  document.getElementById("d_praktikum").innerText = "Praktikum: " + d.praktikum;
  document.getElementById("d_deskripsi").innerText = "Deskripsi: " + d.deskripsi;

  const tbody = document.getElementById("detailTable");
  tbody.innerHTML = "";

  d.kelas.forEach(k => {
    tbody.innerHTML += `
      <tr>
        <td>-</td>
        <td>-</td>
        <td>30</td>
        <td>${k}</td>
      </tr>
    `;
  });

  document.getElementById("detailModal").style.display = "flex";
}

function closeDetail() {
  document.getElementById("detailModal").style.display = "none";
}

data = [
  {
    mk: "Pemrograman Dasar",
    pertemuan: "1",
    praktikum: "Variabel & Tipe Data",
    deskripsi: "Pengenalan variabel",
    kelas: ["A", "B", "C"],
    status: "Active"
  },
  {
    mk: "Jaringan Komputer",
    pertemuan: "2",
    praktikum: "Topologi Jaringan",
    deskripsi: "Jenis topologi",
    kelas: ["A", "B"],
    status: "Non Active"
  }
];

renderTable();