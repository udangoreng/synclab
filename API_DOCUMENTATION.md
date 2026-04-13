# API Documentation - CRUD Fitur Nilai, Laboratorium, dan Presensi

## Ringkasan Implementasi

Saya telah membuat fitur CRUD lengkap untuk tiga entitas dengan kontrol akses sesuai role:

### 1. **Laboratorium**
- **Database Relationship**: One-to-Many dengan Praktikum
- **Akses**:
  - ✅ Semua role dapat **melihat** laboratorium
  - 🔒 **Hanya Admin** yang dapat Create, Update, Delete

### 2. **Nilai**
- **Database Relationship**: Many-to-Many dengan Praktikum dan User (Praktikan)
- **Relasi tambahan**: Terhubung ke Pertemuan
- **Akses**:
  - **Admin/Asisten/Dosen**: Dapat melihat semua nilai semua praktikan
  - **Praktikan**: Hanya dapat melihat nilai miliknya sendiri
  - **Create/Update/Delete**: Hanya Admin/Asisten/Dosen

### 3. **Presensi**
- **Database Relationship**: Many-to-Many dengan User (Praktikan), Pertemuan, dan Praktikum
- **Akses**:
  - **Admin/Asisten/Dosen**: Dapat melihat semua presensi semua praktikan
  - **Praktikan**: Hanya dapat melihat presensi miliknya sendiri
  - **Create/Update/Delete**: Hanya Admin/Asisten/Dosen

---

## Database Migrations

Tiga migration baru telah dibuat untuk menambahkan relasi:

1. **2026_04_13_add_laboratorium_to_praktikums.php** - Menambahkan foreign key `id_laboratorium` ke tabel `praktikums` (akan dihapus)
2. **2026_04_13_add_pertemuan_to_nilais.php** - Menambahkan foreign key `id_pertemuan` ke tabel `nilais` (akan dihapus)
3. **2026_04_13_add_praktikum_to_presensis.php** - Menambahkan foreign key `id_praktikum` ke tabel `presensis` (dipertahankan)
4. **2026_04_13_update_relationships.php** - Migration baru untuk menghapus foreign key yang tidak diperlukan

**Jalankan migrations:**
```bash
php artisan migrate
```

---

## API Endpoints

### **LABORATORIUM**

#### GET - Daftar Semua Laboratorium
```
GET /api/laboratorium
```
**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "nama_laboratorium": "Lab Komputer A",
      "lokasi": "Gedung A Lt. 2",
      "kapasitas": 30,
      "kepala_lab": 5,
      "status": "Terpakai",
      "kepalLab": { /* User object */ },
      "praktikums": [ /* Praktikum objects */ ]
    }
  ]
}
```

#### GET - Detail Laboratorium
```
GET /api/laboratorium/{id}
```

#### POST - Buat Laboratorium (Admin Only)
```
POST /api/laboratorium
Content-Type: application/json

{
  "nama_laboratorium": "Lab Komputer B",
  "lokasi": "Gedung B Lt. 1",
  "kapasitas": 25,
  "kepala_lab": 6,
  "status": "Tersedia"
}
```

#### PUT - Update Laboratorium (Admin Only)
```
PUT /api/laboratorium/{id}
Content-Type: application/json

{
  "nama_laboratorium": "Lab Komputer B Updated",
  "status": "Terpakai"
}
```

#### DELETE - Hapus Laboratorium (Admin Only)
```
DELETE /api/laboratorium/{id}
```

---

### **NILAI**

#### GET - Daftar Nilai (dengan kontrol akses)
```
GET /api/nilai
```
- **Admin/Asisten/Dosen**: Melihat semua nilai
- **Praktikan**: Hanya nilai milik sendiri

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "id_praktikum": 1,
      "id_user": 5,
      "id_pertemuan": 1,
      "nilai_pretest": 85,
      "nilai_laporan": 90,
      "nilai_total": 87,
      "nilai_akhir": 87,
      "komentar": "Bagus",
      "status": "Terkonfirmasi",
      "praktikum": { /* Praktikum object */ },
      "user": { /* User object */ },
      "pertemuan": { /* Pertemuan object */ }
    }
  ]
}
```

#### GET - Detail Nilai
```
GET /api/nilai/{id}
```

#### POST - Buat Nilai (Non-Praktikan Only)
```
POST /api/nilai
Content-Type: application/json

{
  "id_praktikum": 1,
  "id_user": 5,
  "id_pertemuan": 1,
  "nilai_pretest": 85,
  "nilai_laporan": 90,
  "nilai_total": 87,
  "nilai_akhir": 87,
  "komentar": "Bagus",
  "status": "Pending"
}
```

#### PUT - Update Nilai (Non-Praktikan Only)
```
PUT /api/nilai/{id}
Content-Type: application/json

{
  "nilai_akhir": 88,
  "status": "Terkonfirmasi"
}
```

#### DELETE - Hapus Nilai (Non-Praktikan Only)
```
DELETE /api/nilai/{id}
```

#### GET - Nilai berdasarkan Praktikum
```
GET /api/nilai/praktikum/{idPraktikum}
```
- **Praktikan**: Hanya nilai miliknya di praktikum itu
- **Non-Praktikan**: Semua nilai di praktikum itu

#### GET - Nilai berdasarkan User
```
GET /api/nilai/user/{userId}
```
- **Praktikan**: Hanya jika userId adalah milik sendiri
- **Non-Praktikan**: Semua nilai user tersebut

---

### **PRESENSI**

#### GET - Daftar Presensi (dengan kontrol akses)
```
GET /api/presensi
```
- **Admin/Asisten/Dosen**: Melihat semua presensi
- **Praktikan**: Hanya presensi milik sendiri

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "id_pertemuan": 1,
      "id_user": 5,
      "id_praktikum": 1,
      "kehadiran": "Hadir",
      "status": "Dikonfirmasi",
      "pertemuan": { /* Pertemuan object */ },
      "user": { /* User object */ },
      "praktikum": { /* Praktikum object */ }
    }
  ]
}
```

#### GET - Detail Presensi
```
GET /api/presensi/{id}
```

#### POST - Buat Presensi (Non-Praktikan Only)
```
POST /api/presensi
Content-Type: application/json

{
  "id_pertemuan": 1,
  "id_user": 5,
  "id_praktikum": 1,
  "kehadiran": "Hadir",
  "status": "Pending"
}
```

#### PUT - Update Presensi (Non-Praktikan Only)
```
PUT /api/presensi/{id}
Content-Type: application/json

{
  "kehadiran": "Izin",
  "status": "Dikonfirmasi"
}
```

#### DELETE - Hapus Presensi (Non-Praktikan Only)
```
DELETE /api/presensi/{id}
```

#### GET - Presensi berdasarkan Pertemuan
```
GET /api/presensi/pertemuan/{idPertemuan}
```
- **Praktikan**: Hanya presensi miliknya di pertemuan itu
- **Non-Praktikan**: Semua presensi di pertemuan itu

#### GET - Presensi berdasarkan User
```
GET /api/presensi/user/{userId}
```
- **Praktikan**: Hanya jika userId adalah milik sendiri
- **Non-Praktikan**: Semua presensi user tersebut

#### GET - Presensi berdasarkan Pertemuan & Praktikum
```
GET /api/presensi/pertemuan/{idPertemuan}/praktikum/{idPraktikum}
```
- **Praktikan**: Hanya presensi miliknya
- **Non-Praktikan**: Semua presensi di pertemuan dan praktikum itu

---

## Status & Error Handling

Semua endpoint mengembalikan:

**Success Response (200/201):**
```json
{
  "success": true,
  "message": "Operation successful",
  "data": { /* Data object */ }
}
```

**Unauthorized Response (403):**
```json
{
  "success": false,
  "message": "Unauthorized. Only admin can..."
}
```

**Not Found Response (404):**
```json
{
  "success": false,
  "message": "Resource not found"
}
```

**Error Response (500):**
```json
{
  "success": false,
  "message": "Error message",
  "error": "Exception details"
}
```

---

## Model Relationships

### **Laboratorium Model**
```php
- hasMany('jadwals') - Relasi one-to-many dengan Jadwal
- belongsTo('kepalLab') - Relasi dengan User sebagai kepala lab
```

### **Praktikum Model**
```php
- hasMany('jadwals') - Relasi dengan Jadwal
- hasMany('nilais') - Relasi dengan Nilai
- hasMany('presensis') - Relasi dengan Presensi
```

### **Nilai Model**
```php
- belongsTo('praktikum') - Relasi dengan Praktikum
- belongsTo('user') - Relasi dengan User (Praktikan)
```

### **Presensi Model**
```php
- belongsTo('praktikum') - Relasi dengan Praktikum
- belongsTo('user') - Relasi dengan User (Praktikan)
```

### **Jadwal Model**
```php
- belongsTo('praktikum') - Relasi dengan Praktikum
- belongsTo('laboratorium') - Relasi dengan Laboratorium
- belongsTo('dosen') - Relasi dengan User (Dosen)
- hasMany('pertemuans') - Relasi dengan Pertemuan
```

### **User Model**
```php
- hasMany('nilais') - Relasi dengan Nilai
- hasMany('presensis') - Relasi dengan Presensi
```

---

## Validation Rules

### **Laboratorium**
- `nama_laboratorium`: required, string, max 255
- `lokasi`: required, string, max 255
- `kapasitas`: required, integer, min 1
- `kepala_lab`: required, integer, exists in users table
- `status`: required, enum (Terpakai, Tersedia)

### **Nilai**
- `id_praktikum`: required, integer, exists in praktikums table
- `id_user`: required, integer, exists in users table
- `nilai_pretest`: integer, 0-100
- `nilai_laporan`: integer, 0-100
- `nilai_total`: integer, 0-100
- `nilai_akhir`: integer, 0-100
- `komentar`: string
- `status`: enum (Pending, Terkonfirmasi)

### **Presensi**
- `id_praktikum`: required, integer, exists in praktikums table
- `id_user`: required, integer, exists in users table
- `kehadiran`: required, enum (Hadir, Izin, Sakit, Alpha)
- `status`: enum (Dikonfirmasi, Pending, Ditolak)

---

## Testing dengan cURL

### Daftar semua laboratorium
```bash
curl -H "Authorization: Bearer YOUR_TOKEN" http://localhost:8000/api/laboratorium
```

### Buat laboratorium (Admin only)
```bash
curl -X POST -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "nama_laboratorium": "Lab Testing",
    "lokasi": "Gedung C",
    "kapasitas": 20,
    "kepala_lab": 1,
    "status": "Tersedia"
  }' \
  http://localhost:8000/api/laboratorium
```

### Daftar nilai (sesuai role)
```bash
curl -H "Authorization: Bearer YOUR_TOKEN" http://localhost:8000/api/presensi
```

### Buat nilai (Non-Praktikan only)
```bash
curl -X POST -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "id_praktikum": 1,
    "id_user": 5,
    "id_pertemuan": 1,
    "nilai_pretest": 80,
    "nilai_laporan": 90,
    "nilai_total": 85,
    "nilai_akhir": 85,
    "status": "Pending"
  }' \
  http://localhost:8000/api/nilai
```

---

## File yang Dibuat/Diupdate

### **Models** (app/Models/)
- `Laboratorium.php` ✅
- `Praktikum.php` ✅
- `Pertemuan.php` ✅
- `Nilai.php` ✅
- `Presensi.php` ✅
- `User.php` ✅ (ditambah methods untuk relasi)

### **Controllers** (app/Http/Controllers/)
- `LaboratoriumController.php` ✅
- `NilaiController.php` ✅
- `PresensiController.php` ✅

### **Migrations** (database/migrations/)
- `2026_04_13_add_laboratorium_to_praktikums.php` ✅
- `2026_04_13_add_pertemuan_to_nilais.php` ✅
- `2026_04_13_add_praktikum_to_presensis.php` ✅

### **Routes** (routes/web.php)
- Updated dengan semua routes untuk CRUD ✅

---

## Langkah Selanjutnya

1. Jalankan migrations:
   ```bash
   php artisan migrate
   ```

2. Test endpoints menggunakan Postman atau cURL

3. Integrate dengan frontend sesuai kebutuhan

4. Jika ada custom validation atau business logic tambahan, bisa ditambahkan di Controller dan Model

