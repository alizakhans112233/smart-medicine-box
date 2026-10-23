

<?php
require_once __DIR__ . '/db.php';

// Database se latest active products load karein.
try {
    $stmt = $pdo->query(
        "SELECT id, name, description, price, image
         FROM products
         WHERE status = 'active'
         ORDER BY created_at DESC
         LIMIT 4"
    );
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log($e->getMessage());
    $products = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Smart Medicine Box | Your Health, Our Priority</title>

    <meta name="description"
          content="Discover Smart Medicine Box, a simple way to organize your medicine routine and support better daily care.">

    <link rel="stylesheet" href="assets/css/index.css">
    <script src="assets/js/index.js" defer></script>
</head>
<body>

<!-- ================= HEADER ================= -->
<header class="navbar">
    <a href="index.php" class="brand">
        <span class="brand-icon">✚</span>
        <span class="brand-text">
            <strong>Smart Medicine Box</strong>
            <small>Your Health, Our Priority</small>
        </span>
    </a>

    <button class="menu-toggle"
            id="menuToggle"
            aria-label="Open navigation"
            aria-expanded="false">
        ☰
    </button>

    <nav class="nav-links" id="navLinks">
        <a href="index.php" class="active">Home</a>
        <a href="features.php">Features</a>
        <a href="how-it-works.php">How It Works</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
    </nav>

    <a href="product.php" class="nav-button">Buy Now ↗</a>
</header>

<main>

    <!-- ================= HERO SECTION ================= -->
    <section class="hero">
        <div class="hero-content">
            <p class="eyebrow">SMART · SAFE · SIMPLE</p>

            <h1>
                Never Miss<br>
                Your Medicine Again
            </h1>

            <p class="hero-description">
                Smart Medicine Box helps you organize your medicines,
                plan your routine and take better care of your health —
                every day, effortlessly.
            </p>

            <div class="hero-buttons">
                <a href="product.php" class="btn btn-primary">
                    Shop Now <span>→</span>
                </a>

                <a href="how-it-works.php" class="btn btn-outline">
                    <span>▷</span> How It Works
                </a>
            </div>

            <div class="benefits">
                <div class="benefit">
                    <span class="benefit-icon">◷</span>
                    <strong>Timely<br>Reminders</strong>
                </div>

                <div class="benefit">
                    <span class="benefit-icon">♧</span>
                    <strong>Reminder<br>Planning</strong>
                </div>

                <div class="benefit">
                    <span class="benefit-icon">♡</span>
                    <strong>Safe &amp;<br>Secure</strong>
                </div>

                <div class="benefit">
                    <span class="benefit-icon">⌂</span>
                    <strong>Home &amp;<br>Travel</strong>
                </div>
            </div>
        </div>

        <div class="hero-image">
            <img
                src="https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=1000&q=85"
                alt="Medicine and healthcare products"
            >

            <div class="image-note">
                Small box,<br>
                <strong>Big care ♡</strong>
            </div>
        </div>
    </section>

    <!-- ================= FEATURES ================= -->
    <section class="features-section">
        <div class="section-heading">
            <p class="eyebrow">CARE MADE SIMPLE</p>

            <h2>Why Choose Smart Medicine Box?</h2>

            <p>
                It's not just a box, it's your personal health assistant.
            </p>
        </div>

        <div class="feature-grid">
            <article class="feature-card">
                <div class="feature-icon">♧</div>
                <h3>Smart Reminders</h3>
                <p>
                    Plan reminders to help you stay organized
                    with your daily medicine routine.
                </p>
            </article>

            <article class="feature-card">
                <div class="feature-icon">▦</div>
                <h3>Organized Compartments</h3>
                <p>
                    Keep medicines sorted for convenient
                    everyday organization.
                </p>
            </article>

            <article class="feature-card">
                <div class="feature-icon">♡</div>
                <h3>Routine Support</h3>
                <p>
                    Make it easier to follow the schedule
                    recommended by your healthcare professional.
                </p>
            </article>

            <article class="feature-card">
                <div class="feature-icon">▰</div>
                <h3>Convenient Design</h3>
                <p>
                    A practical concept for organizing medicines
                    at home or while travelling.
                </p>
            </article>
        </div>

        <div class="center-button">
            <a href="features.php" class="text-link">
                Explore All Features →
            </a>
        </div>
    </section>

    <!-- ================= HOW IT WORKS ================= -->
    <section class="how-section">
        <div class="how-content">
            <p class="eyebrow">SIMPLE STEPS</p>

            <h2>How It Works</h2>

            <p class="section-description">
                Get started with a simple and organized
                medicine routine.
            </p>

            <div class="steps">
                <article class="step">
                    <span class="step-number">1</span>

                    <div>
                        <h3>Organize Your Medicines</h3>
                        <p>
                            Arrange your medicines according
                            to their instructions.
                        </p>
                    </div>
                </article>

                <article class="step">
                    <span class="step-number">2</span>

                    <div>
                        <h3>Plan Your Reminders</h3>
                        <p>
                            Set your preferred reminder times
                            to help manage your routine.
                        </p>
                    </div>
                </article>

                <article class="step">
                    <span class="step-number">3</span>

                    <div>
                        <h3>Follow Your Routine</h3>
                        <p>
                            Keep track of your planned
                            medicine schedule.
                        </p>
                    </div>
                </article>
            </div>

            <a href="how-it-works.php" class="btn btn-primary">
                Learn More →
            </a>
        </div>

        <div class="how-image">
            <img
                src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=900&q=85"
                alt="Healthcare professional in a clinical setting"
                loading="lazy"
            >

            <div class="image-caption">
                <span>♡</span>
                <p>Easy to use, designed for everyday care.</p>
            </div>
        </div>
    </section>

    <!-- ================= PRODUCT FEATURES ================= -->
    <section class="product-section">
        <div class="product-image">
            <img
                src="https://images.unsplash.com/photo-1585435557343-3b092031a831?auto=format&fit=crop&w=900&q=85"
                alt="Healthcare and pharmacy products"
                loading="lazy"
            >
        </div>

        <div class="product-content">
            <p class="eyebrow">DESIGNED FOR YOUR ROUTINE</p>

            <h2>Product Features</h2>

            <p class="section-description">
                Discover features designed to make medicine
                organization more convenient.
            </p>

            <div class="spec-grid">
                <span>✓ Easy organization</span>
                <span>✓ User-friendly design</span>
                <span>✓ Reminder planning</span>
                <span>✓ Convenient storage</span>
                <span>✓ Everyday portability</span>
                <span>✓ Simple maintenance</span>
            </div>

            <a href="product.php" class="btn btn-primary">
                View Product →
            </a>
        </div>
    </section>

    <!-- ================= DATABASE PRODUCTS ================= -->
    <section class="shop-section">
        <div class="section-heading">
            <p class="eyebrow">OUR COLLECTION</p>

            <h2>Explore Our Products</h2>

            <p>
                Explore the products available in our store.
            </p>
        </div>

        <div class="shop-grid">

            <?php if (!empty($products)): ?>

                <?php foreach ($products as $product): ?>
                    <article class="shop-card">

                        <a href="product.php?id=<?= (int)$product['id'] ?>"
                           class="shop-card-image">

                            <?php if (!empty($product['image'])): ?>
                                <img
                                    src="<?= htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8') ?>"
                                    alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>"
                                    loading="lazy"
                                >
                            <?php else: ?>
                                <div class="product-placeholder">
                                    <span>✚</span>
                                    <p>Smart Medicine Box</p>
                                </div>
                            <?php endif; ?>
                        </a>

                        <div class="shop-card-content">
                            <h3>
                                <?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>
                            </h3>

                            <p>
                                <?= htmlspecialchars(
                                    mb_strimwidth(
                                        $product['description'] ?? '',
                                        0,
                                        100,
                                        '...'
                                    ),
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </p>

                            <div class="shop-card-bottom">
                                <strong>
                                    Rs. <?= number_format((float)$product['price'], 2) ?>
                                </strong>

                                <a href="product.php?id=<?= (int)$product['id'] ?>"
                                   class="small-btn">
                                    View Details
                                </a>
                            </div>
                        </div>

                    </article>
                <?php endforeach; ?>

            <?php else: ?>

                <div class="empty-products">
                    <span>✚</span>
                    <h3>Products Coming Soon</h3>
                    <p>
                        Our products will appear here when they
                        are added to the database.
                    </p>
                </div>

            <?php endif; ?>

        </div>

        <div class="center-button">
            <a href="product.php" class="btn btn-outline">
                View All Products →
            </a>
        </div>
    </section>

    <!-- ================= TESTIMONIAL STYLE SECTION ================= -->
    <section class="testimonials">
        <div class="section-heading">
            <p class="eyebrow">SIMPLE CARE, EVERY DAY</p>

            <h2>Designed Around Your Needs</h2>

            <p>
                A thoughtful approach to organizing your
                everyday medicine routine.
            </p>
        </div>

        <div class="testimonial-grid">
            <article class="testimonial-card">
                <div class="testimonial-symbol">♡</div>
                <h3>Peace of Mind</h3>
                <p>
                    Keep your medicine schedule organized
                    in one convenient place.
                </p>
            </article>

            <article class="testimonial-card">
                <div class="testimonial-symbol">✚</div>
                <h3>Everyday Convenience</h3>
                <p>
                    Build a routine that fits your everyday
                    care needs.
                </p>
            </article>

            <article class="testimonial-card">
                <div class="testimonial-symbol">✓</div>
                <h3>Simple Organization</h3>
                <p>
                    Make your medicine organization easier
                    with a clear and simple system.
                </p>
            </article>
        </div>
    </section>

    <!-- ================= CALL TO ACTION ================= -->
    <section class="cta-section">
        <div class="cta-icon">✚</div>

        <div class="cta-content">
            <h2>Take Control of Your Health Today</h2>

            <p>
                Smart Medicine Box — a small step towards
                a more organized routine.
            </p>
        </div>

        <a href="product.php" class="btn btn-light">
            Buy Now →
        </a>
    </section>

</main>

<!-- ================= FOOTER ================= -->
<footer class="footer">
    <div class="footer-main">
        <div class="footer-about">
            <a href="index.php" class="footer-brand">
                ✚ Smart Medicine Box
            </a>

            <p>Your Health, Our Priority.</p>

            <p>
                A simple approach to medicine organization
                and everyday care.
            </p>
        </div>

        <div class="footer-column">
            <h3>Quick Links</h3>
            <a href="index.php">Home</a>
            <a href="features.php">Features</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact</a>
        </div>

        <div class="footer-column">
            <h3>Customer Care</h3>
            <a href="faq.php">FAQs</a>
            <a href="product.php">Our Product</a>
            <a href="cart.php">Shopping Cart</a>
            <a href="my-orders.php">My Orders</a>
        </div>

        <div class="footer-column">
            <h3>Your Account</h3>
            <a href="login.php">Login</a>
            <a href="register.php">Create Account</a>
            <a href="user_dashboard.php">My Dashboard</a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>
            &copy; <?= date('Y') ?> Smart Medicine Box.
            All rights reserved.
        </p>

        <p>Designed with care ♡</p>
    </div>
</footer>

</body>
</html>
