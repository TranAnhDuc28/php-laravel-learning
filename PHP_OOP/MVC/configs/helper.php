<?php

// hàm để gỡ lỗi
if(!function_exists('debug')) {
    function debug($data)
    {
        echo '<pre>';
        print_r($data);
        die;
    }
}

// hàm upload file
if(!function_exists('upload_file')) {
    function upload_file($folder, $file)
    {
        $targetFile = $folder . '/' . time() . '_' . $file['name'];

        /**
         * Hàm move_uploaded_file() được sử dụng để di chuyển tệp đã tải lên từ thư mục tạm
         * sang thư mục đích trên server.
         * Cú pháp: move_uploaded_file(string $from, string $to): bool
         *  Trong đó:
         *      $from: Đường dẫn tạm thời của tệp tải lên ($_FILES['file']['tmp_name']).
         *      $to: Đường dẫn đích muốn lưu tệp.
         *      Trả về true nếu thành công, false nếu thất bại.
         */

        if (move_uploaded_file($file['tmp_name'], PATH_ASSETS_UPLOADS . $targetFile)) {
            return $targetFile;
        }

        throw new Exception('Upload file failed');
    }
}