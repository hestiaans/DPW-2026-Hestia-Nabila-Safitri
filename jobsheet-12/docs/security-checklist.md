# Checklist Keamanan

---

## 1. Matriks Audit Keamanan

| # | Kerentanan | Ditemukan di | Sebelum | Sesudah (Perbaikan / Audit) | Status |
|---|---|---|---|---|---|
| 1 | **SQL Injection (SQLi)** | Semua query di `buku/`, `anggota/`, dan `auth/` | Sejak Jobsheet 8 sudah menggunakan *Prepared Statements* PDO (`:parameter`). | **Diaudit ulang, sudah aman** — Tidak ada kueri SQL yang menyisipkan `$_POST` atau `$_GET` langsung ke string SQL. Diuji input `' OR '1'='1` di form login $\rightarrow$ gagal bypass. | ✅ Safe |
| 2 | **Cross-Site Scripting (XSS)** | `buku/list.php`, `buku/edit.php`, `anggota/list.php`, `anggota/edit.php`, `includes/header.php` | Output `judul`, `pengarang`, `nama`, `alamat`, `no_hp`, dan nilai pencarian (`q`) dicetak langsung tanpa *escaping*. | **Perbaikan Selesai** — Dibungkus fungsi `e()` (`includes/helpers.php`, menggunakan `htmlspecialchars` dengan `ENT_QUOTES`). Diuji simpan judul `<script>alert(1)</script>` $\rightarrow$ tampil sebagai teks biasa. | ✅ Fixed |
| 3 | **Cross-Site Request Forgery (CSRF)** | Form Tambah/Edit/Hapus (Buku & Anggota), Login, Register | Form `POST` tidak memiliki token verifikasi — aksi sensitif dapat dipicu dari situs/domain lain. | **Perbaikan Selesai** — Ditambahkan `includes/csrf.php` (`csrf_field()` + `csrf_verify()`). Token disimpan di `$_SESSION['csrf_token']` dan diverifikasi sebelum query diproses. | ✅ Fixed |
| 4 | **Validasi & Sanitasi Input** | `proses_tambah.php`, `proses_edit.php` (Buku & Anggota) | Sudah ada validasi tipe (`is_numeric`) dan *required field* sejak Jobsheet 7–9. | **Diaudit ulang & ditingkatkan** — Ditambah *type casting* eksplisit `(int)` pada `id` di form Edit untuk mencegah manipulasi *hidden input* non-numerik. | ✅ Fixed |
| 5 | **Session Fixation** | `auth/proses_login.php` | Session ID tidak diperbarui setelah proses autentikasi/login berhasil. | **Perbaikan Selesai** — Fungsi `session_regenerate_id(true)` dipanggil tepat setelah `password_verify()` bernilai berhasil. | ✅ Fixed |

---

## 2. Rincian Implementasi & Pengujian

### 2.1 SQL Injection Prevention
- **Pendekatan:** Menggunakan PDO *Prepared Statements* dengan *named parameters*.
- **Contoh Kode Safe:**
  ```php
  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
  $stmt->execute(['username' => $username]);
  ```
- **Hasil Pengujian:** Percobaan injeksi payload `' OR '1'='1` pada kolom username/password menghasilkan kegagalan otentikasi karena dinilai sebagai string literal.

---

### 2.2 Cross-Site Scripting (XSS) Prevention
- **Pendekatan:** Centralized escaping helper pada `includes/helpers.php`.
- **Implementasi Fungsi:**
  ```php
  function e($string) {
      return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
  }
  ```
- **Hasil Pengujian:** String input `<script>alert(1)</script>` yang disimpan ke database berhasil dirender sebagai `&lt;script&gt;alert(1)&lt;/script&gt;` di browser.

---

### 2.3 Anti-CSRF Token
- **Pendekatan:** Pembangkitan token pseudo-random cryptographically secure via `random_bytes()`.
- **Implementasi Helper (`includes/csrf.php`):**
  ```php
  function csrf_field() {
      if (empty($_SESSION['csrf_token'])) {
          $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
      }
      return '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">';
  }

  function csrf_verify() {
      if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
          http_response_code(403);
          die("403 Forbidden: Token CSRF tidak valid atau tidak ditemukan.");
      }
  }
  ```
- **Hasil Pengujian:** Pengiriman request `POST` via CURL / Postman tanpa menyertakan `csrf_token` menghasilkan respon **HTTP 403 Forbidden**.

---

### 2.4 Hardening Session (Session Fixation)
- **Pendekatan:** Regenerasi ID sesi saat terjadi eskalasi hak akses (login).
- **Implementasi (`auth/proses_login.php`):**
  ```php
  if ($user && password_verify($password, $user['password'])) {
      session_regenerate_id(true); // Hapus ID session lama & buat ID baru
      $_SESSION['user'] = $user;
      header("Location: ../index.php");
      exit;
  }
  ```

---

## 3. Catatan Arsitektur & Alur Eksekusi
1. **Urutan Guard Middleware:** Guard otentikasi `includes/auth.php` dipanggil **sebelum** `includes/csrf.php` pada berkas pemrosesan data. Hal ini mencegah *unauthenticated users* dari memicu pengecekan token CSRF (langsung di-redirect ke `login.php`).
2. **Strict Handling:** Kegagalan verifikasi CSRF langsung menghentikan eksekusi script (`die()`) dan mengembalikan *status code* HTTP 403 guna mencegah proses lanjutan ke basis data.