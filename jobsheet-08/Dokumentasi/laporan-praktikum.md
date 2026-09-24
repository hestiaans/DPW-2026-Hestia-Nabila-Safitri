# LAPORAN PRAKTIKUM PEMROGRAMAN WEB
## JOBSHEET 08: Koneksi PostgreSQL

### **INFORMASI PRAKTIKUM**
* **Mata Kuliah:** Desain & Pemrograman Web 2026
* **Modul:** Jobsheet 08 - Koneksi PostgreSQL
* **Nama:** Hestia Nabila Safitri
* **NIM:** 254107020159
* **Kelas:** TI-2F

---

## 1. Konsep Dasar Database & SQL
Pada jobsheet ini, penyimpanan data mulai beralih menggunakan *Database Management System* (DBMS) PostgreSQL. Pendekatan ini menggantikan *session* agar data tetap tersimpan secara permanen dan tidak hilang saat sesi aplikasi berakhir.

## 2. Skema Database: `01_buku_anggota.sql`

| Kolom | Tipe Data | Aturan | Fungsi |
| :--- | :--- | :--- | :--- |
| `id` | `SERIAL` | `PRIMARY KEY` | ID unik buku |
| `judul` | `VARCHAR(255)` | `NOT NULL` | Judul buku |
| `pengarang` | `VARCHAR(255)` | `NOT NULL` | Nama pengarang |
| `tahun` | `INTEGER` | `NOT NULL` | Tahun terbit |
| `isbn` | `VARCHAR(50)` | - | Nomor ISBN |
| `stok` | `INTEGER` | `NOT NULL DEFAULT 0` | Jumlah stok |
| `kategori` | `VARCHAR(50)` | - | Kategori buku |

**Keterkaitan dengan Kode PHP**  
Nama kolom pada tabel `buku` (`judul`, `pengarang`, `tahun`, `isbn`, `stok`, `kategori`) serta tabel `anggota` (`nama`, `no_anggota`, `alamat`, `no_hp`) dibuat identik dengan *key* pada *array* asosiatif di `proses_tambah.php` (Jobsheet 07). Hal ini menjaga konsistensi alur data.

## 3. Persiapan Lingkungan Database
Langkah konfigurasi sebelum aplikasi dijalankan:
1. **Pemeriksaan Layanan & Ekstensi:** Memastikan PostgreSQL aktif serta ekstensi `psql` dan `pdo_pgsql` pada PHP/Laragon sudah menyala.
2. **Pembuatan Database:**
   ```bash
   createdb simpus_mini
   ```
- Eksekusi Skema SQL:
```bash
psql -d simpus_mini -f sql/01_buku_anggota.sql
```
- Penyesuaian Akses: Menyesuaikan variabel username dan password pada file includes/koneksi.php sesuai konfigurasi lokal.

## 4. Koneksi PHP ke Database (koneksi.php)
File koneksi.php berperan sebagai jembatan komunikasi antara skrip PHP dan PostgreSQL.

### Konfigurasi & Inisialisasi PDO
```PHP
$host = "localhost";
$port = "5432";
$db   = "simpus_mini";
$user = "postgres";
$pass = "postgres";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
```
- DSN (Data Source Name): String yang memuat jenis driver (pgsql), host, port, dan nama database.
- Penganganan Error (try-catch): Memastikan kegagalan koneksi tertangkap oleh PDOException dan menampilkan pesan error secara rinci sebelum dihentikan lewat die().
- Pemanggilan: File ini diakses pada halaman lain menggunakan require __DIR__ . '/includes/koneksi.php'; agar objek $pdo siap digunakan.

## 5. Penyimpanan Data (INSERT & Prepared Statement)
Implementasi buku/proses_tambah.php
```PHP
require __DIR__ . '/../includes/koneksi.php';

$stmt = $pdo->prepare(
    "INSERT INTO buku (judul, pengarang, tahun, isbn, stok, kategori)
     VALUES (:judul, :pengarang, :tahun, :isbn, :stok, :kategori)
     RETURNING id"
);

$stmt->execute([
    'judul'     => $judul,
    'pengarang' => $pengarang,
    'tahun'     => (int) $tahun,
    'isbn'      => $isbn,
    'stok'      => (int) $stok,
    'kategori'  => $kategori,
]);
```
### Mekanisme Kerja
- Placeholder (:nama): Penanda lokasi nilai sementara untuk memisahkan instruksi SQL dari data pengguna.

- RETURNING id: Fitur khas PostgreSQL untuk mengembalikan nilai ID yang baru terbentuk secara otomatis.

- Keamanan Prepared Statement: Proses pemisahan prepare() dan execute() mencegah celah SQL Injection karena masukan pengguna dieksekusi murni sebagai data, bukan perintah database.

## 6. Pembacaan Data (SELECT)
Mengambil Data di buku/list.php
```PHP
require __DIR__ . '/../includes/koneksi.php';

$daftarBuku = $pdo
    ->query("SELECT * FROM buku ORDER BY id DESC")
    ->fetchAll(PDO::FETCH_ASSOC);
```
- query(): Digunakan untuk eksekusi SQL statis tanpa parameter dari pengguna.

- ORDER BY id DESC: Menampilkan data terbaru di urutan paling atas.

- fetchAll(PDO::FETCH_ASSOC): Mengubah seluruh baris hasil query menjadi array asosiatif. Struktur data ini dapat ditampilkan ke tabel HTML menggunakan foreach tanpa perlu mengubah kode tampilan dari jobsheet sebelumnya.

### Menghitung Total Data di index.php
``` PHP
require __DIR__ . '/includes/koneksi.php';

$totalBuku = $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
$totalAnggota = $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
```
- COUNT(*): Agregasi langsung di tingkat database untuk efisiensi memori.

- fetchColumn(): Mengambil nilai tunggal (skalar) hasil dari query agregat.