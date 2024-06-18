<?php
include('includes/db.php');

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$article_id = $_GET['id'];
$query = "SELECT articles.*, categories.name AS category_name FROM articles JOIN categories ON articles.category_id = categories.id WHERE articles.id = $article_id";
$result = mysqli_query($conn, $query);
$article = mysqli_fetch_assoc($result);

if (!$article) {
    header('Location: index.php');
    exit();
}

// Determine the back link
$back_link = 'index.php';
if (isset($_SERVER['HTTP_REFERER'])) {
    $referer = $_SERVER['HTTP_REFERER'];
    if (strpos($referer, 'all_articles.php') !== false || strpos($referer, 'all_categories.php') !== false) {
        $back_link = $referer;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" type="images/logo.png" href="images/logo.png">
    <title><?php echo $article['title']; ?> - JuaraJawara</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FFFFFF;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 40px;
            background-color: #27374E;
            color: #fff;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s, background-color 0.3s;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .navbar a:hover {
            background-color: #fff;
            color: #27374E;
        }

        .article-box {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #f4f4f4;
            margin-top: 20px;
        }

        .article-box img {
            display: block;
            max-width: 100%;
            height: auto;
            margin: 0 auto 20px;
            border-radius: 10px;
        }

        .article-box h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .article-box p {
            text-align: justify;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #27374E;
            color: #fff;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .article-meta {
            text-align: center;
            margin-bottom: 20px;
            color: #555;
        }

        .article-meta span {
            margin-right: 15px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img src="images/logo.png" alt="JuaraJawara">
            <h1>JuaraJawara</h1>
        </div>
        <a href="<?php echo htmlspecialchars($back_link); ?>">Kembali</a>
    </div>

    <div class="container">
        <div class="article-box">
            <img src="uploads/<?php echo $article['image']; ?>" alt="<?php echo $article['title']; ?>">
            <h1><?php echo $article['title']; ?></h1>
            <div class="article-meta">
                <span>Kategori: <?php echo $article['category_name']; ?></span>
                <span>Ditulis oleh: <?php echo $article['author']; ?></span>
                <span>Pada: <?php echo date('d M Y', strtotime($article['created_at'])); ?></span>
            </div>
            <p><?php echo nl2br($article['content']); ?></p>
        </div>
    </div>
</body>
</html>
