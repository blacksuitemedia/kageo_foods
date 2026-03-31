<?php
session_start();
// 1. Gatekeeper: Ensure user is logged in
if (!isset($_SESSION['admin_user'])) {
    header("Location: login.php");
    exit();
}
include '../config/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kageo Foods | Admin Panel</title>
    <link rel="icon" type="image/x-icon" href="/admin/favicon.ico">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <div class="admin-container">
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <img src="../images/logo.webp" alt="Kageo Logo" width="50">
                <span>Admin Portal</span>
            </div>
            <nav class="admin-nav">
                <a href="#" id="show-products" class="active"><i class="fas fa-box"></i> Products</a>
                <a href="#" id="show-blogs"><i class="fas fa-blog"></i> Blogs</a>
                <a href="#" id="show-categories"><i class="fas fa-tags"></i> Categories</a>
                <a href="../index.php" target="_blank"><i class="fas fa-eye"></i> View Site</a>
                <a href="logout.php" style="color: #ff4d4d;"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>

        <main class="admin-main">
            <section class="admin-stats" style="display: flex; gap: 20px; margin-bottom: 30px;">
                <div style="background: white; padding: 20px; border-radius: 10px; flex: 1; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-left: 5px solid #006837;">
                    <h3 style="margin: 0; color: #777; font-size: 0.9rem;">Total Products</h3>
                    <p style="margin: 5px 0 0; font-size: 1.8rem; font-weight: bold;">
                        <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT id FROM products")); ?>
                    </p>
                </div>
                <div style="background: white; padding: 20px; border-radius: 10px; flex: 1; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-left: 5px solid #ffc107;">
                    <h3 style="margin: 0; color: #777; font-size: 0.9rem;">Total Blogs</h3>
                    <p style="margin: 5px 0 0; font-size: 1.8rem; font-weight: bold;">
                        <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT id FROM blogs")); ?>
                    </p>
                </div>
            </section>
            <?php if (isset($_GET['success']) || isset($_GET['update']) || isset($_GET['delete'])): ?>
                <div style="background: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #c3e6cb;">
                    Action completed successfully!
                </div>
            <?php endif; ?>
            <section id="products-section">
                <header class="admin-header">
                    <h1>Product Management</h1>
                    <button class="btn-add" id="openModal">
                        <i class="fas fa-plus"></i> Add New Product
                    </button>
                </header>

                <section class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Weight</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
                            while ($row = mysqli_fetch_assoc($res)):
                                // Determine styling for deactivated products
                                $isDeactivated = ($row['status'] == 0);
                                $rowStyle = $isDeactivated ? 'opacity: 0.6; background: #f9f9f9;' : '';
                            ?>
                                <tr style="<?php echo $rowStyle; ?>">
                                    <td>
                                        <img src="../uploads/<?php echo $row['image_path']; ?>" width="50" class="admin-thumbnail">
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>
                                        <?php if ($isDeactivated): ?>
                                            <br><span style="color: #dc3545; font-size: 0.75rem; font-weight: bold;">(HIDDEN)</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>Ksh <?php echo number_format($row['price']); ?></td>
                                    <td><?php echo $row['weight']; ?></td>
                                    <td>
                                        <button class="btn-edit" onclick='editProduct(<?php echo json_encode($row); ?>)'>
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-duplicate" title="Duplicate" onclick='duplicateProduct(<?php echo json_encode($row); ?>)' style="background: #6c757d; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                        <a href="scripts/toggle-status.php?id=<?php echo $row['id']; ?>&current_status=<?php echo $row['status']; ?>"
                                            class="btn-status"
                                            title="<?php echo $isDeactivated ? 'Activate' : 'Deactivate'; ?>"
                                            style="color: <?php echo ($row['status'] == 1) ? '#28a745' : '#777'; ?>; margin: 0 10px; font-size: 1.2rem;">
                                            <i class="fas <?php echo ($row['status'] == 1) ? 'fa-toggle-on' : 'fa-toggle-off'; ?>"></i>
                                        </a>

                                        <a href="scripts/delete-product.php?id=<?php echo $row['id']; ?>"
                                            class="btn-delete"
                                            onclick="return confirm('Are you sure? This cannot be undone.');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </section>
            </section>

            <section id="blogs-section" style="display: none;">
                <header class="admin-header">
                    <h1>Blog Management</h1>
                    <button class="btn-add" id="openBlogModal">
                        <i class="fas fa-plus"></i> Create New Blog
                    </button>
                </header>

                <section class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $blogRes = mysqli_query($conn, "SELECT * FROM blogs ORDER BY created_at DESC");
                            while ($blog = mysqli_fetch_assoc($blogRes)): ?>
                                <tr>
                                    <td><img src="../uploads/blog/<?php echo $blog['image_path']; ?>" width="50" class="admin-thumbnail" style="border-radius: 5px;"></td>
                                    <td>
                                        <strong><?php echo $blog['title']; ?></strong><br>
                                        <small style="color: #777;">By: <?php echo $blog['author']; ?></small>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($blog['created_at'])); ?></td>
                                    <td>
                                        <button class="btn-edit" onclick='editBlog(<?php echo json_encode($blog); ?>)'>
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="scripts/delete-blog.php?id=<?php echo $blog['id']; ?>" class="btn-delete" onclick="return confirm('Delete this blog?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </section>
            </section>
            <section id="categories-section" style="display: none;">
                <header class="admin-header">
                    <h1>Category Management</h1>
                    <button class="btn-add" id="openCatModal">
                        <i class="fas fa-plus"></i> Add New Category
                    </button>
                </header>

                <section class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $catRes = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");
                            while ($cat = mysqli_fetch_assoc($catRes)):
                                $catStatus = ($cat['status'] == 1); // Assuming you have a status column
                            ?>
                                <tr style="<?php echo !$catStatus ? 'opacity: 0.5;' : ''; ?>">
                                    <td><strong><?php echo $cat['category_name']; ?></strong></td>
                                    <td>
                                        <span class="badge <?php echo $catStatus ? 'bg-success' : 'bg-danger'; ?>">
                                            <?php echo $catStatus ? 'Active' : 'Inactive'; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="scripts/toggle-category.php?id=<?php echo $cat['id']; ?>&status=<?php echo $cat['status']; ?>" class="btn-status">
                                            <i class="fas <?php echo $catStatus ? 'fa-toggle-on' : 'fa-toggle-off'; ?>"></i>
                                        </a>
                                        <a href="scripts/delete-category.php?id=<?php echo $cat['id']; ?>" class="btn-delete" onclick="return confirm('Careful! Deleting a category might hide products assigned to it. Continue?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </section>
            </section>
        </main>
    </div>

    <div class="modal" id="productModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('productModal')">&times;</span>
            <h2 id="modalTitle">Add Product</h2>
            <form id="productForm" action="scripts/save-product.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id" id="productId">
                <div class="form-group">
                    <label>Product Image</label>
                    <div style="margin-bottom: 10px;">
                        <img id="pImgPreview" src="" alt="Preview" style="max-width: 100px; border-radius: 5px; display: none; border: 1px solid #ddd;">
                    </div>
                    <input type="file" name="image" id="pImage" accept="image/*">
                    <small style="color: #888;">Leave blank to keep the current image.</small>
                </div>
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="name" id="pName" required>
                </div>

                <div class="form-group">
                    <label>Price (Ksh)</label>
                    <input type="number" name="price" id="pPrice" required>
                </div>

                <div class="form-group">
                    <label>Weight (e.g. 400g)</label>
                    <input type="text" name="weight" id="pWeight" required>
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" id="pCategory" required>
                        <option value="">-- Select Category --</option>
                        <?php
                        // Fetch only active categories for the dropdown
                        $cat_query = "SELECT * FROM categories WHERE status = 1 ORDER BY category_name ASC";
                        $cat_result = mysqli_query($conn, $cat_query);

                        if ($cat_result && mysqli_num_rows($cat_result) > 0) {
                            while ($cat = mysqli_fetch_assoc($cat_result)) {
                                echo '<option value="' . $cat['id'] . '">' . $cat['category_name'] . '</option>';
                            }
                        } else {
                            echo '<option value="" disabled>No active categories found</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="pDesc" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label>Nutrition Facts</label>
                    <textarea name="nutrition_info" id="pNutrition" rows="4" placeholder="Calories: 190"></textarea>
                </div>

                <div class="form-group">
                    <label>Ingredients</label>
                    <textarea name="ingredients" id="pIngredients" rows="2" placeholder="Roasted Peanuts, Salt"></textarea>
                </div>

                <button type="submit" class="btn-save">Save Product</button>
            </form>
        </div>
    </div>

    <div class="modal" id="blogModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('blogModal')">&times;</span>
            <h2 id="blogModalTitle">Add Blog Post</h2>
            <form action="scripts/save-blog.php" method="POST" enctype="multipart/form-data" id="blogForm">
                <input type="hidden" name="blogId" id="editBlogId">

                <div class="form-group">
                    <label>Blog Title</label>
                    <input type="text" name="title" id="blogTitleInput" required>
                </div>

                <div class="form-group">
                    <label>Author / Written By</label>
                    <input type="text" name="author" id="blogAuthorInput" placeholder="e.g. Kageo Admin" required>
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" id="blogContentInput" rows="10" required></textarea>
                </div>

                <div class="form-group">
                    <label>Blog Featured Image</label>
                    <input type="file" name="blogImage" accept="image/*">
                    <small style="color: #888;">Leave blank if not changing image (when editing)</small>
                </div>

                <button type="submit" name="submit_blog" class="btn-save">Save Blog Post</button>
            </form>
        </div>
    </div>
    <div class="modal" id="catModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('catModal')">&times;</span>
            <h2>Add New Category</h2>
            <form action="scripts/save-category.php" method="POST">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" name="category_name" placeholder="e.g., Natural Honey" required>
                </div>
                <button type="submit" class="btn-save">Create Category</button>
            </form>
        </div>
    </div>

    <script src="js/admin.js"></script>
</body>

</html>