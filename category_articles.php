<?php
include 'includes/db.php';

$category_id = $_GET['category_id'] ?? null;
$referer = $_GET['referer'] ?? 'all_categories.php'; // Default ke all_categories.php jika referer tidak ada

if (!$category_id) {
    header('Location: all_categories.php');
    exit();
}

// Fetch category name
$category_query = "SELECT name FROM categories WHERE id = $category_id";
$category_result = mysqli_query($conn, $category_query);
$category = mysqli_fetch_assoc($category_result);

if (!$category) {
    echo "Kategori tidak ditemukan.";
    exit();
}

// Fetch articles in the category
$articles_query = "SELECT * FROM articles WHERE category_id = $category_id";
$articles_result = mysqli_query($conn, $articles_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Articles in <?php echo htmlspecialchars($category['name']); ?> - JuaraJawara Blog</title>
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
                    <li><a href="<?php echo htmlspecialchars($referer); ?>">Kembali</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="article-section">
            <div class="article-header">
                <h2 class="article-title">Articles in <?php echo htmlspecialchars($category['name']); ?></h2>
                <p class="article-description">Daftar artikel dalam kategori <?php echo htmlspecialchars($category['name']); ?></p>
            </div>
            <div class="article-container">
                <?php
                if (mysqli_num_rows($articles_result) > 0) {
                    while ($row = mysqli_fetch_assoc($articles_result)) {
                        echo '<div class="article-card">';
                        echo '<img src="uploads/' . $row['image'] . '" alt="' . $row['title'] . '">';
                        echo '<h3>' . $row['title'] . '</h3>';
                        echo '<p>' . substr($row['content'], 0, 100) . '...</p>';
                        echo '<a href="article_detail.php?id=' . $row['id'] . '&referer=category_articles.php?category_id=' . $category_id . '">Selengkapnya ⟶</a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Tidak ada artikel dalam kategori ini.</p>';
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <div class="container-footer">
            <div class="footer-left">
                <h2>JuaraJawara</h2>
                <p>copyright@2024</p>
            </div>
        </div>
    </footer>
</body>
</html>
