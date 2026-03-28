<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Kageo Foods</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/about-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php include 'components/header.php';?>

<main class="about-container">
    <section class="hero-premium">
        <div class="hero-inner">
            <div class="hero-copy">
                <span class="badge-new">ESTABLISHED 2014</span>
                <h1>OUR STORY: <br> <span class="text-purple">BORN IN KENYA</span></h1>
                <p>From humble beginnings to your breakfast table, discover how Kageo Foods is redefining natural nutrition through KRAVEE.</p>
                <div class="hero-actions">
                    <a href="#intro" class="btn-primary">LEARN MORE</a>
                    <a href="products.php" class="btn-outline">VIEW PRODUCTS</a>
                </div>
            </div>
            
            
        </div>
    </section>

    <section id="intro" class="about-intro">
        <div class="intro-content">
            <div class="text-content">
                <p>Founded on the belief that nature provides everything we need for a healthy life, <strong>Kageo Foods</strong> was born out of a passion for pure, unadulterated nutrition...</p>
            </div>
        </div>
    </section>
    <section class="vmg-grid">
        <div class="vmg-item">
            <i class="fas fa-eye vmg-icon"></i>
            <h2>Our Vision</h2>
            <p>To be East Africa’s leading provider of natural, plant-based nutrition, setting the gold standard for purity and taste in every household.</p>
        </div>
        <div class="vmg-item">
            <i class="fas fa-bullseye vmg-icon"></i>
            <h2>Our Mission</h2>
            <p>To craft wholesome, additive-free food products that empower our community to lead healthier lives while supporting local Kenyan farmers.</p>
        </div>
        <div class="vmg-item">
            <i class="fas fa-check-circle vmg-icon"></i>
            <h2>Our Goal</h2>
            <p>To ensure 100% transparency from farm to jar, maintaining our "No Preservatives" promise across every product line we launch.</p>
        </div>
    </section>

    <section class="commitment-section">
        <div class="commitment-content">
            <div class="commitment-img-wrapper">
                <img src="images/factory-production.png" alt="Production Line" class="commitment-img">
                <div class="img-accent-box"></div>
            </div>
            <div class="commitment-text">
                <h2>OUR COMMITMENT</h2>
                <p class="subtitle-green">Quality Without Compromise</p>
                <p>From our factory in Kenya to your breakfast table, we maintain strict quality controls. We don't just make peanut butter; we preserve the nutritional integrity of the peanut. Our commitment is simple: if it's not found in nature, it's not in our jar.</p>
            </div>
        </div>
    </section>

    <section class="cta-footer-banner">
        <div class="overlay-content">
            <h2>READY TO TASTE NATURE?</h2>
            <p>Explore our full range of natural spreads and honeys.</p>
            <a href="products.php" class="btn-brand">OUR PRODUCTS</a>
        </div>
    </section>
</main>


include 'components/footer.php'; ?>

<script src="main.js"></script>
</body>
</html>