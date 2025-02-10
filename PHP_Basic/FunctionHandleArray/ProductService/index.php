<?php

echo "<pre>"; // Định hình hiển thị mảng cho rõ ràng hơn

// Danh sách sản phẩm
$products = [];

/**
 * Thêm sản phẩm mới. 
 * @param array $products
 * @param int $id
 * @param string $name
 * @param float $price
 * @return void
 */
function addProduct(&$products, $id, $name, $price)
{
    $products[] = [
        'id' => $id,
        'name' => $name,
        'price' => $price,
    ];
}

/**
 * Xóa sản phẩm theo id.
 * @param array $products
 * @param int $id
 * @return void
 */
function deleteProductById(&$products, $id)
{
    foreach ($products as $key => $product) {
        if ($product['id'] == $id) {
            unset($products[$key]);
            break;
        }
    }

    // Sắp xếp lại chỉ số mảng sau khi xóa
    $products = array_values($products);
}

/**
 * Tìm sản phẩm theo tên.
 * @param array $products
 * @param string $name
 */
function findProductByName($products, $name) {

    foreach ($products as $product) {
        if (strcasecmp($product['name'], $name) == 0) { 
            return $product;
        }
    }

    return null;

}

/**
 * Trả về danh sách tất cả sản phẩm có giá trị price lớn hơn một giá trị cho trước. 
 * @param array $products
 * @param float $minPrice
 * @return array
 */
function getProductsByMinPrice($products, $minPrice): array {
    $result = [];
    foreach ($products as $product) {
        if ($product['price'] > $minPrice) { 
            $result[] = $product;
        }
    }
    return $result;
}

/**
 * Trả về danh sách các name của sản phẩm.
 * @param array $products
 * @return array
 */
function getProductNames($products) {
    return array_column($products, 'name');
}


/**
 * Run Application 
 * */ 
// Thêm sản phẩm mới.
addProduct($products, 1, 'Laptop', 1000);
addProduct($products, 2, 'Smartphone', 800);
addProduct($products, 3, 'Tablet', 600);

echo "Danh sách sản phẩm ban đầu:\n";
print_r($products);


// Xóa sản phẩm theo id.
// deleteProductById($products, 2);
// echo "\nDanh sách sản phẩm sau khi xóa sản phẩm có ID 2:\n";
// print_r($products);


// Tìm sản phẩm theo tên.
// $product = findProductByName($products, 'tablet');
// echo "Sản phẩm đã tìm thấy với tên 'Tablet': \n";
// print_r($product);


// Trả về danh sách tất cả sản phẩm có giá trị price lớn hơn một giá trị cho trước.
// $expensiveProducts = getProductsByMinPrice($products, 700);
// echo "Danh sách sản phẩm có giá lớn hơn 700: \n";
// print_r($expensiveProducts);


// Trả về danh sách các name của sản phẩm.
$productNames = getProductNames($products);
echo "Danh sách tên các sản phẩm: \n";
print_r($productNames);