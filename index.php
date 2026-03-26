<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kageo Foods | All Natural Taste</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

 <?php include 'components/header.php';
 // 1. Include the database connection first!
include 'config/db.php'; ?>

    <main>
        <section class="hero-slider">
            <div class="hero-content">
                
                <div class="hero-center">
                    <button class="btn-brand">OUR BRAND</button>
                    <p>learn more...</p>
                </div>
                <div class="hero-product-display">
                    <img src="images/jars-row.jpg" alt="Kravee Peanut Butter Lineup">
                </div>
                <div class="slider-dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>
        </section>

        <section class="home-about">
    <div class="about-grid">
        <div class="about-text">
            <span>Our Story</span>
            <h2>Purely Natural, Truly Kenyan</h2>
            <p>At Kageo Foods, we believe in the power of nature. Our peanut butter is crafted without additives, ensuring you get the full nutritional benefit of every nut.</p>
            <a href="about.php" class="btn-brand">Learn More</a>
        </div>

        <div class="about-image-container">
            <img src="images/factory-production.png" alt="Natural Peanut Butter Process">
        </div>
    </div>
</section>

        <section class="home-stats">
            <div class="stat-box">
                <span class="stat-number">10+</span>
                <span class="stat-label">Years Experience</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">1.5k</span>
                <span class="stat-label">Customers</span>
            </div>
            <div class="stat-box">
                <span class="stat-number">1.5k</span>
                <span class="stat-label">Deliveries</span>
            </div>
        </section>

        <section class="natural-footer-banner">
        <img src="images/peanut-left.png" class="floating-peanut-left" alt="">
        <div class="banner-text">
            <h2>ALL NATURAL TASTE</h2>
            <p>No Additives | No Preservatives</p>
        </div>
        <img src="images/peanut-right.png" class="floating-peanut-right" alt="">
    </section>

       <section class="home-product-grid">
    <?php
    $product_query = "SELECT * FROM products ORDER BY id DESC LIMIT 8";
    $product_result = mysqli_query($conn, $product_query);

    if ($product_result && mysqli_num_rows($product_result) > 0) {
        while ($product = mysqli_fetch_assoc($product_result)) {
            ?>
            <div class="product-card">
                <div class="card-badge">ORIGINAL TASTE</div>
                <div class="card-image">
                    <img src="uploads/<?php echo $product['image_path']; ?>" alt="<?php echo $product['name']; ?>">
                </div>
                <div class="card-info">
                    <h3 class="product-title"><?php echo $product['name']; ?></h3>
                    <p class="product-weight"><?php echo $product['weight']; ?> | A Taste of Nature</p>
                    <a href="products.php" class="btn-find-card">FIND PRODUCT</a>
                </div>
            </div>
            <?php
        }
    }
    ?>
</section>
    </main>

    <?php include 'components/footer.php'; ?>

    <script src="main.js"></script>
</body>
</html>