<?php
// 1. Force PHP to show errors if they happen (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 2. Check if the config file exists before including
$configPath = '../../config/db.php';
if (!file_exists($configPath)) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Database config file not found at path: ' . $configPath]);
    exit;
}

include $configPath;

header('Content-Type: application/json');

// 3. Verify the database connection variable from db.php
if (!isset($conn)) {
    echo json_encode(['error' => 'Database connection variable $conn is not defined in db.php']);
    exit;
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Use mysqli_real_escape_string just to be safe
    $query = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        
        // Clear any accidental whitespace/warnings before outputting JSON
        ob_clean(); 
        echo json_encode($product);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Product not found in database']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'No ID provided in the URL']);
}
exit();