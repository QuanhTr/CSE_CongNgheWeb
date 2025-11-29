<?php include "db.php";

$id = $_GET['id'];
$flower = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM flowers WHERE id=$id"));

if (isset($_POST["update"])) {
    $name = $_POST["name"];
    $desc = $_POST["description"];

    // Nếu có upload ảnh mới
    if ($_FILES["image"]["name"] != "") {
        $img = $_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $img);
    } else {
        $img = $flower["image"]; // giữ ảnh cũ
    }

    mysqli_query($conn,
        "UPDATE flowers SET 
            name='$name',
            description='$desc',
            image='$img'
         WHERE id=$id"
    );

    header("Location: gdquanly.php");
}
?>

<h2>Sửa hoa</h2>

<form method="POST" enctype="multipart/form-data">
    Tên hoa: <br>
    <input type="text" name="name" value="<?php echo $flower['name']; ?>"><br><br>

    Mô tả: <br>
    <textarea name="description" rows="4"><?php echo $flower['description']; ?></textarea><br><br>

    Ảnh hiện tại: <br>
    <img src="images/<?php echo $flower['image']; ?>" width="120"><br><br>

    Ảnh mới (nếu thay): <br>
    <input type="file" name="image"><br><br>

    <button type="submit" name="update">Cập nhật</button>
</form>
