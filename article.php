<?php
include('includes/header.php');
include('includes/db.php');

// Mendapatkan ID artikel dari URL
$id = $_GET['id'];

// Query untuk mendapatkan detail artikel
$article_query = "SELECT * FROM articles WHERE id=$id";
$article_result = mysqli_query($conn, $article_query);
$article = mysqli_fetch_assoc($article_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $article['title']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<main>
    <section class="article-detail">
        <div class="container">
            <h2><?= $article['title']; ?></h2>
            <p><?= $article['content']; ?></p>
        </div>
    </section>
</main>

<?php
include('includes/footer.php');
?>
</body>
</html>
