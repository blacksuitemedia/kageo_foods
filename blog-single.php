<?php
include 'config/db.php';

// 1. Get the ID from the URL
if (isset($_GET['id'])) {
    $blog_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // 2. Fetch the specific blog post
    $query = "SELECT * FROM blogs WHERE id = '$blog_id'";
    $result = mysqli_query($conn, $query);
    
    // 3. Check if post exists
    if (mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);
    } else {
        // Redirect if ID is invalid
        header("Location: blogs.php");
        exit();
    }
} else {
    header("Location: blog.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $post['title']; ?> | Kageo Foods</title>
    <link rel="stylesheet" href="css/blog-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>

<?php include 'components/header.php'; ?>

<article class="single-post-container">
    <div class="post-header">
        <a href="blogs.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Blog</a>
        <span class="post-category">Healthy Living</span>
        <h1><?php echo $post['title']; ?></h1>
        <div class="post-meta">
            <span><i class="far fa-calendar-alt"></i> <?php echo date('F d, Y', strtotime($post['created_at'])); ?></span>
            <span><i class="far fa-user"></i> Admin</span>
        </div>
    </div>

    <div class="featured-image-full">
        <img src="uploads/<?php echo $post['image_path']; ?>" alt="<?php echo $post['title']; ?>">
    </div>

    <div class="post-content">
        <?php echo nl2br($post['content']); ?>
    </div>

    <div class="post-footer">
        <h3>Share this story:</h3>
        <div class="share-buttons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-whatsapp"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
</article>

<?php include 'components/footer.php'; ?>

<script src="main.js"></script>
</body>
</html>