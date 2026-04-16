const data = [
  {
    title: "Pengolahan Citra Digital",
    room: "10.4.3",
    date: "2 January 2026",
    time: "09:00 - 11:00"
  },
  {
    title: "Basis Data",
    room: "Lab 2",
    date: "3 January 2026",
    time: "10:00 - 12:00"
  },
  {
    title: "Jaringan Komputer",
    room: "Lab 3",
    date: "4 January 2026",
    time: "08:00 - 10:00"
  },
  {
    title: "Algoritma",
    room: "Lab 1",
    date: "5 January 2026",
    time: "13:00 - 15:00"
  }
];

function showDetail(index) {
  const detailBox = document.getElementById("detailBox");

  const pills = document.querySelectorAll(".pill");
  pills.forEach(p => p.classList.remove("active"));
  pills[index].classList.add("active");

  const d = data[index];

  detailBox.innerHTML = `
    <h5>${d.title}</h5>
    <p>Ruangan : ${d.room}</p>
    <p>Tanggal : ${d.date}</p>
    <p>Jam : ${d.time}</p>
  `;
}

showDetail(0);
