
<?php
$pageTitle = "FAQs | Smart Medicine Box";

?>
<link rel="stylesheet" href="assets/css/index.css">

<link rel="stylesheet" href="assets/css/faq.css">

<main class="faq-page">

    <!-- Hero Section -->
    <section class="faq-hero">
        <div class="faq-hero-content">
            <span class="faq-badge">HELP & SUPPORT</span>
            <h1>Frequently Asked <span>Questions</span></h1>
            <p>
                Find answers about Smart Medicine Box, medicine reminders,
                your account and how to use our platform.
            </p>

            <div class="faq-search">
                <span class="search-icon">⌕</span>
                <input type="search" id="faqSearch"
                       placeholder="Search your question..."
                       aria-label="Search frequently asked questions">
            </div>

            <p class="search-hint" id="searchHint">
                Explore the questions below to find your answer.
            </p>
        </div>

        <div class="faq-hero-art" aria-hidden="true">
            <div class="hero-ring ring-one"></div>
            <div class="hero-ring ring-two"></div>
            <div class="hero-medical-icon">✚</div>
            <span class="hero-star star-one">✦</span>
            <span class="hero-star star-two">＋</span>
        </div>
    </section>

    <!-- FAQ Categories -->
    <section class="faq-container">

        <div class="faq-intro">
            <span class="section-label">GOT QUESTIONS?</span>
            <h2>How can we help you?</h2>
            <p>Choose a category or search for a specific question.</p>
        </div>

        <div class="faq-categories">
            <button class="faq-category active" data-category="all" type="button">
                <span>✦</span> All Questions
            </button>

            <button class="faq-category" data-category="general" type="button">
                <span>ⓘ</span> General
            </button>

            <button class="faq-category" data-category="account" type="button">
                <span>♙</span> Account
            </button>

            <button class="faq-category" data-category="reminders" type="button">
                <span>◷</span> Reminders
            </button>

            <button class="faq-category" data-category="privacy" type="button">
                <span>♡</span> Privacy & Safety
            </button>
        </div>

        <div class="faq-content">

            <!-- General -->
            <section class="faq-group" data-group="general">
                <div class="faq-group-heading">
                    <span class="group-icon purple">✦</span>
                    <div>
                        <h3>General Questions</h3>
                        <p>Learn about Smart Medicine Box</p>
                    </div>
                </div>

                <div class="faq-item" data-category="general">
                    <button class="faq-question" type="button" aria-expanded="false">
                        <span>What is Smart Medicine Box?</span>
                        <span class="faq-toggle">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>
                            Smart Medicine Box is a web-based platform designed
                            to help users organize their medicine schedules
                            and keep track of saved reminders.
                        </p>
                    </div>
                </div>

                <div class="faq-item" data-category="general">
                    <button class="faq-question" type="button" aria-expanded="false">
                        <span>How does Smart Medicine Box work?</span>
                        <span class="faq-toggle">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>
                            Create an account, log in to your dashboard, and
                            add a medicine name, dosage, reminder time and
                            optional instructions. Your saved entries appear
                            in your medicine schedule.
                        </p>
                    </div>
                </div>

                <div class="faq-item" data-category="general">
                    <button class="faq-question" type="button" aria-expanded="false">
                        <span>Who can use this website?</span>
                        <span class="faq-toggle">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>
                            Anyone who wants to organize a medicine schedule
                            can use the platform. Follow your healthcare
                            professional's advice for medication decisions.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Account -->
            <section class="faq-group" data-group="account">
                <div class="faq-group-heading">
                    <span class="group-icon blue">♙</span>
                    <div>
                        <h3>Account & Dashboard</h3>
                        <p>Manage your profile and account</p>
                    </div>
                </div>

                <div class="faq-item" data-category="account">
                    <button class="faq-question" type="button" aria-expanded="false">
                        <span>How do I create an account?</span>
                        <span class="faq-toggle">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>
                            Open the Create Account or Register page, enter
                            the requested details, and submit the form.
                            After registration, log in to access your dashboard.
                        </p>
                    </div>
                </div>

                <div class="faq-item" data-category="account">
                    <button class="faq-question" type="button" aria-expanded="false">
                        <span>Where can I see my saved medicines?</span>
                        <span class="faq-toggle">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>
                            Log in and open your User Dashboard. Your saved
                            medicine reminders are displayed in the My
                            Medicine Schedule section.
                        </p>
                    </div>
                </div>

                <div class="faq-item" data-category="account">
                    <button class="faq-question" type="button" aria-expanded="false">
                        <span>Can I delete a medicine reminder?</span>
                        <span class="faq-toggle">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>
                            Yes. In your dashboard, use the delete button
                            beside the relevant reminder and confirm the
                            deletion.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Reminders -->
            <section class="faq-group" data-group="reminders">
                <div class="faq-group-heading">
                    <span class="group-icon green">◷</span>
                    <div>
                        <h3>Medicine Reminders</h3>
                        <p>Organize your medicine routine</p>
                    </div>
                </div>

                <div class="faq-item" data-category="reminders">
                    <button class="faq-question" type="button" aria-expanded="false">
                        <span>How do I add a medicine reminder?</span>
                        <span class="faq-toggle">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>
                            Open your dashboard and complete the Add Medicine
                            form. Enter the medicine name, dosage and reminder
                            time, then select Save Medicine Reminder.
                        </p>
                    </div>
                </div>

                <div class="faq-item" data-category="reminders">
                    <button class="faq-question" type="button" aria-expanded="false">
                        <span>Does the website send phone notifications?</span>
                        <span class="faq-toggle">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>
                            The current dashboard stores and displays reminder
                            times. Automatic phone notifications and alarms
                            require additional functionality and are not
                            provided by the basic dashboard code.
                        </p>
                    </div>
                </div>

                <div class="faq-item" data-category="reminders">
                    <button class="faq-question" type="button" aria-expanded="false">
                        <span>Can I change my medicine dosage myself?</span>
                        <span class="faq-toggle">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>
                            Your saved dosage is for organizing your records.
                            Never change a prescribed dosage without consulting
                            your doctor or pharmacist.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Privacy -->
            <section class="faq-group" data-group="privacy">
                <div class="faq-group-heading">
                    <span class="group-icon pink">♡</span>
                    <div>
                        <h3>Privacy & Safety</h3>
                        <p>Important information about your use of the platform</p>
                    </div>
                </div>

                <div class="faq-item" data-category="privacy">
                    <button class="faq-question" type="button" aria-expanded="false">
                        <span>Is Smart Medicine Box a replacement for a doctor?</span>
                        <span class="faq-toggle">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>
                            No. The platform is intended to help organize
                            medicine information. It does not diagnose
                            conditions or replace professional medical advice.
                        </p>
                    </div>
                </div>

                <div class="faq-item" data-category="privacy">
                    <button class="faq-question" type="button" aria-expanded="false">
                        <span>How should I protect my account?</span>
                        <span class="faq-toggle">+</span>
                    </button>
                    <div class="faq-answer">
                        <p>
                            Use a strong, unique password, do not share your
                            login details, and log out after using your account
                            on a shared computer.
                        </p>
                    </div>
                </div>
            </section>

            <div class="no-results" id="noResults" hidden>
                <div class="no-results-icon">⌕</div>
                <h3>No matching questions found</h3>
                <p>Try another keyword or choose a different category.</p>
                <button type="button" id="resetFaq">Show all questions</button>
            </div>

        </div>
    </section>

    <!-- Support CTA -->
    <section class="faq-support">
        <div class="support-icon">✉</div>
        <div class="support-copy">
            <h2>Still have questions?</h2>
            <p>Visit our contact page for further assistance.</p>
        </div>
        <a href="contact.php" class="support-button">Contact Us <span>→</span></a>
    </section>

</main>

<footer class="footer">
    <div class="footer-main">
        <div class="footer-about">
            <a href="index.php" class="footer-brand">✚ Smart Medicine Box</a>
            <p>Your Health, Our Priority.</p>
            <p>A simple approach to medicine organization and everyday care.</p>
        </div>

        <div class="footer-column">
            <h3>Quick Links</h3>
            <a href="index.php">Home</a>
            <a href="features.php">Features</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact</a>
        </div>

        <div class="footer-column">
            <h3>Explore</h3>
            <a href="how-it-works.php">How It Works</a>
            <a href="product.php">Our Product</a>
            <a href="faq.php">FAQs</a>
            <a href="blog.php">Blog</a>
        </div>

        <div class="footer-column">
            <h3>Your Account</h3>
            <a href="login.php">Login</a>
            <a href="register.php">Create Account</a>
            <a href="user_dashboard.php">Dashboard</a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?= date('Y') ?> Smart Medicine Box. All rights reserved.</p>
        <p>Designed with care ♡</p>
    </div>
</footer>

<script src="assets/js/faq.js"></script>


