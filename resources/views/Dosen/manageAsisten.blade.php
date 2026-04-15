<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Kelola Asisten | Portal Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
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
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #1e293b;
        }

        .add-btn {
            padding: 12px 24px;
            background: linear-gradient(135deg, #818cf8, #c084fc);
            border: none;
            border-radius: 40px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(129, 140, 248, 0.4);
        }

        .content-card {
            background: white;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8fafc;
        }

        th {
            padding: 16px;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9rem;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #818cf8, #c084fc);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-name {
            font-weight: 500;
            color: #1e293b;
        }

        .user-nim {
            font-size: 0.8rem;
            color: #94a3b8;
        }

        .action-btns {
            display: flex;
            gap: 8px;
        }

        .edit-btn, .delete-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .edit-btn {
            background: #3b82f6;
            color: white;
        }

        .edit-btn:hover {
            background: #2563eb;
        }

        .delete-btn {
            background: #ef4444;
            color: white;
        }

        .delete-btn:hover {
            background: #dc2626;
        }

        .empty-state {
            text-align: center;
            padding: 48px;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 16px;
        }

        .empty-state p {
            font-size: 0.9rem;
        }

        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 24px;
            padding: 32px;
            width: 100%;
            max-width: 480px;
            animation: fadeInUp 0.3s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .modal-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1e293b;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
        }

        .modal-close:hover {
            color: #1e293b;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            transition: 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #818cf8;
            box-shadow: 0 0 0 3px rgba(129, 140, 248, 0.2);
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .cancel-btn {
            padding: 12px 24px;
            background: #f1f5f9;
            border: none;
            border-radius: 40px;
            color: #64748b;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .cancel-btn:hover {
            background: #e2e8f0;
        }

        .save-btn {
            padding: 12px 24px;
            background: linear-gradient(135deg, #818cf8, #c084fc);
            border: none;
            border-radius: 40px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .save-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(129, 140, 248, 0.4);
        }

        .success-message {
            background: #dcfce7;
            color: #16a34a;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-message {
            background: #fee2e2;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 20px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .content-card {
                padding: 16px;
            }

            th, td {
                padding: 12px 8px;
            }

            .action-btns {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        @include('Dosen.partials.sidebar')

        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">
                    <i class="fas fa-user-graduate"></i>
                    Kelola Asisten
                </h1>
                <button class="add-btn" onclick="openModal('add')">
                    <i class="fas fa-plus"></i> Tambah Asisten
                </button>
            </div>

            @if(session('success'))
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            <div class="content-card">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nomor Induk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($asistens as $index => $asisten)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($asisten->nama, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="user-name">{{ $asisten->nama }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $asisten->nomor_induk }}</td>
                                <td>
                                    <div class="action-btns">
                                        <button class="edit-btn" onclick="openModal('edit', {{ $asisten->id }}, '{{ $asisten->nama }}', '{{ $asisten->nomor_induk }}')">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="delete-btn" onclick="confirmDelete({{ $asisten->id }}, '{{ $asisten->nama }}')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="fas fa-user-slash"></i>
                                        <p>Belum ada asisten yang terdaftar</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Add/Edit Modal -->
    <div class="modal-overlay" id="userModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Tambah Asisten</h2>
                <button class="modal-close" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="userForm" method="POST">
                @csrf
                <input type="hidden" id="userId" name="id">

                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" required>
                </div>

                <div class="form-group">
                    <label for="nomor_induk">Nomor Induk</label>
                    <input type="text" id="nomor_induk" name="nomor_induk" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group" id="passwordGroup">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>

                <div class="modal-actions">
                    <button type="button" class="cancel-btn" onclick="closeModal()">Batal</button>
                    <button type="submit" class="save-btn">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Konfirmasi Hapus</h2>
                <button class="modal-close" onclick="closeDeleteModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <p style="margin-bottom: 20px; color: #475569;">Apakah Anda yakin ingin menghapus asisten <strong id="deleteUserName"></strong>?</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-actions">
                    <button type="button" class="cancel-btn" onclick="closeDeleteModal()">Batal</button>
                    <button type="submit" class="delete-btn">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(type, id = null, nama = '', nomor_induk = '') {
            const modal = document.getElementById('userModal');
            const form = document.getElementById('userForm');
            const title = document.getElementById('modalTitle');
            const passwordGroup = document.getElementById('passwordGroup');
            const passwordInput = document.getElementById('password');

            modal.classList.add('active');

            if (type === 'edit') {
                title.textContent = 'Edit Asisten';
                form.action = '/dosen/asisten/' + id;
                document.getElementById('userId').value = id;
                document.getElementById('nama').value = nama;
                document.getElementById('nomor_induk').value = nomor_induk;
                document.getElementById('email').value = '';
                passwordGroup.style.display = 'block';
                passwordInput.required = false;
                
                // Add method field for PUT
                let methodField = document.getElementById('methodField');
                if (!methodField) {
                    methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'PUT';
                    methodField.id = 'methodField';
                    form.appendChild(methodField);
                }
            } else {
                title.textContent = 'Tambah Asisten';
                form.action = '/dosen/asisten';
                form.reset();
                document.getElementById('userId').value = '';
                passwordGroup.style.display = 'block';
                passwordInput.required = true;
                
                // Remove method field for POST
                const methodField = document.getElementById('methodField');
                if (methodField) methodField.remove();
            }
        }

        function closeModal() {
            const modal = document.getElementById('userModal');
            modal.classList.remove('active');
        }

        function confirmDelete(id, nama) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const userName = document.getElementById('deleteUserName');

            form.action = '/dosen/asisten/' + id;
            userName.textContent = nama;
            modal.classList.add('active');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('active');
        }

        // Close modal when clicking outside
        document.getElementById('userModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });
    </script>
</body>

</html>