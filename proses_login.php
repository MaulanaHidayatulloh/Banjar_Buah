<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_email = $_POST['username_email'];
    $password = $_POST['password'];

    // Query untuk cek username/email
    $sql = "SELECT * FROM admin WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username_email, $username_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Validasi password menggunakan password_verify
        if (password_verify($password, $row['password'])) {
            // Set session dan redirect langsung ke admin.php
            $_SESSION['username'] = $row['username'];
            header("Location: admin.php");
            exit();
        } else {
            // Jika password salah
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Password salah.',
                        icon: 'error',
                        confirmButtonText: 'Coba Lagi'
                    }).then(() => {
                        window.location.href = 'login.php';
                    });
                });
            </script>";
        }
    } else {
        // Jika username/email tidak ditemukan
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Username atau Email tidak ditemukan.',
                    icon: 'error',
                    confirmButtonText: 'Coba Lagi'
                }).then(() => {
                    window.location.href = 'login.php';
                });
            });
        </script>";
    }
    $stmt->close();
}
$conn->close();
?>
