<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #53c358, #9ed32d);
        }
        .login-container {
            background-color: #FFDA44;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            width: 350px;
        }
        h2 {
            text-align: center;
            color: #000;
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }
        .btn-login {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #ff9f43;
            color: #000;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            border: none;
        }
        .btn-login:hover {
            background-color: #ff8f33;
        }
        small {
            color: red;
            font-size: 12px;
            display: block;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Admin</h2>
        <form action="proses_login.php" method="POST">
            <label for="username_email">Username atau Email</label>
            <input type="text" name="username_email" id="username_email" placeholder="Username atau Email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required>

            <small>*Login khusus Admin</small>

            <button type="submit" class="btn-login">LOGIN</button>
        </form>
    </div>
</body>
</html>
