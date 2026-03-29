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
    <div id="header-placeholder"></div>
    <main class="products-container">
        <h1 class="page-title">Our Products</h1>
        <hr class="title-underline">

        <div class="shop-layout">
            <aside class="sidebar">
                <h3>Categories</h3>
                <ul class="category-list">
                    <li><a href="products.php" class="<?php echo !isset($_GET['cat']) ? 'active' : ''; ?>">All Products</a></li>
                    <?php
                    $cat_query = mysqli_query($conn, "SELECT * FROM categories");
                    while ($cat = mysqli_fetch_assoc($cat_query)):
                        $active_class = (isset($_GET['cat']) && $_GET['cat'] == $cat['id']) ? 'active' : '';
                    ?>
                        <li>
                            <a href="products.php?cat=<?php echo $cat['id']; ?>" class="<?php echo $active_class; ?>">
                                <?php echo $cat['category_name']; ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </aside>

            <div class="product-grid main-catalog">
                <?php
                // Filter Logic
                $cat_id = isset($_GET['cat']) ? (int)$_GET['cat'] : 0;

                if ($cat_id > 0) {
                    $sql = "SELECT * FROM products WHERE status = 1 AND category_id = $cat_id ORDER BY id DESC";
                } else {
                    $sql = "SELECT * FROM products WHERE status = 1 ORDER BY id DESC";
                }

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="product-item">
                            <h3 class="p-type"><?php echo strtoupper($row['name']); ?></h3>
                            <p class="p-weight"><?php echo $row['weight']; ?></p>
                            <div class="p-image">
                                <img src="uploads/<?php echo $row['image_path']; ?>" alt="<?php echo $row['name']; ?>">
                            </div>
                            <div class="p-meta">
                                <span class="p-price">Ksh <?php echo number_format($row['price']); ?></span>
                            </div>
                            <a href="product-detail.php?id=<?php echo $row['id']; ?>" class="btn-order-now">ORDER NOW</a>
                        </div>
                <?php
                    }
                } else {
                    echo "<p class='no-products'>No products found in this category.</p>";
                }
                ?>
            </div>
        </div>
    </main>
    <?php include 'components/footer.php'; ?>

    <script src="main.js"></script>
</body>

</html>