let data = [
  {
    nama: "Andi Saputra",
    nip: "12345",
    email: "andi@mail.com",
    hp: "08123456789",
    kelas: ["A", "B"],
    status: "Active"
  },
  {
    nama: "Siti Rahma",
    nip: "67890",
    email: "siti@mail.com",
    hp: "08987654321",
    kelas: ["A"],
    status: "Non Active"
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
        <td>${d.nama}</td>
        <td>${d.nip}</td>
        <td>${d.email}</td>
        <td>${d.hp}</td>
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
  document.getElementById("modalTitle").innerText = "Add Asisten";
  clearForm();
  editIndex = null;
}

function closeModal() {
  document.getElementById("formModal").style.display = "none";
}

function clearForm() {
  document.getElementById("nama").value = "";
  document.getElementById("nip").value = "";
  document.getElementById("email").value = "";
  document.getElementById("hp").value = "";
  document.getElementById("kelas").value = "";
  document.getElementById("status").value = "Active";
}

function saveData() {
  const nama = document.getElementById("nama").value.trim();
  const nip = document.getElementById("nip").value.trim();
  const email = document.getElementById("email").value.trim();
  const hp = document.getElementById("hp").value.trim();
  const kelas = document
    .getElementById("kelas")
    .value.split(",")
    .map(k => k.trim())
    .filter(k => k !== "");
  const status = document.getElementById("status").value;

  const obj = { nama, nip, email, hp, kelas, status };

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

  document.getElementById("nama").value = d.nama;
  document.getElementById("nip").value = d.nip;
  document.getElementById("email").value = d.email;
  document.getElementById("hp").value = d.hp;
  document.getElementById("kelas").value = d.kelas.join(",");
  document.getElementById("status").value = d.status;

  document.getElementById("modalTitle").innerText = "Edit Asisten";

  editIndex = i;
  document.getElementById("formModal").style.display = "flex";
}

function deleteData(i) {
  if (!confirm("Yakin mau hapus asisten ini?")) return;

  data.splice(i, 1);
  renderTable();
}

function showDetail(i) {
  const d = data[i];

  document.getElementById("d_nama").innerText = "Nama: " + d.nama;
  document.getElementById("d_nip").innerText = "NIP: " + d.nip;
  document.getElementById("d_email").innerText = "Email: " + d.email;
  document.getElementById("d_hp").innerText = "No HP: " + d.hp;
  document.getElementById("d_kelas").innerText = "Kelas: " + d.kelas.join(", ");
  document.getElementById("d_status").innerText = "Status: " + d.status;

  document.getElementById("detailModal").style.display = "flex";
}

function closeDetail() {
  document.getElementById("detailModal").style.display = "none";
}

renderTable();