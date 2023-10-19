<?php 
session_start();
require_once('db.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE username = ?";

$stmt = $db -> prepare($sql);
$stmt->execute([$username]);
$row = $stmt -> fetch (PDO::FETCH_ASSOC);

if (!$row) {
    echo "User not found";
    header('location: ../frontend/login.php?warning=Incorrect+Username');
} else {
    if (!password_verify($password, $row['password'])) {
        header('location: ../frontend/login.php?warning=Wrong+Password');
    } else {
        $_SESSION['id_user'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        header('location: ../frontend/homepage/menu.php');
    }
}


?> 