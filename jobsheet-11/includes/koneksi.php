<?php
$host = "db.dsyqkmqevewtnnpaqdap.supabase.co"; 
$port = "5432"; 
$db   = "postgres"; 
$user = "postgres";
$pass = "rW9LS+ESi78!NZ?"; 

try {
    // 3. Menggunakan driver pgsql (PostgreSQL) bawaan PHP
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Opsional: aktifkan baris di bawah ini jika ingin mengetes koneksi sukses di layar
    // echo "Koneksi ke Supabase Berhasil!"; 
} catch (PDOException $e) {
    // Jika gagal, PHP akan langsung menjabarkan penyebab errornya di browser
    die("Koneksi database gagal: " . $e->getMessage());
}
