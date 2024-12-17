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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    <title>Banjar Buah - Kasir</title>
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

    <!-- Kasir -->
    <div class="container">
        <div class="tab-menu">
            <a href="#">Kasir</a>
            <a href="admin.php" class="tab-admin">Admin</a>
        </div>

        <div id="kasir-section" class="kasir-section">
            <div class="form-section">
                <div class="form-row">
                    <label for="nama-buah">Nama Buah</label>
                    <select id="nama-buah">
                        <option value="">Pilih Buah</option>
                        <?php
                        include 'koneksi.php';
                        $query = "SELECT nama_buah, stok FROM produk_buah ORDER BY nama_buah ASC";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['nama_buah'] . "' data-stok='" . $row['stok'] . "'>" . $row['nama_buah'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-row">
                    <label for="jumlah-beli">Jumlah Beli (Kg)</label>
                    <input type="number" id="jumlah-beli" min="0.1" step="0.1">
                </div>
                <div class="form-row">                
                    <button id="cancel-btn" class="btn-cancel">Cancel</button>
                    <button id="tambah-btn" class="btn-tambah">Tambah</button>
                </div>
            </div>
            <div class="cart-section">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Buah</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody id="cart-body" class="cart-body"></tbody>
                </table>
                <div class="total-section">
                    <p>Total Harga: <span id="total-harga">Rp 0</span></p>
                    <button id="beli-btn" class="btn-green">Beli</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="js/kasir.js"></script>
</body>
</html>
