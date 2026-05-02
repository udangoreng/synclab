// Store all pertemuan data with relationships
const pertemuanDataMap = new Map();

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.pertemuan-data').forEach(el => {
        const id = parseInt(el.dataset.id);
        pertemuanDataMap.set(id, {
            id: id,
            nama_pertemuan: el.dataset.nama_pertemuan,
            pertemuan_ke: el.dataset.pertemuan_ke,
            deskripsi_pertemuan: el.dataset.deskripsi_pertemuan,
            id_jadwal: el.dataset.id_jadwal,
            id_laporan: el.dataset.id_laporan,
            id_modul: el.dataset.id_modul,
            id_nilai: el.dataset.id_nilai,
            id_presensi: el.dataset.id_presensi,
            jadwal: JSON.parse(el.dataset.jadwal || 'null'),
            modul: JSON.parse(el.dataset.modul || 'null'),
            laporan: JSON.parse(el.dataset.laporan || 'null'),
            nilai: JSON.parse(el.dataset.nilai || 'null'),
            presensi: JSON.parse(el.dataset.presensi || 'null'),
            created_at: el.dataset.created_at,
            updated_at: el.dataset.updated_at
        });
    });
});

function openAddModal() {
    document.getElementById('addModal').style.display = 'flex';
}

function closeAddModal() {
    document.getElementById('addModal').style.display = 'none';
}

function openEditModal(id) {
    const pertemuan = pertemuanDataMap.get(id);
    if (!pertemuan) {
        console.error('Pertemuan not found:', id);
        return;
    }
    
    document.getElementById('editForm').action = "/laboran/updatePertemuan/" + id;
    document.getElementById('edit_nama_pertemuan').value = pertemuan.nama_pertemuan || '';
    document.getElementById('edit_pertemuan_ke').value = pertemuan.pertemuan_ke || '';
    document.getElementById('edit_deskripsi_pertemuan').value = pertemuan.deskripsi_pertemuan || '';
    document.getElementById('edit_id_jadwal').value = pertemuan.id_jadwal || '';
    document.getElementById('edit_id_modul').value = pertemuan.id_modul || '';
    
    document.getElementById('editModal').style.display = 'flex';
}

function openDetailModal(id) {
    const pertemuan = pertemuanDataMap.get(id);
    if (!pertemuan) return;
    
    let html = `
        <div class="detail-section">
            <h4>Informasi Pertemuan</h4>
            <table class="detail-info-table">
                <tr><th>Nama Pertemuan</th><td>${escapeHtml(pertemuan.nama_pertemuan)}</td></tr>
                <tr><th>Pertemuan Ke-</th><td>${escapeHtml(pertemuan.pertemuan_ke)}</td></tr>
                <tr><th>Deskripsi</th><td>${escapeHtml(pertemuan.deskripsi_pertemuan || '-')}</td></tr>
            </table>
        </div>
    `;
    
    if (pertemuan.jadwal) {
        html += `<div class="detail-section"><h4>📅 Jadwal</h4><p>${escapeHtml(pertemuan.jadwal.hari)} - ${escapeHtml(pertemuan.jadwal.jam_mulai)}</p></div>`;
    }
    
    if (pertemuan.modul) {
        html += `<div class="detail-section"><h4>📖 Modul</h4><p>${escapeHtml(pertemuan.modul.judul_modul)}</p></div>`;
    }
    
    document.getElementById('detailContent').innerHTML = html;
    document.getElementById('detailModal').style.display = 'flex';
}

function escapeHtml(str) {
    if (!str) return '';
    return String(str).replace(/[&<>]/g, function(m) {
        if (m === '&') return '&amp;';
        if (m === '<') return '&lt;';
        if (m === '>') return '&gt;';
        return m;
    });
}

window.onclick = function(event) {
    if (event.target.classList && event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}