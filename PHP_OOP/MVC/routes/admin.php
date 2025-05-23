<?php

$action = $_GET['action'] ?? '/';

if (empty($_SESSION['user']) && !in_array($action, ['login', 'show-form-login', 'change-password'])) {
    header('Location: ' . BASE_URL_ADMIN . '&action=show-form-login');
    exit();
}

match ($action) {
    '/' => (new DashboardController())->index(),
    'test-show' => (new TestController())->show(),

    // Auth
    'show-form-login' => (new AuthenticationController())->showFormLogin(),
    'change-password' => (new AuthenticationController())->showFormChangePassword(),
    'login' => (new AuthenticationController())->login(),
    'logout' => (new AuthenticationController())->logout(),

    // CRUD User
    'users-index' => (new UserController())->index(),  // hiển thị danh sách
    'users-show' => (new UserController())->show(), // Hiển thị chi tiết theo ID
    'users-create' => (new UserController())->create(), // Hiển thị form thêm mới
    'users-store' => (new UserController())->store(), // Lưu dữ liệu thêm mới
    'users-edit' => (new UserController())->edit(), // Hiển thị form cập nhật theo ID
    'users-update' => (new UserController())->update(), // Lưu dữ liệu cập nhật theo ID
    'users-delete' => (new UserController())->delete(), // Xóa dữ liệu theo ID

    // CRUD Book
    'books-index' => (new BookController())->index(),  // hiển thị danh sách
    'books-show' => (new BookController())->show(), // Hiển thị chi tiết theo ID
    'books-create' => (new BookController())->create(), // Hiển thị form thêm mới
    'books-store' => (new BookController())->store(), // Lưu dữ liệu thêm mới
    'books-edit' => (new BookController())->edit(), // Hiển thị form cập nhật theo ID
    'books-update' => (new BookController())->update(), // Lưu dữ liệu cập nhật theo ID
    'books-delete' => (new BookController())->delete(), // Xóa dữ liệu theo ID
};