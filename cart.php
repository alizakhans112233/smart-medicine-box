
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$products = [
    1 => [
        'name' => 'Smart Medicine Box',
        'price' => 4500,
        'description' => 'Smart medication organization'
    ],
    2 => [
        'name' => 'Medicine Reminder Box',
        'price' => 2500,
        'description' => 'Daily medicine management'
    ],
    3 => [
        'name' => 'Digital Pill Organizer',
        'price' => 1800,
        'description' => 'Compact pill storage'
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);

    if ($action === 'remove' && $id !== false && $id !== null) {
        unset($_SESSION['cart'][$id]);
    }

    if (
        $action === 'update' &&
        $id !== false &&
        $id !== null &&
        isset($_SESSION['cart'][$id])
    ) {
        $quantity = filter_input(
            INPUT_POST,
            'quantity',
            FILTER_VALIDATE_INT
        );

        if ($quantity !== false && $quantity !== null) {
            if ($quantity <= 0) {
                unset($_SESSION['cart'][$id]);
            } else {
                $_SESSION['cart'][$id] = min($quantity, 99);
            }
        }
    }

    header('Location: cart.php');
    exit;
}

$cart = $_SESSION['cart'];
$subtotal = 0;
$totalItems = 0;

foreach ($cart as $id => $quantity) {
    if (!isset($products[$id])) {
        unset($_SESSION['cart'][$id]);
        continue;
    }

    $subtotal += $products[$id]['price'] * $quantity;
    $totalItems += $quantity;
}

$cart = $_SESSION['cart'];
?>
<link rel="stylesheet" href="assets/css/index.css">
<link rel="stylesheet" href="assets/css/cart.css">

<main class="cart-page">
    <section class="cart-hero">
        <span class="cart-eyebrow">SMART MEDICINE BOX</span>
        <h1>Your Shopping Cart</h1>
        <p>Review your selected products before continuing.</p>
    </section>

    <section class="cart-container">
        <div class="cart-main">
            <div class="cart-title-row">
                <h2>Cart Items</h2>
                <span class="item-count">
                    <?= (int)$totalItems ?>
                    <?= $totalItems === 1 ? 'item' : 'items' ?>
                </span>
            </div>

            <?php if (empty($cart)): ?>
                <div class="empty-cart">
                    <div class="empty-cart-icon">🛒</div>
                    <h2>Your cart is empty</h2>
                    <p>You haven't added any products yet.</p>
                    <a href="pricing.php" class="cart-btn">
                        Explore Products
                    </a>
                </div>
            <?php else: ?>

                <?php foreach ($cart as $id => $quantity): ?>
                    <?php
                    if (!isset($products[$id])) {
                        continue;
                    }

                    $product = $products[$id];
                    $lineTotal = $product['price'] * $quantity;
                    ?>

                    <article class="cart-item">
                        <div class="product-icon">💊</div>

                        <div class="product-info">
                            <h3>
                                <?= htmlspecialchars($product['name']) ?>
                            </h3>

                            <p>
                                <?= htmlspecialchars($product['description']) ?>
                            </p>

                            <strong>
                                Rs. <?= number_format($product['price']) ?>
                            </strong>

                            <form method="POST" class="quantity-form">
                                <input type="hidden" name="action"
                                       value="update">
                                <input type="hidden" name="product_id"
                                       value="<?= (int)$id ?>">

                                <label for="qty-<?= (int)$id ?>">
                                    Quantity:
                                </label>

                                <div class="quantity-control">
                                    <button type="button"
                                            class="qty-btn"
                                            data-change="-1"
                                            aria-label="Decrease quantity">−</button>

                                    <input type="number"
                                           id="qty-<?= (int)$id ?>"
                                           name="quantity"
                                           value="<?= (int)$quantity ?>"
                                           min="1" max="99"
                                           class="quantity-input"
                                           required>

                                    <button type="button"
                                            class="qty-btn"
                                            data-change="1"
                                            aria-label="Increase quantity">+</button>
                                </div>

                                <button type="submit"
                                        class="update-btn">
                                    Update
                                </button>
                            </form>

                            <form method="POST" class="remove-form"
                                  onsubmit="return confirm('Remove this product from your cart?');">
                                <input type="hidden" name="action"
                                       value="remove">
                                <input type="hidden" name="product_id"
                                       value="<?= (int)$id ?>">
                                <button type="submit" class="remove-btn">
                                    Remove item
                                </button>
                            </form>
                        </div>

                        <div class="product-total">
                            <span>Item total</span>
                            <strong>
                                Rs. <?= number_format($lineTotal) ?>
                            </strong>
                        </div>
                    </article>
                <?php endforeach; ?>

            <?php endif; ?>
        </div>

        <aside class="cart-summary">
            <h2>Order Summary</h2>

            <div class="summary-line">
                <span>Total items</span>
                <span><?= (int)$totalItems ?></span>
            </div>

            <div class="summary-line">
                <span>Subtotal</span>
                <span>Rs. <?= number_format($subtotal) ?></span>
            </div>

            <div class="summary-line">
                <span>Delivery</span>
                <span>Calculated at checkout</span>
            </div>

            <div class="summary-total">
                <span>Subtotal</span>
                <strong>Rs. <?= number_format($subtotal) ?></strong>
            </div>

            <?php if (!empty($cart)): ?>
                <a href="checkout.php" class="cart-btn checkout-btn">
                    Proceed to Checkout →
                </a>
            <?php else: ?>
                <button class="cart-btn checkout-btn" disabled>
                    Proceed to Checkout
                </button>
            <?php endif; ?>

            <a href="pricing.php" class="continue-shopping">
                ← Continue Shopping
            </a>

            <div class="secure-note">
                <span>🔒</span>
                <p>Never share your medical or payment details on an
                   untrusted page.</p>
            </div>
        </aside>
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


<script src="assets/js/cart.js"></script>


