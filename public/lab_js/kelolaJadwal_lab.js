let data = [
  {
    mk: "Pemrograman Dasar",
    pertemuan: "1",
    praktikum: "Variabel",
    kelas: "A",
    hari: "Senin",
    jam: "10.00-12.00",
    ruangan: "Lab 1",
    asisten: "Andi"
  },
  {
    mk: "Jaringan Komputer",
    pertemuan: "2",
    praktikum: "Topologi",
    kelas: "B",
    hari: "Selasa",
    jam: "13.00-15.00",
    ruangan: "Lab 2",
    asisten: "Siti"
  }
];

let editIndex = null;

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
        <td>${d.kelas}</td>
        <td>${d.hari}</td>
        <td>${d.jam}</td>
        <td>${d.ruangan}</td>
        <td>${d.asisten}</td>
        <td>
          <button class="edit" onclick="editData(${i})">Edit</button>
          <button class="delete" onclick="deleteData(${i})">Hapus</button>
        </td>
      </tr>
    `;
  });
}

function openAdd() {
  document.getElementById("formModal").style.display = "flex";
  document.getElementById("modalTitle").innerText = "Add Jadwal";
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
  document.getElementById("kelas").value = "";
  document.getElementById("hari").value = "";
  document.getElementById("jam").value = "";
  document.getElementById("ruangan").value = "";
  document.getElementById("asisten").value = "";
}

function saveData() {
  const obj = {
    mk: document.getElementById("mk").value,
    pertemuan: document.getElementById("pertemuan").value,
    praktikum: document.getElementById("praktikum").value,
    kelas: document.getElementById("kelas").value,
    hari: document.getElementById("hari").value,
    jam: document.getElementById("jam").value,
    ruangan: document.getElementById("ruangan").value,
    asisten: document.getElementById("asisten").value
  };

  if (editIndex === null) data.push(obj);
  else data[editIndex] = obj;

  closeModal();
  renderTable();
}

function editData(i) {
  const d = data[i];

  document.getElementById("mk").value = d.mk;
  document.getElementById("pertemuan").value = d.pertemuan;
  document.getElementById("praktikum").value = d.praktikum;
  document.getElementById("kelas").value = d.kelas;
  document.getElementById("hari").value = d.hari;
  document.getElementById("jam").value = d.jam;
  document.getElementById("ruangan").value = d.ruangan;
  document.getElementById("asisten").value = d.asisten;

  document.getElementById("modalTitle").innerText = "Edit Jadwal";

  editIndex = i;
  document.getElementById("formModal").style.display = "flex";
}

function deleteData(i) {
  if (!confirm("Yakin mau hapus jadwal ini?")) return;

  data.splice(i, 1);
  renderTable();
}

renderTable();