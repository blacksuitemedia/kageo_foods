<?php
include '../../config/db.php';

if (isset($_POST['productId'])) {
    $id = (int)$_POST['productId'];
    $category_id = (int)$_POST['category_id'];
    $name = mysqli_real_escape_string($conn, $_POST['productName']);
    $price = $_POST['productPrice'];
    $weight = mysqli_real_escape_string($conn, $_POST['productWeight']);
    $desc = mysqli_real_escape_string($conn, $_POST['productDesc']);

    // Check if a new file was uploaded
    if ($_FILES['productImage']['name'] != "") {
        // SCENARIO 2: NEW IMAGE UPLOADED
        $file = $_FILES['productImage'];
        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $newFileName = uniqid('', true) . "." . $fileExt;
        $fileDestination = '../../uploads/' . $newFileName;

        if (move_uploaded_file($fileTmpName, $fileDestination)) {
            // Update everything INCLUDING the image path
            $sql = "UPDATE products SET 
                    category_id = '$category_id',
                    name = '$name', 
                    price = '$price', 
                    weight = '$weight', 
                    description = '$desc', 
                    image_path = '$newFileName' 
                    WHERE id = $id";
        }
    } else {
        // SCENARIO 1: NO NEW IMAGE (Keep existing one)
        $sql = "UPDATE products SET 
                category_id = '$category_id',
                name = '$name', 
                price = '$price', 
                weight = '$weight', 
                description = '$desc' 
                WHERE id = $id";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: ../admin.php?update=success");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>