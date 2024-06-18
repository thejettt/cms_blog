<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}
$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin_style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" type="images/logo.png" href="images/logo.png">
    <title>Dashboard</title>
</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <div class="logo-container">
                <img src="../images/logo.png" alt="Logo" class="logo">
                <h2 class="site-title">JuaraJawara</h2>
            </div>
            <nav>
                <ul>
                    <li><a href="dashboard.php" class="active"><span class="icon"><i class="fas fa-tachometer-alt"></i></span> Dashboard</a></li>
                    <li><a href="category.php"><span class="icon"><i class="fas fa-folder-plus"></i></span> Category</a></li>
                    <li><a href="article.php"><span class="icon"><i class="fas fa-file-alt"></i></span> Article</a></li>
                </ul>
            </nav>
            <div class="logout-section">
                <a href="logout.php"><span class="icon"><i class="fas fa-sign-out-alt"></i></span> Log Out</a>
                <p>Login as : <?php echo $email; ?></p>
            </div>
        </div>
        <div class="admin-main">
            <h2>Welcome back, <?php echo $username; ?></h2>
            <p>Selamat datang kembali di dashboard JuaraJawara. Di sini Anda dapat mengelola artikel dan kategori Anda.</p>
            <div class="article-section">
                <div class="article-card">
                    <h3>Write your article</h3>
                    <p>Mulailah menulis artikel baru Anda dan bagikan pengetahuan serta pengalaman Anda dengan komunitas JuaraJawara. Klik tombol di bawah ini untuk memulai.</p>
                    <a href="article.php" class="btn">Start Writing</a>
                </div>
            </div>
            <div class="creation-section">
                <h3>Start Creating Article</h3>
                <p>Pilih untuk membuat kategori baru atau langsung menulis artikel. Anda juga dapat membaca artikel-artikel yang telah dipublikasikan oleh pengguna lain. Jelajahi dan berkontribusilah sekarang!</p>
                <div class="creation-buttons">
                    <a href="category.php" class="btn"><i class="fas fa-folder-plus"></i> Input a new Category</a>
                    <a href="article.php" class="btn"><i class="fas fa-file-alt"></i> Create a new article</a>
                    <a href="../index.php" class="btn"><i class="fas fa-book"></i> Read article</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
