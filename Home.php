<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce</title>
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <script src="assets/js/color-modes.js"></script>
    <link rel="stylesheet" href="carousel/carousel.css?v=2.0">
    <meta name="theme-color" content="#712cf9" />
</head>
<body>
 <?php include 'header.php';?>

    
     <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button
            type="button"
            data-bs-target="#myCarousel"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1"
          ></button>
          <button
            type="button"
            data-bs-target="#myCarousel"
            data-bs-slide-to="1"
            aria-label="Slide 2"
          ></button>
          <button
            type="button"
            data-bs-target="#myCarousel"
            data-bs-slide-to="2"
            aria-label="Slide 3"
          ></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
           <img src="img/Hero1.jpg" style="width: 100%; height: auto;">
            <div class="container">
              <div class="carousel-caption text-start">
                <!-- <h1>Example headline.</h1>
                <p class="opacity-75">
                  Some representative placeholder content for the first slide of
                  the carousel.
                </p>
                <p>
                  <a class="btn btn-lg btn-primary" href="#">Sign up today</a>
                </p> -->
              </div>
            </div>
          </div>
          <div class="carousel-item">
          <img src="img/Hero2.jpg" style="width: 100%; height: auto;">
           
            <div class="container">
              <div class="carousel-caption">
                <!--  <h1>Another example headline.</h1>
                <p>
                  Some representative placeholder content for the second slide
                  of the carousel.
                </p>
                <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>  -->
              </div>
            </div>
          </div>
          <div class="carousel-item">
             <img src="img/Hero3.jpg" style="width: 100%; height: auto;">
            <div class="container">
            <div class="carousel-caption text-end"> 
                <!-- 
                <h1>One more for good measure.</h1>
                <p>
                  Some representative placeholder content for the third slide of
                  this carousel.
                </p>
                <p>
                  <a class="btn btn-lg btn-primary" href="#">Browse gallery</a>
                </p>
                -->
              </div>
            </div>
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#myCarousel"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#myCarousel"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
         <h1 style="text-align: center;">PRODUCTS</h1>
      <section class="product-section">

        <div class="product-container">
         <img src="img/Products/3cc23e3c2fac2c57faec113cf0cf1e2e.jpg" height="100%" width="100%" class="imageaArea">
        </div>

        
        <div class="product-container">
         <img src="img/Products/05b6107c5bc8e694d1b4948994af160d.jpg" height="100%" width="100%" class="imageaArea">
        </div>

        
        <div class="product-container">
         <img src="img/Products/d3e47b90f5ff84be182f9f7718bd6630.jpg" height="100%" width="100%" class="imageaArea">
        </div>
      </section>

      <footer class="footer-container">
        <div class="footer-section footer-brand">
          <div class="footer-logo-wrapper">
            <img src="img/Logo2-removebg.png" alt="Logo" class="footer-logo">
          </div>
          <h3 class="footer-brand-name">PIE•CE</h3>
          <p class="footer-brand-tagline">Premium quality products delivered to your door</p>
      
        </div>

        <div class="footer-section">
          <h4 class="footer-section-title">Quick Links</h4>
          <ul class="footer-links">
            <li><a href="Home.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="About.php">About</a></li>
            <li><a href="Contact.php">Contact</a></li>
          </ul>
        </div>

        <div class="footer-section">
          <h4 class="footer-section-title">Customer Support</h4>
          <ul class="footer-links">
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Shipping Info</a></li>
            <li><a href="#">Returns & Exchanges</a></li>
            <li><a href="#">Track Order</a></li>
          </ul>
        </div>

        <div class="footer-section">
          <h4 class="footer-section-title">Contact Info</h4>
          <p class="footer-contact">
            <strong>Email:</strong> <a href="mailto:info@store.com">piece@store.com</a>
          </p>
          <p class="footer-contact">
            <strong>Phone:</strong> <a href="tel:+1234567890">+1 (234) 567-890</a>
          </p>
          <p class="footer-contact">
            <strong>Address:</strong> 144 San Miguel Street
          </p>
        </div>

        <div class="footer-bottom">
          <p>&copy; 2026 PIE•CE. All rights reserved.</p>
          <div class="footer-legal">
            <a href="#">Privacy Policy</a>
            <span class="divider">|</span>
            <a href="#">Terms of Service</a>
            <span class="divider">|</span>
            <a href="#">Cookie Policy</a>
          </div>
        </div>
      </footer>
 
</body>
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
</html>
