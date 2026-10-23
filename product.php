
<?php
require_once 'db.php';

try {
    $stmt = $pdo->query("
        SELECT id, name, price, description, expiry_date, stock, image
        FROM medicines
        WHERE stock > 0
          AND (expiry_date IS NULL OR expiry_date >= CURDATE())
        ORDER BY id DESC
    ");

    $medicines = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log($e->getMessage());
    $medicines = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Our Products | Smart Medicine Box</title>

    <!-- CSS file inside assets/css folder -->
     <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/product.css">
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

<main class="products-section">

    <div class="products-header">
        <span class="section-label">SMART MEDICINE BOX</span>
        <h1>Our Products</h1>
        <p>Explore our available medicines and find the product you need.</p>
    </div>

    <div class="products-grid">

        <?php if (!empty($medicines)): ?>

            <?php foreach ($medicines as $medicine): ?>

                <article class="product-card">

                    <div class="product-image-box">
                        <?php if (!empty($medicine['image'])): ?>
                            <img
                                src="uploads/medicines/<?php
                                    echo htmlspecialchars(
                                        basename($medicine['image']),
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );
                                ?>"
                                alt="<?php
                                    echo htmlspecialchars(
                                        $medicine['name'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );
                                ?>"
                                class="product-image"
                                loading="lazy"
                            >
                        <?php else: ?>
                            <div class="image-placeholder">
                                <span>No Image Available</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="product-content">

                        <h2>
                            <?php
                            echo htmlspecialchars(
                                $medicine['name'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>
                        </h2>

                        <p class="product-description">
                            <?php
                            echo htmlspecialchars(
                                $medicine['description'],
                                ENT_QUOTES,
                                'UTF-8'
                            );
                            ?>
                        </p>

                        <div class="product-price">
                            Rs.
                            <?php echo number_format((float)$medicine['price'], 2); ?>
                        </div>

                        <?php if (!empty($medicine['expiry_date'])): ?>
                            <p class="product-expiry">
                                <strong>Expiry:</strong>
                                <?php
                                echo htmlspecialchars(
                                    $medicine['expiry_date'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                );
                                ?>
                            </p>
                        <?php endif; ?>

                        <p class="product-stock">
                            <span class="stock-dot"></span>
                            In Stock: <?php echo (int)$medicine['stock']; ?>
                        </p>

                        <a
                            class="product-btn"
                            href="contact.php?medicine=<?php
                                echo urlencode($medicine['name']);
                            ?>"
                        >
                            Enquire Now
                        </a>

                    </div>
                </article>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="no-products">
                <h2>No Products Available</h2>
                <p>Products will appear here when the admin adds them.</p>
            </div>

        <?php endif; ?>

    </div>
</main>
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
