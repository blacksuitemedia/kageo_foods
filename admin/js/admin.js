/**
 * GLOBAL HELPERS
 */
const openModal = (id) => {
    const m = document.getElementById(id);
    if (m) m.style.display = 'flex';
};

const closeModal = (id) => {
    const m = document.getElementById(id);
    if (m) m.style.display = 'none';
};

// Universal close if clicking outside the modal box
window.addEventListener('click', (e) => {
    if (e.target.classList.contains('modal')) {
        e.target.style.display = 'none';
    }
});

/**
 * ELEMENT SELECTORS & EVENT LISTENERS
 */
// Product Modal Buttons
const openProductBtn = document.getElementById('openModal');
const closeProductBtn = document.getElementById('closeModal');

if (openProductBtn) {
    openProductBtn.onclick = () => {
        // Reset product form to "Add" mode
        const form = document.querySelector('#productModal form');
        if (form) {
            form.action = 'scripts/add-product.php';
            form.reset();
        }
        openModal('productModal');
    };
}

if (closeProductBtn) {
    closeProductBtn.onclick = () => closeModal('productModal');
}

// Blog Modal Buttons
const openBlogBtn = document.getElementById('openBlogModal');
if (openBlogBtn) {
    openBlogBtn.onclick = () => {
        const title = document.getElementById('blogModalTitle');
        const form = document.getElementById('blogForm');
        if (title) title.innerText = "Create New Blog Post";
        if (form) {
            form.action = 'scripts/add-blog.php';
            form.reset();
        }
        openModal('blogModal');
    };
}

/**
 * TAB SWITCHING LOGIC
 * (Used if you have products and blogs on the SAME page)
 */
const productBtn = document.getElementById('show-products');
const blogBtn = document.getElementById('show-blogs');
const productSection = document.getElementById('products-section');
const blogSection = document.getElementById('blogs-section');

if (productBtn && blogBtn && productSection && blogSection) {
    blogBtn.addEventListener('click', (e) => {
        e.preventDefault();
        blogSection.style.display = 'block';
        productSection.style.display = 'none';
        blogBtn.classList.add('active');
        productBtn.classList.remove('active');
    });

    productBtn.addEventListener('click', (e) => {
        e.preventDefault();
        productSection.style.display = 'block';
        blogSection.style.display = 'none';
        productBtn.classList.add('active');
        blogBtn.classList.remove('active');
    });
}

/**
 * EDIT FUNCTIONS (AJAX FETCH)
 */
function editProduct(id) {
    // 1. Fetch data from PHP
    fetch(`scripts/get-product.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            // 2. Fill the modal inputs using YOUR specific IDs:
            document.getElementById('productId').value = data.id;
            document.getElementById('pCategory').value = data.category_id;
            document.getElementById('pName').value = data.name;
            document.getElementById('pPrice').value = data.price;
            document.getElementById('pWeight').value = data.weight;
            document.getElementById('pDesc').value = data.description;

            // 3. Change Modal Title and Form Action to UPDATE
            document.getElementById('modalTitle').innerText = "Edit Product";
            document.getElementById('productForm').action = 'scripts/update-product.php';

            // 4. Open the modal
            openModal('productModal');
        })
        .catch(err => {
            console.error("Error fetching product:", err);
            alert("Could not load product data.");
        });
}
function editBlog(id) {
    fetch(`scripts/get-blog.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('editBlogId').value = data.id;
            document.getElementById('blogTitleInput').value = data.title;
            document.getElementById('blogContentInput').value = data.content;

            // Switch form to UPDATE mode
            const form = document.getElementById('blogForm');
            const title = document.getElementById('blogModalTitle');
            if (form) form.action = 'scripts/update-blog.php';
            if (title) title.innerText = "Edit Blog Post";

            openModal('blogModal');
        })
        .catch(err => console.error("Error fetching blog:", err));
}