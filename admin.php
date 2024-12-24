<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
include 'koneksi.php';

// Ambil query pencarian jika ada
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// Query data produk
$sql = "SELECT * FROM produk_buah";
if ($search !== '') {
    $sql .= " WHERE nama_buah LIKE '%$search%'";
}
$sql .= " ORDER BY stok ASC";

$result = $conn->query($sql);
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
    
    <!-- Bootstrap Icon -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Halaman Admin</title>
</head>
<body class="kasir-container">
    <!-- Navbar -->
    <nav>
      <div class="navbar">
        <a href="riwayat_penjualan.php" class="riwayat-btn">Riwayat</a>
        <a class="brand">Banjar Buah</a>
        <a href="logout.php" class="logout-btn">Logout</a>
      </div>
    </nav>

    <div class="container">
        <div class="tab-menu">
                <a href="kasir.php" class="tab-admin">Kasir</a>
                <a href="#">Admin</a>
        </div>

        <!-- Halaman Admin -->
        <div class="admin-container">
            <form method="GET" class="cari-buah">
                <button type="submit"><i class="bi bi-search"></i></button>
                <input
                    type="text"
                    id="search"
                    name="search"
                    placeholder="Nama Buah"
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"/>
            </form>

            <a href="tambah_produk.php" class="tambahProduk_admin">+</a>

            <!-- Isi -->
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Cek apakah stok kurang dari 5
                    $lowStock = $row["stok"] < 5 ? 'low-stock' : '';
                    $icon = $row["stok"] < 5 ? '<i class="bi bi-exclamation-triangle-fill"></i>' : '';

                    echo '
                    <div class="admin-box">
                      <div class="judul-adminBuah ' . $lowStock . '">
                        ' . $icon . '
                        <img src="uploads/' . $row["gambar"] . '" alt="' . $row["nama_buah"] . '" />
                        <h3>' . htmlspecialchars($row["nama_buah"]) . '</h3>
                      </div>
                      <div class="ket-adminBuah">
                        <p>Stok : ' . $row["stok"] . ' Kg</p>
                        <p>Harga : Rp. ' . number_format($row["harga"], 0, ',', '.') . '/Kg</p>
                      </div>
                      <div class="buttonAksi_admin">
                        <a class="editProduk_admin" href="edit_produk.php?id=' . $row['id'] . '">Edit</a>
                        <a class="hapusProduk_admin" href="#" data-id="' . $row['id'] . '">Hapus</a>
                      </div> 
                    </div>';
                }
            } else {
                echo '<p>Tidak ada produk yang sesuai dengan pencarian Anda.</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>

<script>
// SweetAlert2
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',  
    cancelButton: 'btn btn-danger'    
  },
  buttonsStyling: false  
});

document.querySelectorAll('.hapusProduk_admin').forEach(function(element) {
    element.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.getAttribute('data-id');
        
        swalWithBootstrapButtons.fire({
            title: 'Apakah Anda yakin ingin menghapus produk buah ini?',
            text: 'Data produk buah ini akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal Hapus',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire({
                    title: 'Dihapus!',
                    text: 'Produk buah ini telah dihapus.',
                    icon: 'success'
                }).then(() => {
                    window.location.href = 'hapus.php?id=' + id;
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: 'Dibatalkan',
                    text: 'Produk buah ini tidak jadi dihapus!',
                    icon: 'error'
                });
            }
        });
    });
});
</script>

</body>
</html>
