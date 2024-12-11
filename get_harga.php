<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaBuah = $_POST['nama_buah'];

    $query = "SELECT harga FROM produk_buah WHERE nama_buah = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $namaBuah);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode(['harga' => $data['harga']]);
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Produk tidak ditemukan']);
    }
}
?>
