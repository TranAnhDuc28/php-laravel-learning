<?php

echo '<pre>';

$fruits = ['apple', 'banana', 'orange'];

// foreach ($fruits as $key => $value) {
//     echo $key . ' - ' . $value . PHP_EOL;
// }

/**
 * Mảng chỉ số (Indexed Arrays)
 */
// print_r($fruits);

// Truy cập phần tử trong mảng
// echo $fruits[1];

// Thêm phần tử vào mảng
$fruits[] = 'lemon';
// print_r($fruits);


/**
 * Mảng kết hợp (Associative Arrays)
 */
$person = [
    'name' => 'John Doe',
    'age' => 30,
    'city' => 'New York'
];
// print_r($person);

// Truy cập phần tử trong mảng
// PHP_EOL là một hằng số đại diện cho ký tự xuống dòng phù hợp với hệ điều hành đang chạy.
// echo $person['name'] . PHP_EOL;
// echo $person['age'] . PHP_EOL;
// echo $person['city'] . PHP_EOL;


/**
 * Mảng đa chiều (Multidimensional Arrays)
 */
$array = [
    [1, 2, 3],
    'student' => [
        'name' => 'John Doe',
        'age' => 20
    ],
    [
        'a' => [1, 2],
        'b' => ['c', 'd']
    ]
];

// truy xuất phần tử
// print_r($array['student']['name']);
// print_r($array[1]['b'][0]);

// thêm phần tử
// $array[1]['b'][] = '3';
// $array[1]['b'][] = $person = [
//     'name' => 'John Doe',
//     'age' => 30,
//     'city' => 'New York'
// ];
// print_r($array);

foreach ($array as $key => $value) {
    echo "KEY: $key" . PHP_EOL;
    // print_r($value);

    foreach ($value as $key2 => $value2) {
        echo "KEY2: $key2" . PHP_EOL;
        print_r($value2);
    }
}
