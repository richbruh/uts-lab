<?php 
require_once('db.php');


// Data from Register Form 
if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $username =$_POST['username'];
    $password = $_POST['password'];
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (email, username, password) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);

    if ($stmt->execute([$email, $username, $hashedPassword])) {
        
        #header('Location: ../frontend/registerSuccess.php');
        header('Location: ../frontend/registerSuccess.php?message=Registration%20successful');
    } else {
        die("Error: " . print_r($stmt->errorInfo(), true)); // Menampilkan pesan kesalahan
    }
} else {
    header('Location: ../frontend/error.php');
}
?>
