<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Articles</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" type="images/logo.png" href="images/logo.png">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo-container">
                <img src="images/logo.png" alt="JuaraJawara" class="logo">
                <h1 class="site-title">JuaraJawara</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Kembali</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section class="grid-container">
            <?php
            include 'includes/db.php';

            $query = "SELECT articles.*, categories.name AS category_name 
                      FROM articles 
                      JOIN categories ON articles.category_id = categories.id";
            $result = mysqli_query($conn, $query);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="grid-item">';
                    echo '<a href="article_detail.php?id=' . $row['id'] . '">';
                    echo '<img src="uploads/' . $row['image'] . '" alt="' . $row['title'] . '">';
                    echo '<h3>' . $row['title'] . '</h3>';
                    echo '<p>Kategori: ' . $row['category_name'] . '</p>';
                    echo '<p>' . substr($row['content'], 0, 100) . '...</p>';
                    echo '<a href="article_detail.php?id=' . $row['id'] . '">Selengkapnya ⟶</a>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo '<p>Failed to load articles.</p>';
            }
            ?>
        </section>
    </main>
    <footer>
        <div class="container-footer">
            <div class="footer-left">
                <h2>JuaraJawara</h2>
                <p>© 2024 JuaraJawara. All rights reserved.</p>
            </div>
            <div class="footer-right">
                <p>Email : info@juarajawara.com</p>
                <p>Phone : 123-456-789-0</p>
            </div>
        </div>
    </footer>
</body>
</html>
