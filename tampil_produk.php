<?php
include 'koneksi.php';

$sql = "SELECT * FROM produk_buah";
$result = $conn->query($sql);
?>

<table border="1">
    <tr>
        <th>No</th>
        <th>Nama Buah</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>
    <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama_buah']; ?></td>
        <td><?= $row['harga']; ?></td>
        <td><?= $row['stok']; ?></td>
        <td><img src="uploads/<?= $row['gambar']; ?>" width="50"></td>
        <td>
            <a href="edit_produk.php?id=<?= $row['id']; ?>">Edit</a> |
            <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Hapus data?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
