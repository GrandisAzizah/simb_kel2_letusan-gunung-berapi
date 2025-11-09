<?php
$koneksi = new mysqli("localhost", "root", "", "gunung_berapi");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
