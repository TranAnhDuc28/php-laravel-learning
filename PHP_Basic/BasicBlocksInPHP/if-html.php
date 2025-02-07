<?php
$isLoggedIn = true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ví dụ if và HTML</title>
</head>

<body>
    <?php if ($isLoggedIn): ?>
        <h1>Chào mừng, bạn đã đăng nhập!</h1>
    <?php else: ?>
        <h1>Vui lòng đăng nhập để xem trang này!</h1>
    <?php endif; ?>
</body>

</html>