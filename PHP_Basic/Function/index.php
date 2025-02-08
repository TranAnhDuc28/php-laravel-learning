<?php

echo '<pre></pre>';

// Hàm không có tham số
function sayHello() {
    echo "Hello";
}
// sayHello();


//hàm có tham số
function sayHelloWho($name) {
    echo "Hello $name <br>";
}
// sayHelloWho('ABC');


// hàm có tả về 
function sumTwoNumber($a, $b) {
    $sum = $a + $b;
    return $sum;
}
// echo sumTwoNumber(5, 8);


// hàm PHP cung cấp
$str = 'HelloWorld';
// echo strlen($str);



// Tham số bắt buộc và không bắt buộc
function response($message, $statusCode = 200) {
    echo $message . ' - ' . $statusCode . '<br>';
}
// response('Thành công');
// response('Thành công', 500);



// Hàm ẩn danh
$sayHello = function() {
    return "Hello";
};

// echo $sayHello();


$message = 'Good morning';

$greet = function($name) use ($message) {
    return "$message, $name!";
};

echo $greet('Duc');