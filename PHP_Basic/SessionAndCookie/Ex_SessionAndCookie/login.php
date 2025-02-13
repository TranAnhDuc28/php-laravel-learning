<?php

echo '<pre>';

session_start();

// Mô phỏng thông tin đăng nhập hợp lệ (trong thực tế, bạn sẽ truy xuất từ cơ sở dữ liệu)
$validUsername = "admin";
$validPassword = "123456";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // print_r($_POST);
    // die;

    // Lấy dữ liệu từ form
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Kiểm tra tính hợp lệ của thông tin đăng nhập
    if ($username === $validUsername && $password === $validPassword) {

        // kiểm tra nếu người dùng chọn "Remember Me"
        // kiểm tra xem giá trị của input remember_me trong form gửi qua phương thức POST có tồn tại và khác null hay không.
        if (isset($_POST['remember_me'])) {

            // Lưu thông tin đăng nhập vào Cookie với thời hạn 30 ngày
            setcookie('username', $username, time() + 60 * 60 * 24 * 30, '/');
        } else {
            // Lưu thông tin đăng nhập vào session
            $_SESSION['username'] = $username;
        }

        // chuyển hướng đến trang đăng nhập thành công
        header('Location: welcome.php');
        exit(); // thoát chương trình
    } else {
        $_SESSION['error'] = 'Sai name hoặc sai password';

        header('Location: index.php');
        exit();
    }
}
