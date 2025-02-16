<?php

// import các class cần sử dụng (import tuần tự theo thự tự cần sử dụng)
use ExerciseOOP\Cart;
use ExerciseOOP\Item;

require_once './Item.php';
require_once './CartItem.php';
require_once './Cart.php';

echo '<pre>';

// create product
$item1 = new Item(1, 'MacBook Pro', 1000);
$item2 = new Item(2, 'Iphone Pro', 1500);

// hiển thị product đang có
echo 'Danh sách sản phẩm: ' . PHP_EOL;
print_r($item1);
print_r($item2);

// create cart
$cart = new Cart();
$cart->addProduct($item1, 2);
$cart->addProduct($item2, 1);
$cart->addProduct($item1, 1);

// hiển thị cart
$cart->displayCart();

// xóa sản phẩm Iphone khỏi giỏ và hiển thị giỏ sau khi xóa
$cart->removeProduct(2);
$cart->displayCart();
