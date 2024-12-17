<?php
include 'koneksi.php';

// Ambil ID dari URL dan validasi
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Periksa apakah ID ada dalam database
    $result = $conn->query("SELECT COUNT(*) FROM produk_buah WHERE id = $id");
    if ($result->fetch_row()[0] > 0) {
        // Menggunakan prepared statement untuk menghapus data
        $stmt = $conn->prepare("DELETE FROM produk_buah WHERE id = ?");
        $stmt->bind_param("i", $id); // 'i' untuk integer
        if ($stmt->execute()) {
            // Redirect setelah berhasil menghapus
            header("Location: admin.php?status=deleted");
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "ID tidak ditemukan di database.";
    }
} else {
    echo "ID tidak valid.";
}

$conn->close();
?>
