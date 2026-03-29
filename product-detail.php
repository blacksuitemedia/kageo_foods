<?php
include 'config/db.php';
// Only include this ONCE here

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

// 1. Get the ID from the URL and keep it safe
if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // (int) ensures it's a number for security

    // 2. Fetch the specific product
    $query = "SELECT * FROM products WHERE id = $id AND status = 1 LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        // Product not found or deactivated
        header("Location: products.php");
        exit();
    }
} else {
    header("Location: products.php");
    exit();
}
?>

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
    <div id="header-placeholder"></div>
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
                            <p class="price-row active-price"> <?php echo $product['weight']; ?></p>
                            <h3>Product Description</h3>
                            <p><?php echo $product['description']; ?></p>
                            <p class="price-row active-price">Ksh <?php echo number_format($product['price']); ?>/-</p>

                            <div class="order-box">
                                <h4>Order via WhatsApp</h4>
                                <div class="quantity-controls" style="margin-bottom: 20px; display: flex; align-items: center; gap: 15px;">
                                    <label style="font-weight: bold;">Quantity:</label>
                                    <input type="number" id="order-qty" value="1" min="1" max="50"
                                        style="width: 70px; padding: 8px; border: 1px solid #ddd; border-radius: 5px; font-size: 1.1rem;">
                                </div>

                                <a href="#" id="whatsapp-order-btn" class="btn-whatsapp-order" target="_blank">
                                    <i class="fab fa-whatsapp"></i> ORDER NOW
                                </a>

                            </div>
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
    <script>
        function updateWhatsAppLink() {
            // 1. Get the current quantity
            const qty = document.getElementById('order-qty').value;
            const phoneNumber = "254727334853"; // Replace with your number

            // 2. Product Details (pulled from PHP)
            const pName = "<?php echo $product['name']; ?>";
            const pWeight = "<?php echo $product['weight']; ?>";
            const pPrice = <?php echo (int)$product['price']; ?>;
            const total = pPrice * qty;

            // 3. Construct the message with Price AND Total
            let message = "Hello Kageo Foods! I'd like to order:\n\n";
            message += "*Item:* " + pName + " (" + pWeight + ")\n";
            message += "*Unit Price:* Ksh " + pPrice.toLocaleString() + "\n"; // <-- New Line
            message += "*Quantity:* " + qty + "\n";
            message += "--------------------------\n";
            message += "*TOTAL PRICE:* Ksh " + total.toLocaleString() + "\n\n";
            message += "Please let me know the delivery details.";

            // 4. Update the button link
            const encodedMessage = encodeURIComponent(message);
            document.getElementById('whatsapp-order-btn').href = "https://wa.me/" + phoneNumber + "?text=" + encodedMessage;
        }

        // Initialize on load and listen for changes
        updateWhatsAppLink();
        document.getElementById('order-qty').addEventListener('input', updateWhatsAppLink);
    </script>
    <script src="main.js"></script>
</body>

</html>