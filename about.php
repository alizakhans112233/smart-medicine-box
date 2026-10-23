
<?php
session_start();

$pageTitle = "About Us | Smart Medicine Box";
$currentYear = date("Y");

$isLoggedIn = isset($_SESSION["user_id"]);
$accountLink = $isLoggedIn ? "dashboard.php" : "register.php";
$accountText = $isLoggedIn ? "My Dashboard" : "Get Started";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <meta name="description" content="Learn about Smart Medicine Box, our mission, vision and commitment to organized medicine management.">

    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/about.css">
</head>
<body>

<!-- Navbar -->
<header class="about-header">
    <div class="about-container about-navbar">

        <a href="index.php" class="about-logo">
            <span class="about-logo-icon">+</span>
            <span>Smart Medicine Box</span>
        </a>

        <button class="about-menu-toggle"
                id="aboutMenuToggle"
                type="button"
                aria-label="Open navigation"
                aria-expanded="false">
            ☰
        </button>

        <nav class="about-nav" id="aboutNav">
            <a href="index.php">Home</a>
            <a href="features.php">Features</a>
            <a href="how-it-works.php">How It Works</a>
            <a href="about.php" class="active">About</a>
            <a href="contact.php">Contact</a>
            <?php
$accountLink = 'user_dashboard.php';
?>

<a href="<?php echo htmlspecialchars($accountLink); ?>"
   class="hiw-btn hiw-btn-light">
    <?php echo htmlspecialchars($accountText); ?> →
</a>
        </nav>

    </div>
</header>

<main>

    <!-- Hero -->
    <section class="about-hero">
        <div class="about-container about-hero-grid">

            <div class="about-hero-content">
                <span class="about-badge">GET TO KNOW US</span>

                <h1>
                    About <span>Smart Medicine Box</span>
                </h1>

                <p>
                    We aim to make medicine management simpler and more
                    organized. Smart Medicine Box is designed to help users
                    manage medicine information and review their daily
                    medicine schedules in one convenient place.
                </p>

                <div class="about-hero-buttons">
                    <a href="how-it-works.php"
                       class="about-btn about-btn-primary">
                        How It Works →
                    </a>

                    <a href="contact.php"
                       class="about-btn about-btn-outline">
                        Contact Us
                    </a>
                </div>
            </div>

            <div class="about-hero-visual">
                <div class="about-visual-circle">
                    <div class="about-medical-symbol">✚</div>
                    <div class="about-heart">♥</div>
                </div>

                <div class="about-floating about-floating-top">
                    <span>✓</span> Organized Medicine
                </div>

                <div class="about-floating about-floating-bottom">
                    <span>♡</span> Care Through Organization
                </div>
            </div>

        </div>
    </section>

    <!-- Introduction -->
    <section class="about-intro">
        <div class="about-container about-intro-grid">

            <div class="about-intro-card">
                <span class="about-card-icon">💊</span>
                <h3>One Convenient Place</h3>
                <p>
                    Keep medicine details and schedule information organized
                    through a simple website interface.
                </p>
            </div>

            <div class="about-intro-content">
                <span class="about-badge">WHO WE ARE</span>

                <h2>
                    Making Medicine Management <span>Simpler</span>
                </h2>

                <p>
                    Smart Medicine Box is a medicine management website
                    concept focused on convenience, organization and
                    ease of use. It provides a central place to manage
                    medicine-related information.
                </p>

                <p>
                    Our goal is to make it easier for users to review
                    their medicine details and planned schedules without
                    making the process unnecessarily complicated.
                </p>

                <a href="features.php"
                   class="about-text-link">
                    Explore Our Features →
                </a>
            </div>

        </div>
    </section>

    <!-- Mission and Vision -->
    <section class="about-purpose">
        <div class="about-container">

            <div class="about-section-heading">
                <span class="about-badge">OUR PURPOSE</span>
                <h2>Our Mission and <span>Vision</span></h2>
                <p>
                    We focus on making medicine information easier to
                    organize and review.
                </p>
            </div>

            <div class="about-purpose-grid">

                <article class="about-purpose-card">
                    <div class="about-purpose-icon">🎯</div>
                    <h3>Our Mission</h3>
                    <p>
                        To provide a simple and accessible platform that
                        helps users organize medicine details and manage
                        their planned schedules more conveniently.
                    </p>
                </article>

                <article class="about-purpose-card">
                    <div class="about-purpose-icon">🌱</div>
                    <h3>Our Vision</h3>
                    <p>
                        To make digital medicine management more convenient
                        through a user-friendly experience that encourages
                        organized daily routines.
                    </p>
                </article>

                <article class="about-purpose-card">
                    <div class="about-purpose-icon">🤝</div>
                    <h3>Our Commitment</h3>
                    <p>
                        To prioritize clear information, a simple interface
                        and a more organized way to review medicine-related
                        details.
                    </p>
                </article>

            </div>
        </div>
    </section>

    <!-- Values -->
    <section class="about-values">
        <div class="about-container about-values-grid">

            <div class="about-values-content">
                <span class="about-badge">WHAT MATTERS TO US</span>

                <h2>
                    Designed Around <span>Your Needs</span>
                </h2>

                <p>
                    We believe a useful medicine management website should
                    be straightforward, easy to navigate and designed
                    around the user's needs.
                </p>

                <div class="about-value-item">
                    <span class="about-value-check">✓</span>
                    <div>
                        <h3>Simplicity</h3>
                        <p>A clear interface that is easy to understand.</p>
                    </div>
                </div>

                <div class="about-value-item">
                    <span class="about-value-check">✓</span>
                    <div>
                        <h3>Organization</h3>
                        <p>Medicine information arranged in one place.</p>
                    </div>
                </div>

                <div class="about-value-item">
                    <span class="about-value-check">✓</span>
                    <div>
                        <h3>Convenience</h3>
                        <p>A practical way to review planned schedules.</p>
                    </div>
                </div>
            </div>

            <div class="about-values-panel">
                <div class="about-panel-top">
                    <span class="about-panel-icon">✚</span>
                    <span class="about-panel-label">SMART MEDICINE BOX</span>
                </div>

                <h3>Organize Today. Manage Better.</h3>

                <p>
                    Keep your medicine-related information together
                    and make your routine easier to review.
                </p>

                <div class="about-panel-divider"></div>

                <div class="about-panel-feature">
                    <span>01</span>
                    <p>Medicine Information</p>
                </div>

                <div class="about-panel-feature">
                    <span>02</span>
                    <p>Planned Reminders</p>
                </div>

                <div class="about-panel-feature">
                    <span>03</span>
                    <p>Daily Organization</p>
                </div>
            </div>

        </div>
    </section>

    <!-- CTA -->
    <section class="about-cta">
        <div class="about-container about-cta-content">
            <span class="about-cta-label">SMARTER ORGANIZATION</span>

            <h2>Discover a Simpler Way to Manage Medicine Information</h2>

            <p>
                Explore the features and see how Smart Medicine Box
                is designed to work.
            </p>

       


        </div>
    </section>

</main>

<!-- Footer -->

<footer class="footer">
    <div class="footer-main">
        <div class="footer-about">
            <a href="index.php" class="footer-brand">✚ Smart Medicine Box</a>
            <p>Your Health, Our Priority.</p>
            <p>A simple approach to medicine organization and everyday care.</p>
        </div>

        <div class="footer-column">
            <h3>Quick Links</h3>
            <a href="index.php">Home</a>
            <a href="features.php">Features</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact</a>
        </div>

        <div class="footer-column">
            <h3>Explore</h3>
            <a href="how-it-works.php">How It Works</a>
            <a href="product.php">Our Product</a>
            <a href="faq.php">FAQs</a>
            <a href="blog.php">Blog</a>
        </div>

        <div class="footer-column">
            <h3>Your Account</h3>
            <a href="login.php">Login</a>
            <a href="register.php">Create Account</a>
            <a href="user_dashboard.php">Dashboard</a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?= date('Y') ?> Smart Medicine Box. All rights reserved.</p>
        <p>Designed with care ♡</p>
    </div>
</footer>
<script src="assets/js/index.js"></script>
<script src="assets/js/about.js"></script>

</body>
</html>
