<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "inventaris_barang";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// --- PASTIKAN DUA FUNGSI INI SUDAH TERTULIS DI SINI ---
function formatRupiah($angka) {
    $hasil = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil;
}

function hitungAset($stok, $harga) {
    $total = $stok * $harga;
    return $total;
}
?>
