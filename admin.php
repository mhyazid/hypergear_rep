<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

// Hapus produk
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Ambil daftar produk
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - Manage Products</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h2>Admin - Manage Products</h2>
    <a href="logout.php">Logout</a>
    <br>
    <br>
    <a href="manage-testimonials.php">Manage Testimonials</a> | 
    <a href="manage-gallery.php">Manage Gallery</a>

    
    <h3>Product List</h3>
    <a href="add-product.php">Add New Product</a>
    <br><br>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo "$ " . $row['price']; ?></td>
                    <td><?php echo '<img src="img/' . $row["image"] . '" alt="' . $row["name"] . '" width="100">'; ?></td>
                    <td>
                        <a href="edit-product.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="admin.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>

<?php
$conn->close();
?>
