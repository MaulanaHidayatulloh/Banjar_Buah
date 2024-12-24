<?php
include 'koneksi.php';

// Mengatur locale ke Format Indonesia
setlocale(LC_TIME, 'id_ID.UTF-8', 'Indonesian_Indonesia.1252');

// Fungsi untuk format tanggal ke format Indonesia
function formatTanggalIndonesia($tanggal) {
    $tanggal = strtotime($tanggal);
    return strftime('%d %B %Y', $tanggal);
}

// Inisialisasi variabel
$dari_tanggal = isset($_GET['dari_tanggal']) ? $_GET['dari_tanggal'] : '';
$sampai_tanggal = isset($_GET['sampai_tanggal']) ? $_GET['sampai_tanggal'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Data penjualan
$penjualan = [];

// Jika tanggal diinputkan
if (!empty($dari_tanggal) && !empty($sampai_tanggal)) {
    $sql = "SELECT produk_buah.nama_buah, penjualan.tanggal, 
                   SUM(penjualan.jumlah_beli) AS total_beli, 
                   SUM(penjualan.total_harga) AS total_harga
            FROM penjualan
            JOIN produk_buah ON penjualan.product_id = produk_buah.id
            WHERE penjualan.tanggal BETWEEN ? AND ?";

    // Jika ada pencarian nama buah
    if (!empty($search)) {
        $sql .= " AND produk_buah.nama_buah LIKE ?";
    }

    $sql .= " GROUP BY produk_buah.nama_buah, penjualan.tanggal
              ORDER BY penjualan.tanggal ASC";

    $stmt = $conn->prepare($sql);

    // Bind parameter sesuai dengan kondisi pencarian
    if (!empty($search)) {
        $search_param = "%$search%";
        $stmt->bind_param('sss', $dari_tanggal, $sampai_tanggal, $search_param);
    } else {
        $stmt->bind_param('ss', $dari_tanggal, $sampai_tanggal);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $penjualan[] = $row;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penjualan</title>
    
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

</head>
<body class="riwayat-container">
    <!-- Navbar -->
    <nav>
      <div class="navbar">
        <a href="admin.php" class="riwayat-btn">Admin</a>
        <a class="brand">Banjar Buah</a>
        <a href="logout.php" class="logout-btn">Logout</a>
      </div>
    </nav>

    <!-- Riwayat -->
    <div class="container">
        <div class="riwayat-title">
            <h1>Riwayat Penjualan</h1>
            <form method="GET" class="form-riwayat">
                <div class="riwayat-tanggal">
                    <label for="dari_tanggal">Dari</label>
                    <input type="date" id="dari_tanggal" name="dari_tanggal" value="<?= htmlspecialchars($dari_tanggal ?? '') ?>" required>
                </div>
                <div class="riwayat-tanggal">
                    <label for="sampai_tanggal">Sampai</label>
                    <input type="date" id="sampai_tanggal" name="sampai_tanggal" value="<?= htmlspecialchars($sampai_tanggal ?? '') ?>" required>
                </div>
                <button type="submit">cari</button>
            </form>
        </div>

        <?php if (!empty($penjualan)): ?>
            <form method="GET" class="cari-buah">
                <input type="hidden" name="dari_tanggal" value="<?= htmlspecialchars($dari_tanggal) ?>">
                <input type="hidden" name="sampai_tanggal" value="<?= htmlspecialchars($sampai_tanggal) ?>">
                <button type="submit"><i class="bi bi-search"></i></button>
                <input
                    type="text"
                    id="search"
                    name="search"
                    placeholder="Cari Nama Buah"
                    value="<?= htmlspecialchars($search ?? '') ?>"/>
            </form>

            <div class="riwayat-penjualan-list">
                <?php foreach ($penjualan as $item): ?>
                    <div class="riwayat-penjualan-card">
                        <div><h3><?= htmlspecialchars($item['nama_buah']) ?></h3></div>
                        <div><p><?= formatTanggalIndonesia($item['tanggal']) ?></p></div>                        
                        <div><p class="riwayat-total-pembelian"><?= htmlspecialchars($item['total_beli']) ?> Kg</p></div>
                        <div><p class="riwayat-total-harga">Rp. <?= number_format($item['total_harga'], 0, ',', '.') ?></p></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif (!empty($dari_tanggal) && !empty($sampai_tanggal)): ?>
            <p style="text-align :center; font-size: 20px; margin-top: 5rem; font-weight: bold;">Tidak ada Riwayat penjualan untuk tanggal yang dipilih</p>
        <?php else : ?>
            <p style="text-align :center; font-size: 20px; margin-top: 5rem; font-weight: bold;">Input Tanggal yang ingin ditampilkan Riwayat penjualan</p>
        <?php endif; ?>
    </div>
</body>
</html>
