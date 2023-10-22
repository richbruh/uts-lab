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
        $alertMessage = "<p>Data not Found !</p>";
        header("Location: ../frontend/login.php?data=" . urlencode($alertMessage));
    } else {
        if (!password_verify($password, $row['password'])) {
            $alertMessage = "<p>Wrong Password !</p>";
            header("Location: ../frontend/login.php?data=" . urlencode($alertMessage));
        } else {
            $_SESSION['id_user'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header('location: ../frontend/homepage/menu.php');
        }}
} 

function logout(){
    session_start();
    session_unset();
    session_destroy();
    header("Location:../frontend/login.php");
}

if($_POST['mode'] == "verify"){
    verifyLogin();
}else if($_POST['mode'] == "register"){
    header("../frontend/register.php");
}else{
    logout();
}
?>