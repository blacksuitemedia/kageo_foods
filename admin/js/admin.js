/**
 * 1. ELEMENT SELECTORS
 * We select these at the top so they are available to all functions.
 */
// Product Elements
const productModal = document.getElementById('productModal');
const productForm = document.getElementById('productForm');
const productModalTitle = document.getElementById('modalTitle');
const openProductBtn = document.getElementById('openModal');

// Blog Elements
const blogModal = document.getElementById('blogModal');
const blogForm = document.getElementById('blogForm');
const blogModalTitle = document.getElementById('blogModalTitle');
const openBlogBtn = document.getElementById('openBlogModal');

// Tab Switching Elements
const productTabBtn = document.getElementById('show-products');
const blogTabBtn = document.getElementById('show-blogs');
const productSection = document.getElementById('products-section');
const blogSection = document.getElementById('blogs-section');

/**
 * 2. GLOBAL MODAL HELPERS
 */
const openModal = (id) => {
    const m = document.getElementById(id);
    if (m) {
        m.style.display = 'flex'; // Using flex to center the modal content
    }
};

const closeModal = (id) => {
    const m = document.getElementById(id);
    if (m) {
        m.style.display = 'none';
    }
};

// Close modal if user clicks the dark background area
window.addEventListener('click', (e) => {
    if (e.target.classList.contains('modal')) {
        e.target.style.display = 'none';
    }
});

/**
 * 3. PRODUCT LOGIC (Add & Edit)
 */
if (openProductBtn) {
    openProductBtn.onclick = () => {
        // Set form to "Add" mode
        if (productForm) {
            productForm.action = 'scripts/add-product.php';
            productForm.reset();
            // Ensure hidden ID is cleared for new products
            const idInput = document.getElementById('productId');
            if (idInput) idInput.value = '';
        }
        if (productModalTitle) productModalTitle.innerText = "Add New Product";
        openModal('productModal');
    };
}

// Triggered by the "Edit" button in your PHP while loop
function editProduct(product) {
    // 1. Log the data to see it working in the console
    console.log("Product data received:", product);

    // 2. Get the form
    const form = document.getElementById('productForm');
    if (!form) return;

    // 3. Set to Update Mode
    form.action = 'scripts/update-product.php';
    document.getElementById('modalTitle').innerText = 'Edit Product';
    
    // 4. Fill the fields (Using the exact keys from your DB)
    document.getElementById('productId').value = product.id;
    document.getElementById('pName').value = product.name;
    document.getElementById('pPrice').value = product.price;
    document.getElementById('pWeight').value = product.weight;
    document.getElementById('pDesc').value = product.description;
    document.getElementById('pCategory').value = product.category_id;

    // 5. Show the modal
    openModal('productModal');
}
/**
 * 4. BLOG LOGIC (Add & Edit)
 */
if (openBlogBtn) {
    openBlogBtn.onclick = () => {
        if (blogForm) {
            blogForm.action = 'scripts/add-blog.php';
            blogForm.reset();
        }
        if (blogModalTitle) blogModalTitle.innerText = "Create New Blog Post";
        openModal('blogModal');
    };
}

function editBlog(id) {
    // Fetch current blog data via AJAX
    fetch(`scripts/get-blog.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (blogForm) blogForm.action = 'scripts/update-blog.php';
            if (blogModalTitle) blogModalTitle.innerText = "Edit Blog Post";

            // Map data to blog form inputs
            document.getElementById('editBlogId').value = data.id;
            document.getElementById('blogTitleInput').value = data.title;
            document.getElementById('blogContentInput').value = data.content;

            openModal('blogModal');
        })
        .catch(err => {
            console.error("Error fetching blog data:", err);
            alert("Could not load blog details.");
        });
}

/**
 * 5. TAB SWITCHING (Products vs Blogs)
 */
if (productTabBtn && blogTabBtn && productSection && blogSection) {
    blogTabBtn.addEventListener('click', (e) => {
        e.preventDefault();
        blogSection.style.display = 'block';
        productSection.style.display = 'none';
        blogTabBtn.classList.add('active');
        productTabBtn.classList.remove('active');
    });

    productTabBtn.addEventListener('click', (e) => {
        e.preventDefault();
        productSection.style.display = 'block';
        blogSection.style.display = 'none';
        productTabBtn.classList.add('active');
        blogTabBtn.classList.remove('active');
    });
}