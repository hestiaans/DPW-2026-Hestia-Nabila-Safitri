# LAPORAN PRAKTIKUM PEMROGRAMAN WEB
## JOBSHEET 05: JavaScript DOM & Event

### **INFORMASI PRAKTIKUM**
* **Mata Kuliah:** Desain & Pemrograman Web 2026
* **Modul:** Jobsheet 05 - JavaScript DOM & Event
* **Nama:** Hestia Nabila Safitri
* **NIM:** 254107020159
* **Kelas:** TI-2F

---

## DAFTAR ISI

1. [`index.html`](../index.html)
2. [`buku/list.html`](../buku/list.html)
3. [`buku/tambah.html`](../buku/tambah.html)
4. [`anggota/list.html`](../anggota/list.html)
5. [`anggota/tambah.html`](../anggota/tambah.html)
6. [`assets/css/stle.css`](../assets/css/style.css)
7. [`docs/wireframe.md`](../docs/wireframe.md)

---

## 1. Dasar-Dasar JavaScript dan DOM
Pada praktikum ini, file JavaScript dihubungkan ke dokumen HTML agar halaman web dapat memiliki fitur interaktif. File tersebut digunakan untuk mengatur beberapa fungsi, seperti menu hamburger, pencarian data, penghapusan baris tabel, dan validasi form.

Langkah Konfigurasi:
1. Membuat folder js di dalam direktori assets.

2. Membuat file app.js di dalam folder assets/js.

3. Menambahkan kode berikut sebelum tag penutup </body> pada setiap file HTML:

```xml
<script src="assets/js/app.js"></script>
```

### 1.1 Perbedaan HTML, CSS, dan JavaScript
Sebuah website umumnya dibangun menggunakan tiga komponen utama berikut:

HTML digunakan untuk menyusun struktur dan menampilkan konten halaman.

CSS digunakan untuk mengatur warna, ukuran, posisi, serta tampilan elemen.

JavaScript digunakan untuk memberikan perilaku dan interaksi pada halaman web.

### 1.2 Cara Menghubungkan JavaScript dengan HTML

File JavaScript dapat dimasukkan ke dalam halaman HTML menggunakan elemen `<script>`:

```xml
<script src="assets/js/app.js"></script>
```
Keterangan:

- `<script>` merupakan tag untuk menyisipkan atau memanggil kode JavaScript.

- src menunjukkan lokasi file JavaScript.

- app.js adalah nama file JavaScript yang digunakan.

### 1.3 Alasan Script Diletakkan di Bagian Bawah

File JavaScript diletakkan sebelum `</body>` karena browser membaca dokumen HTML secara berurutan dari atas ke bawah. Dengan meletakkan script di bagian akhir, elemen HTML telah selesai dimuat terlebih dahulu sehingga JavaScript dapat menemukan dan memanipulasinya dengan baik.

## 2. Perubahan pada File HTML
Beberapa bagian HTML perlu disesuaikan agar dapat dikenali dan dikendalikan oleh JavaScript melalui id, class, maupun atribut tertentu.

### 2.1 Perubahan Tombol Hamburger
Pada struktur sebelumnya, menu hamburger dibuat menggunakan checkbox dan label:

```xml
<input type="checkbox">
<label>☰</label>
```

Struktur tersebut kemudian diganti menjadi tombol HTML:

```xml
<button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Menu">
    &#9776;
</button>
```
Perubahan yang dilakukan meliputi:

- Elemen checkbox dihilangkan.
- Elemen `<label>` diganti menjadi `<button>`.
- Atribut `id="nav-toggle-btn"` digunakan sebagai penanda agar tombol dapat ditemukan oleh JavaScript.
- Class `nav-toggle-label` tetap dipertahankan agar aturan CSS sebelumnya masih dapat digunakan.
- Atribut `aria-label="Menu"` membantu pengguna screen reader mengenali fungsi tombol tersebut.

### 2.2 Penambahan Kolom Pencarian
Kolom pencarian ditambahkan menggunakan kode berikut:

```xml
<div class="search-box">
    <label for="search-input">Cari Judul Buku</label>
    <input type="text" id="search-input" placeholder="Ketik judul buku...">
</div>
```
Fungsinya adalah:
- Menyediakan tempat bagi pengguna untuk mengetik kata kunci.
- Nilai yang diketik tidak disimpan ke dalam database.
- JavaScript membaca nilai input setiap kali pengguna mengetik.
- id="search-input" menjadi identitas yang digunakan oleh document.getElementById("search-input").

Teks pada placeholder hanya berfungsi sebagai petunjuk. Teks tersebut bukan nilai sebenarnya dari input.

### 2.3 Penambahan Tombol Hapus
Agar JavaScript dapat menemukan seluruh tombol hapus dalam tabel, tombol diberikan class khusus:

```xml
<button type="button" class="btn-hapus">Hapus</button>
```
Class btn-hapus kemudian digunakan oleh:

```js
document.querySelectorAll(".btn-hapus")
```
Dengan cara ini, seluruh tombol hapus pada halaman dapat diproses sekaligus.

### 2.4 Penambahan Identitas pada Form
Form pada halaman tambah buku dan tambah anggota diberikan atribut id:

```xml
<form id="form-tambah">
```
Atribut tersebut digunakan oleh JavaScript untuk menemukan form dan memasang event listener ketika form dikirim. Sebelumnya, form pada dokumentasi Jobsheet 1 belum memiliki identitas khusus.

## 3. CSS untuk Mendukung Fitur JavaScript
Beberapa aturan CSS diperbarui agar tampilan fitur JavaScript dapat bekerja dengan baik.

### 3.1 Perubahan Tampilan Menu Hamburger
Menghapus Aturan .nav-toggle
Aturan lama berikut tidak lagi digunakan:

```css
.nav-toggle {
    display: none;
}
```
Hal ini dilakukan karena pengaturan menu sekarang dilakukan berdasarkan class nav-open yang ditambahkan oleh JavaScript.

#### A. Mengubah Tampilan Tombol Hamburger
Karena elemen yang digunakan sekarang adalah `<button>`, diperlukan pengaturan tambahan agar tampilan tombol tidak mengikuti gaya bawaan browser:

```css
.nav-toggle-label {
    display: none;
    font-size: 1.6rem;
    color: #fff;
    background: none;
    border: none;
    cursor: pointer;
}
```
Keterangan:

- display: none menyembunyikan tombol pada tampilan desktop.
- font-size mengatur ukuran ikon hamburger.
- color menentukan warna ikon.
- background: none menghilangkan warna latar bawaan tombol.
- border: none menghapus bingkai bawaan browser.
- cursor: pointer mengubah kursor ketika diarahkan ke tombol.

#### B. Menampilkan Menu dengan Class nav-open
Menu akan ditampilkan jika elemen `<nav>` di dalam `<header>` memiliki class nav-open:

```css
header nav.nav-open {
    display: block;
}
```
Status menu ditentukan oleh ada atau tidaknya class tersebut. JavaScript akan menambahkan class ketika tombol ditekan dan menghapusnya ketika tombol ditekan kembali.

### 3.2 CSS untuk Pesan Kesalahan
Pesan kesalahan pada form diberikan class error. Aturan CSS yang digunakan bertujuan agar pesan terlihat jelas:

- display: block membuat pesan muncul pada baris tersendiri di bawah input.
- color: #d9534f memberikan warna merah sebagai penanda adanya kesalahan.
- font-size: 0.85rem membuat ukuran teks lebih kecil daripada teks input.
- margin-top: 0.25rem memberikan jarak antara input dan pesan kesalahan.

### 3.3 CSS untuk Kolom Pencarian
Kolom pencarian juga diberikan aturan CSS khusus:

```css
.search-box {
    margin-bottom: 1rem;
}
```
Aturan tersebut memberikan jarak antara kolom pencarian dan tabel.

Selain itu, selector .search-box input digunakan untuk mengatur tampilan input pencarian agar memiliki gaya yang serupa dengan input pada form.

## 4. JavaScript untuk Menu Hamburger
Fungsi berikut digunakan untuk mengatur perilaku tombol hamburger:

```js
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");

    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}
```

### 4.1 Mengambil Elemen HTML
Dua elemen yang dibutuhkan adalah:

```js
const toggleBtn = document.getElementById("nav-toggle-btn");
const nav = document.querySelector("header nav");
```
- toggleBtn menyimpan tombol dengan ID nav-toggle-btn.
- nav menyimpan elemen <nav> yang berada di dalam <header>.
- const digunakan untuk membuat variabel yang tidak akan diganti nilainya setelah dideklarasikan.

### 4.2 Penggunaan Guard Clause
Bagian berikut berfungsi sebagai pengaman:

```js
if (!toggleBtn || !nav) return;
```
Penjelasannya:

- Tanda ! berarti negasi atau kebalikan nilai.
- || berarti operator logika “atau”.
- Jika tombol atau elemen navigasi tidak ditemukan, fungsi langsung dihentikan.
- Dengan demikian, JavaScript tidak mencoba menjalankan addEventListener() pada elemen yang bernilai null.

### 4.3 Event Listener pada Tombol
Kode berikut menjalankan fungsi ketika tombol diklik:

```js
toggleBtn.addEventListener("click", function () {
    nav.classList.toggle("nav-open");
});
```
addEventListener("click", ...) berarti JavaScript menunggu tindakan klik dari pengguna.

Method classList.toggle("nav-open") memiliki dua kemungkinan:
- Menambahkan class nav-open jika class tersebut belum ada.
- Menghapus class nav-open jika sebelumnya sudah ada.

### 4.4 Hubungan JavaScript dengan CSS
Alur kerja menu hamburger adalah sebagai berikut:

1. Pengguna menekan tombol hamburger.
2. Event click dijalankan.
3. JavaScript menambahkan class nav-open ke elemen <nav>.
4. Selector CSS header nav.nav-open mulai berlaku.
5. Menu navigasi ditampilkan dengan display: block.
6. Ketika tombol ditekan lagi, class nav-open dihapus.
7. Menu kembali mengikuti aturan awal dan menjadi tersembunyi.

## 5. JavaScript untuk Konfirmasi Penghapusan
Fitur ini digunakan untuk memberikan konfirmasi sebelum baris data dihapus dari tabel.

### 5.1 Memasang Event Listener pada Banyak Tombol
Untuk mengambil semua tombol hapus, digunakan:

```js
document.querySelectorAll(".btn-hapus")
```
Karena hasilnya berupa kumpulan elemen, setiap tombol perlu diproses menggunakan forEach(). Dengan begitu, masing-masing tombol mempunyai event listener sendiri.

### 5.2 Menemukan Baris Tabel
Setelah tombol ditekan, baris tabel tempat tombol berada dicari menggunakan:

```js
const row = btn.closest("tr");
```
Method closest("tr") mencari elemen induk terdekat yang berupa <tr>.

### 5.3 Mengambil Data dari Baris
Nama atau judul yang terdapat pada kolom pertama dapat diambil menggunakan:

```js
const nama = row ? row.querySelector("td")?.textContent : "data ini";
```
Kode tersebut menggunakan beberapa fitur JavaScript:

- Operator ternary digunakan sebagai bentuk ringkas dari if...else.
- querySelector("td") mengambil elemen <td> pertama.
- Optional chaining ?. mencegah kesalahan jika elemen tidak ditemukan.
- textContent mengambil teks yang berada di dalam elemen tersebut.

### 5.4 Menampilkan Konfirmasi
Fungsi bawaan browser confirm() digunakan untuk menampilkan dialog konfirmasi:

```js
const yakin = confirm(`Apakah Anda yakin ingin menghapus ${nama}?`);
```
Dialog tersebut menyediakan pilihan OK dan Cancel.

### 5.5 Menghapus Baris dari DOM
Baris hanya akan dihapus apabila pengguna memilih OK dan baris berhasil ditemukan:

```js
if (yakin && row) {
    row.remove();
}
```
Operator && berarti kedua kondisi harus terpenuhi. Method remove() menghilangkan baris tersebut dari DOM sehingga langsung tidak terlihat di halaman tanpa perlu memuat ulang halaman.

## 6. JavaScript untuk Filter Tabel Secara Real-Time
Fitur pencarian digunakan untuk menyaring baris tabel berdasarkan teks yang diketik pengguna.

### 6.1 Mengambil Input dan Tabel
Elemen yang diperlukan dicari menggunakan kode berikut:

```js
const input = document.getElementById("search-input");
const table = document.querySelector(".table-responsive table");

if (!input || !table) return;
```

- input adalah kolom pencarian.
- table adalah tabel yang berada di dalam elemen .table-responsive.
- Guard clause membuat fungsi tetap aman ketika dijalankan pada halaman yang tidak memiliki pencarian atau tabel.

### 6.2 Merespons Setiap Ketikan
Event keyup dijalankan ketika tombol keyboard dilepas:

```js
input.addEventListener("keyup", function () {
    // proses pencarian
});
```
Dengan event tersebut, hasil pencarian dapat diperbarui setiap kali pengguna selesai mengetik sebuah karakter.

### 6.3 Mengolah Kata Kunci
Nilai pencarian diambil dari properti value:

```js
const keyword = input.value.toLowerCase();
```
value berisi teks yang sedang diketik pengguna, sedangkan placeholder hanya merupakan teks petunjuk.

Method toLowerCase() digunakan agar pencarian tidak membedakan huruf kapital dan huruf kecil. Sebagai contoh, kata laskar tetap dapat menemukan data Laskar Pelangi.

### 6.4 Memeriksa Baris pada Tabel
Baris data diambil dari bagian <tbody> menggunakan:

```js
table.querySelectorAll("tbody tr").forEach(function (row) {
    const teks = row.textContent.toLowerCase();

    row.style.display = teks.includes(keyword) ? "" : "none";
});
```
Penjelasan:
- tbody tr hanya mengambil baris data, bukan baris judul pada <thead>.
- textContent mengambil seluruh teks di dalam satu baris.
- toLowerCase() menyamakan format huruf dengan kata kunci.
- includes(keyword) memeriksa apakah teks baris mengandung kata kunci.
- Jika cocok, baris tetap ditampilkan.
- Jika tidak cocok, baris disembunyikan.

### 6.5 Perbedaan remove() dan display: none
Penyaringan tabel menggunakan:

```js
row.style.display = "none";
```
Cara tersebut hanya menyembunyikan baris sementara. Elemen masih berada di dalam DOM dan dapat ditampilkan kembali ketika kata kunci pencarian dihapus.

Hal ini berbeda dengan:
```js
row.remove();
```
remove() benar-benar menghapus elemen dari DOM sehingga elemen tersebut tidak dapat muncul kembali tanpa dibuat ulang.

## 7. Validasi Form dengan JavaScript
Validasi digunakan untuk memeriksa data sebelum form dikirim. Pada praktikum ini, validasi dibagi menjadi tiga fungsi utama:

- tampilkanError() untuk menambahkan pesan kesalahan.
- hapusError() untuk menghilangkan pesan kesalahan.
- initValidasiForm() untuk menjalankan validasi saat form dikirim.

### 7.1 Fungsi tampilkanError()
Fungsi berikut membuat dan menampilkan pesan error setelah input:

```js
function tampilkanError(input, pesan) {
    hapusError(input);

    const span = document.createElement("span");
    span.className = "error";
    span.textContent = pesan;

    input.insertAdjacentElement("afterend", span);
}
```
Tahapan yang dilakukan:

- createElement("span") membuat elemen <span>.
- className = "error" memberikan class pada elemen tersebut.
- textContent memasukkan isi pesan error.
- insertAdjacentElement("afterend", span) menempatkan pesan setelah elemen input.
- hapusError(input) dipanggil terlebih dahulu agar pesan yang sama tidak muncul berkali-kali.

### 7.2 Fungsi hapusError()
Fungsi ini digunakan untuk menghapus pesan error yang sudah ditampilkan:

```js
function hapusError(input) {
    const next = input.nextElementSibling;

    if (next && next.classList.contains("error")) {
        next.remove();
    }
}
```
Keterangan:

- nextElementSibling mengambil elemen HTML tepat setelah input.
- classList.contains("error") memeriksa apakah elemen tersebut memiliki class error.
- Jika benar, elemen tersebut dihapus menggunakan remove().

### 7.3 Fungsi initValidasiForm()
Validasi dijalankan ketika form disubmit:

```js
function initValidasiForm() {
    const form = document.getElementById("form-tambah");

    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

        // proses pemeriksaan field

        if (!valid) {
            e.preventDefault();
        }
    });
}
```
Penjelasan:

- getElementById() mencari form dengan ID form-tambah.
- Jika form tidak ditemukan, fungsi dihentikan.
- Event submit digunakan untuk menangkap proses pengiriman form.
- Variabel valid digunakan sebagai penanda apakah seluruh input sudah benar.
- e.preventDefault() membatalkan pengiriman form jika terdapat kesalahan.

### 7.4 Validasi Field Judul atau Nama
Contoh pemeriksaan untuk field judul buku atau nama anggota:

```js
const judul = form.querySelector("[name='judul'], [name='nama']");

if (judul && judul.value.trim() === "") {
    tampilkanError(judul, "Field ini wajib diisi.");
    valid = false;
} else if (judul) {
    hapusError(judul);
}
```
Proses validasinya adalah:

- querySelector() mencari field dengan atribut name bernilai judul atau nama.
- trim() menghilangkan spasi pada awal dan akhir input.
- Jika hasilnya kosong, pesan error ditampilkan.
- Nilai valid diubah menjadi false.
- Jika input telah diisi, pesan error sebelumnya dihapus.

### 7.5 Validasi Tahun
Field tahun divalidasi menggunakan rentang nilai tertentu:

```js
const tahun = form.querySelector("[name='tahun']");

if (tahun) {
    const nilai = parseInt(tahun.value, 10);

    if (isNaN(nilai) || nilai < 1900 || nilai > 2026) {
        tampilkanError(tahun, "Tahun harus di antara 1900-2026.");
        valid = false;
    } else {
        hapusError(tahun);
    }
}
```
Fungsi yang digunakan:

- parseInt() mengubah teks input menjadi bilangan bulat.
- isNaN() memeriksa apakah hasil konversi bukan angka.
- Tahun dianggap valid apabila berada pada rentang 1900 sampai 2026.
- Jika nilai tidak memenuhi syarat, pesan error ditampilkan dan proses submit dibatalkan.

Field stok diperiksa dengan pola serupa, tetapi nilainya tidak boleh kurang dari nol.

### 7.6 Mencegah Pengiriman Form
Bagian berikut digunakan untuk menghentikan pengiriman form:

```js
if (!valid) {
    e.preventDefault();
}
```
Jika ada setidaknya satu field yang tidak valid, preventDefault() mencegah form dikirim dan halaman tidak dimuat ulang. Sebaliknya, jika semua data telah benar, form tetap mengikuti perilaku bawaan browser.

## 8. Kaitan dengan Form pada Jobsheet Sebelumnya
Pada Jobsheet sebelumnya, form belum mempunyai atribut action dan method. Oleh sebab itu, data yang diisi belum benar-benar dikirim ke server atau disimpan ke database.

Validasi JavaScript hanya bertugas melakukan pemeriksaan awal di sisi pengguna sebelum proses submit. Dengan demikian, validasi tersebut belum dapat dianggap sebagai mekanisme penyimpanan data. Untuk menyimpan data secara permanen, diperlukan pengaturan server-side, atribut form yang sesuai, serta koneksi ke database.