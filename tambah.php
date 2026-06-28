<?php
// Memenuhi syarat: include/require
include 'koneksi.php';

// Memenuhi syarat: Form Processing POST & Create (CRUD)
if (isset($_POST['simpan'])) {
    $kode_barang = $_POST['kode_barang']; // Memenuhi syarat: Variabel
    $nama_barang = $_POST['nama_barang'];
    $kategori    = $_POST['kategori'];
    $stok        = $_POST['stok'];
    $harga       = $_POST['harga'];

    $query = "INSERT INTO barang (kode_barang, nama_barang, kategori, stok, harga) VALUES ('$kode_barang', '$nama_barang', '$kategori', '$stok', '$harga')";
    mysqli_query($koneksi, $query);
    header("Location: daftar.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container container-mini">
    <h2>Form Tambah Barang</h2>
    <form action="" method="POST">
        <label>Kode Barang</label>
        <input type="text" name="kode_barang" placeholder="Contoh: BRG001" required>

        <label>Nama Barang</label>
        <input type="text" name="nama_barang" placeholder="Masukkan Nama Barang" required>

        <label>Kategori</label>
        <select name="kategori" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="Elektronik">Elektronik</option>
            <option value="Pakaian">Pakaian</option>
            <option value="Makanan">Makanan</option>
            <option value="Alat Tulis">Alat Tulis</option>
        </select>

        <label>Stok</label>
        <input type="number" name="stok" placeholder="0" required>

        <label>Harga (Rp)</label>
        <input type="number" name="harga" placeholder="0" required>

        <button type="submit" name="simpan" class="btn-success">Simpan Barang</button>
        <a href="index.php" class="btn btn-secondary" style="margin-top: 10px;">Kembali ke Home</a>
    </form>
</div>

</body>
</html>
