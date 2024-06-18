<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JuaraJawara Blog</title>
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
                    <li><a href="#home" class="active">Home</a></li>
                    <li><a href="#category">Category</a></li>
                    <li><a href="#article">Article</a></li>
                    <li><a href="#" id="write-link">Write</a></li>
                </ul>
            </nav>
        </div>
    </header>
<main>
    <section class="hero" id="home">
        <div class="container-hero">
            <h2>Welcome To JuaraJawara Blog</h2>
            <p>read more article now</p>
            <a href="all_articles.php?referer=index.php" class="btn">read article</a>
        </div>
    </section>
    <section class="hero-image-section">
        <img src="images/cardSilat.png" alt="Silat" class="hero-image">
    </section>

    <section class="category-section" id="category">
        <div class="category-header">
            <div class="category-text">
                <h2 class="category-title">Category</h2>
                <p class="category-description">Perguruan Silat di Indonesia</p>
            </div>
            <a href="all_categories.php?referer=index.php" class="category-more">More</a>
        </div>
        <div class="category-container">
            <?php
            include 'includes/db.php';

            $query = "SELECT * FROM categories LIMIT 6";
            $result = mysqli_query($conn, $query);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="category-card">';
                    echo '<a href="category_articles.php?category_id=' . $row['id'] . '&referer=index.php">';
                    echo '<img src="uploads/' . $row['image'] . '" alt="' . $row['name'] . '">';
                    echo '<h3>' . $row['name'] . '</h3>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo '<p>Failed to load categories.</p>';
            }
            ?>
        </div>
    </section>

    <section class="article-section" id="article">
        <div class="article-header">
            <div class="article-text">
                <h2 class="article-title">Article</h2>
                <p class="article-description">read more article</p>
            </div>
            <a href="all_articles.php?referer=index.php" class="article-more">More</a>
        </div>
        <div class="article-container">
            <?php
            // Kode untuk mengambil artikel beserta kategori dari database
            $query = "SELECT articles.*, categories.name AS category_name 
                      FROM articles 
                      JOIN categories ON articles.category_id = categories.id 
                      LIMIT 6";
            $result = mysqli_query($conn, $query);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="article-card">';
                    echo '<a href="article_detail.php?id=' . $row['id'] . '&referer=index.php">';
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
        </div>
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

<script>
    // Smooth scroll functionality
    document.querySelectorAll('nav ul li a').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            if (this.id !== 'write-link') {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            } else {
                window.location.href = 'admin/dashboard.php';
            }
        });
    });

    // Active link switching on scroll
    const sections = document.querySelectorAll('section');
    const navLi = document.querySelectorAll('nav ul li a');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= (sectionTop - sectionHeight / 3)) {
                current = section.getAttribute('id');
            }
        });

        navLi.forEach(a => {
            a.classList.remove('active');
            if (a.getAttribute('href').includes(current)) {
                a.classList.add('active');
            }
        });
    });
</script>
</body>
</html>
