<?php
// Enable error reporting to see what's going wrong
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../config/db.php';

// 1. Clear existing admin to start fresh
mysqli_query($conn, "DELETE FROM users WHERE username = 'admin'");

// 2. Set your credentials
$user = 'admin';
$pass = 'admin123'; 

// 3. Hash the password
$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

// 4. Attempt Insert
$sql = "INSERT INTO users (username, password) VALUES ('$user', '$hashed_pass')";

if (mysqli_query($conn, $sql)) {
    echo "<h1>Success!</h1>";
    echo "<p>Admin account created.</p>";
    echo "<ul>
            <li><strong>Username:</strong> admin</li>
            <li><strong>Password:</strong> admin123</li>
          </ul>";
    echo "<a href='login.php'>Go to Login Page</a>";
} else {
    echo "<h1>Database Error</h1>";
    echo "Error: " . mysqli_error($conn);
}
?>