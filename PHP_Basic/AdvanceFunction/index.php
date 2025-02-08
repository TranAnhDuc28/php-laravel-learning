<?php

echo '<pre></pre>';

// Hàm ẩn danh được khai báo bằng từ khóa function nhưng không có tên hàm.
$sayHello = function($name) {
    return 'Hello' . $name;
};

// echo $sayHello('Duc');

// Closure và use: Bạn có thể sử dụng từ khóa use để "bắt" các biến từ phạm vi bên ngoài hàm ẩn danh.
$message = 'Good morning';

$greet = function($name) use ($message) {
    return "$message, $name!" . '<br>';
};

// echo $greet('Duc');
// echo $greet('Ducta');


// Hàm callback
$array = [1, 2, 3, 4];

$array2 = array_map(function($item) {
    return $item * 2;
}, $array);

// print_r($array2);


/*
* Tham trị và tham chiếu
* - Tham trị: một bản sao của giá trị biến được truyền vào hàm. Điều này có nghĩa là 
* mọi thay đổi đối với tham số trong hàm không ảnh hưởng đến biến ban đầu.
* - Khi truyền tham chiếu, một tham chiếu đến biến ban đầu được truyền vào hàm, 
* có nghĩa là mọi thay đổi đối với tham số trong hàm sẽ ảnh hưởng đến biến ban đầu.
* Sử dụng ký hiệu & để truyền tham chiếu
*
*/


function increment(&$value) {
    $value++;

    echo $value . '<br>';
}

$num = 5;
increment($num);
echo $num;