<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <script src="assets/js/color-modes.js"></script>
    <link rel="stylesheet" href="carousel/carousel.css?v=2.0">
</head>
<body>
    <nav>
        <div class="logo-container">
            <img src="img/Logo2-removebg.png" alt="Logo" class="logo">
        </div>
        <div class="nav-links-container">
            <ul class="nav-links">
                <li><a href="Home.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="About.php">About</a></li>
                <li><a href="Contact.php">Contact</a></li>
            </ul>
        </div>
        <button class="hamburger" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="nav-icons">
            <a href="shop.php"><img src="img/cart-removebg-preview.png" alt="Cart" class="icons"></a>
            <a href="admin.php"><img src="img/Profile-removebg-preview.png" alt="Profile" class="icons"></a>
        </div>
    </nav>

    <script>
        // Hamburger menu toggle
        const hamburger = document.querySelector('.hamburger');
        const navLinks = document.querySelector('.nav-links');
        
        if (hamburger) {
            hamburger.addEventListener('click', () => {
                navLinks.classList.toggle('active');
                hamburger.classList.toggle('active');
            });
        }
    </script>
</body>
</html>
