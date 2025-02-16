<?php

echo '<pre>';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // print_r($_FILES);
    // die;

    // thư mục lưu file upload
    $targetDir = 'uploads/';

    // lấy dữ liệu của avatar từ mảng 2 chiều $_FILES
    $fileAvatar = $_FILES['avatar'];
    // print_r($fileAvatar);

    // đường dẫn của file được upload
    $targetFile = $targetDir . time() . '-' . $fileAvatar['name'];
    // print_r($targetFile);

    // Cờ nhận biết upload thành công hay không, mặc định là thành công
    $uploadOk = 1;

    // kiểm ta nếu file tồn tại
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // kiểm tra kích thước file
    // 1MB = 1024KB = 1024 BYTE
    $maxSize = 5* 1024 * 1024;

    if ($fileAvatar['size'] > 500000) {
        echo "Sorry, your file is too large." . PHP_EOL;
        $uploadOk = 0;
    }
    
    // giới hạn những loại file được upload
    // lấy ra extension (đuôi file) của file
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    // echo $fileType;
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if(!in_array($fileType, $allowedTypes)) {
        echo "Xin lỗi, chỉ chấp nhận các loại file JPG, JPEG, PNG, GIF." . PHP_EOL;
        $uploadOk = 0;
    
    }

    // kiểm tra xem upload có bị lỗi không
    if($uploadOk == 0) {
        echo "Sorry, your file was not uploaded." . PHP_EOL;
    } else {
        if (move_uploaded_file($fileAvatar['tmp_name'], $targetFile)) {
            echo "File " . $fileAvatar["name"] . " đã được upload thành công." . PHP_EOL;
            echo "<img src='$targetFile' width='100px'>";
        } else {
            echo "Xin lỗi, có lỗi xảy ra khi upload file." . PHP_EOL;
        }
    }
}