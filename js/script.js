document.addEventListener('DOMContentLoaded', function() {
    // Kode untuk kategori
    const categoryContainer = document.querySelector('.category-container');
    let isDown = false;
    let startX;
    let scrollLeft;

    categoryContainer.addEventListener('mousedown', (e) => {
        isDown = true;
        categoryContainer.classList.add('active');
        startX = e.pageX - categoryContainer.offsetLeft;
        scrollLeft = categoryContainer.scrollLeft;
    });

    categoryContainer.addEventListener('mouseleave', () => {
        isDown = false;
        categoryContainer.classList.remove('active');
    });

    categoryContainer.addEventListener('mouseup', () => {
        isDown = false;
        categoryContainer.classList.remove('active');
    });

    categoryContainer.addEventListener('mousemove', (e) => {
        if(!isDown) return;
        e.preventDefault();
        const x = e.pageX - categoryContainer.offsetLeft;
        const walk = (x - startX) * 2; // scroll-fast
        categoryContainer.scrollLeft = scrollLeft - walk;
    });

    // Kode untuk artikel
    const articleContainer = document.querySelector('.article-container');
    let isDownArticle = false;
    let startXArticle;
    let scrollLeftArticle;

    articleContainer.addEventListener('mousedown', (e) => {
        isDownArticle = true;
        articleContainer.classList.add('active');
        startXArticle = e.pageX - articleContainer.offsetLeft;
        scrollLeftArticle = articleContainer.scrollLeft;
    });

    articleContainer.addEventListener('mouseleave', () => {
        isDownArticle = false;
        articleContainer.classList.remove('active');
    });

    articleContainer.addEventListener('mouseup', () => {
        isDownArticle = false;
        articleContainer.classList.remove('active');
    });

    articleContainer.addEventListener('mousemove', (e) => {
        if(!isDownArticle) return;
        e.preventDefault();
        const x = e.pageX - articleContainer.offsetLeft;
        const walk = (x - startXArticle) * 2; // scroll-fast
        articleContainer.scrollLeft = scrollLeftArticle - walk;
    });
});
