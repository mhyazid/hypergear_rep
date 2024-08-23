<?php
include 'db.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
    // Periksa apakah file di-upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Tentukan path penyimpanan file
        $uploadDir = 'img/';
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $uploadFileDir = $uploadDir . $newFileName;
        
        // Pindahkan file dari tmp ke direktori upload
        if (move_uploaded_file($fileTmpPath, $uploadFileDir)) {
            // Simpan data ke database
            $stmt = $conn->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $name, $description, $price, $newFileName);
            $stmt->execute();
            $stmt->close();
            
            $message = "Product added successfully.";
        } else {
            $message = "There was an error uploading the file, please try again.";
        }
    } else {
        $message = "No file uploaded or there was an upload error.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h2>Add New Product</h2>
    <?php if (isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="add-product.php" method="post" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" required><br><br>
        
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required></textarea><br><br>
        
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required><br><br>
        
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" required><br><br>
        
        <button type="submit">Add Product</button>
    </form>
</body>
</html>
