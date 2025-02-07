<?php
$students = ['Anh', 'Đức', 'Lâm', 'An'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ví dụ foreach và HTML</title>
</head>

<body>
    <h1>Danh sách học sinh</h1>
    <ul>
        <?php foreach ($students as $student): ?>

            <!-- 2 cú pháp dưới tương đương nhau -->
            
            <li><?php echo $student ?></li>
            
            <!-- <li><? // = $student ?></li> -->

        <?php endforeach; ?>
    </ul>
</body>

</html>