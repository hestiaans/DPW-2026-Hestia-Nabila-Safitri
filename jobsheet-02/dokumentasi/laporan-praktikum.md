# LAPORAN PRAKTIKUM PEMROGRAMAN WEB
## JOBSHEET 02: CSS3 Styling Dasar

### **INFORMASI PRAKTIKUM**
* **Mata Kuliah:** Desain & Pemrograman Web 2026
* **Modul:** Jobsheet 02 - CSS3 Styling Dasar
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

---

## HASIL PRAKT

### 1. Reset dan Base Style

Bagian awal CSS digunakan untuk melakukan reset terhadap nilai bawaan browser.

```css
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}
```

Selector `*` memilih seluruh elemen HTML. Property `box-sizing: border-box` membuat ukuran elemen lebih mudah dikontrol karena `padding` dan `border` dihitung ke dalam ukuran elemen.

Property `margin: 0` dan `padding: 0` digunakan untuk menghilangkan jarak bawaan browser sehingga tampilan dapat diatur secara konsisten menggunakan CSS.

### 2. Pengaturan Body

```css
body {
  font-family: "Segoe UI", Arial, sans-serif;
  color: #2b2b2b;
  background-color: #f5f6f8;
  line-height: 1.5;
}
```

Style pada `body` digunakan sebagai dasar tampilan seluruh halaman.

- `font-family` menentukan jenis huruf yang digunakan.
- `color` menentukan warna teks utama.
- `background-color` memberikan warna latar belakang halaman.
- `line-height: 1.5` memberikan jarak antarbaris agar teks lebih mudah dibaca.

Penggunaan beberapa jenis font pada `font-family` berfungsi sebagai **fallback** (pilihan cadangan) apabila font utama tidak tersedia pada perangkat pengguna.

### 3. Pengaturan Link

```css
a {
  color: #1d5b8a;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}
```

Selector `a` digunakan untuk mengatur seluruh elemen hyperlink.

### 4. Header dan Navbar

```css
header {
  background-color: #1d5b8a;
  color: #fff;
  padding: 1rem 1.5rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
}
```

Digunakan untuk mengatur tampilan header dan posisi nama website serta menu navigasi.

Navbar menggunakan Flexbox agar menu tersusun secara horizontal.

```css
header nav ul {
  list-style: none;
  display: flex;
  gap: 1.25rem;
}
```

list-style: none digunakan untuk menghilangkan tanda bullet pada menu.

### 5. Main dan Section

```css
main {
  max-width: 1000px;
  margin: 2rem auto;
  padding: 0 1.5rem;
}
```

Digunakan untuk mengatur lebar dan posisi konten utama agar berada di tengah halaman.

```css
section {
  background-color: #fff;
  border-radius: 8px;
  padding: 1.5rem;
  margin-bottom: 1.5rem;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
}
```

Digunakan untuk membuat setiap bagian konten memiliki background putih, sudut melengkung, jarak dalam, dan bayangan.

### 6. Kartu Statistik

```css
main section:nth-of-type(2) {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1rem;
}
```

Digunakan untuk membuat tiga kartu statistik tersusun dalam tiga kolom menggunakan CSS Grid.

Kartu tersebut menampilkan:

a. Total Buku

b. Total Anggota

c. Sedang Dipinjam

### 7. Tabel

```css
table {
  width: 100%;
  border-collapse: collapse;
}
```

Digunakan agar tabel memenuhi lebar area dan tampil lebih rapi.

```css
thead {
  background-color: #1d5b8a;
  color: #fff;
}
```

Digunakan untuk memberikan warna pada bagian header tabel.

```css
tbody tr:nth-child(even) {
  background-color: #f7f9fb;
}
```

Digunakan untuk memberikan warna berbeda pada baris genap agar tabel lebih mudah dibaca.

### 8. Form

```css
form input,
form select {
  width: 100%;
  max-width: 400px;
  padding: 0.55rem 0.7rem;
  border: 1px solid #cdd4da;
  border-radius: 4px;
}
```

Digunakan untuk mengatur ukuran dan tampilan input serta pilihan kategori pada halaman Tambah Buku.

Tombol submit diberikan warna biru agar sesuai dengan tema website.

### 9. Footer

```css
footer {
  text-align: center;
  padding: 1.25rem;
  color: #7a8794;
  font-size: 0.9rem;
}
```

Digunakan untuk mengatur posisi, warna, dan ukuran teks pada bagian footer.

---

Setelah CSS diterapkan, website SIMPUS-Mini memiliki tampilan yang lebih rapi. Header dan navbar tersusun dengan baik, kartu statistik menggunakan tiga kolom, tabel lebih mudah dibaca, dan form memiliki tampilan yang lebih teratur.