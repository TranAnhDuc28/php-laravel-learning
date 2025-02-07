<?php 

echo '<pre>';

// Bài tập 1: Tính tổng các số từ 1 đến 100
// Viết một đoạn mã PHP sử dụng vòng lặp for để tính tổng các số từ 1 đến 100 và hiển thị kết quả.

/*
$sum = 0;

for ($i = 1; $i <= 100; $i++) { 
    $sum += $i;
}

echo "Tổng của các số từ 1 đến 100: ". $sum;
*/


// Bài tập 2: In các số chẵn từ 1 đến 20
// Viết một đoạn mã PHP sử dụng vòng lặp while để in ra các số chẵn từ 1 đến 20.

/*
$i = 1;

while ($i <= 20) {
    if ($i % 2 == 0) { 
        echo $i. " ";
    }
    $i++;
}
*/

// Bài tập 3: Đếm số phần tử trong mảng
// Viết một đoạn mã PHP sử dụng vòng lặp do...while để đếm số phần tử trong một mảng không sử dụng hàm count()

/*
$i = 0;
$count = 0;
$arr = ['banana', 'apple', 'tomato', 'melon', 'mango', 'cherry', 'orange'];

do {
    $count++;
    $i++;
} while ($i < sizeof($arr));

echo 'Số phần tử trong mảng: ' . $count;
*/

// Bài tập 4: Tìm số lớn nhất trong mảng
// Cho một mảng các số nguyên. Viết đoạn mã PHP sử dụng vòng lặp foreach để tìm và hiển thị số lớn nhất trong mảng.

$arrNumber = [3, 5, 7, 2, 9, 12, 1, 0];
$maxNumber = $arrNumber[0] ?? 0;

foreach ($arrNumber as $number) {

    echo "Duyệt số $number <br>";

    if ($number > $maxNumber) {
        $maxNumber = $number;
    }
}

echo 'Số lớn nhất trong mảng: ' . $maxNumber;