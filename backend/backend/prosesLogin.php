<?php 
session_start();
require_once('db.php');

verifyLogin();
function verifyLogin(){
    global $db;

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM user WHERE username = ?";
    
    $stmt = $db -> prepare($sql);
    $stmt->execute([$username]);
    $row = $stmt -> fetch (PDO::FETCH_ASSOC);
    
    if (!$row) {
        $alertMessage = "Data not Found !";
        header("Location: ../frontend/login.php?data=" . urlencode($alertMessage));
    } else {
        if (!password_verify($password, $row['password'])) {
            $alertMessage = "Wrong Password !";
            header("Location: ../frontend/login.php?data=" . urlencode($alertMessage));
        } else {
            $_SESSION['id_user'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header('location: ../frontend/homepage/menu.php');
        }}
} 
?>