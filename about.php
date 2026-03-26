<!DOCTYPE html>
<html lang="en">
<<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="css/about-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
<body>
<?php include 'components/header.php'; ?>
    <main class="about-container">
        <h1 class="page-title">about us</h1>
        <hr class="title-underline">

        <section class="about-hero">
            <img src="images/bread-slices.jpg" alt="Fresh Ingredients" class="full-width-img">
        </section>

        <section class="about-intro">
            <div class="text-content">
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                <p>Lorem ipsum dolor sit amet, cons ectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam.</p>
            </div>
            <div class="triangle-purple"></div>
        </section>

        <section class="vmg-grid">
            <div class="vmg-item">
                <h2>Our Vision</h2>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="vmg-item">
                <h2>Our Mission</h2>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="vmg-item">
                <h2>Our Goal</h2>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
            </div>
        </section>

        <section class="commitment-section">
            <div class="commitment-content">
                <div class="commitment-img">
                    <img src="images/factory-production.png" alt="Production Line">
                </div>
                <div class="commitment-text">
                    <h2>OUR COMMITMENT</h2>
                    <p class="subtitle-green">how we are</p>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>
        </section>

        <section class="cta-footer-banner">
            <div class="overlay-content">
                <h2>DISCOVER THE LATEST NEWS</h2>
                <button class="btn-brand" onclick="location.href='products.php'">OUR PRODUCTS</button>
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