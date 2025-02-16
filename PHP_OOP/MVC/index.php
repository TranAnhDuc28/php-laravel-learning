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
    print_r($fileModel);die();
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

$product = new Item();
debug($product);

// điều hướng
$mode = $_GET['mode'] ?? 'client';

if ($mode == 'admin') {
    // require đường dẫn admin
    require_once './routes/admin.php';
} else {
    // require đường dẫn client
    require_once './routes/client.php';
}