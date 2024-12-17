<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan'])) {
    $nama_buah = $_POST['nama_buah'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Upload file gambar
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO produk_buah (nama_buah, harga, stok, gambar) VALUES ('$nama_buah', '$harga', '$stok', '$gambar')";
        if ($conn->query($sql) === TRUE) {
            echo "
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Produk Buah berhasil dibuat!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'admin.php';
                    });
                });
            </script>";
        } else {
            echo "
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan: " . addslashes($conn->error) . "',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
            </script>";
        }
        
    } else {
        echo "Upload gambar gagal.";
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
    
    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <title>Tambah Produk Buah</title>
    <script src="js/tambah_buah.js" defer></script>
</head>
<body class="kasir-container">
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
            <h2>Tambah Produk Buah</h2>
            <form id="form-produk" action="" method="post" enctype="multipart/form-data">
                <div class="tambah-produk-box">
                    <div class="tambah-produk-section">
                        <div class="tambah-produk-ket">
                            <p>Nama Buah :</p>
                            <input type="text" name="nama_buah" required>
                        </div>
                        <div class="tambah-produk-ket">
                            <p>Harga :</p> 
                            <input type="number" name="harga" required>
                        </div>
                        <div class="tambah-produk-ket">
                            <p>Stok :</p>
                            <div class="stok-input">
                                <input type="number" id="stok-produkBuah" step="0.1" name="stok" required>
                                <button type="button" id="increment-btn">+</button>
                                <button type="button" id="decrement-btn">−</button>
                            </div>
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
