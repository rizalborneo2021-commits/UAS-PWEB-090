<?php
include 'koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Jalankan perintah hapus
mysqli_query($koneksi, "DELETE FROM barang WHERE id='$id'");

// Lempar kembali ke halaman utama
header("Location: index.php");
?>
