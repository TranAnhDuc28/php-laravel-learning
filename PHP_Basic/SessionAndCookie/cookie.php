<?php

echo '<pre>';

// Sử dụng hàm setcookie() để tạo cookie. Có thể chỉ định tên, giá trị và thời gian hết hạn (tính bằng giây từ thời điểm hiện tại).
// setcookie('username', 'Ahihi', time() + 3600, '/');
// setcookie('age', 69, time() + 3600, '/');

// print_r($_COOKIE);

echo '===========DELETE COOKIE============' . PHP_EOL;

// xóa một cookie, đặt thời gian hết hạn của cookie về quá khứ.
setcookie('username', '', time() - 3600, '/');
setcookie('age', '', time() - 3600, '/');

print_r($_COOKIE);