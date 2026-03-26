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
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="admin-container">
    <aside class="admin-sidebar">
        <div class="admin-logo">
            <img src="../images/logo.png" alt="Kageo Logo" width="50">
            <span>Admin Portal</span>
        </div>
        <nav class="admin-nav">
            <a href="admin.php" class="active"><i class="fas fa-box"></i> Products</a>
            <a href="blogs_admin.php"><i class="fas fa-blog"></i> Blogs</a>
            <a href="../index.php" target="_blank"><i class="fas fa-eye"></i> View Site</a>
            <a href="logout.php" style="color: #ff4d4d;"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>
    </aside>

    <main class="admin-main">
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
                    while($row = mysqli_fetch_assoc($res)): ?>
                    <tr>
                        <td><img src="../uploads/<?php echo $row['image_path']; ?>" width="50" class="admin-thumbnail"></td>
                        <td><?php echo $row['name']; ?></td>
                        <td>Ksh <?php echo number_format($row['price']); ?></td>
                        <td><?php echo $row['weight']; ?></td>
                        <td>
                            <button class="btn-edit" onclick="editProduct(<?php echo $row['id']; ?>)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="scripts/delete-product.php?id=<?php echo $row['id']; ?>&image=<?php echo $row['image_path']; ?>" 
                               class="btn-delete" onclick="return confirm('Delete this product?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </main>
</div>

<div class="modal" id="productModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('productModal')">&times;</span>
        <h2 id="modalTitle">Add Product</h2>
        <form action="scripts/add-product.php" method="POST" enctype="multipart/form-data" id="productForm">
            <input type="hidden" name="productId" id="productId">
            
            <div class="form-group">
                <label>Category</label>
                <select name="category_id" id="pCategory" required>
                    <?php
                    $cats = mysqli_query($conn, "SELECT * FROM categories");
                    while($c = mysqli_fetch_assoc($cats)) {
                        echo "<option value='".$c['id']."'>".$c['category_name']."</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="productName" id="pName" placeholder="Product Name" required>
            </div>
            
            <div class="form-group">
                <label>Price</label>
                <input type="number" name="productPrice" id="pPrice" placeholder="Price" required>
            </div>

            <div class="form-group">
                <label>Weight</label>
                <input type="text" name="productWeight" id="pWeight" placeholder="Weight (e.g. 400g)" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="productDesc" id="pDesc" placeholder="Description"></textarea>
            </div>
            
            <div class="form-group">
                <label>Product Image (Leave blank if not changing)</label>
                <input type="file" name="productImage" accept="image/*">
            </div>

            <button type="submit" name="submit" class="btn-save">Save Product</button>
        </form>
    </div>
</div>

<script src="js/admin.js"></script>
</body>
</html>