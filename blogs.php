<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest Blogs | Kageo</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="css/blog-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<?php include 'components/header.php'; 
// 1. Connect to the database
include 'config/db.php'; 

// 2. Fetch all blogs (newest first)
$query = "SELECT * FROM blogs ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>
    <div class="blog-container">
    <h1 class="main-heading">Kageo News Blog</h1>

    <section class="featured-top">
        <h2 class="label-red">Featured Updates</h2>
        <div class="mini-grid">
            <?php
            // Fetch 4 featured posts
            $featuredQuery = mysqli_query($conn, "SELECT * FROM blogs ORDER BY created_at DESC LIMIT 4");
            while($fRow = mysqli_fetch_assoc($featuredQuery)):
            ?>
            <a href="blog-single.php?id=<?php echo $fRow['id']; ?>" class="blog-card-mini">
                <img src="uploads/<?php echo $fRow['image_path']; ?>" alt="">
                <div class="card-overlay">
                    <span><?php echo date('M d', strtotime($fRow['created_at'])); ?></span>
                    <h4><?php echo $fRow['title']; ?></h4>
                </div>
            </a>
            <?php endwhile; ?>
        </div>
    </section>

    <hr style="margin: 50px 0; border: 0; border-top: 1px solid #eee;">

    <div class="blog-layout">
        <main class="blog-main">
            <h2 class="section-title">All Articles</h2>
            <div class="blog-grid">
                <?php
                // Fetch all blogs
                $mainQuery = mysqli_query($conn, "SELECT * FROM blogs ORDER BY created_at DESC");
                while($post = mysqli_fetch_assoc($mainQuery)):
                ?>
                <div class="blog-card">
                    <div class="blog-image">
                        <img src="uploads/<?php echo $post['image_path']; ?>" alt="">
                    </div>
                    <div class="blog-info" style="padding: 20px;">
                        <span class="label-red">Recipe</span>
                        <h3><?php echo $post['title']; ?></h3>
                        <p><?php echo substr($post['content'], 0, 100); ?>...</p>
                        <a href="blog-single.php?id=<?php echo $post['id']; ?>" class="read-more-btn">Read Full Story</a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </main>

        <aside class="blog-sidebar">
            <div class="sidebar-box">
                <h3>About Kageo Blog</h3>
                <p style="font-size: 0.9rem; color: #666; padding: 10px 0;">
                    Sharing the best tips on natural foods, smooth peanut butter recipes, and healthy living.
                </p>
                
                <h3 style="margin-top: 20px;">Quick Links</h3>
                <ul class="featured-list">
                    <li><a href="shop.php">View Our Products</a></li>
                    <li><a href="index.php#contact">Contact Support</a></li>
                </ul>
            </div>
        </aside>
    </div>
</div>
<?php include 'components/footer.php'; ?>
    
<script src="main.js"></script>
    </body>
</html>