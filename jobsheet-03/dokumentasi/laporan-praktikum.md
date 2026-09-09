# LAPORAN PRAKTIKUM PEMROGRAMAN WEB
## JOBSHEET 03: Responsive Design

### **INFORMASI PRAKTIKUM**
* **Mata Kuliah:** Desain & Pemrograman Web 2026
* **Modul:** Jobsheet 03 - Responsive Design
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
### A. Perubahan pada Berkas

1. **Penambahan meta viewport pada kelima halaman HTML**

```html
<meta name="viewport" content="width=device-width, initial-scale=1">
```

Tujuannya agar tampilan web dapat menyesuaikan diri secara akurat dengan lebar layar perangkat yang digunakan.

2. **Pemasangan pasangan checkbox dan menu hamburger**

```html
<input type="checkbox" id="nav-toggle" class="nav-toggle">
<label for="nav-toggle" class="nav-toggle-label">&#9776;</label>
```

3. **Penambahan div pembungkus untuk tabel responsif**

```html
<div class="table-responsive">
```
---

### B. CSS untuk Hamburger dan Checkbox

1. **Menyembunyikan Checkbox**

```css
.nav-toggle {
    display: none;
}
```
Checkbox tidak ditampilkan karena tidak perlu terlihat oleh pengguna. Fungsinya hanya sebagai penanda status:

- Dicentang → menu terbuka.

- Tidak dicentang → menu tertutup.

2. **Label Berperan sebagai Tombol Hamburger**

```css
.nav-toggle-label {
    display: none;
    font-size: 1.6rem;
    color: #fff;
    cursor: pointer;
}
```
Karena checkbox disembunyikan, <label> digunakan sebagai pengganti tombol. Label menampilkan ikon hamburger ☰, dan terhubung dengan checkbox melalui atribut for:

```html
<label for="nav-toggle">☰</label>
<input type="checkbox" id="nav-toggle">
```
Dengan demikian, saat pengguna mengklik ikon ☰, status checkbox akan otomatis berubah (centang/tidak). Pada layar besar, tombol hamburger disembunyikan dengan display: none.

3. **Menyembunyikan Menu di Perangkat Bergerak**

```css
header nav {
    display: none;
    width: 100%;
    order: 3;
    margin-top: 1rem;
}
```
Aturan ini berlaku untuk layar kecil (misalnya ponsel).

``` css
display: none;
```
 → menu disembunyikan terlebih dahulu.

```css 
width: 100%;
```
 → menu memenuhi lebar penuh.

```css
order: 3;
```
 → posisi menu berada setelah elemen lain dalam tata letak Flexbox.

4. **Menghubungkan Status Checkbox dengan Navigasi**

```css
.nav-toggle:checked ~ nav {
    display: block;
}
```
Inilah inti dari checkbox hack. Saat checkbox .nav-toggle dalam keadaan dicentang, maka elemen <nav> akan ditampilkan.

- nav-toggle → elemen checkbox.

- :checked → status checkbox sedang dicentang.

- ~ → memilih elemen saudara yang berada setelah checkbox.

- nav → elemen menu yang akan dimunculkan.

5. **Mengapa Aturan Ditulis Ulang di dalam Media Query?**

Karena CSS menerapkan aturan yang berbeda untuk ukuran layar yang berbeda. Pada layar besar, tombol hamburger disembunyikan. Namun, di dalam media query dengan kondisi layar maksimal 480px, tombol hamburger justru dimunculkan.

Ketika ukuran layar memenuhi:

```css
max-width: 480px
```
Aturan di dalam @media akan berlaku dan menimpa aturan sebelumnya.

6. **Menu Menjadi Vertikal**

```css
header nav ul {
    flex-direction: column;
    gap: 0.75rem;
}
```

---

### C. CSS Tabel Responsif
Diberikan satu properti agar tabel dapat ditampilkan sesuai lebar aslinya di layar ponsel, namun dengan pendekatan gulir horizontal sehingga pengguna cukup menggeser (swipe di ponsel atau scroll horizontal di mouse/trackpad) untuk melihat kolom yang terpotong.

```css
.table-responsive {
    overflow-x: auto;
}
```
overflow-x mengatur perilaku konten yang melampaui lebar elemen pada arah horizontal (terdapat pula overflow-y untuk vertikal, dan overflow untuk keduanya).
Nilai auto berarti browser hanya akan menampilkan bilah gulir jika benar-benar diperlukan (isi di dalamnya melebihi lebar kotak). Jika tabel cukup sempit dan muat (misalnya di layar desktop yang lebar), tidak ada gulir yang muncul—perilaku ini lebih ramah dibandingkan nilai scroll yang selalu menampilkan gulir meski tidak diperlukan.

---

### D. CSS Media Query

`@media` digunakan untuk menyesuaikan tampilan situs berdasarkan ukuran layar. Terdapat dua titik henti (*breakpoint*) yang diterapkan:

- ≤ 768px → Tablet
- ≤ 480px → Ponsel / HP

1. **Breakpoint Tablet (≤ 768px)**

**Perubahan tata letak:**
- Desktop: **3 kolom**
- Tablet: **2 kolom**

Kartu ketiga akan turun ke baris berikutnya secara otomatis.

2. **Breakpoint Ponsel (≤ 480px)**

**Perubahan tata letak:**
- Kartu statistik disusun menjadi **1 kolom** penuh.

```css
main section:nth-of-type(2) {
    grid-template-columns: 1fr;
}
```

Berikut ringkasan jumlah kolom berdasarkan ukuran layar:

| Ukuran Layar     | Jumlah Kolom |
| ---------------- | ------------ |
| Desktop (> 768px) | 3 kolom      |
| Tablet (≤ 768px)  | 2 kolom      |
| Ponsel (≤ 480px)  | 1 kolom      |

3. **Formulir Input**

Pada perangkat ponsel, elemen input dan dropdown dibuat agar memanfaatkan lebar penuh layar sehingga lebih nyaman digunakan.

```css
form input,
form select {
    max-width: 100%;
}
```