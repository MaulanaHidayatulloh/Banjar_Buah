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

    <!-- Bootstrap Icon -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />

    <title>Semua Buah</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav>
      <div class="navbar">
        <a href="index.php" class="brand">Banjar Buah</a>
        <a href="login.php" class="login-btn">Login Admin</a>
      </div>
    </nav>

    <!-- Semua Buah -->
    <div class="semuabuah-container">
      <div class="semuabuah-title">
        <h2>Semua Buah</h2>
        <form method="GET" class="cari-buah">
          <button type="submit"><i class="bi bi-search"></i></button>
          <input
            type="text"
            id="search"
            name="search"
            placeholder="Cari Buahmu"
            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
          />
        </form>
      </div>

      <!-- Isi -->
      <div class="semuabuah-boxes">
        <?php
        include 'koneksi.php';

        // Ambil query pencarian jika ada
        $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

        // Query data produk
        $sql = "SELECT * FROM produk_buah";
        if ($search !== '') {
            $sql .= " WHERE nama_buah LIKE '%$search%'";
        }
        $sql .= " ORDER BY nama_buah ASC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="semuabuah-box">
                  <div class="judul-semuabuah">
                    <img src="uploads/' . $row["gambar"] . '" alt="' . $row["nama_buah"] . '" />
                    <h3>' . htmlspecialchars($row["nama_buah"]) . '</h3>
                  </div>
                  <div class="ket-semuabuah">
                    <p>Rp. ' . number_format($row["harga"], 0, ',', '.') . '/Kg</p>
                    <p>Stok: ' . $row["stok"] . ' Kg</p>
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
  </body>
</html>
