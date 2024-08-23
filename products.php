<!DOCTYPE html>
<html lang="en">
<head>
    <title>Our Products - HyperGear</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <div class="header">
        <img src="img/logo2.png" alt="logo">
        <h2>HyperGear</h2>
    </div>

    <div class="row">
        <div class="column side" style="background-color:#aaa;">
            <ul class="nav">
                <li><a href="index.html">Home</a></li>
                <li><a href="about-us.html">About Us</a></li>
                <li><a href="contact-us.html">Contact Us</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="testimonials.php">Testimonials</a></li>
                <li><a href="gallery.php">Gallery</a></li>

            </ul>
        </div>
        
        <div class="column middle" style="background-color:#bbb;">
            <h2>Our Products</h2>

            <?php
            include 'db.php';

            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while($row = $result->fetch_assoc()) {
                    echo '<div class="product">';
                    echo '<img src="img/' . $row["image"] . '" alt="' . $row["name"] . '">';
                    echo '<h3>' . $row["name"] . '</h3>';
                    echo '<p>' . $row["description"] . '</p>';
                    echo '<p>Price: $' . $row["price"] . '</p>';
                    echo '</div>';
                }
            } else {
                echo "There's no product";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <div class="footer">
    <div class="footer-content">
        <div class="footer-section about">
            <h3>About HyperGear</h3>
            <p>HyperGear is your go-to source for high-performance gaming gear. We provide top-tier products to enhance your gaming experience, whether you're a casual gamer or a pro.</p>
        </div>
        
        <div class="footer-section contact">
            <h3>Contact Us</h3>
            <p><i class="fas fa-map-marker-alt"></i>Jl Jalan Mulu Tapi Ga Jadian5</p>
            <p><i class="fas fa-phone"></i> +62 890 1234 5678 </p>
            <p><i class="fas fa-envelope"></i> support@hypergear.com</p>
        </div>
        
        <div class="footer-section social">
            <h3>Follow Us</h3>
            <p>Stay connected with us on social media for the latest updates and exclusive offers:</p>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 HyperGear. All Rights Reserved.</p>
    </div>
</div>
</body>
</html>
