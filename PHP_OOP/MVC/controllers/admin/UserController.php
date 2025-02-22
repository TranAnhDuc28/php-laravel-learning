<?php

class UserController
{

    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Hiển thị danh sách
     *
     * @return void
     */
    public function index()
    {
        // màn hình hiển thị
        $view = 'users/index';

        // tiêu đề hiển thị
        $title = 'Danh sách user';

        // lấy dữ liệu user sắp xếp theo ID giảm dần (dữ liệu mới nhất lên đầu)
        $data = $this->user->select('*', '1=1 ORDER BY id DESC');

        require_once PATH_VIEW_ADMIN_MAIN;
    }

    /**
     * Hiển thị chi tiết theo ID
     *
     * @return void
     */
    public function show()
    {
        try {
            // validate id delete
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số "id"', 99);
            }

            $id = $_GET['id'];

            $user = $this->user->find('*', 'id = :id', ['id' => $id]);

            if (empty($user)) {
                throw new Exception("User có ID = $id không tồn tại.");
            }

            // màn hình hiển thị
            $view = 'users/show';

            // tiêu đề hiển thị
            $title = 'Chi tiết User có ID = ' . $id;

            require_once PATH_VIEW_ADMIN_MAIN;
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

            header('Location: ' . BASE_URL_ADMIN . '&action=users-index');
            exit();
        }
    }

    /**
     * Hiển thị form thêm mới
     *
     * @return void
     */
    public function create()
    {
        $view = 'users/create';
        $title = 'Thêm mới User';
        require_once PATH_VIEW_ADMIN_MAIN;
    }

    /**
     * Thêm dữ liệu mới vào DB
     *
     * @return void
     */
    public function store()
    {
        try {
            if($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception('Yêu cầu phương thức phải là POST');
            }

            // merge dữ liệu gửi lên và dữ liệu file thành 1 mảng
            $data = $_POST + $_FILES;
//            debug($data);

            // nơi lưu lỗi giá trị
            $_SESSION['errors'] = [];

            // validate data
            // name
            if (empty($data['name']) || strlen($data['name']) > 50) {
                $_SESSION['errors']['name'] = 'Trường name bắt buộc và độ dài không quá 50 ký tự.';
            }

            // email
            if (
                empty($data['email']) ||
                strlen($data['email']) > 100 ||
                !filter_var($data['email'], FILTER_VALIDATE_EMAIL) ||
                !empty($this->user->find('*', 'email = :email', ['email' => $data['email']]))
            ) {
                $_SESSION['errors']['email'] = 'Trường email bắt buộc, độ dài không quá 100 ký tự và không được trùng.';
            }

            // password
            if (empty($data['password']) || strlen($data['password']) < 6 || strlen($data['password']) > 30) {
                $_SESSION['errors']['password'] = 'Trường password bắt buộc, độ dài trong khoảng từ 6 đến 30 ký tự.';
            }

            // avatar
            if ($data['avatar']['size'] > 0) {
                if ($data['avatar']['size'] > (2 * 1024 * 1024)) {
                    $_SESSION['errors']['name'] = 'Trường avatar có dung lượng tối đa 2MB.';
                }

                $fileType = $data['avatar']['type'];
                $allowTypes = ['image/jpg', 'image/gif', 'image/jpeg', 'image/png'];
                if (!in_array($fileType, $allowTypes)) {
                    $_SESSION['errors']['name'] = 'Xin lỗi, chỉ chấp nhận các loại file JPG, JPEG, PNG, GIF.';
                }
            }

            if (!empty($_SESSION['errors'])) {
                $_SESSION['old'] = $data;
                throw new Exception('Dữ liệu lỗi!');
            }

            if ($data['avatar']['size'] > 0) {
                $data['avatar'] = upload_file('users', $data['avatar']);
            } else {
                $data['avatar'] = null;
            }

            $rowCount = $this->user->insert($data);

            if ($rowCount > 0) {
                $_SESSION['success'] = true;
                $_SESSION['msg'] = 'Thao tác thành công!';
            } else {
                throw new Exception('Thao tác không thành công!');
            }

        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();
        }

        header('Location: ' . BASE_URL_ADMIN . '&action=users-create');
        exit();
    }

    /**
     * Hiển thị form cập nhật theo ID
     *
     * @return void
     */
    public function edit()
    {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số "id"', 99);
            }

            $id = $_GET['id'];

            $user = $this->user->find('*', 'id = :id', ['id' => $id]);

            $view = 'users/edit';
            $title = 'Cập nhật User có ID = ' . $id;
            require_once PATH_VIEW_ADMIN_MAIN;
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

            header('Location: ' . BASE_URL_ADMIN . '&action=users-index');
            exit();
        }
    }

    /**
     * Cập nhật dữ liệu mới vào DB theo ID
     *
     * @return void
     */
    public function update()
    {
        $id = null;

        try {
            if($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception('Yêu cầu phương thức phải là POST');
            }

            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số "id"', 99);
            }

            $id = $_GET['id'];

            $user = $this->user->find('*', 'id = :id', ['id' => $id]);

            if (empty($user)) {
                throw new Exception("User có ID = $id không tồn tại!");
            }

            // merge dữ liệu gửi lên và dữ liệu file thành 1 mảng
            $data = $_POST + $_FILES;
//            debug($data);

            // nơi lưu lỗi giá trị
            $_SESSION['errors'] = [];

            // validate data
            // name
            if (empty($data['name']) || strlen($data['name']) > 50) {
                $_SESSION['errors']['name'] = 'Trường name bắt buộc và độ dài không quá 50 ký tự.';
            }

            // email
            if (
                empty($data['email']) ||
                strlen($data['email']) > 100 ||
                !filter_var($data['email'], FILTER_VALIDATE_EMAIL) ||
                !empty($this->user->find('*', 'email = :email AND id != :id', ['email' => $data['email'], 'id' => $id]))
            ) {
                $_SESSION['errors']['email'] = 'Trường email bắt buộc, độ dài không quá 100 ký tự và không được trùng.';
            }

            // password
            if (empty($data['password']) || strlen($data['password']) < 6 || strlen($data['password']) > 30) {
                $_SESSION['errors']['password'] = 'Trường password bắt buộc, độ dài trong khoảng từ 6 đến 30 ký tự.';
            }

            // avatar
            if ($data['avatar']['size'] > 0) {
                if ($data['avatar']['size'] > (2 * 1024 * 1024)) {
                    $_SESSION['errors']['name'] = 'Trường avatar có dung lượng tối đa 2MB.';
                }

                $fileType = $data['avatar']['type'];
                $allowTypes = ['image/jpg', 'image/gif', 'image/jpeg', 'image/png'];
                if (!in_array($fileType, $allowTypes)) {
                    $_SESSION['errors']['name'] = 'Xin lỗi, chỉ chấp nhận các loại file JPG, JPEG, PNG, GIF.';
                }
            }

            if (!empty($_SESSION['errors'])) {
                $_SESSION['old'] = $data;
                throw new Exception('Dữ liệu lỗi!');
            }

            if ($data['avatar']['size'] > 0) {
                $data['avatar'] = upload_file('users', $data['avatar']);
            }

            $data['updated_at'] = date('Y-m-d H:i:s');

            $rowCount = $this->user->update($data, 'id = :id', ['id' => $id]);

            if ($rowCount > 0) {

                // kiểm tra file đã tồn tại trong folder upload thì không lưu nữa
                if ($_FILES['avatar']['size'] > 0 &&
                    !empty($user['avatar']) &&
                    file_exists(PATH_ASSETS_UPLOADS . $user['avatar'])
                ) {
                    unlink(PATH_ASSETS_UPLOADS . $user['avatar']);
                }

                $_SESSION['success'] = true;
                $_SESSION['msg'] = 'Thao tác thành công!';
            } else {
                throw new Exception('Thao tác không thành công!');
            }

        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

            if ($th->getCode() == 99) {
                header('Location: ' . BASE_URL_ADMIN . '&action=users-index');
                exit();
            }
        }

        header('Location: ' . BASE_URL_ADMIN . '&action=users-edit&id=' . $id);
        exit();
    }

    /**
     * Xóa dữ liệu theo ID
     *
     * @return void
     */
    public function delete()
    {
        try {
            // validate id delete
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số "id"', 99);
            }

            $id = $_GET['id'];

            $user = $this->user->find('*', 'id = :id', ['id' => $id]);

            if (empty($user)) {
                throw new Exception("User có ID = $id không tồn tại.");
            }

            $rowCount = $this->user->delete('id = :id', ['id' => $id]);

            if ($rowCount > 0) {
                // delete avatar user trong folder upload
                if (!empty($user['avatar']) && file_exists(PATH_ASSETS_UPLOADS . $user['avatar'])) {
                    unlink(PATH_ASSETS_UPLOADS . $user['avatar']);
                }

                // trả về msg thành công lưu trong session để hiển thị ra màn hình
                $_SESSION['success'] = true;
                $_SESSION['msg'] = 'Thao tác thành công!';
            } else {
                throw new Exception("Thao tác không thành công!");
            }
        } catch (\Throwable $th) { // bắt các ngoại lệ được throw
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();
        }

        header('Location: ' . BASE_URL_ADMIN . '&action=users-index');
        exit();
    }
}