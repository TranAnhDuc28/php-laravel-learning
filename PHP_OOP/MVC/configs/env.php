<?php

define('BASE_URL', 'http://localhost:81/PHP_OOP/MVC/');
define('BASE_URL_ADMIN', 'http://localhost:81/PHP_OOP/MVC/?mode=admin');

define('PATH_ROOT', __DIR__ . '/../');
// echo PATH_ROOT; // => D:\TU_HOC\PHP_Laravel\PHP_OOP\MVC\configs/../


// views
define('PATH_VIEW_ADMIN', PATH_ROOT . 'views/admin/');
define('PATH_VIEW_CLIENT', PATH_ROOT . 'views/client/');

define('PATH_VIEW_ADMIN_MAIN', PATH_ROOT . 'views/admin/main.php');


// assets
define('BASE_ASSETS_ADMIN', BASE_URL . 'assets/admin/');
define('BASE_ASSETS_CLIENT', BASE_URL . 'assets/client/');
define('BASE_ASSETS_UPLOADS', BASE_URL . 'assets/uploads/');

define('PATH_ASSETS_UPLOADS', PATH_ROOT . 'assets/uploads/');


// controllers
define('PATH_CONTROLLER_ADMIN', PATH_ROOT . 'controllers/admin/');
define('PATH_CONTROLLER_CLIENT', PATH_ROOT . 'controllers/client/');


// models
define('PATH_MODEL', PATH_ROOT . 'models/');


// connection DB
define('DB_HOST', 'localhost');
define('DB_POST', '3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'testdb');
define('DB_OPTIONS', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_PERSISTENT => true
]);