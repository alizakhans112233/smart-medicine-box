
<?php
$pageTitle = "Health Blog | Smart Medicine Box";

?>
<link rel="stylesheet" href="assets/css/index.css">

<link rel="stylesheet" href="assets/css/blog.css">

<section class="blog-hero">
    <div class="blog-hero-content">
        <span class="blog-tag">SMART HEALTH • BETTER LIVING</span>
        <h1>Health Tips for a <span>Better Tomorrow</span></h1>
        <p>
            Explore helpful articles about medication management,
            healthy habits, and smarter healthcare.
        </p>
        <a href="#blog-posts" class="blog-btn">Explore Articles</a>
    </div>
</section>

<section class="blog-section" id="blog-posts">
    <div class="blog-heading">
        <span class="section-label">OUR LATEST ARTICLES</span>
        <h2>Learn. Improve. Stay Healthy.</h2>
        <p>Simple information to help you manage your health every day.</p>
    </div>

    <div class="blog-controls">
        <div class="blog-search">
            <span>⌕</span>
            <input type="text" id="blogSearch"
                   placeholder="Search health articles...">
        </div>

        <div class="blog-filters">
            <button class="filter-btn active" data-category="all">All Articles</button>
            <button class="filter-btn" data-category="medicine">Medicine</button>
            <button class="filter-btn" data-category="wellness">Wellness</button>
            <button class="filter-btn" data-category="technology">Technology</button>
        </div>
    </div>

    <div class="blog-grid" id="blogGrid">

        <article class="blog-card" data-category="medicine">
            <div class="blog-image medicine-image">
                <span class="image-icon">💊</span>
                <span class="article-label">MEDICINE</span>
            </div>
            <div class="blog-card-content">
                <div class="article-meta">5 min read · Health Tips</div>
                <h3>Why Taking Medicine on Time Matters</h3>
                <p>
                    Learn why following your prescribed medication schedule
                    can help you manage your treatment more effectively.
                </p>
                <a href="contact.php" class="read-more">Learn More <span>→</span></a>
            </div>
        </article>

        <article class="blog-card" data-category="wellness">
            <div class="blog-image wellness-image">
                <span class="image-icon">🌿</span>
                <span class="article-label">WELLNESS</span>
            </div>
            <div class="blog-card-content">
                <div class="article-meta">4 min read · Healthy Living</div>
                <h3>Simple Habits for a Healthier Life</h3>
                <p>
                    Discover everyday habits such as staying hydrated,
                    sleeping well, and maintaining a balanced routine.
                </p>
                <a href="contact.php" class="read-more">Learn More <span>→</span></a>
            </div>
        </article>

        <article class="blog-card" data-category="technology">
            <div class="blog-image technology-image">
                <span class="image-icon">⏰</span>
                <span class="article-label">TECHNOLOGY</span>
            </div>
            <div class="blog-card-content">
                <div class="article-meta">6 min read · Smart Healthcare</div>
                <h3>How Smart Medicine Boxes Can Help</h3>
                <p>
                    Explore how reminders and organized medicine storage
                    can support a more consistent medication routine.
                </p>
                <a href="contact.php" class="read-more">Learn More <span>→</span></a>
            </div>
        </article>

        <article class="blog-card" data-category="medicine">
            <div class="blog-image safety-image">
                <span class="image-icon">🩺</span>
                <span class="article-label">MEDICINE</span>
            </div>
            <div class="blog-card-content">
                <div class="article-meta">4 min read · Safety</div>
                <h3>How to Store Medicines Safely</h3>
                <p>
                    Understand the importance of checking medicine labels,
                    expiry dates, and storage instructions.
                </p>
                <a href="contact.php" class="read-more">Learn More <span>→</span></a>
            </div>
        </article>

        <article class="blog-card" data-category="wellness">
            <div class="blog-image routine-image">
                <span class="image-icon">📅</span>
                <span class="article-label">WELLNESS</span>
            </div>
            <div class="blog-card-content">
                <div class="article-meta">3 min read · Daily Routine</div>
                <h3>Build a Better Daily Health Routine</h3>
                <p>
                    Small planning steps can make it easier to organize
                    appointments, prescriptions, and daily activities.
                </p>
                <a href="contact.php" class="read-more">Learn More <span>→</span></a>
            </div>
        </article>

        <article class="blog-card" data-category="technology">
            <div class="blog-image digital-image">
                <span class="image-icon">📱</span>
                <span class="article-label">TECHNOLOGY</span>
            </div>
            <div class="blog-card-content">
                <div class="article-meta">5 min read · Digital Health</div>
                <h3>The Role of Technology in Healthcare</h3>
                <p>
                    Learn how digital tools can help people organize
                    health information and communicate with caregivers.
                </p>
                <a href="contact.php" class="read-more">Learn More <span>→</span></a>
            </div>
        </article>

    </div>

    <div class="no-articles" id="noArticles" hidden>
        <span>🔎</span>
        <h3>No articles found</h3>
        <p>Try another keyword or choose a different category.</p>
        <button type="button" id="resetBlog">Show All Articles</button>
    </div>

    <div class="blog-note">
        <strong>Health information notice:</strong>
        These articles provide general educational information and are not
        a substitute for advice from a qualified healthcare professional.
        Always follow your prescription and consult your pharmacist or doctor
        about medication questions.
    </div>
</section>

<section class="blog-cta">
    <div>
        <span>HAVE A QUESTION?</span>
        <h2>We're Here to Help</h2>
        <p>Contact our team to learn more about Smart Medicine Box.</p>
    </div>
    <a href="contact.php" class="blog-btn">Contact Us →</a>
</section>
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
<script src="assets/js/blog.js"></script>


