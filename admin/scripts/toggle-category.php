<?php
include '../../config/db.php';
$id = $_GET['id'];
$new_status = ($_GET['status'] == 1) ? 0 : 1;

$query = "UPDATE categories SET status = $new_status WHERE id = $id";
if (mysqli_query($conn, $query)) {
    header("Location: ../admin.php?update=1");
}
