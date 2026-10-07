<?php
$host = "utawjeejvebswflkkviu.supabase.co"; 
$port = "5432"; 
$db   = "postgres"; 
$user = "postgres";
$pass = "8R6nEIciOywLMHT4"; 

$dsn = "pgsql:host=$host;port=$port;dbname=$db";

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
