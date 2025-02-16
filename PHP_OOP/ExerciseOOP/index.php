<?php

// import các class cần sử dụng (import tuần tự theo thự tự cần sử dụng)
require_once './Product.php';
require_once './CartItem.php';
require_once './Cart.php';

echo '<pre>';

// create product
$product1 = new Product(1, 'MacBook Pro', 1000);
$product2 = new Product(2, 'Iphone Pro', 1500);

// hiển thị product đang có
echo 'Danh sách sản phẩm: ' . PHP_EOL;
print_r($product1);
print_r($product2);

// create cart
$cart = new Cart();
$cart->addProduct($product1, 2);
$cart->addProduct($product2, 1);
$cart->addProduct($product1, 1);

// hiển thị cart
$cart->displayCart();

// xóa sản phẩm Iphone khỏi giỏ và hiển thị giỏ sau khi xóa
$cart->removeProduct(2);
$cart->displayCart();
