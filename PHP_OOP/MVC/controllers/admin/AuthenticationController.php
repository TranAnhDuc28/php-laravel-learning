<?php

class AuthenticationController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }


    public function showFormLogin()
    {
        $title = "Login";
        $view = "auth/login";
        require_once PATH_VIEW_ADMIN_MAIN;
    }

    public function showFormChangePassword()
    {
        $title = "Change password";
        $view = "auth/change_password";
        require_once PATH_VIEW_ADMIN_MAIN;
    }


    public function login()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception("Request method must be POST.");
            }

            $email = $_POST["email"] ?? null;
            $password = $_POST["password"] ?? null;
            if (empty($email) || empty($password)) {
                throw new Exception("Email or password is not empty.");
            }

            $user = $this->user->find(
                '*',
                'email = :email && password = :password',
                [
                    'email' => $email,
                    'password' => $password
                ]
            );

            if (empty($user)) {
                throw  new Exception("Thông tin tài khoản không đúng!");
            }

            $_SESSION['user'] = $user;

            header('Location: ' . BASE_URL_ADMIN);
            exit();

        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

            header('Location: ' . BASE_URL_ADMIN . '&action=show-form-login');
            exit();
        }
    }

    public function logout()
    {
        /*
         * session_destroy() là một hàm trong PHP dùng để hủy toàn bộ session hiện tại của người dùng.
         * Khi gọi hàm này, tất cả các dữ liệu được lưu trong $_SESSION sẽ bị xóa khỏi server.
         */
        session_destroy();
        header('Location: ' . BASE_URL);
        exit();

    }
}