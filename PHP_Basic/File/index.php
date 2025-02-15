<?php

echo '<pre>';

/*
// mở file với chế độ chỉ ghi
$file = fopen('example.txt', 'w');
// ghi file
fwrite($file, 'hello world');
// đóng file
fclose($file);
*/


/*
// mở file với chế độ chỉ đọc
$file = fopen('example.txt', 'r');
// đọc nội dung
$content = fread($file, filesize('example.txt'));
fclose($file);
// in nội dung ra màn hình
echo $content;
*/


// xóa file
// unlink('example.txt');


/**
 * PHP cung cấp nhiều hàm và hằng số để làm việc với đường dẫn:
 */
/*
 // __FILE__: Trả về đường dẫn tuyệt đối đến file hiện tại.
echo __FILE__ . PHP_EOL;

// __DIR__: Trả về thư mục của file hiện tại.
echo __DIR__ . PHP_EOL;

// basename(): Trả về tên file từ một đường dẫn.
echo basename(__FILE__) . PHP_EOL;

// dirname(): Trả về đường dẫn của thư mục chứa file.
echo dirname(__FILE__) . PHP_EOL;

// realpath(): Trả về đường dẫn tuyệt đối thực tế từ một đường dẫn tương đối.
echo realpath('file.docx') . PHP_EOL;

// pathinfo(): Trả về thông tin về đường dẫn, bao gồm thư mục, tên file, phần mở rộng.
print_r(pathinfo('D:\TU_HOC\PHP_Laravel\PHP_Basic\File\file.docx')) . PHP_EOL;
*/


/**
 * Nhúng file
 */
require_once 'config.php';

// => đưa hết những gì có trong config.php vào trong index.php