<?php

echo '<pre>';

$fruits = [
    'a' => 'apple',
    'b' => 'banana',
    'o' => 'orange',
    'OK'
];

// echo implode(' ', $fruits[0]);

/**
 * 1. count(): Đếm số phần tử trong mảng
 */
// echo count($fruits);


/**
 * 2. array_push(): Thêm một hoặc nhiều phần tử vào cuối mảng
 */
// $fruits[] = 'Ahihi';
// $fruits['keke'] = 'OKOK';
// $fruits['keke'] = 'Hehe';

// array_push($fruits, 25, ['ahihi' => 'keke']);


/**
 * 3. array_pop(): Xóa và trả về phần tử cuối cùng của mảng
 */
// $lastElement = array_pop($fruits);
// print_r($lastElement);


/**
 * 4. array_merge(): Hợp nhất hai hoặc nhiều mảng
 */
$ext = [
    'l' => 'lemon',
    'm' => 'mango',
    'o' => 'KEKE'
];

// $fruits2 = array_merge($fruits, $ext);
// print_r($fruits);
// print_r($fruits2);


/**
 * 5. in_array(): Kiểm tra xem một giá trị có tồn tại trong mảng không
 */
// if (in_array('oranssssge', $fruits)) {
//     echo 'YES';
// } else {
//     echo 'NO';
// }


/**
 * 6. array_keys(): Lấy tất cả các khóa của mảng
 */
// print_r(array_keys($fruits));


/**
 * 7. array_values(): Lấy tất cả các giá trị của mảng
 */
// print_r(array_values($fruits));


/**
 * 8. array_search(): Tìm khóa của một giá trị trong mảng
 */
// var_dump(array_search('oranges', $fruits));


/**
 * 9. array_column(): Lấy ra giá trị của cột mong muốn
 */
// $records = [
//     ['id' => 1, 'name' => 'ahihi 1', 'age' => 25],
//     ['id' => 2, 'name' => 'ahihi 2', 'age' => 29],
//     ['id' => 3, 'name' => 'ahihi 3', 'age' => 96],
// ];
// print_r( array_column($records, 'name', 'age') );


/**
 * 10. unset(): Xóa 1 phần tử của mảng theo key
 */
// print_r($fruits);
// unset($fruits['b']);
// print_r($fruits);


/**
 * 11. implode(): Chuyển mảng thành chuỗi
 */
echo implode(', ', $fruits);