<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Contact Us | Kageo</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="css/contact-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<?php include 'components/header.php'; ?>
    <main class="contact-container">
        <h1 class="page-title">Contact Us</h1>
        <p class="subtitle">Any questions or remarks? just write us a message!</p>

        <section class="contact-grid">
            <form class="contact-form">
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" placeholder="Enter a valid email">
                </div>
                <div class="input-group">
                    <label>Name</label>
                    <input type="text" placeholder="Enter your Full Name">
                </div>
                <div class="input-group full-width">
                    <textarea placeholder="type your request here"></textarea>
                </div>
                <button type="submit" class="btn-send">Send Email</button>
            </form>
        </section>

        <section class="contact-cards">
            <div class="card">
                <i class="fas fa-globe"></i>
                <h3>Social Media</h3>
                <p>@kageofoods</p>
            </div>
            <div class="card">
                <i class="fas fa-mobile-alt"></i>
                <h3>Phone</h3>
                <p>+254 703 347 925</p>
            </div>
            <div class="card">
                <i class="fas fa-map-marker-alt"></i>
                <h3>Our Office Location</h3>
                <p>Sunshine Road, off Kangundo Rd</p>
            </div>
        </section>
    </main>
    <?php include 'components/footer.php'; ?>
    <script>
        function loadComponent(id, file) {
            fetch(file)
                .then(response => response.text())
                .then(data => {
                    document.getElementById(id).innerHTML = data;
                });
        }

        loadComponent('header-placeholder', 'components/header.php');
        loadComponent('footer-placeholder', 'components/footer.php');
    </script>
<script src="main.js"></script>
</body>
</html>