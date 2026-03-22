<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - YourStoreName</title>
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <script src="assets/js/color-modes.js"></script>
    <link rel="stylesheet" href="carousel/carousel.css?v=2.0">
    <meta name="theme-color" content="#712cf9" />
    <style>
        .about-hero {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            padding: 80px 40px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .about-hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin: 0 0 20px 0;
            color: #ffffff;
        }

        .about-hero p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .about-content {
            padding: 80px 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .about-section {
            margin-bottom: 80px;
        }

        .about-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 30px;
            color: #ffffff;
            position: relative;
            padding-bottom: 20px;
        }

        .about-section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

        .about-text {
            font-size: 1.05rem;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.9;
            margin-bottom: 20px;
        }

        .mission-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .mission-card {
            background: rgba(255, 255, 255, 0.05);
            padding: 30px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .mission-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }

        .mission-card h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .mission-card p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.7;
            margin: 0;
        }

        .team-section {
            background: rgba(255, 255, 255, 0.02);
            padding: 60px 40px;
            border-radius: 12px;
            margin-top: 40px;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .team-member {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .team-member:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }

        .team-avatar {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: rgba(255, 255, 255, 0.3);
        }

        .team-info {
            padding: 25px;
        }

        .team-info h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0 0 10px 0;
            color: #ffffff;
        }

        .team-info p {
            color: rgba(255, 255, 255, 0.7);
            margin: 0;
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .about-hero h1 {
                font-size: 2.5rem;
            }

            .about-content {
                padding: 40px 20px;
            }

            .about-section h2 {
                font-size: 1.8rem;
            }

            .mission-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
   <?php include 'header.php';?>


    <main>
        <section class="about-hero">
            <h1>PIE•CE</h1>
            <p>We're passionate about delivering quality products and exceptional customer experiences. Founded with a vision to make quality accessible to everyone.</p>
        </section>

        <section class="about-content">
            <div class="about-section">
                <h2>Our Story</h2>
                <p class="about-text">
                  Our Story

          PIE•CE was founded in 2026 with a clear vision: to create apparel that represents precision, purpose, and individuality, without sacrificing accessibility. Inspired by the idea that every piece matters, we design clothing that blends thoughtful 
          craftsmanship with everyday wearability. What began as a passion for clean design and meaningful symbols has grown into a brand trusted by a global community. Each PIE•CE garment is carefully designed, tested, and refined to meet our standards for fit, comfort, and durability. 
          We believe apparel should feel intentional, something you can wear confidently, knowing it was made with care.

      
                <p class="about-text">
                    We work closely with ethical partners who value responsible production and sustainable practices. From concept to final stitch, every PIE•CE reflects our commitment to quality, longevity, and modern style, because true fashion isn’t fast, it’s thoughtful.
                </p>
            </div>
        </section>

    </main>

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
                <strong>Email:</strong> <a href="mailto:info@piece.com">piece@store.com</a>
            </p>
            <p class="footer-contact">
                <strong>Phone:</strong> <a href="tel:+1234567890">+1 (234) 567-890</a>
            </p>
            <p class="footer-contact">
                <strong>Address:</strong> 144 San Miguel Street
            </p>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2024 PIE•CE. All rights reserved.</p>
            <div class="footer-legal">
                <a href="#">Privacy Policy</a>
                <span class="divider">|</span>
                <a href="#">Terms of Service</a>
                <span class="divider">|</span>
                <a href="#">Cookie Policy</a>
            </div>
        </div>
    </footer>

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
