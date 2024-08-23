<?php
session_start();
include 'db.php'; // Koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Ambil data admin berdasarkan username
    $stmt = $conn->prepare("SELECT id, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $stored_password);
    $stmt->fetch();
    
    // Periksa apakah password yang diinput sama dengan password di database
    if ($password === $stored_password) {
        $_SESSION['admin_id'] = $id;
        header('Location: admin.php');
        exit();
    } else {
        echo "Invalid username or password.";
    }
    
    $stmt->close();
}

$conn->close();
?>