<?php

echo '<pre>';

// Bài tập 1: Tìm tổng của các số từ 1 đến 100, nhưng dừng lại khi tổng vượt quá 1000
// Viết một đoạn mã PHP sử dụng vòng lặp for để tính tổng của các số từ 1 đến 100. 
// Nếu tổng vượt quá 1000, sử dụng break để dừng vòng lặp và in ra giá trị của tổng tại thời điểm đó.

/*
$sum = 0;

for ($i = 1; $i <= 100; $i++) {

    $sum += $i;

    if ($sum > 1000) {
        echo "Tổng vượt quá 1000 tại giá trị: $sum với số $i";
        break;
    }

    echo "Duyệt số $i <br>";
}
*/

// Bài tập 2: Tính tổng các số lẻ từ 1 đến 20, bỏ qua các số chẵn
// Viết một đoạn mã PHP sử dụng vòng lặp for để tính tổng các số lẻ từ 1 đến 20. 
// Sử dụng continue để bỏ qua các số chẵn.

$sum = 0;

for ($i = 1; $i <= 20; $i++) {

    if ($i % 2 == 0) {
        continue;
    }

    echo "Duyệt số lẻ $i <br>";

    $sum += $i;
}

echo "Tổng các số lẻ từ 1 đến 20: $sum";