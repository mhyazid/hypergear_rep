<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $description = $_POST['description'];
    $target_dir = "img/gallery/";
    $image = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }


    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }


    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $stmt = $conn->prepare("INSERT INTO gallery (image, description) VALUES (?, ?)");
            $stmt->bind_param("ss", $image, $description);
            $stmt->execute();
            $stmt->close();
            echo "The file " . htmlspecialchars($image) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Gallery Image</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h2>Add Image to Gallery</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="description">Description:</label><br>
        <input type="text" name="description" id="description" required><br><br>

        <label for="image">Select image:</label><br>
        <input type="file" name="image" id="image" required><br><br>

        <button type="submit">Upload Image</button>
    </form>
</body>
</html>
