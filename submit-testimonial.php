<?php
include 'db.php';

// Proses pengiriman testimoni
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $testimonial = $_POST['testimonial'];

    // Simpan testimoni ke dalam database
    $stmt = $conn->prepare("INSERT INTO testimonials (name, email, testimonial, status) VALUES (?, ?, ?, 'pending')");
    $stmt->bind_param("sss", $name, $email, $testimonial);
    $stmt->execute();
    $stmt->close();

    echo "<script> alert('Your testimonial has been submitted');</script>";

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Submit Testimonial</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <style>
        .column.middle {
            padding: 20px;
            background-color: #bbb;
        }

        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #555;
        }

        a:link, a:visited {
        background-color: #555;
        color: white;
        padding: 14px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        margin:10px 0
        }

        a:hover, a:active {
        background-color: #555;

        }

    </style>
</head>
<body>
    <div class="column middle" style="background-color:#bbb;">
        <a href="testimonials.php">Return</a>
        <h2>Submit Your Testimonial</h2>
        <form action="submit-testimonial.php" method="post">
            <label for="name">Your Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>
            
            <label for="email">Your Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="testimonial">Your Testimonial:</label><br>
            <textarea id="testimonial" name="testimonial" rows="4" required></textarea><br><br>

            <button type="submit">Submit Testimonial</button>
        </form>
    </div>
</body>
</html>
