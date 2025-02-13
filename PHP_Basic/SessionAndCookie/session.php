<?php

echo '<pre>';

// sử dụng session, cần gọi session_start() ở đầu mỗi tệp PHP nơi bạn muốn sử dụng session.
session_start();

$_SESSION['username'] = 'ducta';
$_SESSION['password'] = 'ducta';
$_SESSION['cart'] = [
    [
        'id' => 1,
        'name' => 'Sản phẩm 1'
    ],
    [
        'id' => 2,
        'name' => 'Sản phẩm 2'
    ]
];

print_r($_SESSION);

// truy cập dữ liệu đã lưu trong session ở bất kỳ tệp PHP nào, miễn là đã khởi tạo session.
echo $_SESSION['username'] . PHP_EOL;
echo $_SESSION['cart'][0]['name'] . PHP_EOL;

// xóa phần tử trong session theo key
unset($_SESSION['username']);
print_r($_SESSION);


echo '================SESSION DESTROY================' . PHP_EOL;

// hủy toàn bộ session
session_destroy();

session_start();

die;