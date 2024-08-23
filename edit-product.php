<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $imageUpdated = false;

  
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
       
        $uploadDir = 'img/';
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $uploadFileDir = $uploadDir . $newFileName;
        

        if (move_uploaded_file($fileTmpPath, $uploadFileDir)) {
   
            $imageUpdated = true;
            $imagePath = $newFileName;
        } else {
            $message = "There was an error uploading the file, please try again.";
        }
    } else {

        $imagePath = $product['image_path'];
    }


    $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssdsi", $name, $description, $price, $imagePath, $id);
    $stmt->execute();
    $stmt->close();
    
    $message = "Product updated successfully.";
    header('Location: admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h2>Edit Product</h2>
    <?php if (isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br><br>
        
        <label for="description">Description:</label>
        <textarea name="description" id="description" required><?php echo htmlspecialchars($product['description']); ?></textarea><br><br>
        
        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" id="price" value="<?php echo htmlspecialchars($product['price']); ?>" required><br><br>
        
        <label for="image">Image:</label>
        <input type="file" name="image" id="image"><br><br>
        
        <?php if (!empty($product['image_path'])): ?>
            <p>Current Image:</p>
            <img src="img/<?php echo htmlspecialchars($product['image_path']); ?>" alt="Product Image" style="max-width: 200px;"><br><br>
        <?php endif; ?>
        
        <button type="submit">Update Product</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
