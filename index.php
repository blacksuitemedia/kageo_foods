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

 <?php include 'config/db.php'; ?>
 <?php include 'components/header.php'; ?>

    <main>
    <section class="hero-premium">
        <div class="hero-inner">
            <div class="hero-copy">
                <span class="badge-new">NEW ARRIVAL</span>
                <h1>PURELY NATURAL <br> <span class="text-purple">TRULY KENYAN</span></h1>
                <p>Experience the rich, additive-free taste of Kravee Peanut Butter. Crafted from 100% Kenyan peanuts.</p>
                <div class="hero-actions">
                    <a href="products.php" class="btn-primary">SHOP THE RANGE</a>
                    <a href="about.php" class="btn-outline">OUR STORY</a>
                </div>
            </div>            
            <div class="hero-visual">                
                                        <div class="hero-jar-background"></div>
            </div>
        </div>
    </section>

    <section class="trust-bar">
        <div class="stat-item">
            <i class="fas fa-leaf"></i>
            <div><strong>100%</strong> <span>Natural</span></div>
        </div>
        <div class="stat-item">
            <i class="fas fa-certificate"></i>
            <div><strong>10+</strong> <span>Years</span></div>
        </div>
        <div class="stat-item">
            <i class="fas fa-truck"></i>
            <div><strong>1.5k</strong> <span>Deliveries</span></div>
        </div>
    </section>

    <section class="featured-catalog">
        <div class="section-title">
            <h2>KRAVEE FAVORITES</h2>
            <p>A Taste of Nature in Every Jar</p>
        </div>
        <div class="product-grid">
            </div>
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