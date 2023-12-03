<?php
define('DB_SERVER', "localhost");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_DATABASE', "miu");
$conn = mysqli_connect('localhost', 'root', '', 'miu');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
