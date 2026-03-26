<?php
include '../../config/db.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM blogs WHERE id = $id");
    $blog = mysqli_fetch_assoc($result);
    echo json_encode($blog); // Send data to JS as a JSON object
}
?>