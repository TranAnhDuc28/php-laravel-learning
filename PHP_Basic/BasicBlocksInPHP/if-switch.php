<?php

echo '<pre>';

// Bài tập 1: Kiểm tra Pass môn
// Viết một đoạn mã PHP yêu cầu người dùng nhập một số. Sử dụng câu lệnh if
// để kiểm tra xem có PASS môn hay không.
// Nếu >= 5 thì PASS

/*
$point = 5;

if ($point >= 5) {
    echo "PASS môn";
}
*/

// Bài tập 2: Kiểm tra số chẵn hay lẻ
// Viết một đoạn mã PHP yêu cầu người dùng nhập một số nguyên. Sử dụng câu lệnh if...else 
// để kiểm tra xem số đó là số chẵn hay số lẻ, và hiển thị kết quả.

/*
$number = 5;

if ($number % 2 == 0) {
    echo 'Số ' . $number . ' là số chẵn.';
} else {
    echo "Số $number là số lẻ.";
}
*/

// Bài tập 3: Kiểm tra độ tuổi
// Viết một đoạn mã PHP yêu cầu người dùng nhập tuổi của mình. Sử dụng câu lệnh if...else...elseif 
//  để kiểm tra và hiển thị các thông báo khác nhau dựa trên độ tuổi:
// Nếu tuổi nhỏ hơn 18, hiển thị "Bạn là thiếu niên."
// Nếu tuổi từ 18 đến 65, hiển thị "Bạn là người trưởng thành."
// Nếu tuổi lớn hơn 65, hiển thị "Bạn là người cao tuổi."

/*
$age = 25;

if ($age < 18) {
    echo 'Bạn là thiếu niên.';
} elseif ($age < 65) {
    echo 'Bạn là người trưởng thành.';
} else {
    echo 'Bạn là người cao tuổi.';
}
*/

// Bài tập 4: Xếp loại học lực
// Viết một đoạn mã PHP yêu cầu người dùng nhập điểm trung bình của một học sinh.
//     Sử dụng câu lệnh switch...case để xếp loại học lực theo thang điểm sau:

// Điểm từ 9 đến 10: "Xuất sắc."
// Điểm từ 8 đến dưới 9: "Giỏi."
// Điểm từ 6 đến dưới 8: "Khá."
// Điểm bằng 5: "Trung bình."
// Điểm dưới 5: "Yếu."

$grade = 8;

$grade = floor($grade);

echo $grade . '<br>';

switch ($grade) {
    case 10:
    case 9:
        echo 'Xuất sắc.';
        break;
    case 8:
        echo 'Giỏi.';
        break;
    case 7:
    case 6:
        echo 'Khá.';
        break;
    case 5:
        echo 'Trung bình.';
        break;
    default:
        echo 'Yếu.';
}
