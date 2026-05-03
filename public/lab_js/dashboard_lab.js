// Modal Functions
function openModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.add('show');
  }
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove('show');
  }
}

// Close modal when clicking outside
window.onclick = function(event) {
  if (event.target.classList.contains('modal')) {
    event.target.classList.remove('show');
  }
}

// Initialize event listeners
document.addEventListener('DOMContentLoaded', function() {
  // Search functionality for praktikum
  const searchInput = document.getElementById('searchPraktikum');
  if (searchInput) {
    searchInput.addEventListener('keyup', function() {
      const searchTerm = this.value.toLowerCase();
      const cards = document.querySelectorAll('.praktikum-card');
      
      cards.forEach(card => {
        const nama = card.getAttribute('data-nama').toLowerCase();
        if (nama.includes(searchTerm)) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    });
  }

  // Jadwal timeline click handler
  document.addEventListener('click', function(e) {
    const timelineItem = e.target.closest('.timeline-item');
    if (timelineItem && timelineItem.getAttribute('data-jadwal')) {
      const jadwalData = JSON.parse(timelineItem.getAttribute('data-jadwal'));
      document.getElementById('jadwalPraktikum').textContent = jadwalData.praktikum?.nama_praktikum || 'Unknown';
      document.getElementById('jadwalHari').textContent = jadwalData.hari;
      document.getElementById('jadwalJam').textContent = jadwalData.jam_mulai + ' - ' + jadwalData.jam_selesai;
      document.getElementById('jadwalLab').textContent = jadwalData.laboratorium?.nama_laboratorium || 'Unknown';
      document.getElementById('jadwalDosen').textContent = jadwalData.dosen?.nama || 'Unknown';
      document.getElementById('jadwalMaxPeserta').textContent = jadwalData.jumlah_max_peserta || '-';
      document.getElementById('jadwalStatus').textContent = jadwalData.status || 'Normal';
      openModal('modalJadwalDetail');
    }
  });

  // Praktikum Detail Button
  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-detail') && e.target.closest('.praktikum-card')) {
      const praktikumData = JSON.parse(e.target.getAttribute('data-praktikum'));
      document.getElementById('detailNama').textContent = praktikumData.nama_praktikum;
      document.getElementById('detailKode').textContent = praktikumData.kode_praktikum;
      document.getElementById('detailAngkatan').textContent = praktikumData.angkatan || '-';
      document.getElementById('detailSemester').textContent = praktikumData.semester || '-';
      openModal('modalPraktikumDetail');
    }

    // Praktikum Edit Button
    if (e.target.classList.contains('btn-edit') && e.target.closest('.praktikum-card')) {
      const praktikumData = JSON.parse(e.target.getAttribute('data-praktikum'));
      document.getElementById('editNama').value = praktikumData.nama_praktikum;
      document.getElementById('editKode').value = praktikumData.kode_praktikum;
      document.getElementById('editAngkatan').value = praktikumData.angkatan || '';
      document.getElementById('editSemester').value = praktikumData.semester || '';
      document.getElementById('editNama').dataset.id = praktikumData.id;
      openModal('modalPraktikumEdit');
    }

    // Praktikum Delete Button
    if (e.target.classList.contains('btn-delete') && e.target.closest('.praktikum-card')) {
      const id = e.target.getAttribute('data-id');
      const nama = e.target.getAttribute('data-nama');
      document.getElementById('deletePraktikumNama').textContent = nama;
      document.getElementById('confirmDeleteBtn').dataset.id = id;
      openModal('modalPraktikumDelete');
    }

    // Asisten Detail Button
    if (e.target.classList.contains('btn-detail-asisten')) {
      const id = e.target.getAttribute('data-id');
      const nama = e.target.getAttribute('data-nama');
      const email = e.target.getAttribute('data-email');
      const nohp = e.target.getAttribute('data-nohp');
      const kelas = e.target.getAttribute('data-kelas');
      
      document.getElementById('asistenNamaDetail').textContent = nama;
      document.getElementById('asistenEmailDetail').textContent = email || '-';
      document.getElementById('asistenNohpDetail').textContent = nohp || '-';
      document.getElementById('asistenKelasDetail').textContent = kelas;
      document.getElementById('asistenStatusDetail').textContent = parseInt(kelas) > 2 ? 'Overload' : 'Normal';
      openModal('modalAsisteDetail');
    }

    // Asisten Jadwal Button
    if (e.target.classList.contains('btn-jadwal-asisten')) {
      const id = e.target.getAttribute('data-id');
      const nama = e.target.getAttribute('data-nama');
      
      document.getElementById('asistenNamaJadwal').textContent = nama;
      
      // Fetch jadwal data - in production, this would call an API
      const asistenCard = e.target.closest('.asisten');
      const jadwalData = JSON.parse(asistenCard.getAttribute('data-asisten')).jadwals;
      
      let jadwalHtml = '<div style="max-height: 300px; overflow-y: auto;">';
      if (jadwalData && jadwalData.length > 0) {
        jadwalData.forEach(jadwal => {
          jadwalHtml += `<div style="padding: 10px; border-bottom: 1px solid #eee;">
            <p><strong>${jadwal.praktikum?.nama_praktikum || 'Unknown'}</strong></p>
            <p>Hari: ${jadwal.hari}</p>
            <p>Jam: ${jadwal.jam_mulai} - ${jadwal.jam_selesai}</p>
            <p>Lab: ${jadwal.laboratorium?.nama_laboratorium || 'Unknown'}</p>
          </div>`;
        });
      } else {
        jadwalHtml += '<p style="padding: 20px; text-align: center; color: #999;">Tidak ada jadwal mengajar</p>';
      }
      jadwalHtml += '</div>';
      
      document.getElementById('asistenJadwalContent').innerHTML = jadwalHtml;
      openModal('modalAsisteJadwal');
    }

    // Laporan Detail Buttons
    if (e.target.classList.contains('btn-detail') && e.target.closest('.laporan-card')) {
      const card = e.target.closest('.laporan-card');
      const tipe = card.querySelector('h4').textContent;
      document.getElementById('laporanType').textContent = tipe;
      openModal('modalLaporanExport');
    }

    // PDF Export
    if (e.target.classList.contains('btn-pdf')) {
      const card = e.target.closest('.laporan-card');
      const tipe = card.querySelector('h4').textContent;
      alert('Mengunduh ' + tipe + ' dalam format PDF...\n(Dalam produksi, ini akan menghasilkan PDF asli)');
    }

    // Excel Export
    if (e.target.classList.contains('btn-excel')) {
      const card = e.target.closest('.laporan-card');
      const tipe = card.querySelector('h4').textContent;
      alert('Mengunduh ' + tipe + ' dalam format Excel...\n(Dalam produksi, ini akan menghasilkan Excel asli)');
    }
  });

  // Form Edit Praktikum Submit
  const formEdit = document.getElementById('formEditPraktikum');
  if (formEdit) {
    formEdit.addEventListener('submit', function(e) {
      e.preventDefault();
      const id = document.getElementById('editNama').dataset.id;
      const nama = document.getElementById('editNama').value;
      const kode = document.getElementById('editKode').value;
      const angkatan = document.getElementById('editAngkatan').value;
      const semester = document.getElementById('editSemester').value;
      
      alert(`Praktikum "${nama}" telah diperbarui!\n(Dalam produksi, ini akan mengirim ke server)`);
      closeModal('modalPraktikumEdit');
    });
  }

  // Delete Confirm Button
  const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
  if (confirmDeleteBtn) {
    confirmDeleteBtn.addEventListener('click', function() {
      const id = this.dataset.id;
      alert(`Praktikum telah dihapus!\n(Dalam produksi, ini akan mengirim ke server)`);
      closeModal('modalPraktikumDelete');
      // In production: window.location.reload();
    });
  }
});
