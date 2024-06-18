<?php
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Query untuk menambahkan pengguna baru
    $query = "INSERT INTO users (email, username, password, role) VALUES ('$email', '$username', '$password', 'user')";
    if (mysqli_query($conn, $query)) {
        $message = "Registrasi berhasil. Silakan login.";
    } else {
        $message = "Terjadi kesalahan: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="images/logo.png" href="images/logo.png">
    <title>Register - JuaraJawara</title>
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

        .register-container {
            background: #fff;
            padding: 2em;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }

        .register-container h1 {
            margin-bottom: 1em;
            font-size: 24px;
        }

        .register-container input[type="email"],
        .register-container input[type="text"],
        .register-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .register-container button {
            background: #27374E;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        .register-container button:hover {
            background: #9CB2BF;
        }

        .message {
            color: green;
            margin-top: 10px;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .login-link {
            display: block;
            margin-top: 15px;
            color: #27374E;
            text-decoration: none;
            font-size: 14px;
        }

        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h1>JuaraJawara</h1>
        <p>please register</p>
        <?php if(isset($message)): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <form method="post" action="register.php">
            <input type="email" name="email" placeholder="email" required>
            <input type="text" name="username" placeholder="username" required>
            <input type="password" name="password" placeholder="password" required>
            <button type="submit">Register</button>
        </form>
        <a href="login.php" class="login-link">Already have an account? Login here</a>
    </div>
</body>

</html>
