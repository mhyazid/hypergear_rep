<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    $stmt = $conn->prepare("SELECT id, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $stored_password);
    $stmt->fetch();
    

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