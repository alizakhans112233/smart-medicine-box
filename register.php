
<?php
session_start();
require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if ($name === '' || $email === '' || $password === '') {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } else {
        try {
            $check = $pdo->prepare('SELECT id FROM users WHERE email = ?');
            $check->execute([$email]);

            if ($check->fetch()) {
                $error = 'Email already registered. Please login.';
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $pdo->prepare(
                    'INSERT INTO users (name, email, password) VALUES (?, ?, ?)'
                );
                $stmt->execute([$name, $email, $hash]);

                header('Location: login.php?registered=1');
                exit;
            }
        } catch (PDOException $e) {
    $error = 'Database Error: ' . $e->getMessage();
}
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account | Smart Medicine Box</title>
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
<div class="auth-page">
    <div class="auth-card">
        <a class="brand" href="index.php">Smart Medicine Box</a>
        <div class="auth-icon">💊</div>
        <h1>Create Account</h1>
        <p class="subtitle">Create an account to manage your medicines.</p>

        <?php if ($error): ?>
            <div class="alert error">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" maxlength="100"
                   autocomplete="name" required
                   value="<?= htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" maxlength="150"
                   autocomplete="email" required
                   value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

            <label for="password">Password (minimum 8 characters)</label>
            <input type="password" id="password" name="password"
                   minlength="8" autocomplete="new-password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password"
                   minlength="8" autocomplete="new-password" required>

            <button type="submit">Create Account</button>
        </form>

        <p class="auth-switch">
            Already have an account? <a href="login.php">Login</a>
        </p>
        <a class="back-link" href="index.php">← Back to Home</a>
    </div>
</div>
</body>
</html>
