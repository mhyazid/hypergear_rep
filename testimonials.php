<!DOCTYPE html>
<html lang="en">
<head>
    <title>Testimonials - HyperGear</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .column.middle {
        padding: 20px;
        background-color: #bbb;
        }


        p {
            font-size: 16px;
            color: #666;
        }

        /* Testimonial Box */
        .testimonial {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 15px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        .testimonial h3 {
            margin: 0;
            color: #333;
        }

        .testimonial p {
            margin: 5px 0;
            color: #444;
        }
        .submit-testimonial {
            text-align: center;
            margin-top: 20px;
        }

        .submit-testimonial a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .submit-testimonial a:hover {
            background-color: #555;
        }
    </style>

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
            <h2>Testimonials</h2>
            <p>This is what our customers say about us</p>

            <?php
                include 'db.php';

                $sql = "SELECT * FROM testimonials WHERE status = 'approved'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="testimonial">';
                        echo '<h3>' . htmlspecialchars($row["name"]) . '</h3>';
                        echo '<p>' . htmlspecialchars($row["testimonial"]) . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>There's no testimonial available at the moment.</p>";
                }
                $conn->close();
            ?>
            <br>
            <div class="submit-testimonial">
                <a href="submit-testimonial.php">Submit Your Testimonial</a>
            </div>
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
