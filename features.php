
<?php
require_once __DIR__ . '/db.php';

$features = [
    [
        'icon' => '◷',
        'title' => 'Medicine Reminders',
        'description' => 'Plan your medicine schedule and set reminder times to help you maintain a consistent routine.'
    ],
    [
        'icon' => '▦',
        'title' => 'Medicine Organization',
        'description' => 'Keep your medicines organized and easy to identify according to your daily schedule.'
    ],
    [
        'icon' => '♡',
        'title' => 'Daily Routine Support',
        'description' => 'Make it easier to follow the medicine schedule recommended by your healthcare professional.'
    ],
    [
        'icon' => '⌂',
        'title' => 'Convenient at Home',
        'description' => 'Use a simple organization system to manage medicines as part of your everyday routine.'
    ],
    [
        'icon' => '✈',
        'title' => 'Travel Friendly',
        'description' => 'Plan how to carry and organize your medicines when travelling.'
    ],
    [
        'icon' => '✓',
        'title' => 'Easy to Use',
        'description' => 'Enjoy a straightforward approach to organizing medicines and planning reminders.'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features | Smart Medicine Box</title>
    <meta name="description" content="Explore Smart Medicine Box features for medicine organization and reminder planning.">

    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/features.css">
    <script src="assets/js/index.js" defer></script>
    <script src="assets/js/features.js" defer></script>
</head>
<body>

<header class="navbar">
    <a href="index.php" class="brand">
        <span class="brand-icon">✚</span>
        <span class="brand-text">
            <strong>Smart Medicine Box</strong>
            <small>Your Health, Our Priority</small>
        </span>
    </a>

    <button class="menu-toggle" id="menuToggle"
            aria-label="Open navigation" aria-expanded="false">☰</button>

    <nav class="nav-links" id="navLinks">
        <a href="index.php">Home</a>
        <a href="features.php" class="active">Features</a>
        <a href="how-it-works.php">How It Works</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
    </nav>

    <a href="product.php" class="nav-button">Buy Now ↗</a>
</header>

<main>
    <section class="features-hero">
        <div class="features-hero-content">
            <p class="eyebrow">SMART · SAFE · SIMPLE</p>
            <h1>Features Designed for Better Everyday Care</h1>
            <p>
                Discover a simple way to organize medicines,
                plan reminders and support a more consistent routine.
            </p>
            <div class="features-hero-buttons">
                <a href="#all-features" class="btn btn-primary">Explore Features ↓</a>
                <a href="how-it-works.php" class="btn btn-outline">How It Works →</a>
            </div>
        </div>

        <div class="features-hero-art" aria-hidden="true">
            <div class="art-circle">
                <span class="art-plus">✚</span>
                <div class="art-pill art-pill-one"></div>
                <div class="art-pill art-pill-two"></div>
                <div class="art-pill art-pill-three"></div>
                <div class="art-check">✓</div>
            </div>
        </div>
    </section>

    <section class="features-intro">
        <div class="section-heading">
            <p class="eyebrow">MADE FOR EVERYDAY LIFE</p>
            <h2>Everything You Need to Stay Organized</h2>
            <p>
                Simple, practical features that help you manage
                your medicine routine more conveniently.
            </p>
        </div>

        <div class="features-grid" id="all-features">
            <?php foreach ($features as $feature): ?>
                <article class="feature-card detailed-feature">
                    <div class="feature-icon">
                        <?= htmlspecialchars($feature['icon'], ENT_QUOTES, 'UTF-8') ?>
                    </div>

                    <h3>
                        <?= htmlspecialchars($feature['title'], ENT_QUOTES, 'UTF-8') ?>
                    </h3>

                    <p>
                        <?= htmlspecialchars($feature['description'], ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <a href="how-it-works.php" class="feature-link">
                        Learn more →
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="reminder-section">
        <div class="reminder-visual">
            <div class="reminder-window">
                <div class="reminder-window-top">
                    <span>My Medicine Routine</span>
                    <span class="window-dot">●</span>
                </div>

                <div class="routine-row">
                    <span class="routine-icon">☀</span>
                    <div>
                        <strong>Morning</strong>
                        <p>Review your planned schedule</p>
                    </div>
                    <span class="routine-check">✓</span>
                </div>

                <div class="routine-row">
                    <span class="routine-icon">◷</span>
                    <div>
                        <strong>Afternoon</strong>
                        <p>Check your next reminder</p>
                    </div>
                    <span class="routine-check">✓</span>
                </div>

                <div class="routine-row">
                    <span class="routine-icon">☾</span>
                    <div>
                        <strong>Evening</strong>
                        <p>Review your daily routine</p>
                    </div>
                    <span class="routine-check">✓</span>
                </div>

                <p class="demo-label">
                    Illustrative interface — not a live reminder system.
                </p>
            </div>
        </div>

        <div class="reminder-content">
            <p class="eyebrow">STAY ON TRACK</p>
            <h2>Build a Routine That Works for You</h2>
            <p>
                Organize your planned medicine times in a clear,
                convenient format. Follow the dosage and timing
                instructions provided by your healthcare professional.
            </p>

            <ul class="reminder-list">
                <li>✓ Organize medicine schedules</li>
                <li>✓ Review planned reminder times</li>
                <li>✓ Keep daily routines easy to understand</li>
            </ul>

            <a href="register.php" class="btn btn-primary">
                Create Your Account →
            </a>
        </div>
    </section>

    <section class="features-bottom">
        <p class="eyebrow">READY TO GET STARTED?</p>
        <h2>Make Medicine Organization Simpler</h2>
        <p>
            Explore our product and discover a practical approach
            to everyday medicine management.
        </p>
        <div class="features-hero-buttons">
            <a href="product.php" class="btn btn-light">Explore Product →</a>
            <a href="contact.php" class="btn feature-contact-btn">Contact Us</a>
        </div>
    </section>
</main>

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

</body>
</html>
