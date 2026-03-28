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
 <div id="header-placeholder"></div>

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
    
            <div class="product-card">
                <?php
                    $product_result = mysqli_query($conn, "SELECT * FROM products WHERE status = 1 ORDER BY id DESC");
                    while($row = mysqli_fetch_assoc($product_result)): ?>
                    
                    <div class="product-card">
                        <span class="card-badge">NATURAL</span>

                        <div class="card-image"> <img src="uploads/<?php echo $row['image_path']; ?>" alt="<?php echo $row['name']; ?>">
                        </div>

                        <h3 class="product-title"><?php echo $row['name']; ?></h3> 
                        <p class="product-weight"><?php echo $row['weight']; ?></p> 
                        <p class="text-content">
                            <strong>Ksh <?php echo number_format($row['price']); ?></strong> </p>

                        <a href="product-detail.php?id=<?php echo $row['id']; ?>" class="btn-find-card">
                            VIEW DETAILS
                        </a> 
                    </div>
                   
                <?php endwhile; ?>
            </div>
        </section>
    </main>

   <div id="footer-placeholder"></div>

    <script src="main.js"></script>
</body>
</html>