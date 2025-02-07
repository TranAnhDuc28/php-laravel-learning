<?php

/**
 *  VARIABLES AND DATA TYPES
 */ 
$a = 1;
$sanPham = 'abc';
$float = 2.5;
$boolTrue = true;
$boolFalse = false;
$array = [1, 2, 'string', $sanPham, $boolTrue, $boolFalse];

# Thẻ <pre> trong HTML giúp giữ nguyên định dạng khoảng trắng và xuống dòng của nội dung bên trong nó.
echo "<pre>";

# var_dump() hiển thị kiểu dữ liệu và giá trị của biến.
# Nếu đã có giá trị, nó sẽ hiển thị kiểu dữ liệu, độ dài (nếu là chuỗi), và nội dung của biến.
var_dump($a, $sanPham, $float, $boolTrue, $boolFalse, $array);


/**
 * CONSTANTS
 */
define('MAX_BUY', 100);
echo MAX_BUY;
echo "<br>";


/**
 * OPERATORS
 */
$x = 5;
$y = 3;
$z = '5';

// Toán tử số học
# Lấy bình phương
$luyThua =  $x ** $y;
echo "Bình phương x^y = $luyThua \n";


// Toán tử so sánh
# So sánh tương đối (loose comparison): ==, != | <>
var_dump($x == $z); // => true

# So sánh tuyệt đối (strict comparison) kiểm tra về cả kiểu dữ liệu: ===, !==
var_dump($x === $z); // => false

# Spaceship: Trả về một số nguyên nhỏ hơn, bằng hoặc lớn hơn 0, tùy thuộc vào việc $x nhỏ hơn, bằng hoặc lớn hơn $y. Được giới thiệu trong PHP 7.
$x = 5;  
$y = 10;
echo ($x <=> $y); // returns -1 because $x is less than $y
echo "<br>";

$x = 10;  
$y = 10;
echo ($x <=> $y); // returns 0 because values are equal
echo "<br>";

$x = 15;  
$y = 10;
echo ($x <=> $y); // returns +1 because $x is greater than $y
echo "<br>";

// Toán tử logic
# And (and | &&)
# Or (or | ||)
# Xor (xor): returns true nếu x hoặc y đúng nhưng không phải cả 2
# Not (!)


// Toán tử chuỗi
$str1 = 'Hôm nay';
$str2 = 'trời đẹp';
echo $str1 . ' ' . $str2;
echo "<br>";
echo $str1 .= $str2;
echo "<br>";


// Toán tử gán có điều kiện
# Toán tử 3 ngôi (?:) VD: condition ? exp1 : exp2

# Toán tử hợp nhất null (??): dùng để kiểm tra biến có tồn tại và không phải null.
echo $a ?? 'Không tồn tại';
echo "<br>";
echo $b ?? 'Không tồn tại';
echo "<br>";


/**
 * DISPLAYING DATA
 */
#echo: Dùng để in một hoặc nhiều chuỗi ra màn hình.
#print: Tương tự như echo, nhưng chỉ in ra một chuỗi và trả về giá trị 1 nếu thành công.
#print_r(): Dùng để in cấu trúc dữ liệu của các biến, đặc biệt hữu ích khi làm việc với mảng hoặc đối tượng.
print_r($array);
#var_dump(): In ra thông tin chi tiết về biến, bao gồm kiểu dữ liệu và giá trị. Thường được sử dụng để debug.
