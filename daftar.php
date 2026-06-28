<?php
include 'koneksi.php';

// Memenuhi syarat: Form Processing GET & Delete (CRUD) serta Percabangan (if)
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM barang WHERE id='$id'");
    header("Location: daftar.php");
}

// Memenuhi syarat: Read (CRUD)
$ambil_data = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Inventaris Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Daftar Inventaris Barang</h2>
    
    <div style="margin-bottom: 20px;">
        <a href="index.php" class="btn btn-secondary btn-sm" style="width: auto;">🏠 Home</a>
        <a href="tambah.php" class="btn btn-success btn-sm" style="width: auto;">➕ Tambah Barang Baru</a>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php 
        $no = 1;
        $grand_total = 0; // Variabel untuk menampung total aset semua barang

        // Memenuhi syarat: Perulangan (while)
        while($d = mysqli_fetch_array($ambil_data)){ 
            // Memanggil FUNGSI 2 untuk menghitung nilai aset per barang
            $nilai_aset_barang = hitungAset($d['stok'], $d['harga']);
            $grand_total += $nilai_aset_barang;
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['kode_barang']; ?></td>
            <td><?php echo $d['nama_barang']; ?></td>
            <td><?php echo $d['kategori']; ?></td>
            <td><?php echo $d['stok']; ?></td>
            <td><?php echo formatRupiah($d['harga']); ?></td>
            <td>
                <a href="edit.php?id=<?php echo $d['id']; ?>" class="btn-sm btn-warning">Edit</a>
                <a href="daftar.php?aksi=hapus&id=<?php echo $d['id']; ?>" class="btn-sm btn-danger" onclick="return confirm('Hapus barang ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
        
        <tr style="background-color: #f1f5f9; font-weight: bold;">
            <td colspan="5" style="text-align: right;">Total Nilai Aset Gudang :</td>
            <td colspan="2"><?php echo formatRupiah($grand_total); ?></td>
        </tr>
    </table>
</div>

</body>
</html>
