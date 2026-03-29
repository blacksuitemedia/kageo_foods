<?php
session_start();
if (!isset($_SESSION['admin_user'])) {
    header("Location: ../login.php");
    exit();
}

include '../../config/db.php';

if (isset($_GET['id'])) {
    $cat_id = (int)$_GET['id'];

    // SAFETY CHECK: Count how many products are currently in this category
    $check_products = mysqli_query($conn, "SELECT id FROM products WHERE category_id = $cat_id");
    $product_count = mysqli_num_rows($check_products);

    if ($product_count > 0) {
        // If there are products, redirect with an error message
        header("Location: ../admin.php?error=category_not_empty&count=$product_count");
        exit();
    } else {
        // If empty, proceed with deletion
        $query = "DELETE FROM categories WHERE id = $cat_id";
        if (mysqli_query($conn, $query)) {
            header("Location: ../admin.php?delete=1");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
