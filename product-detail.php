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
    <link rel="stylesheet" href="css/detailS.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<main class="product-detail-container">
    <div class="product-main-image">
        <img src="uploads/<?php echo $product['image_path']; ?>" alt="<?php echo $product['name']; ?>">
    </div>

    <div class="product-info-box">
        <span class="product-tagline">ORIGINAL TASTE - A TASTE OF NATURE</span>
        <h1><?php echo $product['name']; ?></h1>
        <p class="product-weight"><strong>Weight:</strong> <?php echo $product['weight']; ?></p>
        
        <div class="product-description">
            <p><?php echo $product['description']; ?></p>
        </div>

        <div class="nutrition-facts">
            <h2>Nutrition Facts</h2>
            <p>Serving Size: 18g (1.5 tbsp)</p>
            <div class="nutrition-row bold">
                <span>Calories</span>
                <span>110</span>
            </div>
            <div class="nutrition-row">
                <span>Total Fat</span>
                <span>9g</span>
            </div>
            <div class="nutrition-row">
                <span>Saturated Fat</span>
                <span>1.5g</span>
            </div>
            <div class="nutrition-row">
                <span>Protein</span>
                <span>4g</span>
            </div>
            <div class="nutrition-row" style="border-bottom:none;">
                <span>Total Carbohydrate</span>
                <span>3g</span>
            </div>
        </div>

        <div style="margin-top: 40px;">
            <a href="https://wa.me/YOURNUMBER" class="btn-brand" style="text-decoration:none; padding: 15px 30px; display:inline-block;">
                ORDER VIA WHATSAPP <i class="fab fa-whatsapp"></i>
            </a>
        </div>
    </div>
</main>

<?php include 'components/footer.php'; ?>

<script src="main.js"></script>
</body>
</html>