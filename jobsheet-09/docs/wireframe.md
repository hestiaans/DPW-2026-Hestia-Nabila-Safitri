# USER FLOW

### 1. Login Petugas
```text
[Petugas membuka halaman Login] -> [Memasukkan username & password]
        -> [Klik tombol "Login"]
        -> [Sistem validasi kredensial]
        -> [Jika salah] -> [Tampilkan pesan error] -> [Tetap di halaman Login]
        -> [Jika benar] -> [Redirect ke Dashboard / Halaman Beranda]
```

### 2. Lihat Daftar Buku
```text
[Pengguna klik menu "Daftar Buku"] -> [Halaman buku/list.html tampil] 
        -> [Sistem menampilkan seluruh koleksi buku] 
        -> [Selesai]
```

### 3. Tambah Buku Baru
```text
[Pengguna klik menu "Tambah Buku"] -> [Halaman buku/tambah.html tampil] 
        -> [Mengisi form data buku (judul, penulis, dll.)] 
        -> [Klik tombol "Simpan"] 
        -> [Data buku tersimpan ke database] 
        -> [Redirect / Kembali ke halaman Daftar Buku]
```

### 4. Lihat Daftar Anggota
```text
[Pengguna klik menu "Daftar Anggota"] -> [Halaman anggota/list.html tampil] 
        -> [Sistem menampilkan seluruh data anggota] 
        -> [Selesai]
```

## 5. Flow Peminjaman
```text
[Petugas Login] -> [Dashboard] -> [Pilih menu "Peminjaman Baru"]
        -> [Pilih Anggota] -> [Pilih Buku (stok > 0)]
        -> [Simpan] -> [Stok buku berkurang 1] -> [Kembali ke Dashboard]
```

## 6. Flow Pengembalian
```text
[Dashboard] -> [Menu "Pengembalian"] -> [Cari transaksi aktif (anggota/buku)]
        -> [Tandai "Dikembalikan"] -> [Stok buku bertambah 1]
        -> [Kembali ke Dashboard]
```

## 7. Flow Riwayat
```text
[Petugas Login] -> [Dashboard] -> [Pilih Menu Riwayat] -> [Tampilkan Daftar Semua Transaksi] 
-> [Opsional: Cari berdasarkan nama/judul] atau [Filter Status (Semua/Dipinjam/Dikembalikan/Terlambat)] 
-> [Sistem Perbarui Tampilan Daftar] -> [Pilih Salah Satu Transaksi] -> [Lihat Detail Peminjaman] -> [Selesai]
```

# WIREFRAME

### 1. Login Petugas
```text
╔══════════════════════════════════════════╗
║            SIMPUS-Mini                   ║
║           Login Petugas                  ║
║                                          ║
║       Username                           ║
║       [ Masukkan username   ]            ║
║                                          ║
║       Password                           ║
║       [ Masukkan password    ]           ║
║                                          ║
║              [ Login ]                   ║
║                                          ║
║   Belum punya akun? Daftar di sini       ║
╚══════════════════════════════════════════╝
```

### 2. Beranda Petugas
```text
╔════════════════════════════════════════════════════════════════════════╗
║  SIMPUS-Mini  |  Beranda  Buku  Anggota  Peminjaman  [Petugas]  Logout ║
╠════════════════════════════════════════════════════════════════════════╣
║                                                                        ║
║  ┌────────────────┐  ┌────────────────┐  ┌───────────────────┐         ║
║  │ 📚 Total Buku  │  │👥Total Anggota│  │ 📌Sedang Dipinjam │        ║
║  │     120        │  │     85         │  │     15            │         ║
║  └────────────────┘  └────────────────┘  └───────────────────┘         ║
║                                                                        ║
║  Aksi Cepat:                                                           ║
║   [ + Peminjaman Baru ]   [ + Pengembalian ]                           ║
║                                                                        ║
║  Transaksi Terbaru                                                     ║
║  ┌───────────────┬─────────────────┬────────────┬────────────┐         ║
║  │ Anggota       │ Buku            │ Tgl Pinjam │ Status     │         ║
║  ├───────────────┼─────────────────┼────────────┼────────────┤         ║
║  │ Siti Aminah   │ Laskar Pelangi  │ 20/05/2024 │ Dipinjam   │         ║
║  │ Budi Santoso  │ Bumi Manusia    │ 19/05/2024 │ Dipinjam   │         ║
║  │ Dewi Lestari  │ Negeri 5 Menara │18/05/2024  │ Diambilkan │         ║
║  └───────────────┴─────────────────┴────────────┴────────────┘         ║
║  [ Lihat semua transaksi → ]                                           ║
╚════════════════════════════════════════════════════════════════════════╝
```

### 3. Form Peminjaman
```text
╔══════════════════════════════════════════╗
║     Form Peminjaman Buku                 ║
║                                          ║
║   Anggota                                ║
║   [ -- Pilih Anggota -- ▼ ]              ║
║                                          ║
║   Buku                                   ║
║   [ -- Pilih Buku (stok > 0) -- ▼ ]      ║
║                                          ║
║   Tanggal Pinjam                         ║
║   [ 22/05/2024 ]  (Otomatis: hari ini)   ║
║                                          ║
║        [ 💾 Simpan Peminjaman ]          ║
╚══════════════════════════════════════════╝
```

### 4. Form Pengembalian
```text
╔═══════════════════════════════════════════════════════════════════════╗
║                     Pengembalian Buku                                 ║
║                                                                       ║
║   Cari transaksi aktif:                                               ║
║   [ Nama anggota / judul buku... ]                                    ║
║                                                                       ║
║   ┌──────────────┬────────────────┬────────────┬─────────────┐        ║
║   │ Anggota      │ Buku           │ Tgl Pinjam │ Aksi        │        ║
║   ├──────────────┼────────────────┼────────────┼─────────────┤        ║
║   │ Siti Aminah  │ Bumi Manusia   │ 15/05/2024 │ [Kembalikan]│        ║
║   │ Budi Santoso │ Laskar Pelangi │18/05/2024  │ [Kembalikan]│        ║
║   │ Dewi Lestari │ Negeri 5 Menara│19/05/2024  │ [Kembalikan]│        ║
║   └──────────────┴────────────────┴────────────┴─────────────┘        ║
╚═══════════════════════════════════════════════════════════════════════╝
```

### 5. Riwayat
```text
╔═══════════════════════════════════════════════════════════════════════╗
║         Riwayat Peminjaman — Siti Aminah                              ║
║                                                                       ║
║   ┌────────────────┬────────────┬────────────┬────────────┐           ║
║   │ Buku           │ Pinjam     │ Kembali    │ Status     │           ║
║   ├────────────────┼────────────┼────────────┼────────────┤           ║
║   │ Laskar Pelangi │01/07/2024  │10/07/2024  │ Seleksi    │           ║
║   │ Bumi Manusia   │15/07/2024  │ -          │ Dipinjam   │           ║
║   │ Negeri 5 Menara│20/06/2024  │28/06/2024  │ Seleksi    │           ║
║   │ Pulang         │05/06/2024  │12/06/2024  │ Seleksi    │           ║
║   └────────────────┴────────────┴────────────┴────────────┘           ║
║                                                                       ║
║   Keterangan Status:                                                  ║
║   • Dipinjam     • Seleksi     • Dikembalikan                         ║
╚═══════════════════════════════════════════════════════════════════════╝
```