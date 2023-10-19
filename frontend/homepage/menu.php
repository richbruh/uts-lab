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
<div class="navbar bg-neutral text-neutral-content">
  <a class="btn btn-ghost normal-case text-xl">To-DoPedia</a>
</div>
</body>
</html>