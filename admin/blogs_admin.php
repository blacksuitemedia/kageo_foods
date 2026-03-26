<?php
session_start();

// 1. Gatekeeper: Ensure user is logged in
if (!isset($_SESSION['admin_user'])) {
    header("Location: login.php");
    exit();
}

// 2. Include Database Connection
include '../config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Management | Kageo Foods</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="admin-container">
    <aside class="admin-sidebar">
        <div class="admin-logo">
            <img src="../images/logo-green.png" alt="Kageo Logo" width="50">
            <span>Admin Portal</span>
        </div>
        <nav class="admin-nav">
            <a href="admin.php"><i class="fas fa-box"></i> Products</a>
            <a href="blogs_admin.php" class="active"><i class="fas fa-blog"></i> Blogs</a>
            <a href="../index.php" target="_blank"><i class="fas fa-eye"></i> View Site</a>
            <a href="logout.php" style="color: #ff4d4d; margin-top: 20px;"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>
    </aside>

    <main class="admin-main">
        <header class="admin-header">
            <h1>Blog Management</h1>
            <button class="btn-add" id="openBlogModal">
                <i class="fas fa-plus"></i> Write New Post
            </button>
        </header>

        <?php if(isset($_GET['blog']) && $_GET['blog'] == 'success'): ?>
            <div class="alert success">✅ Blog post published!</div>
        <?php endif; ?>

        <section class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Date Published</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $blogQuery = mysqli_query($conn, "SELECT * FROM blogs ORDER BY id DESC");
                    
                    if(mysqli_num_rows($blogQuery) > 0) {
                        while($blog = mysqli_fetch_assoc($blogQuery)) {
                            ?>
                            <tr>
                                <td><img src="../uploads/<?php echo $blog['image_path']; ?>" class="admin-thumbnail" width="60"></td>
                                <td><strong><?php echo $blog['title']; ?></strong></td>
                                <td><?php echo date('M d, Y', strtotime($blog['created_at'])); ?></td>
                                <td>
                                    <button class="btn-edit" onclick="editBlog(<?php echo $blog['id']; ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="scripts/delete-blog.php?id=<?php echo $blog['id']; ?>&image=<?php echo $blog['image_path']; ?>" 
                                       class="btn-delete" onclick="return confirm('Delete this blog post permanently?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='4'>No blog posts yet. Start writing!</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</div>

<div class="modal" id="blogModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('blogModal')">&times;</span>
        <h2 id="blogModalTitle">Create New Blog Post</h2>
        <form id="blogForm" action="scripts/add-blog.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="blogId" id="editBlogId">
            
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="blogTitle" id="blogTitleInput" placeholder="Blog Title" required>
            </div>

            <div class="form-group">
                <label>Content</label>
                <textarea name="blogContent" id="blogContentInput" placeholder="Write your content here..." rows="10" required></textarea>
            </div>

            <div class="form-group">
                <label>Featured Image</label>
                <input type="file" name="blogImage" accept="image/*">
            </div>

            <button type="submit" class="btn-save">Save Post</button>
        </form>
    </div>
</div>

<script src="js/admin.js"></script>
</body>
</html>