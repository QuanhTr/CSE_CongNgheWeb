<form action="store.php" method="POST" enctype="multipart/form-data">
    <label>Tên hoa:</label>
    <input type="text" name="name" required class="form-control">

    <label>Mô tả:</label>
    <textarea name="description" class="form-control" required></textarea>

    <label>Ảnh:</label>
    <input type="file" name="image" required class="form-control">

    <button class="btn btn-success mt-3">Lưu</button>
</form>
