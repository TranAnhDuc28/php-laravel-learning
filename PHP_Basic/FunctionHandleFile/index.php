<?php 

echo '<pre>';

// $isFile = is_file('FunctionHandleFile.docx');
// var_dump($isFile);

// $isDir = is_dir('uploads');
// var_dump($isDir);

// $fileExists = file_exists('uploads');
// var_dump($fileExists);

// echo getcwd();

// $scandir = scandir('uploads');
// print_r($scandir);

// $data = [
//     [
//         "class_name" => "Lớp 10A1",
//         "students" => [
//             ["name" => "Anh", "age" => 16, "score" => 8.5],
//             ["name" => "Bình", "age" => 17, "score" => 9.0],
//             ["name" => "Châu", "age" => 16, "score" => 6.5],
//             ["name" => "Dương", "age" => 17, "score" => 7.0]
//         ]
//     ],
//     [
//         "class_name" => "Lớp 10A2",
//         "students" => [
//             ["name" => "Hoàng", "age" => 16, "score" => 9.5],
//             ["name" => "Minh", "age" => 16, "score" => 5.0],
//             ["name" => "Lan", "age" => 17, "score" => 7.5],
//             ["name" => "Tùng", "age" => 16, "score" => 6.0]
//         ]
//     ]
// ];
// file_put_contents('data.json', json_encode($data));

$data = file_get_contents('data.json');
// echo $data;

print_r(json_decode($data, true)) ;