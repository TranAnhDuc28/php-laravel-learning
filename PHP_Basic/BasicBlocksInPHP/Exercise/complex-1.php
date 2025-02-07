<?php

$products = [
    ['name' => 'Áo thun', 'price' => 200000, 'on_sale' => true],
    ["name" => "Quần jeans", "price" => 500000, "on_sale" => false],
    ["name" => "Giày thể thao", "price" => 700000, "on_sale" => true],
    ["name" => "Nón lưỡi trai", "price" => 150000, "on_sale" => false]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <style>
        .product {
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .on-sale {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }
    </style>
</head>

<body>

    <h1>Danh sách sản phẩm</h1>
    <div class="product-list">

        <?php foreach ($products as $product):?>
        
            <div class="product <?= $product['on_sale'] ? 'on-sale' : ''; ?> ">
                <h2><?= $product['name'] ?></h2>
                <p>Giá: <?= number_format($product['price']) ?> VND</p>

                <?php if ($product['on_sale']):?>

                    <p><strong>Sản phẩm đang giảm giá</strong></p>   
                    
                <?php endif;?>
            </div>

        <?php endforeach;?>


    </div>    

</body>

</html>