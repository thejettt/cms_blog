<?php
session_start();
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa pengguna
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        // Login berhasil
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['email'] = $user['email']; // Simpan email dalam sesi

        if ($user['role'] == 'admin') {
            header('Location: admin/dashboard.php');
        } else {
            header('Location: index.php');
        }
        exit();
    } else {
        $error = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="images/logo.png" href="images/logo.png">
    <title>Login - JuaraJawara</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .login-container {
            background: #fff;
            padding: 2em;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }

        .login-container h1 {
            margin-bottom: 1em;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .login-container button {
            background: #27374E;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .login-container button:hover {
            background: #9CB2BF;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .register-link {
            display: block;
            margin-top: 15px;
            color: #27374E;
            text-decoration: none;
            font-size: 14px;
        }

        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>JuaraJawara</h1>
        <p>please login</p>
        <?php if(isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="post" action="login.php">
            <input type="text" name="username" placeholder="username" required>
            <input type="password" name="password" placeholder="password" required>
            <button type="submit">Login</button>
        </form>
        <a href="register.php" class="register-link">Don't have an account? Register here</a>
    </div>
</body>
</html>
