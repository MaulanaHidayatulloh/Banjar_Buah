<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "SELECT * FROM produk_buah WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_buah = $_POST['nama_buah'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($gambar);

        move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);
        $sql = "UPDATE buah SET nama_buah = '$nama_buah', harga = '$harga', stok = '$stok', gambar = '$gambar' WHERE id = $id";
    } else {
        $sql = "UPDATE buah SET nama_buah = '$nama_buah', harga = '$harga', stok = '$stok' WHERE id = $id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diupdate.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    
    <title>Tambah Produk Buah</title>
    <script src="js/tambah_buah.js" defer></script>
</head>
<body>
    <!-- Navbar -->
    <nav>
      <div class="navbar">
        <a href="riwayat.php" class="riwayat-btn">Riwayat</a>
        <a class="brand">Banjar Buah</a>
        <a href="logout.php" class="logout-btn">Logout</a>
      </div>
    </nav>

    <div class="container">
        <div class="tab-menu">
                <a href="kasir.php" class="tab-admin">Kasir</a>
                <a href="admin.php">Admin</a>
        </div>

        <!-- Tambah Produk -->
        <div class="tambah-produk">
            <h2>Edit Buah</h2>
            <form id="form-produk" action="" method="post" enctype="multipart/form-data">
                <div class="tambah-produk-box">
                    <div class="tambah-produk-section">
                        <div class="tambah-produk-ket">
                            <p>Nama Buah :</p>
                            <input type="text" name="nama_buah"  value="<?= $row['nama_buah']; ?>" required>
                        </div>
                        <div class="tambah-produk-ket">
                            <p>Harga :</p> 
                            <input type="number" name="harga" value="<?= $row['harga']; ?>" required>
                        </div>
                        <div class="tambah-produk-ket">
                            <p>Stok :</p>
                            <input type="number" step="0.1" name="stok" value="<?= $row['stok']; ?>" required>
                        </div>
                    </div>
                    <div class="tambah-produk-image">
                        <p>Gambar :</p> 
                        <input type="file" name="gambar" accept="image/*" onchange="previewImage(event)" required>
                    
                        <!-- Preview Gambar -->
                        <img id="preview-gambar" src="#" alt="Preview Gambar">

                    </div>
                </div>
                <!-- Buttons -->
                <div class="tambah-produk-button">
                    <button type="button" id="cancel-btn-buah" class="btn-cancel" >Cancel</button>
                    <button type="submit" name="simpan" class="btn-simpan" >Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


<!-- <form action="" method="post" enctype="multipart/form-data">
    Nama Buah: <input type="text" name="nama_buah" value="<?= $row['nama_buah']; ?>" required><br>
    Harga: <input type="number" name="harga" value="<?= $row['harga']; ?>" required><br>
    Stok: <input type="number" name="stok" value="<?= $row['stok']; ?>" required><br>
    Gambar: <input type="file" name="gambar"><br>
    <button type="submit">Update</button>
</form> -->
