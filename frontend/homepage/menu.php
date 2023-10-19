<?php 
session_start();

$dsn = "mysql:host=localhost;dbname=pemweb_utslabexample";
$kunci = new PDO($dsn, "root", "");

$sql = "SELECT * FROM tasks ORDER BY progress";

$hasil = $kunci->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Dopedia</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="container">
<div class="navbar bg-neutral text-neutral-content">
  <a class="btn btn-ghost normal-case text-xl">To-DoPedia</a>
  <a href="logout.php" class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded transition duration-300 ease-in-out">Logout</a>

      <?php
            $loginButton = '<a
            href="login.php"
            class="text-white bg-green-500 hover:bg-green-600 px-4 py-2 rounded transition duration-300 ease-in-out"
            >Login</a
            >';

            $logoutButton = '<a
            href="processLogin.php"
            class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded transition duration-300 ease-in-out"
            >Logout</a
            >';

            if(isset($_SESSION['username'])){
              echo $logoutButton;
            }else{
              echo $loginButton;
      }?>
</div>

<div class="container">
        <h1>To-Do List</h1>
        <input type="text" id="taskInput" placeholder="Tambahkan tugas...">
        <button id="addTask">Tambah</button>
        <ul id="taskList">
            <?php if (isset($_SESSION['tasks'])) : ?>
                    <?php foreach ($_SESSION['tasks'] as $task) : ?>
                        <li><?php echo $task; ?></li>
                    <?php endforeach; ?>
                <?php endif; ?>
        </ul>
    </div>
    <script src="../backend/script.js"></script>

</div>
</body>
</html>