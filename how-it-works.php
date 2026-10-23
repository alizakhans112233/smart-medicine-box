
<?php
session_start();

$pageTitle = "How It Works | Smart Medicine Box";
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
    <meta name="description" content="Learn how Smart Medicine Box helps you organize medicines and manage your daily medicine reminders.">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/index.css">

    <!-- Page CSS -->
    <link rel="stylesheet" href="assets/css/how-it-works.css">
</head>

<body>

<!-- Navbar -->
<header class="hiw-header">
    <div class="hiw-container hiw-navbar">

        <a href="index.php" class="hiw-logo">
            <span class="hiw-logo-icon">+</span>
            <span>Smart Medicine Box</span>
        </a>

        <button class="hiw-menu-toggle"
                id="hiwMenuToggle"
                type="button"
                aria-label="Open navigation"
                aria-expanded="false">
            ☰
        </button>

        <nav class="hiw-nav" id="hiwNav">
            <a href="index.php">Home</a>
            <a href="features.php">Features</a>
            <a href="how-it-works.php" class="active">How It Works</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <a href="<?php echo htmlspecialchars($accountLink); ?>"
               class="hiw-nav-button">
                <?php echo htmlspecialchars($accountText); ?>
            </a>
        </nav>

    </div>
</header>

<main>

    <!-- Hero Section -->
    <section class="hiw-hero">
        <div class="hiw-container hiw-hero-grid">

            <div class="hiw-hero-content">
                <span class="hiw-badge">SIMPLE • SMART • ORGANIZED</span>

                <h1>
                    How It <span>Works</span>
                </h1>

                <p>
                    Managing your medicines can be easier.
                    Smart Medicine Box helps you organize medicine
                    information, plan reminders and review your daily routine
                    in one convenient place.
                </p>

                <div class="hiw-hero-buttons">
                    <a href="#steps" class="hiw-btn hiw-btn-primary">
                        Explore the Steps →
                    </a>

                    <a href="features.php" class="hiw-btn hiw-btn-outline">
                        Explore Features
                    </a>
                </div>
            </div>

            <div class="hiw-visual" aria-label="Medicine management illustration">
                <div class="hiw-circle">
                    <div class="hiw-medicine-icon">💊</div>
                </div>

                <div class="hiw-floating hiw-float-top">
                    <span>✓</span>
                    <span>Medicine Organized</span>
                </div>

                <div class="hiw-floating hiw-float-bottom">
                    <span>⏰</span>
                    <span>Reminder Schedule</span>
                </div>
            </div>

        </div>
    </section>

    <!-- Steps Section -->
    <section class="hiw-steps-section" id="steps">
        <div class="hiw-container">

            <div class="hiw-section-heading">
                <span class="hiw-badge">THE PROCESS</span>
                <h2>Get Started in <span>4 Easy Steps</span></h2>
                <p>
                    Follow these steps to manage your medicine information
                    and daily routine.
                </p>
            </div>

            <div class="hiw-steps-grid">

                <article class="hiw-step-card">
                    <span class="hiw-step-number">01</span>
                    <div class="hiw-step-icon">👤</div>
                    <h3>Create an Account</h3>
                    <p>
                        Register for an account to access the website
                        and your personal medicine management features.
                    </p>
                    <a href="register.php" class="hiw-step-link">
                        Create account →
                    </a>
                </article>

                <article class="hiw-step-card">
                    <span class="hiw-step-number">02</span>
                    <div class="hiw-step-icon">💊</div>
                    <h3>Add Medicine Details</h3>
                    <p>
                        Enter the medicine information you want to organize
                        and keep available for future reference.
                    </p>
                    <a href="login.php" class="hiw-step-link">
                        Access account →
                    </a>
                </article>

                <article class="hiw-step-card">
                    <span class="hiw-step-number">03</span>
                    <div class="hiw-step-icon">⏰</div>
                    <h3>Set Reminders</h3>
                    <p>
                        Plan reminder times according to your prescribed
                        medicine schedule.
                    </p>
                    <a href="login.php" class="hiw-step-link">
                        Manage schedule →
                    </a>
                </article>

                <article class="hiw-step-card">
                    <span class="hiw-step-number">04</span>
                    <div class="hiw-step-icon">✓</div>
                    <h3>Review Your Routine</h3>
                    <p>
                        Review your medicine details and planned schedule
                        to help keep your routine organized.
                    </p>
                    <a href="login.php" class="hiw-step-link">
                        Get started →
                    </a>
                </article>

            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="hiw-benefits-section">
        <div class="hiw-container hiw-benefits-grid">

            <div class="hiw-benefits-content">
                <span class="hiw-badge">WHY SMART MEDICINE BOX?</span>

                <h2>
                    Make Medicine Management <span>Easier</span>
                </h2>

                <p>
                    Keep important medicine information organized and
                    make your daily schedule easier to review.
                </p>

                <ul class="hiw-benefits-list">
                    <li>
                        <span class="hiw-check">✓</span>
                        Organize medicine information in one place
                    </li>
                    <li>
                        <span class="hiw-check">✓</span>
                        Plan and review medicine reminders
                    </li>
                    <li>
                        <span class="hiw-check">✓</span>
                        Access your account when needed
                    </li>
                    <li>
                        <span class="hiw-check">✓</span>
                        Support a more organized daily routine
                    </li>
                </ul>

                <!-- <a href="<?php echo htmlspecialchars($accountLink); ?>"
                   class="hiw-btn hiw-btn-primary">
                    <?php echo htmlspecialchars($accountText); ?> →
                </a> -->
            </div>

            <div class="hiw-info-card">
                <div class="hiw-info-icon">🌿</div>

                <h3>Your Routine, Simplified</h3>

                <p>
                    A convenient way to review the medicine information
                    and schedule you have entered.
                </p>

                <div class="hiw-info-divider"></div>

                <div class="hiw-info-row">
                    <span>Medicine details</span>
                    <strong>Organized</strong>
                </div>

                <div class="hiw-info-row">
                    <span>Reminder planning</span>
                    <strong>Convenient</strong>
                </div>

                <div class="hiw-info-row">
                    <span>Daily routine</span>
                    <strong>Easy to review</strong>
                </div>
            </div>

        </div>
    </section>

    <!-- Call To Action -->
    <section class="hiw-cta-section">
        <div class="hiw-container hiw-cta-content">

            <span class="hiw-cta-label">START TODAY</span>

            <h2>Ready to Organize Your Medicine Routine?</h2>

            <p>
                Create an account and explore the Smart Medicine Box website.
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
<script src="assets/js/how-it-works.js"></script>

</body>
</html>

