<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart = json_decode($_POST['cart'], true);

    foreach ($cart as $item) {
        $namaBuah = $item['namaBuah'];
        $jumlahBeli = $item['jumlahBeli'];
        $subtotal = $item['harga'];

        // Kurangi stok di tabel produk
        $updateStok = "UPDATE produk_buah SET stok = stok - ? WHERE nama_buah = ?";
        $stmtStok = $conn->prepare($updateStok);
        $stmtStok->bind_param("ds", $jumlahBeli, $namaBuah);
        $stmtStok->execute();

        // Tambahkan data ke tabel penjualan
        $insertPenjualan = "INSERT INTO penjualan (product_id, jumlah_beli, total_harga, tanggal) VALUES (
            (SELECT id FROM produk_buah WHERE nama_buah = ?), ?, ?, NOW()
        )";
        $stmtPenjualan = $conn->prepare($insertPenjualan);
        $stmtPenjualan->bind_param("sdd", $namaBuah, $jumlahBeli, $subtotal);
        $stmtPenjualan->execute();
    }

    echo json_encode(['message' => 'Pembelian berhasil!']);
}
?>
