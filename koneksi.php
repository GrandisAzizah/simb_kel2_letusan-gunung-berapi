<?php
// koneksi.php

$host = 'localhost';    // Host database Anda, biasanya 'localhost'
$user = 'root';         // Username database Anda, default XAMPP adalah 'root'
$pass = '';             // Password database Anda, default XAMPP kosong ''
$db   = 'gunung_berapi'; // Nama database Anda (dari file .sql)

// Membuat koneksi menggunakan MySQLi
$koneksi = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($koneksi->connect_error) {
    // Jika koneksi gagal, hentikan script dan tampilkan error
    die(json_encode([
        'status' => 'error',
        'message' => 'Koneksi database gagal: ' . $koneksi->connect_error
    ]));
}

// Mengatur charset ke utf8mb4 (sesuai dengan .sql Anda)
$koneksi->set_charset('utf8mb4');

// Kita tidak perlu menutup koneksi di sini, 
// file yang memanggil akan menggunakannya.
?>
