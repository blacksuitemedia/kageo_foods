/**
 * 1. ELEMENT SELECTORS
 * We select these at the top so they are available to all functions.
 */
// Product Elements
const productModal = document.getElementById("productModal");
const productForm = document.getElementById("productForm");
const productModalTitle = document.getElementById("modalTitle");
const openProductBtn = document.getElementById("openModal");

// Blog Elements
const blogModal = document.getElementById("blogModal");
const blogForm = document.getElementById("blogForm");
const blogModalTitle = document.getElementById("blogModalTitle");
const openBlogBtn = document.getElementById("openBlogModal");

// Tab Switching Elements
const productTabBtn = document.getElementById("show-products");
const blogTabBtn = document.getElementById("show-blogs");
const productSection = document.getElementById("products-section");
const blogSection = document.getElementById("blogs-section");

/**
 * 2. GLOBAL MODAL HELPERS
 */
const openModal = (id) => {
  const m = document.getElementById(id);
  if (m) {
    m.style.display = "flex"; // Using flex to center the modal content
  }
};

const closeModal = (id) => {
  const m = document.getElementById(id);
  if (m) {
    m.style.display = "none";
  }
};

// Close modal if user clicks the dark background area
window.addEventListener("click", (e) => {
  if (e.target.classList.contains("modal")) {
    e.target.style.display = "none";
  }
});

/**
 * 3. PRODUCT LOGIC (Add & Edit)
 */
if (openProductBtn) {
  openProductBtn.onclick = () => {
    // Set form to "Add" mode
    if (productForm) {
      productForm.action = "scripts/add-product.php";
      productForm.reset();
      // Ensure hidden ID is cleared for new products
      const idInput = document.getElementById("productId");
      if (idInput) idInput.value = "";
    }
    if (productModalTitle) productModalTitle.innerText = "Add New Product";
    openModal("productModal");
  };
}

// Triggered by the "Edit" button in your PHP while loop
function editProduct(product) {
  document.getElementById("modalTitle").innerText = "Edit Product";
  document.getElementById("productForm").action = "scripts/save-product.php";

  // Fill basic info
  document.getElementById("productId").value = product.id;
  document.getElementById("pName").value = product.name;
  document.getElementById("pPrice").value = product.price;
  document.getElementById("pWeight").value = product.weight;
  document.getElementById("pDesc").value = product.description;

  // Set the category
  let catSelect = document.getElementById("pCategory");
  catSelect.value = product.category_id;

  document.getElementById("productModal").style.display = "block";
}
/**
 * 4. BLOG LOGIC (Add & Edit)
 */
if (openBlogBtn) {
  openBlogBtn.onclick = () => {
    if (blogForm) {
      blogForm.action = "scripts/add-blog.php";
      blogForm.reset();
    }
    if (blogModalTitle) blogModalTitle.innerText = "Create New Blog Post";
    openModal("blogModal");
  };
}

function editBlog(blog) {
  // 1. Change Title and Action
  document.getElementById("blogModalTitle").innerText = "Edit Blog Post";
  document.getElementById("blogForm").action = "scripts/save-blog.php";

  // 2. Fill the inputs
  document.getElementById("editBlogId").value = blog.id;
  document.getElementById("blogTitleInput").value = blog.title;
  document.getElementById("blogAuthorInput").value = blog.author;
  document.getElementById("blogContentInput").value = blog.content;

  // 3. Open Modal
  document.getElementById("blogModal").style.display = "block";
}

// Ensure the "Add" button resets the form
document.getElementById("openBlogModal").onclick = function () {
  document.getElementById("blogModalTitle").innerText = "Add Blog Post";
  document.getElementById("blogForm").reset();
  document.getElementById("editBlogId").value = "";
  document.getElementById("blogForm").action = "scripts/save-blog.php";
  document.getElementById("blogModal").style.display = "block";
};

/**
 * 5. TAB SWITCHING (Products vs Blogs)
 */
if (productTabBtn && blogTabBtn && productSection && blogSection) {
  blogTabBtn.addEventListener("click", (e) => {
    e.preventDefault();
    blogSection.style.display = "block";
    productSection.style.display = "none";
    blogTabBtn.classList.add("active");
    productTabBtn.classList.remove("active");
  });

  productTabBtn.addEventListener("click", (e) => {
    e.preventDefault();
    productSection.style.display = "block";
    blogSection.style.display = "none";
    productTabBtn.classList.add("active");
    blogTabBtn.classList.remove("active");
  });
}

// Add this to your existing tab switching logic
document.getElementById("show-categories").onclick = function () {
  hideAllSections();
  document.getElementById("categories-section").style.display = "block";
  setActiveLink(this);
};

document.getElementById("openCatModal").onclick = function () {
  document.getElementById("catModal").style.display = "block";
};

function hideAllSections() {
  document.getElementById("products-section").style.display = "none";
  document.getElementById("blogs-section").style.display = "none";
  document.getElementById("categories-section").style.display = "none";
}
