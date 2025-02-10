<?php 

echo '<pre>';

$text = '    Hello, world!   ';

// 1. strlen(): Lấy độ dài của một chuỗi.
// echo strlen($text);

// 2. substr(): Trích xuất một phần của chuỗi.
// echo substr($text,  7,  6);

// 3. strpos(): Tìm vị trí của một chuỗi con bên trong chuỗi.
// echo strpos($text, 'orl');

// 4. str_replace(): Thay thế chuỗi con trong chuỗi.
// echo str_replace('o', '@', $text);

// 5. strtolower() và strtoupper(): Chuyển đổi chuỗi thành chữ thường hoặc chữ hoa.
// echo strtolower($text) . '<br>';
// echo strtoupper($text);

// 6. trim(): Loại bỏ khoảng trắng ở đầu và cuối chuỗi.
// echo trim($text);

// 7. explode(): Chuyển chuỗi thành mảng
$array = explode('o', $text);
print_r($array);