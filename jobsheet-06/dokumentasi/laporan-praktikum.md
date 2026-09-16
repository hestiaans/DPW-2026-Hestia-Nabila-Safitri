# LAPORAN PRAKTIKUM PEMROGRAMAN WEB
## JOBSHEET 06: Fetch API & JSON

### **INFORMASI PRAKTIKUM**
* **Mata Kuliah:** Desain & Pemrograman Web 2026
* **Modul:** Jobsheet 06 - Fetch API & JSON
* **Nama:** Hestia Nabila Safitri
* **NIM:** 254107020159
* **Kelas:** TI-2F

---

## 1. Konsep Dasar: AJAX, JSON, Fetch, async/await

### 1.1 Apa itu AJAX?

AJAX (Asynchronous JavaScript and XML) adalah teknik untuk mengambil data di latar belakang tanpa harus me‑reload seluruh halaman.

- Pada form biasa (seperti di jobsheet awal), saat data dikirim halaman akan dimuat ulang sepenuhnya.
- Dengan AJAX, JavaScript bisa meminta data, lalu hanya memperbarui bagian tertentu dari halaman—dalam praktikum ini, bagian <tbody> pada tabel.

### 1.2 Apa itu JSON?
JSON (JavaScript Object Notation) adalah format teks yang digunakan untuk menyimpan data terstruktur.

### 1.3 Apa itu fetch()?
fetch(url) adalah fungsi bawaan browser untuk meminta data dari sebuah alamat, baik itu file lokal maupun server.

### 1.4 Apa itu Promise? Kenapa Butuh await?
Proses pengambilan data memerlukan waktu. JavaScript tidak berhenti total untuk menunggu (agar halaman tidak membeku). Sebagai gantinya, fetch() mengembalikan sebuah Promise, yaitu “janji” bahwa hasilnya akan tersedia nanti.

await berarti: tunggu hingga Promise selesai, baru lanjut ke baris berikutnya.

### 1.5 Apa itu async function?
await hanya boleh digunakan di dalam fungsi yang ditandai dengan async.
Kata kunci async memberi tahu JavaScript bahwa fungsi tersebut berjalan asinkron, sehingga boleh “berhenti sejenak” pada await tanpa memblokir seluruh halaman.

### 1.6 Menangani Kegagalan: try / catch / finally
```js
try {
    // kode yang mungkin gagal (misalnya fetch gagal)
} catch (err) {
    // dijalankan HANYA kalau ada error di blok try
} finally {
    // selalu dijalankan, entah berhasil atau gagal
}
```
- try digunakan untuk membungkus kode yang berpotensi gagal.
- catch digunakan untuk menangkap error agar program tidak crash; di sini bisa ditampilkan pesan ke pengguna.
- finally selalu dijalankan, baik berhasil maupun gagal, cocok untuk menyembunyikan indikator loading.

## Perubahan File HTML
Dilakukan beberapa perubahan pada HTML agar data dapat diisi secara dinamis oleh JavaScript.

### 2.1 Mengosongkan Isi `<tbody>` pada Tabel
```xml
<tbody>
    <!-- Baris diisi dinamis oleh assets/js/buku.js via fetch('../data/buku.json') -->
</tbody>
```

### 2.2 Urutan Tag `<script>` yang Baru
1. Pada buku/list.html:
```xml
<script src="../assets/js/buku.js"></script>
```

2. Pada anggota/list.html:
```xml
<script src="../assets/js/anggota.js"></script>
```
- app.js dimuat lebih dahulu karena berisi fungsi umum (hamburger menu, hapus, filter, validasi).
- Setelah itu baru buku.js / anggota.js yang berisi fungsi spesifik fetch untuk satu jenis data.
- Halaman Beranda dan halaman tambah tidak memuat buku.js / anggota.js karena tidak memiliki tabel data dinamis.

### 2.3 Alasan buku.js dan anggota.js Dipisah
- app.js merupakan fungsi umum yang digunakan di banyak halaman.
- buku.js dan anggota.js berisi fungsi spesifik fetch untuk satu jenis data saja.
- Pemisahan file membuat kode lebih pendek, lebih mudah dicari, dan halaman yang tidak membutuhkan tidak memuat kode yang tidak relevan.

## 3. Data JSON: buku.json & anggota.json
Langkah yang dilakukan:

1. Menambahkan folder baru data di dalam jobsheet-06.
2. Menambahkan file buku.json dan anggota.json di dalam folder data.

### 3.1 Alasan Nama Kunci Sama dengan name di Form
Kunci JSON (judul, pengarang, tahun, stok / no_anggota, nama, alamat, no_hp) dibuat sama persis dengan atribut name pada form Tambah Buku / Tambah Anggota. Dengan penamaan yang konsisten antara HTML dan JSON, data menjadi lebih mudah dilacak.

### 3.2 Tipe Data di Dalam JSON
- Number

Contoh: "tahun": 2005
Tanpa tanda kutip dianggap sebagai angka (dapat dilakukan operasi seperti tahun > 2000).

- String

Contoh: "no_anggota": "A001"
Tetap berupa string/text karena mengandung huruf, bukan angka murni.

### 3.3 Bagaimana Data Ini Menjadi Objek JavaScript?
await res.json() mengubah teks JSON mentah menjadi array objek JavaScript yang dapat diakses menggunakan .judul, .pengarang, dan seterusnya.

## 4. JS: Mengambil & Menampilkan Daftar Buku
buku.js bertugas mengambil data dari buku.json lalu mengisi <tbody> tabel secara dinamis.

```js
async function muatDaftarBuku() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    try {
        loading.style.display = "block";
        tbody.innerHTML = "";

        await new Promise((resolve) => setTimeout(resolve, 600)); // simulasi delay

        const res = await fetch("../data/buku.json");
        if (!res.ok) throw new Error("Gagal mengambil data (status " + res.status + ")");

        const daftarBuku = await res.json();

        daftarBuku.forEach(function (buku) {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${buku.judul}</td>
                <td>${buku.pengarang}</td>
                <td>${buku.tahun}</td>
                <td>${buku.stok}</td>
                <td><button class="btn btn-hapus">Hapus</button></td>
            `;
            tbody.appendChild(tr);
        });
    } catch (err) {
        tbody.innerHTML =
            "<tr><td colspan=\"5\">Gagal memuat data: " + err.message + "</td></tr>";
    } finally {
        loading.style.display = "none";
    }
}
```

document.addEventListener("DOMContentLoaded", muatDaftarBuku);
Intinya: fetch mengambil JSON, await res.json() mengubahnya jadi array objek, lalu forEach membuat baris tabel untuk setiap buku. Error ditangani dengan try/catch, loading selalu disembunyikan di finally.

## 5. JS: Mengambil & Menampilkan Daftar Anggota
Struktur anggota.js sama dengan buku.js, yang berbeda hanya nama fungsi, variabel, objek, dan seterusnya.

Langkah yang dilakukan:

1. Menambahkan file baru anggota.js di dalam assets/js.
2. Menghubungkan file tersebut di akhir anggota/list.html (setelah app.js).

### 5.1 Kenapa Kolom yang Diakses Harus Sama dengan JSON?
Jika salah mengetik kunci (misalnya anggota.nomor padahal di JSON no_anggota), JavaScript tidak akan menganggapnya sebagai error, tetapi nilainya menjadi undefined, sehingga sel tabel tampil kosong. Oleh karena itu, nama kunci harus sama persis.

## 6. JS: Event Delegation pada Tombol Hapus

### 6.1 Kondisi Sebelumnya
- querySelectorAll(".btn-hapus") mencari tombol yang sudah ada saat DOMContentLoaded.
- Listener kemudian dipasang ke tiap tombol satu per satu.

### 6.2 Kondisi Setelah Menggunakan Event Delegation
```js
function initHapusConfirm() {
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".btn-hapus");
        if (!btn) return;

        const row = btn.closest("tr");
        const nama = row ? row.querySelector("td")?.textContent : "data ini";
        const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");
        if (yakin && row) {
            row.remove();
        }
    });
}
```

### 6.3 Masalah yang Diperbaiki
Pada jobsheet‑06, `<tbody>` kosong saat halaman baru dimuat. Tombol .btn-hapus baru dibuat oleh buku.js / anggota.js setelah fetch selesai (ditambah delay 600ms).

Jika menggunakan versi lama:
1. DOMContentLoaded terpicu.
2. querySelectorAll(".btn-hapus") dijalankan → belum ada tombol.
3. Tidak ada listener yang terpasang.
4. Tombol Hapus yang muncul belakangan tidak bereaksi saat diklik.

### 6.4 Solusi: Event Delegation
Event delegation = memasang satu listener pada elemen root yang stabil (document), bukan pada tiap tombol.
Teknik ini memanfaatkan event bubbling: klik pada tombol menjalar ke atas (tombol → td → tr → … → document).

- e.target → elemen paling spesifik yang diklik.
- e.target.closest(".btn-hapus") → mencari ke atas, apakah klik tersebut berasal dari tombol Hapus.
- if (!btn) return; → jika klik di tempat lain, abaikan.
- Sisa logika (closest("tr"), confirm(), row.remove()) sama seperti pada jobsheet‑05.

### 6.5 Kenapa Berhasil untuk Tombol yang “Belum Ada”?
Karena listener ada di document (selalu ada sejak awal), ia tidak peduli kapan tombol dibuat. Selama tombol sudah ada di DOM saat diklik, klik tersebut tetap menjalar ke document dan terdeteksi.