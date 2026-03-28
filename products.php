
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products | Kageo</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>

<?php include 'config/db.php'; ?>
 <?php include 'components/header.php'; ?>
    <main class="products-container">
    <h1 class="page-title">Our Products</h1>
    <hr class="title-underline">

    <div class="product-grid main-catalog">
        <?php
        // Fetch all products from the database
       $sql = "SELECT * FROM products WHERE status = 1 ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
        // Check if there are any products
        if (mysqli_num_rows($result) > 0) {
            // Loop through each row in the database
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="product-item">
    <h3 class="p-type"><?php echo strtoupper($row['name']); ?></h3>
    <p class="p-weight"><?php echo $row['weight']; ?></p>
    
    <div class="p-image">
        <img src="uploads/<?php echo $row['image_path']; ?>" alt="<?php echo $row['name']; ?>">
    </div>
    
    <div class="p-meta">
        <span class="p-price">Ksh <?php echo number_format($row['price']); ?></span>
        <div class="p-stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <i class="far fa-star"></i>
        </div>
    </div>
    
    <a href="product-detail.php?id=<?php echo $row['id']; ?>" class="btn-order-now">
        ORDER NOW
    </a>
</div>
                <?php
            }
        } else {
            echo "<p>No products found.</p>";
        }
        ?>
    </div>
</main>
<?php include 'components/footer.php'; ?>
    
<script src="main.js"></script>
    </body>
</html>