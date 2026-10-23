
<?php
session_start();
require_once "db.php";

// Support common database connection variable names.
$db = $conn ?? $con ?? $pdo ?? null;

$isLoggedIn = isset($_SESSION["user_id"]);
$accountLink = $isLoggedIn ? "dashboard.php" : "register.php";
$accountText = $isLoggedIn ? "Dashboard" : "Create Account";

$success = "";
$error = "";

$name = "";
$email = "";
$subject = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $subject = trim($_POST["subject"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if (
        $name === "" ||
        strlen($name) > 100 ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        strlen($email) > 190 ||
        $subject === "" ||
        strlen($subject) > 150 ||
        $message === "" ||
        strlen($message) > 3000
    ) {
        $error = "Please fill in all fields correctly.";
    } elseif (!$db) {
        $error = "Database connection not found. Please check db.php.";
    } else {
        try {
            $sql = "INSERT INTO contact_messages
                    (name, email, subject, message)
                    VALUES (?, ?, ?, ?)";

            if ($db instanceof mysqli) {
                $stmt = $db->prepare($sql);
                $stmt->bind_param(
                    "ssss",
                    $name,
                    $email,
                    $subject,
                    $message
                );
                $stmt->execute();
                $stmt->close();

            } elseif ($db instanceof PDO) {
                $stmt = $db->prepare($sql);
                $stmt->execute([
                    $name,
                    $email,
                    $subject,
                    $message
                ]);

            } else {
                throw new RuntimeException(
                    "Unsupported database connection type."
                );
            }

            $success = "Your message has been saved successfully!";
            $name = "";
            $email = "";
            $subject = "";
            $message = "";

        } catch (Throwable $e) {
            error_log($e->getMessage());
            $error = "Message could not be saved. Check your database and contact_messages table.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Smart Medicine Box</title>

    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/contact.css">
</head>
<body>

<header class="contact-header">
    <nav class="contact-nav">
        <a href="index.php" class="contact-logo">
            <span>+</span> Smart Medicine Box
        </a>

        <button
            class="contact-menu-btn"
            id="contactMenuBtn"
            type="button"
            aria-label="Toggle navigation"
            aria-expanded="false">
            ☰
        </button>

        <div class="contact-nav-links" id="contactNavLinks">
            <a href="index.php">Home</a>
            <a href="features.php">Features</a>
            <a href="how-it-works.php">How It Works</a>
            <a href="about.php">About</a>
            <a href="contact.php" class="active">Contact</a>
            
            <a href="<?php echo htmlspecialchars($accountLink); ?>"
               class="contact-nav-cta">
                <?php echo htmlspecialchars($accountText); ?>
            </a>
        </div>
    </nav>
</header>

<main>
    <section class="contact-hero">
        <span class="contact-tag">WE ARE HERE TO HELP</span>
        <h1>Let's Talk About Your <span>Health</span></h1>
        <p>
            Have a question about Smart Medicine Box?
            Send us a message and let us know how we can help.
        </p>
    </section>

    <section class="contact-section">
        <div class="contact-info">
            <span class="contact-tag">GET IN TOUCH</span>
            <h2>We'd love to hear from you.</h2>
            <p>
                Send your questions, feedback, or suggestions
                about our smart medicine management system.
            </p>

            <div class="contact-info-card">
                <div class="contact-info-icon">✉</div>
                <div>
                    <h3>Email Support</h3>
                    <p>Use the contact form to send us a message.</p>
                </div>
            </div>

            <div class="contact-info-card">
                <div class="contact-info-icon">⌖</div>
                <div>
                    <h3>Our Purpose</h3>
                    <p>Helping users manage their medicine routines.</p>
                </div>
            </div>

            <div class="contact-info-card">
                <div class="contact-info-icon">♡</div>
                <div>
                    <h3>Your Feedback Matters</h3>
                    <p>Your suggestions can help us improve.</p>
                </div>
            </div>
        </div>

        <div class="contact-form-card">
            <h2>Send Us a Message</h2>
            <p class="contact-form-subtitle">Fill out the form below.</p>

            <?php if ($success !== ""): ?>
                <div class="contact-alert contact-success" role="status">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <?php if ($error !== ""): ?>
                <div class="contact-alert contact-error" role="alert">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form id="contactForm" method="POST" action="contact.php">
                <div class="contact-field">
                    <label for="name">Full Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        maxlength="100"
                        placeholder="Enter your full name"
                        required
                        value="<?php echo htmlspecialchars($name); ?>">
                </div>

                <div class="contact-field">
                    <label for="email">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        maxlength="190"
                        placeholder="you@example.com"
                        required
                        value="<?php echo htmlspecialchars($email); ?>">
                </div>

                <div class="contact-field">
                    <label for="subject">Subject</label>
                    <input
                        type="text"
                        id="subject"
                        name="subject"
                        maxlength="150"
                        placeholder="What is your message about?"
                        required
                        value="<?php echo htmlspecialchars($subject); ?>">
                </div>

                <div class="contact-field">
                    <label for="message">Your Message</label>
                    <textarea
                        id="message"
                        name="message"
                        rows="5"
                        maxlength="3000"
                        placeholder="Write your message here..."
                        required><?php echo htmlspecialchars($message); ?></textarea>
                </div>

                <button type="submit" class="contact-submit-btn">
                    Send Message <span>→</span>
                </button>

                <p class="contact-form-note">
                    Please do not include private medical information.
                </p>
            </form>
        </div>
    </section>

    <section class="contact-bottom">
        <h2>Better Medicine Management Starts Here</h2>
        <p>
            Explore the features designed to help organize your medicine routine.
        </p>
        <a href="features.php">Explore Features →</a>
    </section>
</main>

<footer class="contact-footer">
    <a href="index.php" class="contact-logo">
        <span>+</span> Smart Medicine Box
    </a>
    <p>Making medicine routines easier to manage.</p>
    <p>
        © <?php echo date("Y"); ?>
        Smart Medicine Box. All rights reserved.
    </p>
</footer>

<script src="assets/js/contact.js"></script>

</body>
</html>
