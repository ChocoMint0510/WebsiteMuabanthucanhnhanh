<?php
function connectDB() {
    // Thay đổi các thông số kết nối cho MySQL của XAMPP
    $servername = "localhost"; // Tên máy chủ (ở đây là localhost)
    $username = "root"; // Tên người dùng mặc định cho MySQL trong XAMPP
    $password = ""; // Mật khẩu mặc định (trống) cho MySQL trong XAMPP
    $database = "db_duandoannhanhonline"; // Tên cơ sở dữ liệu

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $database);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        // Nếu kết nối thành công, thiết lập bộ mã UTF-8
        $conn->set_charset("utf8");
        return $conn;
    }
}
?>