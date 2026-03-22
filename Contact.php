<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - YourStoreName</title>
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <script src="assets/js/color-modes.js"></script>
    <link rel="stylesheet" href="carousel/carousel.css?v=2.0">
    <meta name="theme-color" content="#712cf9" />
    <style>
        .contact-hero {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            padding: 80px 40px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .contact-hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin: 0 0 20px 0;
            color: #ffffff;
        }

        .contact-hero p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .contact-content {
            padding: 80px 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            margin-bottom: 80px;
        }

        .contact-card {
            background: rgba(255, 255, 255, 0.05);
            padding: 40px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-5px);
        }

        .contact-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .contact-card h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .contact-card p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.8;
            margin: 0;
        }

        .contact-card a {
            color: #ffffff;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .contact-card a:hover {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: underline;
        }

        .contact-form-section {
            background: rgba(255, 255, 255, 0.02);
            padding: 60px 40px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .contact-form-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 40px;
            color: #ffffff;
            position: relative;
            padding-bottom: 20px;
        }

        .contact-form-section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

        .form-container {
            max-width: 600px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #ffffff;
            font-size: 1rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 150px;
        }

        .submit-btn {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
            color: #ffffff;
            padding: 15px 40px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.2));
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .faq-section {
            margin-top: 80px;
        }

        .faq-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 40px;
            color: #ffffff;
            position: relative;
            padding-bottom: 20px;
        }

        .faq-section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

        .faq-item {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .faq-question {
            padding: 20px;
            font-weight: 600;
            color: #ffffff;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-toggle {
            font-size: 1.3rem;
            transition: transform 0.3s ease;
        }

        .faq-item.active .faq-toggle {
            transform: rotate(45deg);
        }

        .faq-answer {
            padding: 0 20px 20px 20px;
            color: rgba(255, 255, 255, 0.7);
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            line-height: 1.8;
        }

        .faq-item.active .faq-answer {
            max-height: 500px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .contact-hero h1 {
                font-size: 2.5rem;
            }

            .contact-content {
                padding: 40px 20px;
            }

            .contact-grid {
                grid-template-columns: 1fr;
            }

            .contact-form-section {
                padding: 40px 20px;
            }

            .form-container {
                max-width: 100%;
            }

            .submit-btn {
                padding: 12px 30px;
            }
        }
    </style>
</head>
<body>
    <?php include 'header.php';?>

    <main>
        <section class="contact-hero">
            <h1>Get In Touch</h1>
            <p>We'd love to hear from you. Whether you have a question, feedback, or just want to say hello, feel free to reach out.</p>
        </section>

        <section class="contact-content">
            <div class="contact-grid">
                <div class="contact-card">
                    <h3>Email Us</h3>
                    <p>Send us an email and we'll respond as soon as possible.</p>
                    <a href="mailto:info@store.com">piece@gmail.com</a>
                </div>

                <div class="contact-card">
                    <h3>Call Us</h3>
                    <p>Give us a call during business hours Monday to Friday.</p>
                    <a href="tel:+1234567890">+1 (234) 567-890</a>
                </div>

                <div class="contact-card">
                 
                    <h3>Visit Us</h3>
                    <p>Stop by our store for in-person assistance.</p>
                    <p>144 San Miguel Street</p>
                </div>
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

    <script>
        function toggleFaq(element) {
            const faqItem = element.parentElement;
            faqItem.classList.toggle('active');
        }

        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for your message! We will get back to you soon.');
            this.reset();
        });
    </script>

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
