<?php

class BookController
{

    protected $book;
    protected $category;

    public function __construct()
    {
        $this->book = new Book();
        $this->category = new Category();
    }

    /**
     * Hiển thị danh sách
     *
     * @return void
     */
    public function index()
    {
        // màn hình hiển thị
        $view = 'books/index';

        // tiêu đề hiển thị
        $title = 'Danh sách Book';

        $data = $this->book->getAll();

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

            $book = $this->book->getById($id);

            if (empty($book)) {
                throw new Exception("Book có ID = $id không tồn tại.");
            }

            // màn hình hiển thị
            $view = 'books/show';

            // tiêu đề hiển thị
            $title = 'Chi tiết Book có ID = ' . $id;

            require_once PATH_VIEW_ADMIN_MAIN;
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

            header('Location: ' . BASE_URL_ADMIN . '&action=books-index');
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
        $view = 'books/create';
        $title = 'Thêm mới Book';

        $categories = $this->category->select();
        /*
         * array_column() trong PHP được sử dụng để trích xuất một cột cụ thể từ một mảng nhiều chiều (mảng chứa các mảng con).
         *
         * Cú pháp: array_column(array $array, string|int|null $column_key, string|int|null $index_key = null): array
         * Trong đó:
         *      + $array: Mảng đầu vào (mảng chứa các mảng con).
         *      + $column_key: Tên hoặc chỉ mục của cột muốn lấy ra.
         *      + $index_key (tùy chọn): Tên hoặc chỉ mục để sử dụng làm key trong mảng kết quả.
         */
        $categoryPluck = array_column($categories, 'name', 'id');

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
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception('Yêu cầu phương thức phải là POST');
            }

            // merge dữ liệu gửi lên và dữ liệu file thành 1 mảng
            $data = $_POST + $_FILES;
//            debug($data);

            // nơi lưu lỗi giá trị
            $_SESSION['errors'] = [];

            // validate data
            // title
            if (empty($data['title']) || strlen($data['title']) > 150) {
                $_SESSION['errors']['title'] = 'Trường title bắt buộc và độ dài không quá 150 ký tự.';
            }

            // category
            if (!empty($data['category_id'])) {
                if (!is_numeric($data['category_id']) || $data['category_id'] < 0) {
                    $_SESSION['errors']['category_id'] = 'ID category không hợp lệ.';
                }

                $category = $this->category->find('*', 'id = :id', ['id' => $data['category_id']]);

                if (empty($category)) {
                    throw new Exception("User có ID = {$data['category_id']} không tồn tại!");
                }

            }

            // author
            if (empty($data['author']) || strlen($data['author']) > 50) {
                $_SESSION['errors']['author'] = 'Trường author bắt buộc và độ dài không quá 50 ký tự.';
            }

            // published_year
            if (
                empty($data['published_year']) ||
                !is_numeric($data['published_year']) ||
                $data['published_year'] < 0
            ) {
                $_SESSION['errors']['published_year'] = 'Trường published_year bắt buộc, là số và lớn hơn 0.';
            }

            // img_cover
            if ($data['img_cover']['size'] > 0) {
                if ($data['img_cover']['size'] > (2 * 1024 * 1024)) {
                    $_SESSION['errors']['img_cover'] = 'Trường img_cover có dung lượng tối đa 2MB.';
                }

                $fileType = $data['img_cover']['type'];
                $allowTypes = ['image/jpg', 'image/gif', 'image/jpeg', 'image/png'];
                if (!in_array($fileType, $allowTypes)) {
                    $_SESSION['errors']['img_cover'] = 'Xin lỗi, chỉ chấp nhận các loại file JPG, JPEG, PNG, GIF.';
                }
            }

            if (!empty($_SESSION['errors'])) {
                $_SESSION['old'] = $data;
                throw new Exception('Dữ liệu lỗi!');
            }

            if ($data['img_cover']['size'] > 0) {
                $data['img_cover'] = upload_file('books', $data['img_cover']);
            } else {
                $data['img_cover'] = null;
            }

//            debug($data);
            $rowCount = $this->book->insert($data);

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

        header('Location: ' . BASE_URL_ADMIN . '&action=books-create');
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

            $book = $this->book->getById($id);

            if (empty($book)) {
                throw new Exception("Book có ID = $id không tồn tại.");
            }

            $categories = $this->category->select();
            $categoryPluck = array_column($categories, 'name', 'id');

            $view = 'books/edit';
            $title = 'Cập nhật Book có ID = ' . $id;
            require_once PATH_VIEW_ADMIN_MAIN;
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

            header('Location: ' . BASE_URL_ADMIN . '&action=books-index');
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
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception('Yêu cầu phương thức phải là POST');
            }

            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số "id"', 99);
            }

            $id = $_GET['id'];

            $book = $this->book->find('*', 'id = :id', ['id' => $id]);

            if (empty($book)) {
                throw new Exception("Book có ID = $id không tồn tại!");
            }

            // merge dữ liệu gửi lên và dữ liệu file thành 1 mảng
            $data = $_POST + $_FILES;
//            debug($data);

            // nơi lưu lỗi giá trị
            $_SESSION['errors'] = [];

            // validate data
            // title
            if (empty($data['title']) || strlen($data['title']) > 150) {
                $_SESSION['errors']['title'] = 'Trường title bắt buộc và độ dài không quá 150 ký tự.';
            }

            // category
            if (!empty($data['category_id'])) {
                if (!is_numeric($data['category_id']) || $data['category_id'] < 0) {
                    $_SESSION['errors']['category_id'] = 'ID category không hợp lệ.';
                }

                $category = $this->category->find('*', 'id = :id', ['id' => $data['category_id']]);

                if (empty($category)) {
                    throw new Exception("User có ID = {$data['category_id']} không tồn tại!");
                }

            }

            // author
            if (empty($data['author']) || strlen($data['author']) > 50) {
                $_SESSION['errors']['author'] = 'Trường author bắt buộc và độ dài không quá 50 ký tự.';
            }

            // published_year
            if (
                empty($data['published_year']) ||
                !is_numeric($data['published_year']) ||
                $data['published_year'] < 0
            ) {
                $_SESSION['errors']['published_year'] = 'Trường published_year bắt buộc, là số và lớn hơn 0.';
            }

            // img_cover
            if ($data['img_cover']['size'] > 0) {
                if ($data['img_cover']['size'] > (2 * 1024 * 1024)) {
                    $_SESSION['errors']['img_cover'] = 'Trường img_cover có dung lượng tối đa 2MB.';
                }

                $fileType = $data['img_cover']['type'];
                $allowTypes = ['image/jpg', 'image/gif', 'image/jpeg', 'image/png'];
                if (!in_array($fileType, $allowTypes)) {
                    $_SESSION['errors']['img_cover'] = 'Xin lỗi, chỉ chấp nhận các loại file JPG, JPEG, PNG, GIF.';
                }
            } else {
                $data['img_cover'] = $book['img_cover'];
            }

            if (!empty($_SESSION['errors'])) {
                $_SESSION['old'] = $data;
                throw new Exception('Dữ liệu lỗi!');
            }

            $data['updated_at'] = date('Y-m-d H:i:s');

            if (is_array($data['img_cover']) && $data['img_cover']['size'] > 0) {
                $data['img_cover'] = upload_file('books', $data['img_cover']);
            }

            $rowCount = $this->book->update($data, 'id = :id', ['id' => $id]);

            if ($rowCount > 0) {

                // kiểm tra file đã tồn tại trong folder upload thì không lưu nữa
                if ($_FILES['img_cover']['size'] > 0 &&
                    !empty($book['img_cover']) &&
                    file_exists(PATH_ASSETS_UPLOADS . $book['img_cover'])
                ) {
                    unlink(PATH_ASSETS_UPLOADS . $book['img_cover']);
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
                header('Location: ' . BASE_URL_ADMIN . '&action=books-index');
                exit();
            }
        }

        header('Location: ' . BASE_URL_ADMIN . '&action=books-edit&id=' . $id);
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

            $book = $this->book->find('*', 'id = :id', ['id' => $id]);

            if (empty($book)) {
                throw new Exception("Book có ID = $id không tồn tại.");
            }

            $rowCount = $this->book->delete('id = :id', ['id' => $id]);

            if ($rowCount > 0) {
                if (!empty($book['img_cover']) && file_exists(PATH_ASSETS_UPLOADS . $book['img_cover'])) {
                    unlink(PATH_ASSETS_UPLOADS . $book['img_cover']);
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

        header('Location: ' . BASE_URL_ADMIN . '&action=books-index');
        exit();
    }
}