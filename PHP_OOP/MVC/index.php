<?php

/**
 * Hàm spl_autoload_register() trong PHP được sử dụng để tự động tải các class hoặc interface
 * khi chúng chưa được định nghĩa, giúp tránh việc phải require hoặc include thủ công.
 */

use ExerciseOOP\Item;

spl_autoload_register(function ($class) {
//    echo $class;die;

    $fileName = "$class.php";
    $fileModel = PATH_MODEL . $fileName;
    $fileControllerClient = PATH_CONTROLLER_CLIENT . $fileName;
    $fileControllerAdmin = PATH_CONTROLLER_ADMIN . $fileName;

    /**
     * is_readable() trong PHP được sử dụng để kiểm tra xem một tệp tin (file)
     * hoặc thư mục (directory) có thể đọc được hay không.
     */
    if (is_readable($fileModel)) {
        require_once $fileModel;
    } else if (is_readable($fileControllerClient)) {
        require_once $fileControllerClient;
    } else if (is_readable($fileControllerAdmin)) {
        require_once $fileControllerAdmin;
    }
});

require_once './configs/env.php';
require_once './configs/helper.php';

// điều hướng
$mode = $_GET['mode'] ?? 'client';

if ($mode == 'admin') {
    // require đường dẫn admin
    require_once './routes/admin.php';
} else {
    // require đường dẫn client
    require_once './routes/client.php';
}


$product = new Product();

/**
 * danh sách bản ghi table products
 */
$data = $product->select();
//$data = $product->select('id, name', 'id > :id AND price > :price', ['id' => 3, 'price' => 36000]);


/**
 * số bản ghi table products
 */
//$data = $product->count();
//$data = $product->count('id > :id', ['id' => 5]);


/**
 * lấy danh sách phân trang
 */
//$data = $product->paginate($_GET['page'] ?? 1);

/**
 * lấy 1 bản ghi
 */
//$data = $product->find( '*','id >= :id', ['id' => 5]);

/**
 * thêm bản ghi mới
 */
//$data = $product->insert(['name' => 'Example','price' => 50000]);

/**
 * cập nhật bản ghi
 */
//$data = $product->update(
//    [
//        'name' => 'Example2',
//        'price' => 99999
//    ],
//    'id = :id',
//    ['id' => 2]
//);


/**
 * xóa bản ghi
 */
//$data = $product->delete( 'id >= :id', ['id' => 5]);

debug($data);

