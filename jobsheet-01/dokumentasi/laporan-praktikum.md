# LAPORAN PRAKTIKUM PEMROGRAMAN WEB
## JOBSHEET 01: PENGENALAN DASAR WEB DAN HTML

### **INFORMASI PRAKTIKUM**
* **Mata Kuliah:** Desain & Pemrograman Web 2026
* **Modul:** Jobsheet 01 - HTML5 Semantic Skeleton
* **Nama:** Hestia Nabila Safitri
* **NIM:** 254107020159
* **Kelas:** TI-2F

---

## DAFTAR ISI
1. [`index.html`](index.html)
2. [`buku/list.html`](buku/list.html)
3. [`buku/tambah.html`](buku/tambah.html)
4. [`anggota/list.html`](anggota/list.html)
5. [`anggota/tambah.html`](anggota/tambah.html)

---

## LANGKAH KERJA

### A. Membuat `index.html`

Halaman `index.html` digunakan sebagai halaman beranda dari website. Halaman ini berisi struktur utama website serta ringkasan statistik dummy.

Struktur semantic HTML5 yang digunakan pada halaman ini meliputi `header`, `nav`, `main`, `section`, `article`, dan `footer`.

Potongan kode yang digunakan adalah sebagai berikut:

```html
<header>
    ...
</header>

<nav>
    ...
</nav>

<main>
    <section>
        <article>
            ...
        </article>
    </section>
</main>

<footer>
    ...
</footer>
```

### B. Membuat `buku/list.html`

Halaman `buku/list.html` digunakan untuk menampilkan daftar buku dalam bentuk tabel. Data buku yang digunakan pada halaman ini masih berupa data dummy sebanyak **5 baris**.

Tabel digunakan agar informasi setiap buku dapat ditampilkan secara terstruktur dan mudah dibaca. Beberapa informasi yang dapat ditampilkan antara lain kode buku, judul buku, penulis, penerbit, dan tahun terbit.

Contoh struktur tabel yang digunakan:

```html
<table>
    <thead>
        <tr>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        ...
    </tbody>
</table>
```

### C. Membuat `buku/tambah.html`

Halaman `buku/tambah.html` digunakan untuk membuat form penambahan data buku. Form tersebut berisi beberapa input yang digunakan untuk memasukkan informasi buku.

Pada tahap ini, form belum diproses menggunakan backend sehingga hanya berfungsi sebagai struktur dan tampilan HTML. Data yang dimasukkan belum disimpan ke dalam database.

Elemen HTML yang digunakan antara lain `form`, `label`, `input`, dan `button`.

Contoh struktur form:

```html
<form>
    <p>
        <label for="judul">Judul</label><br>
        <input type="text" id="judul" name="judul" required>
    </p>

    <p>
        <label for="pengarang">Pengarang</label><br>
        <input type="text" id="pengarang" name="pengarang" required>
    </p>

    <p>
        <label for="tahun">Tahun Terbit</label><br>
        <input type="number" id="tahun" name="tahun"
               min="1900" max="2026" required>
    </p>

    <p>
        <label for="isbn">ISBN</label><br>
        <input type="text" id="isbn" name="isbn">
    </p>

    <p>
        <label for="stok">Stok</label><br>
        <input type="number" id="stok" name="stok"
               min="0" required>
    </p>

    <p>
        <label for="kategori">Kategori</label><br>
        <select id="kategori" name="kategori">
            <option value="fiksi">Fiksi</option>
            <option value="non-fiksi">Non-Fiksi</option>
            <option value="referensi">Referensi</option>
        </select>
    </p>

    <p>
        <button type="submit">Simpan</button>
    </p>
</form>
```

### D. Membuat `anggota/list.html`

Data anggota yang ditampilkan merupakan data dummy. Struktur tabel dibuat menggunakan HTML5 sehingga informasi anggota dapat ditampilkan secara terorganisir.

Contoh struktur tabel:

```html
<table>
    <thead>
        <tr>
            <th>No. Anggota</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No. HP</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        ...
    </tbody>
</table>
```

### E. Membuat `anggota/tambah.html`

Halaman `anggota/tambah.html` dibuat sebagai form untuk menambahkan data anggota. Form ini memiliki beberapa komponen input yang digunakan untuk memasukkan informasi anggota.

Form dibuat menggunakan elemen HTML seperti `form`, `label`, `input`, dan `button`. Sama seperti form tambah buku, pada tahap ini form belum terhubung dengan backend sehingga data yang dimasukkan belum diproses atau disimpan ke dalam database.

Contoh struktur form:

```html
<form>
    <p>
        <label for="no_anggota">No. Anggota</label><br>
        <input type="text" id="no_anggota" name="no_anggota" required>
    </p>

    <p>
        <label for="nama">Nama</label><br>
        <input type="text" id="nama" name="nama" required>
    </p>

    <p>
        <label for="alamat">Alamat</label><br>
        <input type="text" id="alamat" name="alamat" required>
    </p>

    <p>
        <label for="no_hp">No. HP</label><br>
        <input type="text" id="no_hp" name="no_hp" required>
    </p>

    <p>
        <button type="submit">Simpan</button>
    </p>
</form>
```

---

## HASIL LATIHAN

Berdasarkan langkah kerja yang telah dilakukan, berhasil dibuat beberapa halaman website menggunakan HTML5, yaitu:

1. `index.html` sebagai halaman beranda.
2. `buku/list.html` sebagai halaman daftar buku.
3. `buku/tambah.html` sebagai halaman form penambahan buku.
4. `anggota/list.html` sebagai halaman daftar anggota.
5. `anggota/tambah.html` sebagai halaman form penambahan anggota.

--- 

## LATIHAN REFLEKTIF
1. Kenapa field "Alamat" dan "No. HP" tidak diberi required, sedangkan "Nama" dan "No. Anggota" diberi?

"Nama" dan "No. Anggota" wajib diisi karena merupakan identitas utama pengguna yang sifatnya krusial di sistem. Sementara "Alamat" dan "No. HP" hanya data pendukung opsional untuk memudahkan pengguna agar tidak terbebani saat pengisian.

2. Apa yang akan terjadi (di browser) kalau kamu klik tombol "Simpan" tanpa mengisi field "Nama"? Coba buka filenya di browser dan praktikkan.

Validasi bawaan HTML5 akan memblokir pengiriman formulir, kursor otomatis berpindah ke kolom "Nama", dan peramban menampilkan pesan peringatan seperti "Please fill out this field" (Harap isi bidang ini).

3. Form ini juga belum punya action pada tag `<form>`-nya — apa dampaknya saat tombol "Simpan" ditekan?

Formulir akan mengirimkan data ke URL halaman itu sendiri dan memuat ulang halaman tersebut. Data tidak akan tersimpan ke dalam basis data karena tidak ada skrip backend penampung yang dituju.

---