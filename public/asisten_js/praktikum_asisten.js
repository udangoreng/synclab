function toggleDropdown(id) {
  document.getElementById(id).classList.toggle("open");
}

function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  sidebar.classList.toggle("active");
}

document.addEventListener("click", function (e) {
  const sidebar = document.getElementById("sidebar");
  const toggle = document.querySelector(".menu-toggle");

  if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
    sidebar.classList.remove("active");
  }
});

function logout() {
  localStorage.removeItem("token"); 
  sessionStorage.clear(); 
  window.location.href = "login.html";
}

function goPage(page) {
  window.location.href = page;
}

document.addEventListener("DOMContentLoaded", function () {
  const search = document.getElementById("search");
  const filter = document.getElementById("filter");
  const cards = document.querySelectorAll(".card");

  function update() {
    const keyword = search ? search.value.toLowerCase() : "";
    const kategori = filter ? filter.value : "all";

    cards.forEach(card => {
      const text = card.innerText.toLowerCase();
      const kategoriCard = card.dataset.kategori || "";

      const cocokSearch = text.includes(keyword);
      const cocokFilter = kategori === "all" || kategoriCard === kategori;

      if (cocokSearch && cocokFilter) {
        card.style.display = "flex";
      } else {
        card.style.display = "none";
      }
    });
  }

  if (search) search.addEventListener("input", update);
  if (filter) filter.addEventListener("change", update);
});