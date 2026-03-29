<?php
session_start();
include '../../config/db.php';

if (isset($_POST['category_name'])) {
    $name = mysqli_real_escape_string($conn, $_POST['category_name']);

    // Default status is 1 (Active)
    $query = "INSERT INTO categories (category_name, status) VALUES ('$name', 1)";

    if (mysqli_query($conn, $query)) {
        header("Location: ../admin.php?success=1");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
