<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "flowers_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Kết nối lỗi: " . $conn->connect_error);
}
?>
