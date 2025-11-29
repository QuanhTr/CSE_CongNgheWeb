<?php
require_once "db.php";

$name = $_POST['name'];
$description = $_POST['description'];

$image = $_FILES['image']['name'];
$target = "img/" . basename($image);

move_uploaded_file($_FILES['image']['tmp_name'], $target);

$sql = "INSERT INTO flowers (name, description, image)
        VALUES ('$name', '$description', '$image')";

$conn->query($sql);

header("Location: gdquanly.php");
?>
