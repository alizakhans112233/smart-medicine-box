
<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['user_id'])) {
    header('Location: user_dashboard.php');
    exit;
}

$error = '';
$success = isset($_GET['registered'])
    ? 'Account created successfully! Please log in.'
    : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = 'Please enter your email and password.';
    } else {
        try {
            $stmt = $pdo->prepare(
                'SELECT id, name, email, password
                 FROM users WHERE email = ? LIMIT 1'
            );
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                session_regenerate_id(true);

                $_SESSION['user_id'] = (int) $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];

                header('Location: user_dashboard.php');
                exit;
            }

            $error = 'Incorrect email or password.';
        } catch (PDOException $e) {
            $error = 'Login failed. Check your database and users table.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Smart Medicine Box</title>
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
<div class="auth-page">
    <div class="auth-card">
        <a class="brand" href="index.php">Smart Medicine Box</a>
        <div class="auth-icon">🔐</div>
        <h1>Welcome Back</h1>
        <p class="subtitle">Login to manage your medicine reminders.</p>

        <?php if ($success): ?>
            <div class="alert success">
                <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert error">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email"
                   autocomplete="email" required
                   value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                   autocomplete="current-password" required>

            <button type="submit">Login</button>
        </form>

        <p class="auth-switch">
            Don't have an account? <a href="register.php">Create Account</a>
        </p>
        <a class="back-link" href="index.php">← Back to Home</a>
    </div>
</div>
</body>
</html>
