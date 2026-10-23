
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$products = [
    1 => [
        'name' => 'Smart Medicine Box',
        'price' => 4500,
        'description' => 'Organize your daily medication routine.',
        'icon' => '💊',
        'features' => [
            'Medicine organization',
            'Daily routine support',
            'Easy-to-use design'
        ]
    ],
    2 => [
        'name' => 'Medicine Reminder Box',
        'price' => 2500,
        'description' => 'A simple solution for medication planning.',
        'icon' => '⏰',
        'features' => [
            'Medicine schedule planning',
            'Daily medication checklist',
            'Compact design'
        ]
    ],
    3 => [
        'name' => 'Digital Pill Organizer',
        'price' => 1800,
        'description' => 'Keep your medicine organized in one place.',
        'icon' => '🩺',
        'features' => [
            'Medicine storage',
            'Simple organization',
            'Portable design'
        ]
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);

    if ($id !== false && $id !== null && isset($products[$id])) {
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $currentQuantity = (int)($_SESSION['cart'][$id] ?? 0);
        $_SESSION['cart'][$id] = min(99, $currentQuantity + 1);

        header('Location: cart.php?added=1');
        exit;
    }

    header('Location: pricing.php');
    exit;
}

$cartCount = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $quantity) {
        $cartCount += max(0, (int)$quantity);
    }
}


?>
<link rel="stylesheet" href="assets/css/index.css">

<link rel="stylesheet" href="assets/css/pricing.css">

<main class="pricing-page">

    <section class="pricing-hero">
        <span class="pricing-label">SMART MEDICINE BOX</span>
        <h1>Choose Your <span>Smart Solution</span></h1>
        <p>
            Explore our sample product options to help organize
            your medicine and daily healthcare routine.
        </p>

        <a href="#products" class="pricing-main-btn">
            Explore Products ↓
        </a>

        <a href="cart.php" class="hero-cart-link">
            View Cart (<?= (int)$cartCount ?>)
        </a>
    </section>

    <?php if (isset($_GET['added'])): ?>
        <div class="cart-success" role="status">
            ✓ Product added to your cart successfully!
            <a href="cart.php">View Cart</a>
        </div>
    <?php endif; ?>

    <section class="pricing-products" id="products">
        <div class="pricing-heading">
            <span class="pricing-label">OUR PRODUCTS</span>
            <h2>Simple Options for Everyday Care</h2>
            <p>Choose a product to add it to your shopping cart.</p>
        </div>

        <div class="pricing-grid">
            <?php foreach ($products as $id => $product): ?>
                <article class="pricing-card">

                    <div class="pricing-product-icon">
                        <?= $product['icon'] ?>
                    </div>

                    <h3><?= htmlspecialchars($product['name']) ?></h3>

                    <p class="pricing-description">
                        <?= htmlspecialchars($product['description']) ?>
                    </p>

                    <div class="price">
                        <span>Rs.</span>
                        <?= number_format($product['price']) ?>
                    </div>

                    <span class="price-caption">Demo price</span>

                    <div class="pricing-divider"></div>

                    <ul class="pricing-features">
                        <?php foreach ($product['features'] as $feature): ?>
                            <li>
                                <span class="feature-check">✓</span>
                                <?= htmlspecialchars($feature) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <form method="POST" class="add-cart-form">
                        <input type="hidden" name="product_id"
                               value="<?= (int)$id ?>">

                        <button type="submit" class="add-cart-btn">
                            Add to Cart <span>→</span>
                        </button>
                    </form>

                </article>
            <?php endforeach; ?>
        </div>

        <p class="pricing-disclaimer">
            Note: These are demonstration products and prices for a student
            project. Availability, actual product specifications and payment
            options have not been configured.
        </p>
    </section>

    <section class="pricing-help">
        <div>
            <span class="pricing-label">NEED HELP?</span>
            <h2>Have Questions About Our Products?</h2>
            <p>Contact our team for more information about Smart Medicine Box.</p>
        </div>

        <a href="contact.php" class="pricing-main-btn">
            Contact Us →
        </a>
    </section>

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

<script src="assets/js/pricing.js"></script>
<script src="assets/js/index.js"></script>



