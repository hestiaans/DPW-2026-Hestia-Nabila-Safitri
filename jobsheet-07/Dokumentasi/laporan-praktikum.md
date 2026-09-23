# LAPORAN PRAKTIKUM PEMROGRAMAN WEB
## JOBSHEET 07: PHP Dasar & Form Handling

### **INFORMASI PRAKTIKUM**
* **Mata Kuliah:** Desain & Pemrograman Web 2026
* **Modul:** Jobsheet 07 - PHP Dasar & Form Handling
* **Nama:** Hestia Nabila Safitri
* **NIM:** 254107020159
* **Kelas:** TI-2F

---

### 1 Konsep Dasar

Pada tahap awal, langkah-langkah yang dilakukan meliputi:
- Mengubah ekstensi file yang semula .html menjadi .php.
- Menjalankan server lokal PHP langsung dari direktori jobsheet-07 melalui perintah:
```bash
php -S localhost:8000
```

### 2 Penggunaan Header & Footer (Includes)

Fitur include memungkinkan kita menuliskan elemen antarmuka yang berulang (seperti header dan footer) cukup satu kali. Elemen ini kemudian dipanggil di berbagai halaman lain secara efisien.

Secara umum, struktur proyek tersusun sebagai berikut:
```bash
jobsheet-07/
├── index.php
├── buku/
│   ├── list.php
│   └── tambah.php
├── anggota/
│   ├── list.php
│   └── tambah.php
└── includes/
    ├── header.php
    └── footer.php
```

#### 2.1 Mekanisme include

Perintah include berfungsi menyisipkan seluruh konten dari file target ke dalam lokasi pemanggilan di file utama.

Contoh pemanggilan:
```bash
include __DIR__ . '/includes/header.php';
```

Pada kode di atas, PHP akan mengambil isi file header.php yang ada di dalam folder includes, lalu menempatkannya tepat di posisi baris include tersebut.

#### 2.2 Fungsi Magic Constant __DIR__

__DIR__ merupakan konstanta bawaan PHP yang mengembalikan jalur (path) absolut dari folder tempat file yang sedang dieksekusi berada.

Jika kita memanggilnya dari index.php (di root folder jobsheet-07):
```bash
__DIR__ . '/includes/header.php'
```

Jalur kodenya akan mengarah ke:
```bash
jobsheet-07/includes/header.php
```

Sedangkan jika kita berada di dalam sub-folder seperti buku/tambah.php:
```bash
include __DIR__ . '/../includes/header.php';
```

Kita perlu menambahkan /../ untuk naik satu tingkat keluar dari folder buku sebelum masuk ke folder includes.

#### 2.3 Pengaturan Judul Dinamis dengan $page_title

Variabel $page_title dimanfaatkan untuk menentukan judul halaman sebelum file header.php dimuat.
```bash
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';
```

Di dalam file header.php, nilai dari variabel ini ditangkap untuk menampilkan tag `<title>` yang dinamis:
```bash
<title>
    SIMPUS-Mini<?php echo isset($page_title) ? ' | ' . $page_title : ''; ?>
</title>
```

Jika $page_title diisi "Beranda", maka judul tab browser akan otomatis berubah menjadi:
```
SIMPUS-Mini | Beranda
```

#### 2.4 Navigasi Fleksibel Menggunakan $base

Variabel $base berfungsi menyesuaikan path relatif tautan agar link tidak rusak saat dipanggil dari folder dengan kedalaman berbeda.
```bash
<a href="<?php echo $base; ?>index.php">Beranda</a>
```

- Jika halaman diakses dari root folder, nilai $base dibuat kosong sehingga link bernilai index.php.

- Jika halaman diakses dari sub-folder (seperti buku/), nilai $base disesuaikan menjadi ../ sehingga link otomatis mengarah ke ../index.php.

Mekanisme ini menjaga agar satu file header.php tetap konsisten dan reusable di mana pun lokasinya.

#### 2.5 Struktur Kolaborasi header.php dan footer.php

- header.php memuat struktur dokumen awal dari tag `<html>` hingga pembuka `<main>`.

- footer.php memuat penutup `</main>` hingga tag penutup `</html>`.

Ketika digabungkan, PHP akan menyatukan header, konten utama, dan footer menjadi dokumen HTML utuh sebelum dikirimkan ke browser:
```bash
include __DIR__ . '/includes/header.php';
// --- Konten Utama Halaman ---
include __DIR__ . '/includes/footer.php';
```

#### 2.6 Pemuatan Skrip Khusus via $extra_scripts

Variabel $extra_scripts berbentuk array yang menampung daftar skrip JavaScript tambahan jika suatu halaman membutuhkannya.
```bash
<?php if (!empty($extra_scripts)): ?>
    <?php foreach ($extra_scripts as $src): ?>
        <script src="<?php echo $src; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
```

Kode ini melakukan perulangan untuk memuat setiap berkas .js yang terdaftar dalam array tersebut secara otomatis.

### 3 Pengelolaan Session & Alur Data

Session digunakan PHP untuk menyimpan data pengguna sementara di sisi server, sehingga data tersebut dapat diakses lintas halaman. Perlu diingat bahwa $_SESSION bukan media penyimpanan permanen seperti basis data (Database); data di dalamnya akan terhapus setelah sesi berakhir atau ditutup.

#### 3.1 Inisialisasi Sesi (session_start())

Fungsi session_start() wajib dipanggil paling awal sebelum mengakses variabel $_SESSION dan sebelum ada output HTML yang dikirim ke browser.
```php 
<?php
session_start();
?>
```

Pada proyek ini, session_start() diletakkan di dalam header.php. Hal ini memastikan seluruh halaman yang menyertakan header otomatis mengaktifkan sesi.

#### 3.2 Struktur Data $_SESSION

Variabel superglobal $_SESSION berlaku seperti wadah penyimpanan sementara untuk tiap sesi pengguna. Praktikum ini memanfaatkan tiga kunci (key) utama:

- $_SESSION['buku']: Menyimpan sekumpulan array data buku.

- $_SESSION['anggota']: Menyimpan sekumpulan array data anggota.

- $_SESSION['flash']: Menyimpan notifikasi sementara (flash message).

#### 3.3 Menambahkan Data Baru ke Sesi

Data hasil inputting formulir disisipkan ke dalam array sesi menggunakan sintaks braket kosong [].
```bash
$_SESSION['buku'][] = [
    'judul' => $judul,
    'pengarang' => $pengarang,
    'tahun' => $tahun,
    'stok' => $stok
];
```

Penggunaan [] memastikan data baru ditambahkan ke urutan paling akhir tanpa menimpa (overwrite) data yang sudah tersimpan sebelumnya.

### 4 Pemrosesan Form: proses_tambah.php

File proses_tambah.php bertindak sebagai pengolah data form. Tugas utamanya mencakup penerimaan data, validasi, penyimpanan ke dalam $_SESSION, serta pengarahan (redirect) halaman.

#### 4.1 Pengiriman Form dengan Metode POST

Form dikirimkan ke proses_tambah.php dengan menyertakan atribut method="post".
```php
<form id="form-tambah" method="post" action="proses_tambah.php">
```

Metode POST dipilih agar data input dikirim di balik layar tanpa memperlihatkannya pada URL browser.

#### 4.2 Pembacaan Input via $_POST

Data yang dikirim dibaca melalui array $_POST berdasarkan atribut name dari masing-masing elemen HTML.
```php
$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = $_POST['tahun'] ?? '';
$stok = $_POST['stok'] ?? '';
```

- Fungsi trim() digunakan untuk membersihkan spasi berlebih di awal dan akhir input.

- Operator Null Coalescing (?? '') memastikan nilai bawaan berupa string kosong jika atribut terkait tidak terkirim.

#### 4.3 Validasi Sisi Server (Server-Side Validation)

Sebelum disimpan ke sistem, seluruh input diperiksa kelayakannya di sisi server:
```php
$errors = [];

if ($judul === '') {
    $errors[] = "Judul wajib diisi.";
}

if (!is_numeric($tahun) || $tahun < 1900 || $tahun > 2026) {
    $errors[] = "Tahun harus di antara 1900-2026.";
}

if (!is_numeric($stok) || $stok < 0) {
    $errors[] = "Stok tidak boleh negatif.";
}
```

Array $errors digunakan untuk menampung seluruh pesan kesalahan. Fungsi is_numeric() memastikan input angka diisi dengan format yang benar.

#### 4.4 Penanganan Data Tidak Valid

Jika ditemui adanya kesalahan input, pesan error akan disimpan ke dalam flash session dan pengguna akan dikembalikan ke halaman form.
```php
if (!empty($errors)) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => implode(' ', $errors)
    ];

    header('Location: tambah.php');
    exit;
}
```

- implode() menggabungkan seluruh pesan error dalam array menjadi satu kalimat utuh.

- header('Location: tambah.php') mengarahkan pengguna kembali ke form input.

- exit memastikan eksekusi skrip PHP dihentikan seketika setelah alur dialihkan.

#### 4.5 Penanganan Data Valid

Jika seluruh input lolos tahap validasi, data akan disimpan ke dalam array $_SESSION['buku'].
```php
if (!isset($_SESSION['buku'])) {
    $_SESSION['buku'] = [];
}

$_SESSION['buku'][] = [
    'judul' => $judul,
    'pengarang' => $pengarang,
    'tahun' => (int) $tahun,
    'stok' => (int) $stok
];
```

Tipe data untuk tahun dan stok diubah menjadi bilangan bulat (integer) menggunakan type casting (int). Setelah data berhasil disimpan, sistem menetapkan notifikasi sukses lalu mengarahkan pengguna ke list.php.
```php
$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Buku berhasil ditambahkan.'
];

header('Location: list.php');
exit;
```

#### 4.6 Pentingnya Validasi di Server

Meskipun form sudah dilengkapi validasi HTML5 atau JavaScript di browser, validasi tersebut sangat mudah dimanipulasi atau dilewati. Validasi di proses_tambah.php (server-side) menjadi benteng pertahanan utama untuk menjamin integritas data yang masuk ke dalam sistem.

### 5 Penyajikan Data: list.php & Notifikasi Flash

list.php bertugas mengambil daftar buku dari $_SESSION['buku'], menampilkan notifikasi sekali pakai (flash message), dan merender data ke dalam tabel HTML.

#### 5.1 Pengambilan Data dari Sesi

Proses pembacaan data sesi dilakukan dengan sintaks berikut:
```php
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$daftarBuku = $_SESSION['buku'] ?? [];
```

Jika $_SESSION['buku'] belum terdefinisi, variabel $daftarBuku akan otomatis diinisialisasi sebagai array kosong ([]).

#### 5.2 Konsep Flash Message

Flash message adalah mekanisme penyampaian status atau notifikasi pesan yang hanya muncul satu kali.
```php
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
```

Dengan memanggil unset($_SESSION['flash']) segera setelah data dibaca, notifikasi akan langsung terhapus dari sesi. Hal ini mencegah notifikasi yang sama muncul kembali saat halaman di-refresh.

#### 5.3 Menampilkan Flash Message pada Antarmuka

Notifikasi di-render ke HTML hanya apabila variabel $flash memuat data.
```php
<?php if ($flash): ?>
    <p class="flash flash-<?php echo $flash['type']; ?>">
        <?php echo $flash['pesan']; ?>
    </p>
<?php endif; ?>
```

Penamaan kelas CSS dinamis disesuaikan dengan tipe pesan:

- Jika sukses: <p class="flash flash-success">

- Jika gagal/error: <p class="flash flash-error">

#### 5.4 Merender Tabel Data Buku

Seluruh koleksi buku ditampilkan ke tabel menggunakan struktur perulangan foreach.
```php
<?php if (empty($daftarBuku)): ?>
    <tr>
        <td colspan="4">Belum ada data buku.</td>
    </tr>
<?php else: ?>
    <?php foreach ($daftarBuku as $buku): ?>
    <tr>
        <td><?php echo htmlspecialchars($buku['judul']); ?></td>
        <td><?php echo htmlspecialchars($buku['pengarang']); ?></td>
        <td><?php echo $buku['tahun']; ?></td>
        <td><?php echo $buku['stok']; ?></td>
    </tr>
    <?php endforeach; ?>
<?php endif; ?>
```

Kondisi empty($daftarBuku) menangani tampilan khusus jika belum ada data yang tersimpan. Sebaliknya, jika data tersedia, foreach akan melakukan iterasi dan menyajikan setiap rekaman buku pada baris tabelnya masing-masing.

### 06 Penataan Gaya CSS: Notifikasi Flash

Pengaturan CSS digunakan untuk membedakan visual notifikasi berdasarkan tipenya:

- Tipe Success: Diberi warna latar/teks hijau untuk menandakan operasi berhasil.

- Tipe Error: Diberi warna latar/teks merah untuk memberi petunjuk terjadinya kesalahan input.