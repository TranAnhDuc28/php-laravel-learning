<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng trực tuyến</title>
</head>

<body>
    <h1>Hệ thống đặt hàng trực tuyến</h1>

    <form method="post" action="./order.php">
        <h2>Thông tin cá nhân</h2>
        Họ và tên: <input type="text" name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Số điện thoại: <input type="text" name="phone" required><br><br>

        <h2>Chi tiết đơn hàng</h2>
        Sản phẩm:
        <select name="product">
            <option value="Laptop">Laptop</option>
            <option value="Smartphone">Smartphone</option>
            <option value="Tablet">Tablet</option>
        </select><br><br>
        Số lượng: <input type="number" name="quantity" min="1" required><br><br>

        <h2>Địa chỉ giao hàng</h2>
        Địa chỉ: <input type="text" name="address" required><br><br>

        <input type="submit" name="submit" value="Đặt hàng">
    </form>
</body>

</html>