
<?php
session_start();
require_once 'db.php';

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = (int) $_SESSION['user_id'];
$userName = $_SESSION['user_name'] ?? 'User';

$error = '';

// Add medicine
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_medicine'])) {
    $medicineName = trim($_POST['medicine_name'] ?? '');
    $dosage = trim($_POST['dosage'] ?? '');
    $reminderTime = trim($_POST['reminder_time'] ?? '');
    $instructions = trim($_POST['instructions'] ?? '');

    if ($medicineName === '' || $dosage === '' || $reminderTime === '') {
        $error = 'Please fill in all required fields.';
    } elseif (
        !preg_match('/^\d{2}:\d{2}$/', $reminderTime) ||
        (int) substr($reminderTime, 0, 2) > 23 ||
        (int) substr($reminderTime, 3, 2) > 59
    ) {
        $error = 'Please enter a valid reminder time.';
    } else {
        try {
            $stmt = $pdo->prepare(
                "INSERT INTO medicine_routines
                (user_id, medicine_name, dosage, reminder_time, instructions)
                VALUES (?, ?, ?, ?, ?)"
            );

            $stmt->execute([
                $userId,
                $medicineName,
                $dosage,
                $reminderTime,
                $instructions
            ]);

            header("Location: user_dashboard.php?added=1");
            exit;

        } catch (PDOException $e) {
            $error = 'Medicine save nahi hui. Database table ke column names check karein.';
        }
    }
}

// Delete medicine
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_medicine'])) {
    $reminderId = filter_input(INPUT_POST, 'reminder_id', FILTER_VALIDATE_INT);

    if ($reminderId) {
        $stmt = $pdo->prepare(
            "DELETE FROM medicine_routines
             WHERE id = ? AND user_id = ?"
        );

        $stmt->execute([$reminderId, $userId]);
    }

    header("Location: user_dashboard.php?deleted=1");
    exit;
}

// Fetch medicines
$stmt = $pdo->prepare(
    "SELECT id, medicine_name, dosage, reminder_time, instructions
     FROM medicine_routines
     WHERE user_id = ?
     ORDER BY reminder_time ASC"
);

$stmt->execute([$userId]);
$medicines = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Dashboard statistics
$totalMedicines = count($medicines);
$currentTime = date('H:i');
$upcomingMedicines = 0;

foreach ($medicines as $medicine) {
    if (substr($medicine['reminder_time'], 0, 5) >= $currentTime) {
        $upcomingMedicines++;
    }
}

// Safe HTML output
function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Dashboard | Smart Medicine Box</title>

    <link rel="stylesheet" href="assets/css/user_dashboard.css">
</head>

<body>

<div class="dashboard-layout">

    <!-- Sidebar -->
    <aside class="sidebar">

        <a href="index.php" class="brand">
            <span class="brand-icon">✚</span>
            <span>Smart<span class="brand-light">Medi</span></span>
        </a>

        <p class="sidebar-label">MAIN MENU</p>

        <a href="user_dashboard.php" class="nav-link active">
            <span>▦</span> Dashboard
        </a>

        <a href="#medicines" class="nav-link">
            <span>♡</span> My Medicines
        </a>

        <a href="#add-medicine" class="nav-link">
            <span>＋</span> Add Reminder
        </a>

        <a href="index.php" class="nav-link">
            <span>⌂</span> Home Page
        </a>

        <div class="sidebar-bottom">

            <div class="help-card">
                <div class="help-icon">✦</div>
                <strong>Stay on track!</strong>
                <p>Keep your medicine schedule organized every day.</p>
            </div>

            <a href="logout.php" class="nav-link logout-link">
                <span>↪</span> Logout
            </a>

        </div>

    </aside>

    <!-- Main content -->
    <main class="main-content">

        <header class="topbar">

            <div>
                <div class="eyebrow">YOUR PERSONAL HEALTH SPACE</div>
                <h1>Dashboard</h1>
            </div>

            <div class="profile">
                <div class="avatar">
                    <?= h(strtoupper(substr($userName, 0, 1))) ?>
                </div>

                <div>
                    <strong><?= h($userName) ?></strong>
                    <span>Member</span>
                </div>
            </div>

        </header>

        <!-- Welcome banner -->
        <section class="welcome-banner">

            <div class="welcome-copy">

                <span class="welcome-tag">YOUR HEALTH MATTERS</span>

                <h2>Hello, <?= h($userName) ?>! 👋</h2>

                <p>
                    Manage your medicines and organize your daily routine
                    in one place.
                </p>

                <a href="#add-medicine" class="banner-button">
                    ＋ Add a Medicine
                </a>

            </div>

            <div class="banner-art" aria-hidden="true">
                <div class="art-circle">
                    <div class="pill">✚</div>
                    <div class="art-spark spark-one">✦</div>
                    <div class="art-spark spark-two">＋</div>
                </div>
            </div>

        </section>

        <!-- Messages -->
        <?php if (isset($_GET['added'])): ?>
            <div class="alert success">
                ✓ Medicine reminder added successfully.
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['deleted'])): ?>
            <div class="alert success">
                ✓ Medicine reminder deleted successfully.
            </div>
        <?php endif; ?>

        <?php if ($error !== ''): ?>
            <div class="alert error">
                <?= h($error) ?>
            </div>
        <?php endif; ?>

        <!-- Statistics -->
        <section class="stats-grid">

            <article class="stat-card">
                <div class="stat-icon purple">♡</div>
                <div class="stat-label">Total Medicines</div>
                <div class="stat-number"><?= $totalMedicines ?></div>
                <div class="stat-note">Saved medicine reminders</div>
            </article>

            <article class="stat-card">
                <div class="stat-icon green">◷</div>
                <div class="stat-label">Upcoming Today</div>
                <div class="stat-number"><?= $upcomingMedicines ?></div>
                <div class="stat-note">Reminders scheduled later today</div>
            </article>

            <article class="stat-card">
                <div class="stat-icon orange">✓</div>
                <div class="stat-label">Daily Routine</div>

                <div class="stat-number">
                    <?= $totalMedicines > 0 ? 'Active' : 'Start' ?>
                </div>

                <div class="stat-note">
                    <?= $totalMedicines > 0
                        ? 'Your schedule is ready'
                        : 'Add your first reminder' ?>
                </div>
            </article>

        </section>

        <!-- Main dashboard sections -->
        <div class="content-grid">

            <!-- Medicine list -->
            <section class="panel medicine-panel" id="medicines">

                <div class="panel-heading">

                    <div>
                        <h3>My Medicine Schedule</h3>
                        <p>Your saved medicine reminders</p>
                    </div>

                    <span class="count-badge">
                        <?= $totalMedicines ?> total
                    </span>

                </div>

                <?php if ($totalMedicines > 0): ?>

                    <div class="medicine-list">

                        <?php foreach ($medicines as $medicine): ?>

                            <article class="medicine-item">

                                <div class="medicine-symbol">✚</div>

                                <div class="medicine-details">

                                    <strong>
                                        <?= h($medicine['medicine_name']) ?>
                                    </strong>

                                    <span>
                                        <?= h($medicine['dosage']) ?>
                                    </span>

                                    <?php if (!empty($medicine['instructions'])): ?>
                                        <p>
                                            <?= h($medicine['instructions']) ?>
                                        </p>
                                    <?php endif; ?>

                                </div>

                                <div class="medicine-time">
                                    <span>REMINDER</span>

                                    <strong>
                                        <?= h(date(
                                            'h:i A',
                                            strtotime($medicine['reminder_time'])
                                        )) ?>
                                    </strong>
                                </div>

                                <form method="POST" class="delete-form"
                                      onsubmit="return confirm('Delete this medicine reminder?');">

                                    <input type="hidden"
                                           name="reminder_id"
                                           value="<?= (int)$medicine['id'] ?>">

                                    <button type="submit"
                                            name="delete_medicine"
                                            class="delete-button"
                                            aria-label="Delete reminder">
                                        ×
                                    </button>

                                </form>

                            </article>

                        <?php endforeach; ?>

                    </div>

                <?php else: ?>

                    <div class="empty-state">

                        <div class="empty-icon">♡</div>

                        <h4>No medicines added yet</h4>

                        <p>
                            Add your first medicine below to start organizing
                            your daily schedule.
                        </p>

                        <a href="#add-medicine" class="primary-button">
                            Add Your First Medicine
                        </a>

                    </div>

                <?php endif; ?>

            </section>

            <!-- Add medicine form -->
            <section class="panel add-panel" id="add-medicine">

                <div class="panel-heading">

                    <div>
                        <h3>Add Medicine</h3>
                        <p>Create a new medicine reminder</p>
                    </div>

                    <div class="form-heading-icon">＋</div>

                </div>

                <form method="POST" class="medicine-form">

                    <label for="medicine_name">Medicine Name *</label>

                    <input
                        type="text"
                        id="medicine_name"
                        name="medicine_name"
                        placeholder="e.g. Vitamin D"
                        maxlength="150"
                        required
                    >

                    <label for="dosage">Dosage *</label>

                    <input
                        type="text"
                        id="dosage"
                        name="dosage"
                        placeholder="e.g. 1 tablet"
                        maxlength="100"
                        required
                    >

                    <label for="reminder_time">Reminder Time *</label>

                    <input
                        type="time"
                        id="reminder_time"
                        name="reminder_time"
                        required
                    >

                    <label for="instructions">Instructions</label>

                    <textarea
                        id="instructions"
                        name="instructions"
                        rows="3"
                        maxlength="500"
                        placeholder="e.g. Take after a meal"
                    ></textarea>

                    <button
                        type="submit"
                        name="add_medicine"
                        class="submit-button"
                    >
                        <span>Save Medicine Reminder</span>
                        <span>→</span>
                    </button>

                    <p class="form-note">* Required fields</p>

                </form>

            </section>

        </div>

        <footer class="dashboard-footer">
            <span>© <?= date('Y') ?> Smart Medicine Box</span>
            <span>Take care of yourself, every day. ♡</span>
        </footer>

    </main>

</div>

<script src="assets/js/dashboard.js"></script>

</body>
</html>
