<?php
session_start();
include '../../config/db.php';

if (isset($_POST['name'])) {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $category_id = (int)$_POST['category_id'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // NEW FIELDS
    $nutrition_info = mysqli_real_escape_string($conn, $_POST['nutrition_info']);
    $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

    // Handle Image Upload (Simplified logic)
    $image_query = "";
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../../uploads/";
        $file_name = time() . "_" . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $file_name);
        $image_query = ", image_path = '$file_name'";
    }

    if ($id > 0) {
        // UPDATE EXISTING
        $sql = "UPDATE products SET 
                name='$name', 
                price='$price', 
                weight='$weight', 
                category_id=$category_id, 
                description='$description',
                nutrition_info='$nutrition_info',
                ingredients='$ingredients'
                $image_query 
                WHERE id=$id";
    } else {
        // INSERT NEW
        $file_name = !empty($file_name) ? $file_name : 'default.jpg';
        $sql = "INSERT INTO products (name, price, weight, category_id, description, nutrition_info, ingredients, image_path, status) 
                VALUES ('$name', '$price', '$weight', $category_id, '$description', '$nutrition_info', '$ingredients', '$file_name', 1)";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: ../admin.php?success=1");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
