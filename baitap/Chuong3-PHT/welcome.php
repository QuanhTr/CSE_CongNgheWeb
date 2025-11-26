<?php
// TODO 1: Khởi động session
session_start();

// TODO 2: Kiểm tra xem SESSION có tồn tại username không
if (isset($_SESSION['logged_user'])) {

    // TODO 3: Lấy username từ SESSION
    $loggedInUser = $_SESSION['logged_user'];

    // TODO 4: In lời chào
    echo "<h1>Chào mừng trở lại, $loggedInUser!</h1>";
    echo "<p>Bạn đã đăng nhập thành công.</p>";

    // TODO 5: Link đăng xuất (tạm thời chỉ quay về login.html)
    echo '<a href="login.html">Đăng xuất (Tạm thời)</a>';

} else {

    // TODO 6: Nếu chưa đăng nhập → chuyển về login.html
    header('Location: login.html');
    exit;
}
?>
