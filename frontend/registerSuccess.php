<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Success</title>
</head>
<body>
    <?php
    if (isset($_GET['message'])) {
        echo '<h1>' . $_GET['message'] . '</h1>';
    }
    ?>
    <p>Thank you for registering. You can now log in using your credentials.</p>
    <a href="login.php">Login</a>
</body>
</html>