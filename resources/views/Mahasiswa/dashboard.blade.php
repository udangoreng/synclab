<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Dashboard Mahasiswa | {{ Auth::user()->nama }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f0f4f8;
            font-family: 'Inter', sans-serif;
            color: #1e293b;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        
        .main-content {
            flex: 1;
            padding: 28px 32px;
            overflow-x: auto;
            transition: all 0.3s ease;
        }

        .page-title {
            font-size: 1.9rem;
            font-weight: 700;
            margin-bottom: 24px;
            background: linear-gradient(135deg, #1e293b, #2d3a4b);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .hero-card {
            border-radius: 28px;
            margin-bottom: 32px;
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            background-image: url('https://placehold.co/1200x300/2c3e50/ffffff?text=Lab+Computer+Science');
            background-size: cover;
            background-position: center 30%;
        }

        .hero-overlay {
            background: linear-gradient(95deg, rgba(10, 25, 47, 0.85) 0%, rgba(30, 58, 80, 0.7) 100%);
            backdrop-filter: blur(2px);
            padding: 32px;
        }

        .hero-text h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
        }

        .hero-text p {
            color: #cbd5e6;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .hero-badge {
            background: #facc15;
            color: #1e293b;
            padding: 6px 14px;
            border-radius: 40px;
            font-size: 0.7rem;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .two-columns {
            display: flex;
            gap: 28px;
            flex-wrap: wrap;
        }

        .left-col {
            flex: 2;
            min-width: 240px;
        }

        .right-col {
            flex: 1.2;
            min-width: 260px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-radius: 28px;
            padding: 22px 24px;
            margin-bottom: 28px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.03), 0 2px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        .notif-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 18px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .notif-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #4b5563;
            font-weight: 600;
        }

        .greeting-name {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .date-chip {
            font-size: 0.8rem;
            background: #eef2ff;
            padding: 4px 12px;
            border-radius: 40px;
            color: #4338ca;
            display: inline-block;
            margin-top: 6px;
        }

        .notif-list {
            margin-top: 14px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .notif-card {
            background: white;
            border-radius: 20px;
            padding: 14px 18px;
            display: flex;
            gap: 14px;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border-left: 6px solid;
        }

        .notif-card.info {
            border-left-color: #3b82f6;
            background: #f0f9ff;
        }

        .notif-card.warning {
            border-left-color: #f59e0b;
            background: #fffbeb;
        }

        .notif-card.success {
            border-left-color: #10b981;
            background: #ecfdf5;
        }

        .notif-icon {
            font-size: 1.5rem;
        }

        .notif-text {
            font-size: 0.85rem;
            font-weight: 500;
            line-height: 1.4;
        }

        .section-title {
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .praktikum-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 18px;
        }

        .course-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            transition: 0.25s ease;
            box-shadow: 0 10px 20px -5px rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }

        .course-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.15);
        }

        .course-img {
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .course-card p {
            padding: 12px 8px;
            font-weight: 600;
            text-align: center;
            font-size: 0.85rem;
            background: white;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .card-header h3 {
            font-weight: 700;
            display: flex;
            gap: 8px;
        }

        .see-all-link {
            font-size: 0.75rem;
            font-weight: 600;
            color: #4f46e5;
            text-decoration: none;
        }

        .reminder-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 6px;
        }

        .reminder-card {
            background: linear-gradient(115deg, #ffffff, #f8fafc);
            border-radius: 18px;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 14px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
            border: 1px solid #eef2ff;
            transition: all 0.2s;
        }

        .reminder-card:hover {
            background: white;
            transform: scale(1.01);
            border-color: #c7d2fe;
        }

        .reminder-icon {
            width: 42px;
            height: 42px;
            background: #eef2ff;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #4f46e5;
            flex-shrink: 0;
        }

        .reminder-detail {
            flex: 1;
        }

        .reminder-title {
            font-weight: 700;
            font-size: 0.95rem;
        }

        .reminder-time {
            font-size: 0.7rem;
            color: #6b7280;
        }

        .task-list {
            margin-top: 14px;
        }

        .task-item {
            background: white;
            border-radius: 18px;
            padding: 12px 16px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 14px;
            transition: 0.2s;
            border: 1px solid #e2e8f0;
            cursor: pointer;
            flex-wrap: wrap;
        }

        .task-item input {
            width: 20px;
            height: 20px;
            accent-color: #4f46e5;
            cursor: pointer;
            flex-shrink: 0;
        }

        .task-text {
            font-weight: 500;
            flex: 1;
            word-break: break-word;
        }

        .task-item.done .task-text {
            text-decoration: line-through;
            color: #94a3b8;
        }

        .task-badge {
            font-size: 0.7rem;
            background: #f1f5f9;
            padding: 4px 12px;
            border-radius: 40px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .task-badge.not-done {
            background: #fee2e2;
            color: #dc2626;
        }

        .task-badge.done-badge {
            background: #dcfce7;
            color: #16a34a;
        }

        .progress-footer {
            margin-top: 16px;
            font-size: 0.7rem;
            background: #f1f5f9;
            border-radius: 40px;
            padding: 6px 12px;
            text-align: center;
        }

        @media (max-width: 1024px) {
            .main-content {
                padding: 24px;
            }

            .page-title {
                font-size: 1.6rem;
            }

            .hero-text h2 {
                font-size: 1.5rem;
            }

            .praktikum-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                gap: 14px;
            }

            .course-img {
                height: 90px;
            }

            .course-img i {
                font-size: 2rem !important;
            }

            .glass-card {
                padding: 18px 20px;
            }
        }

        @media (max-width: 768px) {
            .dashboard-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding-bottom: 0;
            }

            .sidebar-header {
                padding: 16px 20px;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .sidebar-nav {
                display: none;
                padding: 0 20px 20px 20px;
            }

            .sidebar-nav.active {
                display: flex;
            }

            .profile-section {
                flex-direction: row;
                text-align: left;
                gap: 16px;
                margin-bottom: 0;
            }

            .avatar-circle {
                width: 60px;
                height: 60px;
                margin: 0;
            }

            .avatar-circle i {
                font-size: 30px;
            }

            .profile-info h3 {
                font-size: 1.1rem;
            }

            .profile-info p {
                font-size: 0.65rem;
            }

            .nav-menu {
                margin-top: 20px;
            }

            .nav-item {
                padding: 10px 14px;
                font-size: 0.9rem;
            }

            .main-content {
                padding: 20px;
            }

            .page-title {
                font-size: 1.4rem;
                margin-bottom: 16px;
                justify-content: center;
                width: 100%;
                text-align: center;
            }

            .hero-card {
                margin-bottom: 24px;
            }

            .hero-overlay {
                padding: 24px;
            }

            .hero-text h2 {
                font-size: 1.2rem;
            }

            .hero-text p {
                font-size: 0.75rem;
            }

            .two-columns {
                gap: 20px;
            }

            .glass-card {
                padding: 16px;
                margin-bottom: 20px;
            }

            .greeting-name {
                font-size: 1.2rem;
            }

            .notif-card {
                padding: 12px 14px;
            }

            .notif-icon {
                font-size: 1.2rem;
            }

            .notif-text {
                font-size: 0.75rem;
            }

            .section-title {
                font-size: 1.1rem;
                margin-bottom: 16px;
            }

            .card-header h3 {
                font-size: 1rem;
            }
        }

        @media (max-width: 600px) {
            .main-content {
                padding: 16px;
            }

            .page-title {
                font-size: 1.3rem;
            }

            .hero-overlay {
                padding: 20px;
            }

            .hero-text h2 {
                font-size: 1rem;
            }

            .hero-badge {
                font-size: 0.6rem;
                padding: 4px 10px;
            }

            .praktikum-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .course-img {
                height: 80px;
            }

            .course-img i {
                font-size: 1.5rem !important;
            }

            .course-card p {
                font-size: 0.7rem;
                padding: 8px 4px;
            }

            .glass-card {
                padding: 14px;
                border-radius: 20px;
            }

            .reminder-card {
                padding: 10px 12px;
                gap: 10px;
            }

            .reminder-icon {
                width: 36px;
                height: 36px;
                font-size: 1rem;
            }

            .reminder-title {
                font-size: 0.85rem;
            }

            .task-item {
                padding: 10px 12px;
                gap: 10px;
            }

            .task-text {
                font-size: 0.8rem;
            }

            .task-badge {
                font-size: 0.6rem;
                padding: 3px 8px;
            }
        }

        @media (max-width: 480px) {
            .praktikum-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .course-img {
                height: 70px;
            }

            .notif-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .reminder-card {
                flex-direction: column;
                text-align: center;
            }

            .reminder-icon {
                margin: 0 auto;
            }

            .task-item {
                flex-wrap: wrap;
            }

            .task-badge {
                margin-left: 34px;
            }
        }

        @media (min-width: 1200px) {
            .praktikum-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (hover: none) and (pointer: coarse) {

            .nav-item,
            .course-card,
            .task-item,
            .reminder-card,
            .logout-btn {
                cursor: pointer;
                -webkit-tap-highlight-color: transparent;
            }

            .nav-item:active,
            .course-card:active {
                transform: scale(0.98);
                transition: 0.05s;
            }
        }
    </style>

    <div class="dashboard-container">
        @include('mahasiswa/partials/sidebar')

        <main class="main-content">
            <h1 class="page-title"><i class="fas fa-chart-simple"></i> Dashboard</h1>

            <div class="hero-card">
                <div class="hero-overlay">
                    <div class="hero-text">
                        <h2 id="topGreetingText">Selamat Siang, Caca! 👋</h2>
                        <p>
                            <span id="fullDateDisplay"></span>
                            <span class="hero-badge"><i class="fas fa-chalkboard"></i> Semester Genap 2025/2026</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="two-columns">
                <div class="left-col">
                    <div class="glass-card">
                        <div class="notif-header">
                            <div>
                                <p class="notif-title"><i class="far fa-bell"></i> NOTIFIKASI</p>
                                <div class="greeting-name" id="greetingName"></div>
                                <div class="date-chip" id="todayDateChip"></div>
                            </div>
                        </div>
                        <div class="notif-list">
                            <div class="notif-card info">
                                <div class="notif-icon">📅</div>
                                <div class="notif-text"><b>Praktikum Jaringan Komputer</b> hari ini pukul 13:00 WIB (Lab
                                    Jaringan)</div>
                            </div>
                            <div class="notif-card warning">
                                <div class="notif-icon">⚠️</div>
                                <div class="notif-text"><b>RPL - Pretest</b> deadline besok, 14:00 WIB!</div>
                            </div>
                            <div class="notif-card success">
                                <div class="notif-icon">✅</div>
                                <div class="notif-text">Jangan lupa isi presensi setelah praktikum & upload laporan.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card">
                        <div class="section-title">
                            <i class="fas fa-microscope"></i> All Praktikum
                        </div>
                        <div class="praktikum-grid">
                            <div class="course-card">
                                <div class="course-img" style="background: linear-gradient(145deg, #3b82f6, #1e40af);">
                                    <i class="fas fa-code fa-3x"></i>
                                </div>
                                <p>Pemrograman Dasar</p>
                            </div>
                            <div class="course-card">
                                <div class="course-img" style="background: linear-gradient(145deg, #14b8a6, #0f766e);">
                                    <i class="fas fa-layer-group fa-3x"></i>
                                </div>
                                <p>Struktur Data</p>
                            </div>
                            <div class="course-card">
                                <div class="course-img" style="background: linear-gradient(145deg, #3b82f6, #1e40af);">
                                    <i class="fas fa-database fa-3x"></i>
                                </div>
                                <p>Basis Data</p>
                            </div>
                            <div class="course-card">
                                <div class="course-img" style="background: linear-gradient(145deg, #10b981, #047857);">
                                    <i class="fas fa-network-wired fa-3x"></i>
                                </div>
                                <p>Jaringan Komputer</p>
                            </div>
                            <div class="course-card">
                                <div class="course-img" style="background: linear-gradient(145deg, #ef4444, #b91c1c);">
                                    <i class="fas fa-desktop fa-3x"></i>
                                </div>
                                <p>Sistem Operasi</p>
                            </div>
                            <div class="course-card">
                                <div class="course-img" style="background: linear-gradient(145deg, #8b5cf6, #5b21b6);">
                                    <i class="fas fa-image fa-3x"></i>
                                </div>
                                <p>Pengolahan Citra Digital</p>
                            </div>
                            <div class="course-card">
                                <div class="course-img"
                                    style="background: linear-gradient(145deg, #ec489a, #be185d);">
                                    <i class="fas fa-microchip fa-3x"></i>
                                </div>
                                <p>Internet of Things (IoT)</p>
                            </div>
                            <div class="course-card">
                                <div class="course-img"
                                    style="background: linear-gradient(145deg, #f59e0b, #b45309);">
                                    <i class="fas fa-code-branch fa-3x"></i>
                                </div>
                                <p>Rekayasa Perangkat Lunak (RPL)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="right-col">
                    <!-- REMINDER -->
                    <div class="glass-card">
                        <div class="card-header">
                            <h3><i class="fas fa-clock"></i> Reminder</h3>
                            <a href="#" class="see-all-link" id="seeAllReminder">See All <i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="reminder-list" id="reminderContainer"></div>
                    </div>

                    <div class="glass-card">
                        <h3><i class="fas fa-tasks"></i> Assignments</h3>
                        <div id="assignmentsList" class="task-list"></div>
                        <div class="progress-footer" id="progressHint">✔️ Selesaikan tugas sebelum deadline</div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        (function() {

            const profileName = `{{Auth::user()->nama}}`;

            const now = new Date();
            const hour = now.getHours();
            let greetingTime = "Selamat pagi";
            if (hour >= 12 && hour < 18) greetingTime = "Selamat siang";
            else if (hour >= 18) greetingTime = "Selamat malam";

            const topGreetingSpan = document.getElementById("topGreetingText");
            if (topGreetingSpan) topGreetingSpan.innerText = `${greetingTime}, ${profileName}! 👋`;

            const greetingNameDiv = document.getElementById("greetingName");
            if (greetingNameDiv) greetingNameDiv.innerText = `${greetingTime}, ${profileName} 👋`;

            const optionsDate = {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            const formattedDate = now.toLocaleDateString('id-ID', optionsDate);
            const fullDateSpan = document.getElementById("fullDateDisplay");
            if (fullDateSpan) fullDateSpan.innerHTML = `<i class="far fa-calendar-alt"></i> ${formattedDate}`;

            const todayChip = document.getElementById("todayDateChip");
            if (todayChip) todayChip.innerText = formattedDate;

            const remindersData = [{
                    icon: "⏰",
                    title: "Jarkom - Praktikum",
                    time: "Hari ini, 13:00 WIB",
                    badge: "Lab Jaringan"
                },
                {
                    icon: "📌",
                    title: "RPL - Pretest",
                    time: "Besok, 14:00 WIB",
                    badge: "Prioritas"
                },
                {
                    icon: "📝",
                    title: "Pretest PCD",
                    time: "Mulai 7 April 2026",
                    badge: "Segera"
                },
                {
                    icon: "📊",
                    title: "Laporan Basis Data",
                    time: "Deadline 10 April",
                    badge: "Belum"
                }
            ];

            const reminderContainer = document.getElementById("reminderContainer");

            function renderReminders() {
                if (!reminderContainer) return;
                reminderContainer.innerHTML = "";
                remindersData.forEach(rem => {
                    const remDiv = document.createElement("div");
                    remDiv.className = "reminder-card";
                    remDiv.innerHTML = `
                        <div class="reminder-icon">${rem.icon}</div>
                        <div class="reminder-detail">
                            <div class="reminder-title">${rem.title}</div>
                            <div class="reminder-time"><i class="far fa-hourglass-half"></i> ${rem.time}</div>
                            <span style="font-size: 0.65rem; background:#eef2ff; padding:2px 8px; border-radius:20px; display:inline-block; margin-top:4px;">${rem.badge}</span>
                        </div>
                    `;
                    reminderContainer.appendChild(remDiv);
                });
            }

            let assignments = [{
                    name: "Laporan Jaringan Komputer",
                    status: "Not Yet"
                },
                {
                    name: "Tugas RPL (Analisis Kebutuhan)",
                    status: "Not Yet"
                },
                {
                    name: "Laporan Basis Data",
                    status: "Done"
                },
                {
                    name: "Pretest PCD - Modul 1",
                    status: "Not Yet"
                }
            ];

            const assignmentsContainer = document.getElementById("assignmentsList");
            const progressHint = document.getElementById("progressHint");

            function renderAssignments() {
                if (!assignmentsContainer) return;
                assignmentsContainer.innerHTML = "";
                let completedCount = 0;
                assignments.forEach((task, idx) => {
                    const isDone = task.status === "Done";
                    const taskItem = document.createElement("label");
                    taskItem.className = `task-item ${isDone ? "done" : ""}`;
                    taskItem.innerHTML = `
                        <input type="checkbox" ${isDone ? "checked" : ""} data-index="${idx}">
                        <span class="task-text">${task.name}</span>
                        <span class="task-badge ${isDone ? 'done-badge' : 'not-done'}">${isDone ? "✓ Done" : "○ Not Yet"}</span>
                    `;
                    assignmentsContainer.appendChild(taskItem);
                    if (isDone) completedCount++;
                });

                if (progressHint) {
                    const total = assignments.length;
                    progressHint.innerHTML =
                        `📋 Progres: ${completedCount}/${total} selesai • ${completedCount === total ? "✨ Selamat semua tugas selesai!" : "Tetap semangat, kerjakan tugas tepat waktu!"}`;
                }

                document.querySelectorAll("#assignmentsList input[type='checkbox']").forEach(cb => {
                    cb.removeEventListener("change", handleTaskToggle);
                    cb.addEventListener("change", handleTaskToggle);
                });
            }

            function handleTaskToggle(e) {
                const checkbox = e.target;
                const idx = checkbox.getAttribute("data-index");
                if (idx !== null && assignments[idx]) {
                    assignments[idx].status = checkbox.checked ? "Done" : "Not Yet";
                    renderAssignments();
                }
            }

            const seeAllBtn = document.getElementById("seeAllReminder");
            if (seeAllBtn) {
                seeAllBtn.addEventListener("click", (e) => {
                    e.preventDefault();
                    alert(
                        "📋 Semua pengingat:\n• Praktikum Jarkom (13:00 WIB)\n• RPL - Pretest (Besok 14:00 WIB)\n• Pretest PCD (Mulai 7 April)\n• Laporan Basis Data (Deadline 10 April)");
                });
            }

            const mobileToggle = document.getElementById("mobileMenuToggle");
            const sidebarNav = document.getElementById("sidebarNav");

            if (mobileToggle && sidebarNav) {
                mobileToggle.addEventListener("click", () => {
                    sidebarNav.classList.toggle("active");
                    const icon = mobileToggle.querySelector("i");
                    if (sidebarNav.classList.contains("active")) {
                        icon.classList.remove("fa-bars");
                        icon.classList.add("fa-times");
                    } else {
                        icon.classList.remove("fa-times");
                        icon.classList.add("fa-bars");
                    }
                });
            }

            const hasSubItems = document.querySelectorAll(".has-sub");
            hasSubItems.forEach(item => {
                const subUl = item.querySelector(".submenu");
                const triggerDiv = item.querySelector(".sub-trigger");

                if (subUl && triggerDiv) {
                    subUl.style.display = "block";

                    triggerDiv.addEventListener("click", (e) => {
                        e.stopPropagation();
                        if (subUl.style.display === "none") {
                            subUl.style.display = "block";
                            const chevron = triggerDiv.querySelector(".fa-chevron-down");
                            if (chevron) chevron.style.transform = "rotate(0deg)";
                        } else {
                            subUl.style.display = "none";
                            const chevron = triggerDiv.querySelector(".fa-chevron-down");
                            if (chevron) chevron.style.transform = "rotate(-90deg)";
                        }
                    });
                }
            });

            const courseCards = document.querySelectorAll(".course-card");
            courseCards.forEach(card => {
                card.addEventListener("click", () => {
                    const courseName = card.querySelector("p")?.innerText || "Praktikum";
                });
            });

            const navItems = document.querySelectorAll(".nav-item");
            navItems.forEach(item => {
                item.addEventListener("click", () => {
                    if (window.innerWidth <= 768 && sidebarNav.classList.contains("active")) {
                        sidebarNav.classList.remove("active");
                        const icon = mobileToggle?.querySelector("i");
                        if (icon) {
                            icon.classList.remove("fa-times");
                            icon.classList.add("fa-bars");
                        }
                    }
                });
            });

            const submenuItems = document.querySelectorAll(".submenu li");
            submenuItems.forEach(item => {
                item.addEventListener("click", (e) => {
                    e.stopPropagation();
                    const text = item.innerText.trim();
                });
            });

            renderReminders();
            renderAssignments();
        })();
    </script>
    </body>

</html>
