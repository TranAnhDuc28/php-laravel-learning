<?php

session_start();

// Kiểm tra người dùng đã đăng nhập hay chưa
if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {

    // echo '<pre>';
    // print_r($_COOKIE);
    // print_r($_SESSION);
    // die;

    // Lấy thông tin người dùng từ Sesion hoặc Cookie
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : $_COOKIE['username'];

    $username = $_SESSION['username'] ?? $_COOKIE['username'];

    echo "<h2>Xin chào, $username! Bạn đã đăng nhập thành công.</h2>";
    echo "<a href='logout.php'>Đăng xuất</a>";
} else {
    header('Locale: index.php');
    exit();
}