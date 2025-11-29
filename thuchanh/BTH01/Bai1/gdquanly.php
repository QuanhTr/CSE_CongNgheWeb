<?php
require_once "db.php";
$result = $conn->query("SELECT * FROM flowers");
?>

<table class="table table-bordered">
    <tr>
        <th>Tên hoa</th>
        <th>Mô tả</th>
        <th>Ảnh</th>
        <th>Hành động</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['description'] ?></td>
        <td><img src="img/<?= $row['image'] ?>" width="80"></td>
        <td>
            <a class="btn btn-warning btn-sm" href="edit.php?id=<?= $row['id'] ?>">Sửa</a>
            <a class="btn btn-danger btn-sm" href="delete.php?id=<?= $row['id'] ?>">Xóa</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
