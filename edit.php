<?php
// 1. Memanggil file koneksi agar bisa menggunakan database dan fungsinya
include 'koneksi.php';

// 2. Cek apakah ada ID yang dikirim di URL. Jika tidak ada, kembalikan ke halaman daftar
if (!isset($_GET['id'])) {
    header("Location: daftar.php");
    exit;
}

$id = $_GET['id'];

// 3. Ambil data barang lama berdasarkan ID tersebut
$ambildata = mysqli_query($koneksi, "SELECT * FROM barang WHERE id='$id'");
$d = mysqli_fetch_array($ambildata);

// Jika ID tidak ditemukan di database, kembalikan ke daftar
if (!$d) {
    header("Location: daftar.php");
    exit;
}

// 4. PROSES UPDATE DATA (Ketika tombol Simpan Perubahan diklik)
if (isset($_POST['ubah'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $kategori    = $_POST['kategori'];
    $stok        = $_POST['stok'];
    $harga       = $_POST['harga'];

    $query = "UPDATE barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', kategori='$kategori', stok='$stok', harga='$harga' WHERE id='$id'";
    mysqli_query($koneksi, $query);
    
    // Setelah edit sukses, pindah ke halaman daftar
    header("Location: daftar.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container container-mini">
    <h2>Form Edit Data Barang</h2>
    <form action="" method="POST">
        <label>Kode Barang</label>
        <input type="text" name="kode_barang" value="<?php echo $d['kode_barang']; ?>" required>

        <label>Nama Barang</label>
        <input type="text" name="nama_barang" value="<?php echo $d['nama_barang']; ?>" required>

        <label>Kategori</label>
        <select name="kategori" required>
            <option value="Elektronik" <?php if($d['kategori'] == "Elektronik") echo "selected"; ?>>Elektronik</option>
            <option value="Pakaian" <?php if($d['kategori'] == "Pakaian") echo "selected"; ?>>Pakaian</option>
            <option value="Makanan" <?php if($d['kategori'] == "Makanan") echo "selected"; ?>>Makanan</option>
            <option value="Alat Tulis" <?php if($d['kategori'] == "Alat Tulis") echo "selected"; ?>>Alat Tulis</option>
        </select>

        <label>Stok</label>
        <input type="number" name="stok" value="<?php echo $d['stok']; ?>" required>

        <label>Harga (Rp)</label>
        <input type="number" name="harga" value="<?php echo $d['harga']; ?>" required>

        <button type="submit" name="ubah" class="btn-warning">Simpan Perubahan</button>
        <a href="daftar.php" class="btn btn-secondary" style="margin-top: 10px; text-align:center; display:block;">Batal</a>
    </form>
</div>

</body>
</html>
