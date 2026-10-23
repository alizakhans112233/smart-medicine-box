
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

/*
 * Product IDs aur prices apne database ke mutabiq rakhein.
 */
$products = [
    1 => ['name' => 'Smart Medicine Box', 'price' => 4500],
    2 => ['name' => 'Medicine Reminder Box', 'price' => 2500],
    3 => ['name' => 'Digital Pill Organizer', 'price' => 1800],
];

$cart = $_SESSION['cart'] ?? [];
$cartItems = [];
$total = 0;
$error = '';
$success = '';

/* Cart ko normalize karna */
foreach ($cart as $key => $value) {
    if (is_array($value)) {
        $productId = (int)($value['product_id'] ?? $value['id'] ?? $key);
        $quantity = (int)($value['quantity'] ?? $value['qty'] ?? 1);
    } else {
        $productId = (int)$key;
        $quantity = (int)$value;
    }

    if (!isset($products[$productId]) || $quantity < 1) {
        continue;
    }

    $price = (float)$products[$productId]['price'];
    $subtotal = $price * $quantity;

    $cartItems[] = [
        'id' => $productId,
        'name' => $products[$productId]['name'],
        'price' => $price,
        'quantity' => $quantity,
        'subtotal' => $subtotal
    ];

    $total += $subtotal;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['shipping_address'] ?? '');
    $paymentMethod = 'Cash on Delivery';

    if (empty($cartItems)) {
        $error = 'Aapka cart khali hai. Pehle products add karein.';
    } elseif ($phone === '' || $address === '') {
        $error = 'Phone number aur delivery address fill karein.';
    } else {
        try {
            $pdo->beginTransaction();

            // Order save karna
            $orderSql = "INSERT INTO orders
                (user_id, total_amount, shipping_address, phone,
                 payment_method, payment_status, order_status)
                VALUES
                (:user_id, :total_amount, :shipping_address, :phone,
                 :payment_method, 'pending', 'pending')";

            $orderStmt = $pdo->prepare($orderSql);
            $orderStmt->execute([
                ':user_id' => (int)$_SESSION['user_id'],
                ':total_amount' => $total,
                ':shipping_address' => $address,
                ':phone' => $phone,
                ':payment_method' => $paymentMethod
            ]);

            $orderId = (int)$pdo->lastInsertId();

            // Tumhari actual order_items table ke columns
            $itemSql = "INSERT INTO order_items
                (order_id, product_id, quantity, unit_price)
                VALUES
                (:order_id, :product_id, :quantity, :unit_price)";

            $itemStmt = $pdo->prepare($itemSql);

            foreach ($cartItems as $item) {
                $itemStmt->execute([
                    ':order_id' => $orderId,
                    ':product_id' => $item['id'],
                    ':quantity' => $item['quantity'],
                    ':unit_price' => $item['price']
                ]);
            }

            $pdo->commit();

            unset($_SESSION['cart']);

            header('Location: my-orders.php?success=1');
            exit;

        } catch (Throwable $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }

            // Development mein asal error log hogi.
            error_log('Checkout error: ' . $e->getMessage());

            $error = 'Order place nahi ho saka. Database aur product IDs check karein.';

            // Sirf local XAMPP debugging ke liye:
            // $error .= ' Details: ' . $e->getMessage();
        }
    }
}


?>
<link rel="stylesheet" href="assets/css/index.css">

<link rel="stylesheet" href="assets/css/checkout.css">

<main class="checkout-container">
    <section class="checkout-heading">
        <p class="eyebrow">SMART MEDICINE BOX</p>
        <h1>Checkout</h1>
        <p>Apni delivery details enter karein aur order confirm karein.</p>
    </section>

    <?php if ($error !== ''): ?>
        <div class="message error-message">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div class="checkout-grid">
        <section class="checkout-card">
            <h2>Delivery Information</h2>

            <?php if (empty($cartItems)): ?>
                <p>Aapka cart khali hai.</p>
                <a class="checkout-button" href="pricing.php">Shop Now</a>
            <?php else: ?>
                <form method="POST" id="checkoutForm">
                    <label for="phone">Phone Number</label>
                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        placeholder="03XXXXXXXXX"
                        maxlength="25"
                        required
                        value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>"
                    >

                    <label for="shipping_address">Complete Delivery Address</label>
                    <textarea
                        id="shipping_address"
                        name="shipping_address"
                        rows="4"
                        placeholder="House number, street, city..."
                        required
                    ><?= htmlspecialchars($_POST['shipping_address'] ?? '') ?></textarea>

                    <label>Payment Method</label>
                    <div class="payment-option">
                        <span class="payment-icon">💵</span>
                        <div>
                            <strong>Cash on Delivery</strong>
                            <p>Delivery par payment karein.</p>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="checkout-button"
                        id="placeOrderButton"
                    >
                        Place Order — Rs. <?= number_format($total, 2) ?>
                    </button>
                </form>
            <?php endif; ?>
        </section>

        <aside class="checkout-card order-summary">
            <h2>Order Summary</h2>

            <?php if (!empty($cartItems)): ?>
                <?php foreach ($cartItems as $item): ?>
                    <div class="summary-item">
                        <div>
                            <strong><?= htmlspecialchars($item['name']) ?></strong>
                            <p>Quantity: <?= $item['quantity'] ?></p>
                        </div>
                        <span>Rs. <?= number_format($item['subtotal'], 2) ?></span>
                    </div>
                <?php endforeach; ?>

                <div class="summary-total">
                    <span>Total</span>
                    <strong>Rs. <?= number_format($total, 2) ?></strong>
                </div>
            <?php else: ?>
                <p>Order summary ke liye cart mein products add karein.</p>
            <?php endif; ?>
        </aside>
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


<script src="assets/js/checkout.js"></script>

