<?php

define('DSN', 'mysql:host=localhost;dbname=utslab_kelompok1');
define('DBUSER', 'root');
define('DBPASS', '');

try {
    // 1. Connect to DB
    $db = new PDO(DSN, DBUSER, DBPASS);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
} ?> 