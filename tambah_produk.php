<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_buah = $_POST['nama_buah'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO produk_buah (nama_buah, harga, stok, gambar) VALUES ('$nama_buah', '$harga', '$stok', '$gambar')";
        if ($conn->query($sql) === TRUE) {
            echo "Data berhasil ditambahkan.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Upload gambar gagal.";
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    Nama Buah: <input type="text" name="nama_buah" required><br>
    Harga: <input type="number" name="harga" required><br>
    Stok: <input type="number" name="stok" required><br>
    Gambar: <input type="file" name="gambar" required><br>
    <button type="submit">Tambah</button>
</form>
