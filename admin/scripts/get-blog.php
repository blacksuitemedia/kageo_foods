<?php
// Disable error reporting for the final JSON output, 
// but keep this here for debugging if you still get a 500 error.
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../config/db.php'; // double check this path!

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Check if $conn exists (from db.php)
    if (!$conn) {
        echo json_encode(['error' => 'Database connection failed']);
        exit;
    }

    $query = "SELECT * FROM blogs WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $blog = mysqli_fetch_assoc($result);
        if ($blog) {
            echo json_encode($blog);
        } else {
            echo json_encode(['error' => 'Blog not found']);
        }
    } else {
        echo json_encode(['error' => mysqli_error($conn)]);
    }
} else {
    echo json_encode(['error' => 'No ID provided']);
}
exit;