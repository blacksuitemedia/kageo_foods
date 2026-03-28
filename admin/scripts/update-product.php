<?php
include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['productId'])) {
    
    // 1. Sanitize Inputs
    $id = (int)$_POST['productId'];
    $category_id = (int)$_POST['category_id'];
    $name = mysqli_real_escape_string($conn, $_POST['productName']);
    $price = mysqli_real_escape_string($conn, $_POST['productPrice']);
    $weight = mysqli_real_escape_string($conn, $_POST['productWeight']);
    $desc = mysqli_real_escape_string($conn, $_POST['productDesc']);

    // 2. Image Handling Logic
    if (!empty($_FILES['productImage']['name'])) {
        // User uploaded a new image
        $imageName = time() . '_' . $_FILES['productImage']['name'];
        $target = "../../uploads/" . $imageName;
        
        if (move_uploaded_file($_FILES['productImage']['tmp_name'], $target)) {
            // Update query WITH new image
            $sql = "UPDATE products SET 
                    category_id = '$category_id',
                    name = '$name', 
                    price = '$price', 
                    weight = '$weight', 
                    description = '$desc',
                    image_path = '$imageName' 
                    WHERE id = $id";
        }
    } else {
        // Update query WITHOUT changing the image
        $sql = "UPDATE products SET 
                category_id = '$category_id',
                name = '$name', 
                price = '$price', 
                weight = '$weight', 
                description = '$desc' 
                WHERE id = $id";
    }

    // 3. Execute
    if (mysqli_query($conn, $sql)) {
        header("Location: ../admin.php?success=product_updated");
        exit();
    } else {
        echo "Database Error: " . mysqli_error($conn);
    }
} else {
    header("Location: ../admin.php");
    exit();
}
?>