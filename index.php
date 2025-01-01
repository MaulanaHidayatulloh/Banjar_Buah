<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSS -->
    <link rel="stylesheet" href="style.css" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"
      rel="stylesheet"
    />

    <title>Banjar Buah</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav>
      <div class="navbar">
        <a href="#" class="brand">Banjar Buah</a>
        <a href="login.php" class="login-btn">Login <span>Admin</span></a>
      </div>
    </nav>

    <!-- Produk Buah -->
    <div class="container">
      <div class="product-title">
        <h2>Semua Buah</h2>
        <a href="semuabuah.php" class="view-all">Tampilkan semua</a>
      </div>

      <div class="product-grid">
        <?php
        include 'koneksi.php';

        // Query data produk dengan urutan stok terbanyak, dibatasi 9 item
        $sql = "SELECT * FROM produk_buah ORDER BY stok DESC LIMIT 9";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="product-item">
                <img src="uploads/' . $row["gambar"] . '" alt="' . $row["nama_buah"] . '" />
                  <div class="product-ket">
                    <h3>' . $row["nama_buah"] . '</h3>
                    <p>Rp. ' . number_format($row["harga"], 0, ',', '.') . '/Kg</p>
                    <p>Stok: ' . $row["stok"] . ' Kg</p>
                  </div>
                </div>';
            }
        } else {
            echo '<p>Tidak ada produk tersedia.</p>';
        }

        $conn->close();
        ?>
      </div>
    </div>
  </body>
</html>
