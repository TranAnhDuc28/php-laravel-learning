<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống</title>
</head>

<body>
    <h2>Đăng nhập hệ thống</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;">
            <?= $_SESSION['error'] ?>
        </p>
    <?php
        unset($_SESSION['error']);
        endif;
    ?>

    <form method="post" action="login.php">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        Remember Me: <input type="checkbox" name="remember_me"><br><br>
        <input type="submit" value="Đăng nhập">
    </form>
</body>

</html>