<link rel="stylesheet" href="css/login.css">
<?php
session_start();
include 'config/db.php ?>';

// If already logged in, skip the login page
if (isset($_SESSION['admin_user'])) {
    header("Location: admin.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_user'] = $row['username'];
            header("Location: admin.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Kageo Foods</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body class="login-page">

    <div class="login-card">
        <img src="../images/logo-green.png" alt="Kageo Logo">
        <h2>Admin Portal</h2>

        <?php if(isset($error)): ?>
            <div class="error-msg" style="color: red; margin-bottom: 10px;"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required autofocus>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" class="btn-login">SIGN IN</button>
        </form>
    </div>

</body>
</html>