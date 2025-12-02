<?php
// Tệp Model sẽ chứa tất cả logic truy vấn CSDL 

// TODO 1: Hàm lấy toàn bộ sinh viên
function getAllSinhVien($pdo) {
    $sql = "SELECT * FROM sinhvien";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// TODO 2: Hàm thêm sinh viên mới
function addSinhVien($pdo, $ten, $email) {
    $sql = "INSERT INTO sinhvien (ten_sinh_vien, email) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ten, $email]);
}
?>
