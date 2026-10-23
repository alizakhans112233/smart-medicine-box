
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'db.php';

// User login check
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = (int) $_SESSION['user_id'];
$orders = [];
$error = '';
$itemsAvailable = false;

try {
    // Existing orders table ke columns check karo
    $orderColumns = $pdo->query("SHOW COLUMNS FROM `orders`")
                        ->fetchAll(PDO::FETCH_COLUMN);

    $requiredColumns = ['id', 'user_id', 'total_amount', 'created_at'];

    foreach ($requiredColumns as $column) {
        if (!in_array($column, $orderColumns, true)) {
            throw new Exception(
                "orders table mein required column missing hai: " . $column
            );
        }
    }

    // Sirf woh columns select karo jo database mein maujood hain
    $optionalColumns = [
        'shipping_address',
        'phone',
        'payment_method',
        'payment_status',
        'order_status'
    ];

    $selectColumns = $requiredColumns;

    foreach ($optionalColumns as $column) {
        if (in_array($column, $orderColumns, true)) {
            $selectColumns[] = $column;
        }
    }

    $columnList = implode(
        ', ',
        array_map(
            fn($column) => '`' . $column . '`',
            $selectColumns
        )
    );

    $sql = "SELECT $columnList
            FROM `orders`
            WHERE `user_id` = :user_id
            ORDER BY `created_at` DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $userId]);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Order items table ko check karo
    try {
        $itemColumns = $pdo->query("SHOW COLUMNS FROM `order_items`")
                           ->fetchAll(PDO::FETCH_COLUMN);

        $itemsAvailable =
            in_array('order_id', $itemColumns, true) &&
            in_array('quantity', $itemColumns, true);

        if (
            $itemsAvailable &&
            in_array('product_name', $itemColumns, true) &&
            in_array('price', $itemColumns, true)
        ) {
            foreach ($orders as &$order) {
                $itemStmt = $pdo->prepare(
                    "SELECT `product_name`, `quantity`, `price`
                     FROM `order_items`
                     WHERE `order_id` = :order_id"
                );

                $itemStmt->execute([
                    'order_id' => $order['id']
                ]);

                $order['items'] = $itemStmt->fetchAll(PDO::FETCH_ASSOC);
            }
            unset($order);
        } else {
            $itemsAvailable = false;
        }
    } catch (PDOException $e) {
        // Orders table ka data phir bhi display ho sakta hai
        $itemsAvailable = false;
    }

} catch (Throwable $e) {
    error_log('My Orders Error: ' . $e->getMessage());
    $error = 'Orders abhi load nahi ho sake. Database connection aur table structure check karein.';
}

function orderEscape($value) {
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

function orderStatusLabel($status) {
    return ucfirst(str_replace('_', ' ', (string)$status));
}


?>
<link rel="stylesheet" href="assets/css/index.css">
<link rel="stylesheet" href="assets/css/my-orders.css">

<main class="my-orders-page">
    <div class="orders-container">

        <div class="orders-heading">
            <div>
                <span class="orders-eyebrow">YOUR ACCOUNT</span>
                <h1>My Orders</h1>
                <p>Apne medicine box orders aur unki details yahan dekhein.</p>
            </div>

            <a class="orders-shop-btn" href="pricing.php">
                Continue Shopping
            </a>
        </div>

        <?php if ($error !== ''): ?>

            <div class="orders-message orders-error">
                <?= orderEscape($error) ?>
            </div>

        <?php elseif (empty($orders)): ?>

            <div class="orders-empty">
                <div class="empty-icon">&#128722;</div>
                <h2>Abhi koi order nahi hai</h2>
                <p>Jab aap order place karenge, uski details yahan show hongi.</p>
                <a class="orders-shop-btn" href="pricing.php">
                    Explore Products
                </a>
            </div>

        <?php else: ?>

            <div class="orders-count">
                Total Orders: <strong><?= count($orders) ?></strong>
            </div>

            <?php foreach ($orders as $order): ?>
                <?php
                    $status = $order['order_status'] ?? 'pending';
                    $paymentStatus = $order['payment_status'] ?? 'pending';
                    $items = $order['items'] ?? [];
                ?>

                <section class="order-card">
                    <div class="order-card-top">
                        <div>
                            <span class="order-label">ORDER NUMBER</span>
                            <h2>#<?= (int)$order['id'] ?></h2>
                        </div>

                        <span class="order-status status-<?= orderEscape($status) ?>">
                            <?= orderEscape(orderStatusLabel($status)) ?>
                        </span>
                    </div>

                    <div class="order-summary">
                        <div class="order-info">
                            <span>Order Date</span>
                            <strong>
                                <?= orderEscape(date(
                                    'd M Y, h:i A',
                                    strtotime($order['created_at'])
                                )) ?>
                            </strong>
                        </div>

                        <div class="order-info">
                            <span>Total Amount</span>
                            <strong class="order-price">
                                Rs. <?= number_format(
                                    (float)$order['total_amount'], 2
                                ) ?>
                            </strong>
                        </div>

                        <?php if (isset($order['payment_method'])): ?>
                            <div class="order-info">
                                <span>Payment Method</span>
                                <strong><?= orderEscape($order['payment_method']) ?></strong>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($order['payment_status'])): ?>
                            <div class="order-info">
                                <span>Payment Status</span>
                                <strong><?= orderEscape(orderStatusLabel($paymentStatus)) ?></strong>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($order['shipping_address'])): ?>
                        <div class="order-address">
                            <strong>Shipping Address</strong>
                            <p><?= nl2br(orderEscape($order['shipping_address'])) ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($itemsAvailable): ?>
                        <div class="order-items">
                            <h3>Order Items</h3>

                            <?php if (empty($items)): ?>
                                <p class="no-items">Is order ki item details available nahi hain.</p>
                            <?php else: ?>
                                <?php foreach ($items as $item): ?>
                                    <div class="order-item">
                                        <div>
                                            <strong><?= orderEscape($item['product_name']) ?></strong>
                                            <span>Quantity: <?= (int)$item['quantity'] ?></span>
                                        </div>

                                        <strong>
                                            Rs. <?= number_format(
                                                (float)$item['price'] * (int)$item['quantity'],
                                                2
                                            ) ?>
                                        </strong>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($order['phone']) && $order['phone'] !== ''): ?>
                        <div class="order-phone">
                            <strong>Contact:</strong>
                            <?= orderEscape($order['phone']) ?>
                        </div>
                    <?php endif; ?>
                </section>
            <?php endforeach; ?>

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

<script src="assets/js/my-orders.js"></script>


