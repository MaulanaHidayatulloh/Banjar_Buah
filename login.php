<?php
session_start();
include 'koneksi.php';

// Proses login
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
        // Validasi password
        if (password_verify($password, $row['password'])) {
            // Set session
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
            exit();
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
        exit();
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

     <!-- CSS -->
     <link rel="stylesheet" href="style.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="login-admin">
    <div class="login-container">
        <h2>Login Admin</h2>
        <form action="" method="POST">
            <div>
                <label for="username_email">Username/Email</label>
                <input type="text" name="username_email" id="username_email" required>
            </div>
            <div>
                <label for="password" class="password-login-admin">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <small>*Login khusus Admin</small>

            <button type="submit" class="btn-login">LOGIN</button>
        </form>
    </div>
</body>
</html>
