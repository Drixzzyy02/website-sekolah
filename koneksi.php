<?php
// koneksi.php
// konfigurasi koneksi database MySQL untuk project LSP_HendikaGG

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'lsp_hendika';

$koneksi = mysqli_connect($host, $user, $password, $dbname);

if (!$koneksi) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

mysqli_set_charset($koneksi, 'utf8');

// Contoh penggunaan:
// include 'koneksi.php';
// $result = mysqli_query($koneksi, "SELECT * FROM tabel");

?>
