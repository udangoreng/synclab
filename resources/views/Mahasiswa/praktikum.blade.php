<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>My Praktikum | Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg: #f0f4f8;
            --surface: #ffffff;
            --border: #e2e8f0;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --blue: #3b82f6;
            --blue-dark: #2563eb;
            --blue-light: #eff6ff;
            --green: #10b981;
            --green-light: #dcfce7;
            --green-text: #15803d;
            --amber: #f59e0b;
            --amber-light: #fef3c7;
            --amber-text: #b45309;
            --slate: #64748b;
            --slate-light: #f1f5f9;
            --red: #ef4444;
            --red-light: #fee2e2;
            --red-text: #dc2626;
            --radius-sm: 8px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --radius-full: 9999px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
            --shadow-md: 0 4px 16px rgba(0,0,0,0.07);
            --shadow-lg: 0 10px 32px rgba(0,0,0,0.1);
        }

        body {
            background: var(--bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-primary);
            font-size: 14px;
            line-height: 1.6;
        }

        .dashboard-container { display: flex; min-height: 100vh; }
        .main-content { flex: 1; padding: 32px 36px; min-width: 0; overflow-x: hidden; }

        /* ── Page Header ── */
        .page-header { margin-bottom: 28px; }
        .page-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .page-title .title-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            border-radius: var(--radius-md);
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 18px;
        }
        .page-subtitle {
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-top: 4px;
            margin-left: 56px;
        }

        /* ── Tab Navigation ── */
        .tab-nav {
            display: flex;
            gap: 4px;
            background: var(--surface);
            border-radius: var(--radius-full);
            padding: 5px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            margin-bottom: 28px;
            width: fit-content;
        }
        .tab-btn {
            padding: 9px 24px;
            background: transparent;
            border: none;
            border-radius: var(--radius-full);
            font-size: 0.84rem;
            font-weight: 600;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 7px;
            white-space: nowrap;
            font-family: inherit;
        }
        .tab-btn .tab-count {
            background: var(--slate-light);
            color: var(--text-secondary);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 1px 7px;
            border-radius: var(--radius-full);
            transition: all 0.2s;
        }
        .tab-btn.active {
            background: var(--blue);
            color: white;
            box-shadow: 0 4px 12px rgba(59,130,246,0.3);
        }
        .tab-btn.active .tab-count {
            background: rgba(255,255,255,0.25);
            color: white;
        }
        .tab-btn:hover:not(.active) {
            background: var(--slate-light);
            color: var(--text-primary);
        }

        .tab-content { display: none; animation: fadeIn 0.25s ease; }
        .tab-content.active { display: block; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Schedule Cards Grid ── */
        .schedules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 16px;
        }

        .schedule-card {
            background: var(--surface);
            border-radius: var(--radius-lg);
            border: 1.5px solid var(--border);
            overflow: hidden;
            transition: all 0.22s ease;
            box-shadow: var(--shadow-sm);
        }
        .schedule-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
            border-color: var(--blue);
        }

        .card-top {
            padding: 18px 20px 14px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }
        .card-icon {
            width: 48px; height: 48px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            color: white;
            flex-shrink: 0;
        }
        .card-meta { flex: 1; min-width: 0; }
        .card-praktikum {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
        }
        .card-pertemuan {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-primary);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .card-badge {
            padding: 4px 10px;
            border-radius: var(--radius-full);
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            white-space: nowrap;
        }
        .badge-open   { background: var(--green-light); color: var(--green-text); }
        .badge-upcoming { background: var(--amber-light); color: var(--amber-text); }
        .badge-done   { background: var(--slate-light); color: var(--slate); }
        .badge-full   { background: var(--red-light); color: var(--red-text); }

        .card-details { padding: 14px 20px; }
        .detail-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 4px 0;
            font-size: 0.82rem;
            color: var(--text-secondary);
        }
        .detail-item i {
            width: 15px;
            color: var(--blue);
            font-size: 0.75rem;
            flex-shrink: 0;
        }

        .quota-bar-wrap { margin-top: 12px; }
        .quota-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .quota-label .q-text { color: var(--text-secondary); }
        .quota-label .q-num { color: var(--text-primary); }
        .quota-bar {
            height: 5px;
            background: var(--slate-light);
            border-radius: var(--radius-full);
            overflow: hidden;
        }
        .quota-fill {
            height: 100%;
            border-radius: var(--radius-full);
            transition: width 0.5s ease;
        }
        .fill-ok   { background: var(--green); }
        .fill-warn { background: var(--amber); }
        .fill-full { background: var(--red); }

        .card-footer { padding: 12px 20px; border-top: 1px solid var(--border); }
        .btn-register {
            width: 100%;
            padding: 11px;
            border: none;
            border-radius: var(--radius-full);
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            font-family: inherit;
        }
        .btn-register.can-register {
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            color: white;
            box-shadow: 0 4px 12px rgba(59,130,246,0.25);
        }
        .btn-register.can-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(59,130,246,0.35);
        }
        .btn-register.registered {
            background: var(--green-light);
            color: var(--green-text);
            cursor: default;
        }
        .btn-register.full {
            background: var(--red-light);
            color: var(--red-text);
            cursor: not-allowed;
        }
        .btn-register.completed-btn {
            background: var(--slate-light);
            color: var(--slate);
            cursor: default;
        }
        .btn-register.upcoming-btn {
            background: var(--amber-light);
            color: var(--amber-text);
            cursor: default;
        }

        /* ── Empty State ── */
        .empty-state {
            text-align: center;
            padding: 64px 24px;
            color: var(--text-secondary);
        }
        .empty-icon {
            width: 72px; height: 72px;
            background: var(--slate-light);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 28px;
            color: var(--text-muted);
            margin: 0 auto 16px;
        }
        .empty-state h3 { font-size: 1rem; font-weight: 700; color: var(--text-primary); margin-bottom: 6px; }
        .empty-state p  { font-size: 0.83rem; }

        /* ── Confirmation Modal ── */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15,23,42,0.5);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(4px);
        }
        .modal.active { display: flex; }

        .modal-box {
            background: var(--surface);
            border-radius: var(--radius-lg);
            width: 90%;
            max-width: 480px;
            max-height: 90vh;
            overflow-y: auto;
            animation: modalIn 0.25s cubic-bezier(0.34,1.56,0.64,1);
            box-shadow: var(--shadow-lg);
        }
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.9) translateY(20px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }

        .modal-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
        }
        .modal-head h3 {
            font-size: 1.05rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-primary);
        }
        .modal-head h3 i { color: var(--blue); }
        .modal-close-btn {
            background: var(--slate-light);
            border: none;
            width: 30px; height: 30px;
            border-radius: 50%;
            cursor: pointer;
            color: var(--text-secondary);
            font-size: 14px;
            display: flex; align-items: center; justify-content: center;
            transition: 0.2s;
        }
        .modal-close-btn:hover { background: var(--red-light); color: var(--red); }

        .modal-body { padding: 22px 24px; }

        .confirm-summary {
            background: var(--blue-light);
            border: 1px solid #bfdbfe;
            border-radius: var(--radius-md);
            padding: 16px;
            margin-bottom: 18px;
        }
        .confirm-summary .cs-title {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--blue-dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }
        .cs-row {
            display: flex;
            gap: 8px;
            padding: 5px 0;
            font-size: 0.82rem;
            border-bottom: 1px solid #bfdbfe;
        }
        .cs-row:last-child { border-bottom: none; }
        .cs-label { width: 110px; font-weight: 600; color: var(--blue-dark); flex-shrink: 0; }
        .cs-val   { color: var(--text-primary); }

        .confirm-note {
            font-size: 0.8rem;
            color: var(--text-secondary);
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }
        .confirm-note i { color: var(--amber); margin-top: 2px; flex-shrink: 0; }

        .modal-foot {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 16px 24px;
            border-top: 1px solid var(--border);
        }
        .btn-cancel-modal {
            padding: 9px 22px;
            background: var(--slate-light);
            border: none;
            border-radius: var(--radius-full);
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            color: var(--text-secondary);
            font-family: inherit;
            transition: 0.2s;
        }
        .btn-cancel-modal:hover { background: var(--border); }
        .btn-confirm {
            padding: 9px 22px;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            border: none;
            border-radius: var(--radius-full);
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            color: white;
            font-family: inherit;
            transition: 0.2s;
            display: flex; align-items: center; gap: 7px;
        }
        .btn-confirm:hover { box-shadow: 0 4px 12px rgba(59,130,246,0.4); }
        .btn-confirm:disabled { opacity: 0.6; cursor: not-allowed; }

        /* ── Toast ── */
        .toast-container {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .toast {
            background: var(--text-primary);
            color: white;
            padding: 13px 18px;
            border-radius: var(--radius-md);
            font-size: 0.84rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 280px;
            box-shadow: var(--shadow-lg);
            animation: toastIn 0.3s ease;
        }
        .toast.success { background: #064e3b; border-left: 3px solid var(--green); }
        .toast.error   { background: #7f1d1d; border-left: 3px solid var(--red); }
        @keyframes toastIn {
            from { opacity: 0; transform: translateX(40px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .dashboard-container { flex-direction: column; }
            .main-content { padding: 20px 16px; }
            .page-title { font-size: 1.4rem; }
            .page-subtitle { margin-left: 0; }
            .tab-nav { width: 100%; flex-wrap: wrap; }
            .schedules-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    @include('mahasiswa/partials/sidebar')

    <main class="main-content">
        <div class="page-header">
            <h1 class="page-title">
                <span class="title-icon"><i class="fas fa-flask"></i></span>
                My Praktikum
            </h1>
            <p class="page-subtitle">Lihat dan daftarkan diri ke jadwal praktikum yang tersedia</p>
        </div>

        {{-- ── Tab Navigation ── --}}
        <div class="tab-nav">
            <button class="tab-btn active" data-tab="active">
                <i class="fas fa-door-open"></i> Active
                <span class="tab-count" id="count-active">0</span>
            </button>
            <button class="tab-btn" data-tab="upcoming">
                <i class="fas fa-calendar-alt"></i> Upcoming
                <span class="tab-count" id="count-upcoming">0</span>
            </button>
            <button class="tab-btn" data-tab="completed">
                <i class="fas fa-check-double"></i> Completed
                <span class="tab-count" id="count-completed">0</span>
            </button>
        </div>

        {{-- ── Tab: Active ── --}}
        <div id="tab-active" class="tab-content active">
            <div class="schedules-grid" id="grid-active"></div>
        </div>

        {{-- ── Tab: Upcoming ── --}}
        <div id="tab-upcoming" class="tab-content">
            <div class="schedules-grid" id="grid-upcoming"></div>
        </div>

        {{-- ── Tab: Completed ── --}}
        <div id="tab-completed" class="tab-content">
            <div class="schedules-grid" id="grid-completed"></div>
        </div>
    </main>
</div>

{{-- ── Confirmation Modal ── --}}
<div class="modal" id="confirmModal">
    <div class="modal-box">
        <div class="modal-head">
            <h3><i class="fas fa-calendar-check"></i> Konfirmasi Pendaftaran</h3>
            <button class="modal-close-btn" id="closeConfirmModal"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="confirm-summary">
                <div class="cs-title"><i class="fas fa-info-circle"></i> Detail Jadwal</div>
                <div id="confirmDetails"></div>
            </div>
            <div class="confirm-note">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Anda hanya dapat mendaftar ke <strong>1 jadwal per pertemuan</strong>. Pastikan jadwal ini sesuai dengan ketersediaan Anda.</span>
            </div>
        </div>
        <div class="modal-foot">
            <button class="btn-cancel-modal" id="cancelConfirm">Batal</button>
            <button class="btn-confirm" id="submitDaftar">
                <i class="fas fa-check"></i> Daftar Sekarang
            </button>
        </div>
    </div>
</div>

{{-- ── Toast Container ── --}}
<div class="toast-container" id="toastContainer"></div>

{{-- ── Data from Server ── --}}
@php
    $currentUserId = Auth::id();

    // Kumpulkan semua jadwal yang sudah didaftar user ini (id_pertemuan => id_jadwal)
    $userRegistrations = \App\Models\PendaftaranPraktikum::where('id_user', $currentUserId)
        ->with('jadwal')
        ->get()
        ->mapWithKeys(fn($p) => [$p->jadwal->id_pertemuan => $p->id_jadwal])
        ->toArray();

    // Ambil semua jadwal dengan relasi lengkap
    $allJadwals = \App\Models\Jadwal::with([
        'praktikum',
        'dosen',
        'pertemuan.modul',
        'laboratorium',
        'pendaftarans',
    ])->get();

    $now = \Carbon\Carbon::now();

    $jadwalActive    = [];
    $jadwalUpcoming  = [];
    $jadwalCompleted = [];

    foreach ($allJadwals as $j) {
        $tanggal  = $j->tanggal;
        $status   = $j->status;
        $terisi   = $j->pendaftarans ? $j->pendaftarans->count() : 0;
        $maks     = $j->jumlah_max_peserta ?? 0;
        $isFull   = $maks > 0 && $terisi >= $maks;
        $isFullStatus = $status === 'Penuh';

        $idPertemuan = $j->id_pertemuan;
        $isRegistered = isset($userRegistrations[$idPertemuan]) && $userRegistrations[$idPertemuan] === $j->id;
        $hasOtherOnPertemuan = isset($userRegistrations[$idPertemuan]) && !$isRegistered;

        $item = [
            'id'            => $j->id,
            'id_pertemuan'  => $idPertemuan,
            'praktikum'     => $j->praktikum?->nama_praktikum ?? '-',
            'kode'          => $j->praktikum?->kode_praktikum ?? '-',
            'pertemuan'     => $j->pertemuan?->nama_pertemuan ?? '-',
            'pertemuan_ke'  => $j->pertemuan?->pertemuan_ke ?? 0,
            'materi'        => $j->pertemuan?->modul?->judul_modul ?? $j->pertemuan?->deskripsi_pertemuan ?? '-',
            'dosen'         => $j->dosen?->nama ?? '-',
            'lab'           => $j->laboratorium?->nama_laboratorium ?? '-',
            'tanggal'       => $tanggal ? $tanggal->format('l, d M Y') : '-',
            'jam'           => ($j->jam_mulai ?? '-') . ' – ' . ($j->jam_selesai ?? '-'),
            'terisi'        => $terisi,
            'maks'          => $maks,
            'status'        => $status,
            'is_full'       => $isFull || $isFullStatus,
            'is_registered' => $isRegistered,
            'has_other'     => $hasOtherOnPertemuan,
        ];

        if ($status === 'Selesai') {
            $jadwalCompleted[] = $item;
        } elseif ($status === 'Dibuka' || $status === 'Penuh') {
            if ($tanggal && $tanggal->diffInDays($now, false) >= -7) {
                $jadwalActive[] = $item;
            } else {
                $jadwalUpcoming[] = $item;
            }
        } else {
            $jadwalUpcoming[] = $item;
        }
    }
@endphp

<script>
(function () {
    const jadwalActive    = @json($jadwalActive);
    const jadwalUpcoming  = @json($jadwalUpcoming);
    const jadwalCompleted = @json($jadwalCompleted);

    let pendingJadwal = null;

    const iconColors = [
        'linear-gradient(135deg,#3b82f6,#1e40af)',
        'linear-gradient(135deg,#10b981,#065f46)',
        'linear-gradient(135deg,#f59e0b,#92400e)',
        'linear-gradient(135deg,#8b5cf6,#5b21b6)',
        'linear-gradient(135deg,#ef4444,#991b1b)',
        'linear-gradient(135deg,#06b6d4,#0e7490)',
        'linear-gradient(135deg,#ec4899,#9d174d)',
        'linear-gradient(135deg,#14b8a6,#0f766e)',
    ];
    const iconClasses = [
        'fa-code','fa-database','fa-network-wired','fa-desktop',
        'fa-layer-group','fa-image','fa-microchip','fa-cogs',
    ];

    function colorFor(idx) { return iconColors[idx % iconColors.length]; }
    function iconFor(idx)  { return iconClasses[idx % iconClasses.length]; }

    function quotaColor(terisi, maks) {
        if (!maks) return 'fill-ok';
        const pct = terisi / maks;
        if (pct >= 1)   return 'fill-full';
        if (pct >= 0.8) return 'fill-warn';
        return 'fill-ok';
    }

    function renderCard(item, idx, type) {
        const isFull       = item.is_full;
        const isRegistered = item.is_registered;
        const isCompleted  = type === 'completed';
        const isUpcoming   = type === 'upcoming';

        let badgeHtml, btnHtml;

        if (isCompleted) {
            badgeHtml = `<span class="card-badge badge-done">Selesai</span>`;
            btnHtml   = `<button class="btn-register completed-btn" disabled><i class="fas fa-flag-checkered"></i> Praktikum Selesai</button>`;
        } else if (isUpcoming) {
            badgeHtml = `<span class="card-badge badge-upcoming">Akan Datang</span>`;
            btnHtml   = `<button class="btn-register upcoming-btn" disabled><i class="fas fa-clock"></i> Belum Dibuka</button>`;
        } else if (isRegistered) {
            badgeHtml = `<span class="card-badge badge-open">Terdaftar ✓</span>`;
            btnHtml   = `<button class="btn-register registered" disabled><i class="fas fa-check-circle"></i> Sudah Terdaftar</button>`;
        } else if (isFull) {
            badgeHtml = `<span class="card-badge badge-full">Penuh</span>`;
            btnHtml   = `<button class="btn-register full" disabled><i class="fas fa-ban"></i> Kuota Penuh</button>`;
        } else if (item.has_other) {
            badgeHtml = `<span class="card-badge badge-open">Dibuka</span>`;
            btnHtml   = `<button class="btn-register full" disabled><i class="fas fa-minus-circle"></i> Sudah Daftar Pertemuan Ini</button>`;
        } else {
            badgeHtml = `<span class="card-badge badge-open">Dibuka</span>`;
            btnHtml   = `<button class="btn-register can-register" data-id="${item.id}" onclick="openConfirm(${JSON.stringify(item).replace(/"/g, '&quot;')})">
                            <i class="fas fa-plus-circle"></i> Daftar Sekarang
                         </button>`;
        }

        const pct = item.maks > 0 ? Math.min(100, Math.round(item.terisi / item.maks * 100)) : 0;

        return `
        <div class="schedule-card">
            <div class="card-top">
                <div class="card-icon" style="background:${colorFor(idx)}">
                    <i class="fas ${iconFor(item.pertemuan_ke || idx)}"></i>
                </div>
                <div class="card-meta">
                    <div class="card-praktikum">${item.praktikum} · ${item.kode}</div>
                    <div class="card-pertemuan">${item.pertemuan}</div>
                </div>
                ${badgeHtml}
            </div>
            <div class="card-details">
                <div class="detail-item"><i class="fas fa-book-open"></i> ${item.materi}</div>
                <div class="detail-item"><i class="fas fa-user-tie"></i> ${item.dosen}</div>
                <div class="detail-item"><i class="fas fa-flask"></i> ${item.lab}</div>
                <div class="detail-item"><i class="far fa-calendar-alt"></i> ${item.tanggal}</div>
                <div class="detail-item"><i class="far fa-clock"></i> ${item.jam}</div>
                ${item.maks > 0 ? `
                <div class="quota-bar-wrap">
                    <div class="quota-label">
                        <span class="q-text">Kuota Terisi</span>
                        <span class="q-num">${item.terisi} / ${item.maks}</span>
                    </div>
                    <div class="quota-bar">
                        <div class="quota-fill ${quotaColor(item.terisi, item.maks)}" style="width:${pct}%"></div>
                    </div>
                </div>` : ''}
            </div>
            <div class="card-footer">${btnHtml}</div>
        </div>`;
    }

    function renderGrid(gridId, data, type, countId) {
        const grid = document.getElementById(gridId);
        document.getElementById(countId).textContent = data.length;
        if (!data.length) {
            const msgs = {
                active:    ['Tidak Ada Jadwal Aktif', 'Jadwal yang sedang dibuka akan muncul di sini.'],
                upcoming:  ['Tidak Ada Jadwal Mendatang', 'Jadwal yang akan datang akan muncul di sini.'],
                completed: ['Belum Ada Jadwal Selesai', 'Riwayat praktikum yang selesai akan muncul di sini.'],
            };
            const [h, p] = msgs[type] || ['Tidak Ada Data', ''];
            grid.innerHTML = `
                <div class="empty-state" style="grid-column:1/-1">
                    <div class="empty-icon"><i class="fas fa-calendar-xmark"></i></div>
                    <h3>${h}</h3><p>${p}</p>
                </div>`;
            return;
        }
        grid.innerHTML = data.map((item, i) => renderCard(item, i, type)).join('');
    }

    window.openConfirm = function(item) {
        pendingJadwal = item;
        document.getElementById('confirmDetails').innerHTML = `
            <div class="cs-row"><span class="cs-label">Praktikum</span><span class="cs-val">${item.praktikum}</span></div>
            <div class="cs-row"><span class="cs-label">Pertemuan</span><span class="cs-val">${item.pertemuan}</span></div>
            <div class="cs-row"><span class="cs-label">Materi</span><span class="cs-val">${item.materi}</span></div>
            <div class="cs-row"><span class="cs-label">Dosen</span><span class="cs-val">${item.dosen}</span></div>
            <div class="cs-row"><span class="cs-label">Laboratorium</span><span class="cs-val">${item.lab}</span></div>
            <div class="cs-row"><span class="cs-label">Tanggal</span><span class="cs-val">${item.tanggal}</span></div>
            <div class="cs-row"><span class="cs-label">Waktu</span><span class="cs-val">${item.jam}</span></div>
            <div class="cs-row"><span class="cs-label">Sisa Kuota</span><span class="cs-val">${item.maks - item.terisi} dari ${item.maks}</span></div>
        `;
        document.getElementById('confirmModal').classList.add('active');
    };

    function showToast(msg, type = 'success') {
        const icon = type === 'success' ? 'fa-check-circle' : 'fa-times-circle';
        const t = document.createElement('div');
        t.className = `toast ${type}`;
        t.innerHTML = `<i class="fas ${icon}"></i> ${msg}`;
        document.getElementById('toastContainer').appendChild(t);
        setTimeout(() => t.remove(), 4000);
    }

    document.getElementById('submitDaftar').addEventListener('click', function () {
        if (!pendingJadwal) return;
        this.disabled = true;
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mendaftar...';

        fetch('/mahasiswa/praktikum/daftar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    || '{{ csrf_token() }}',
            },
            body: JSON.stringify({ id_jadwal: pendingJadwal.id }),
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('confirmModal').classList.remove('active');
            if (data.success) {
                showToast('Pendaftaran berhasil! Silakan cek halaman Pendaftaran Saya.', 'success');
                setTimeout(() => location.reload(), 1500);
            } else {
                showToast(data.message || 'Gagal mendaftar. Coba lagi.', 'error');
            }
        })
        .catch(() => showToast('Terjadi kesalahan jaringan.', 'error'))
        .finally(() => {
            this.disabled = false;
            this.innerHTML = '<i class="fas fa-check"></i> Daftar Sekarang';
        });
    });

    function closeConfirm() {
        document.getElementById('confirmModal').classList.remove('active');
        pendingJadwal = null;
    }

    document.getElementById('closeConfirmModal').addEventListener('click', closeConfirm);
    document.getElementById('cancelConfirm').addEventListener('click', closeConfirm);
    window.addEventListener('click', e => { if (e.target.id === 'confirmModal') closeConfirm(); });

    // Tab switching
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById('tab-' + btn.dataset.tab).classList.add('active');
        });
    });

    // Mobile sidebar
    const mobileToggle = document.getElementById('mobileMenuToggle');
    const sidebarNav   = document.getElementById('sidebarNav');
    if (mobileToggle && sidebarNav) {
        mobileToggle.addEventListener('click', () => {
            sidebarNav.classList.toggle('active');
            const icon = mobileToggle.querySelector('i');
            icon?.classList.toggle('fa-bars');
            icon?.classList.toggle('fa-times');
        });
    }

    // Render all grids
    renderGrid('grid-active',    jadwalActive,    'active',    'count-active');
    renderGrid('grid-upcoming',  jadwalUpcoming,  'upcoming',  'count-upcoming');
    renderGrid('grid-completed', jadwalCompleted, 'completed', 'count-completed');
})();
</script>
</body>
</html>