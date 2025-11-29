<?php
include "db.php";

$id = $_GET["id"];
mysqli_query($conn, "DELETE FROM flowers WHERE id=$id");
header("Location: gdquanly.php");
