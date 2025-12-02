<?php
// === CONTROLLER ===

// TODO 6: Import model
require_once '../models/SinhVienModel.php';

// === KẾT NỐI PDO ===
$host = '127.0.0.1';
$dbname = 'cse485_web';
$username = 'root';
$password = '';

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
// === KẾT THÚC PDO ===


// TODO 8: Kiểm tra POST
if (isset($_POST['ten_sinh_vien']) && isset($_POST['email'])) {

    // TODO 9: Lấy dữ liệu từ form
    $ten = $_POST['ten_sinh_vien'];
    $email = $_POST['email'];

    // TODO 10: Gọi hàm thêm sinh viên
    addSinhVien($pdo, $ten, $email);

    // TODO 11: Refresh trang
    header('Location: index.php');
    exit;
}

// TODO 12: Lấy danh sách sinh viên
$danh_sach_sv = getAllSinhVien($pdo);

// TODO 13: Gọi View
include '../views/sinhvien_view.php';
?>
