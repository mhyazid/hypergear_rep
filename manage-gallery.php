<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

// Hapus gambar
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    
    // Dapatkan nama file gambar dari database
    $stmt = $conn->prepare("SELECT image FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($image);
    $stmt->fetch();
    $stmt->close();
    
    // Hapus file gambar dari folder
    if ($image && file_exists("img/gallery/" . $image)) {
        unlink("img/gallery/" . $image);
    }
    
    // Hapus data dari database
    $stmt = $conn->prepare("DELETE FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    
    header('Location: manage-gallery.php');
    exit();
}

// Ambil daftar gambar
$sql = "SELECT * FROM gallery";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - Manage Gallery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Admin - Manage Gallery</h2>
    <a href="logout.php">Logout</a> |
    <a href="admin.php">Manage Products</a> |
    <a href="add-gallery.php">Add New Image</a>
    <br><br>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo '<img src="img/gallery/' . $row["image"] . '" alt="' . $row["description"] . '" width="100">'; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <a href="manage-gallery.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this image?')">Delete</a>
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
