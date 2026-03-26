<?php
include 'config/db.php';
include 'components/header.php'; // Only include this ONCE here

// 1. Security: Ensure ID is an integer
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 2. Fetch specific product
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

// 3. Error Handling: Redirect if product not found
if (!$product) {
    header("Location: products.php");
    exit();
}
// Get the category from the URL (e.g., product.php?cat=Peanut Butter)
$category = isset($_GET['cat']) ? mysqli_real_escape_string($conn, $_GET['cat']) : '';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?> | Kageo</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="css/product-detail.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<main class="product-detail-page">
    <div class="product-detail-layout">
        
        <div class="product-visual-area">            
            <div class="main-product-img-wrapper">
                <img src="uploads/<?php echo $product['image_path']; ?>" class="product-main-img" alt="">
                
            </div>
        </div>

        <div class="product-info-content">
                        <h1 class="product-main-title"><?php echo strtoupper($product['name']); ?></h1>
            <div class="price-list-display">
                               

            <div class="description-and-nutrition">
                
                <div class="text-desc">
                    <p class="price-row active-price"> <?php echo $product['weight']; ?>gm</p>
                    <h3>Product Description</h3>
                    <p><?php echo $product['description']; ?></p>
                    <p class="price-row active-price">Ksh <?php echo number_format($product['price']); ?>/-</p>
                    <a href="tel:0703347925" class="btn-order-call">ORDER NOW</a>
                </div>

                <div class="nutrition-fact-card">
                    <div class="nutrition-header">NUTRITON FACT</div>
                    <div class="nutrition-body">
                        <p class="serving">Serving 1.0 1Table spoon</p>
                        <div class="n-row"><span>Calories:</span> <span>190</span></div>
                        <div class="n-row"><span>Total Fat</span> <span>16g</span></div>
                        <div class="n-row"><span>Saturated</span> <span>3g</span></div>
                        <div class="n-row"><span>Protein</span> <span>4g</span></div>
                        <div class="n-row"><span>Vitamin C</span> <span>0%</span></div>
                        
                        <div class="ingredients-box">
                            <h4>INGREDIENTS:</h4>
                            <p>Roasted Peanut, Peanut oil, Salt</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</main>

<?php include 'components/footer.php'; ?>

<script src="main.js"></script>
</body>
</html>