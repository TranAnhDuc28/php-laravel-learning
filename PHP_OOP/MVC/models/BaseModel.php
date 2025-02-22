<?php

class BaseModel
{
    protected $table;
    protected $pdo;

    /**
     * Kết nối CSDL
     */
    public function __construct()
    {
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8', DB_HOST, DB_POST, DB_NAME);

        try {
            $this->pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD, DB_OPTIONS);
        } catch (PDOException $e) {
            // Xử lý lỗi kết nối
            die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage() . '. Vui lòng thử lại sau.');
        }
    }

    /**
     * Hủy kết nối CSDL
     */
    public function __destruct()
    {
        $this->pdo = null;
    }

    /**
     * Hàm lấy danh sách
     *
     * @param string $columns Mặc định lấy tất cả các cột, truyền cột phân cách nhau bằng dấu phẩy
     * @param string|null $condition Mệnh đề điều kiện có thể không có
     * @param array $paramsCondition giá trị của các tham số ảo trong $conditions
     * @return array
     *
     * Khi dùng: $obj->select('id, name', 'id > :id AND price > :price', ['id' => 3, 'price' => 36000])
     */
    public function select(string $columns = '*', ?string $condition = null, array $paramsCondition = []): array
    {
        $sql = "SELECT $columns FROM {$this->table}";

        if ($condition) {
            $sql .= " WHERE $condition";
        }

//        echo $sql . PHP_EOL;
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($paramsCondition);

        return $stmt->fetchAll();
    }


    /**
     * Lấy ra số bản ghi của 1 bảng theo điều kiện
     *
     * @param string|null $condition Mệnh đề điều kiện có thể không có
     * @param array $paramsCondition giá trị của các tham số ảo trong $conditions
     * @return int
     *
     * Khi dùng: $obj->count('id > :id', ['id' => 5])
     */
    public function count(?string $condition = null, array $paramsCondition = []): int
    {
        $sql = "SELECT COUNT(*) FROM {$this->table}";

        if ($condition) {
            $sql .= " WHERE $condition";
        }

//        echo $sql . PHP_EOL;
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($paramsCondition);

        return $stmt->fetchColumn();
    }


    /**
     * Hàm lấy danh sách có phân trang
     *
     * @param int $page Trang hiện tại
     * @param int $size Số bản ghi trên 1 trang
     * @param string $columns Mặc định lấy tất cả các cột, truyền cột phân cách nhau bằng dấu phẩy
     * @param string|null $condition Mệnh đề điều kiện đặt ở đây
     * @param array $paramsCondition giá trị của các tham số ảo trong $conditions
     * @return array
     *
     * Khi dùng: $obj->paginate(1, 3, 'id, name', 'id > :id AND price > :price', ['id' => 3, 'price' => 36000])
     */
    public function paginate(int $page = 1, int $size = 5, string $columns = '*', ?string $condition = null, array $paramsCondition = []): array
    {
        $sql = "SELECT $columns FROM {$this->table}";

        if ($condition) {
            $sql .= " WHERE $condition";
        }

        // tính lấy từ row bao nhiêu
        $offset = ($page - 1) * $size;

        // PDO không hỗ trợ trực tiếp bindParam cho LIMIT và OFFSET,
        // vì vậy ta phải sử dụng bindValue or truyền thẳng giá trị luôn cũng được.
        $sql .= " LIMIT $size OFFSET $offset";

//        echo $sql . PHP_EOL;
        $stmt = $this->pdo->prepare($sql);

        // Chỉ dùng cách này được khi KHÔNG CÓ param của limit và offset
        // Nếu có param của limit và offset thì phải dùng hàm bindParam cho từng param 1.
        $stmt->execute($paramsCondition);

        return $stmt->fetchAll();
    }

    /**
     * Hàm lấy 1 row
     *
     * @param string $columns Mặc định lấy tất cả các cột, truyền cột phân cách nhau bằng dấu phẩy
     * @param string|null $condition Mệnh đề điều kiện có thể không có
     * @param array $paramsCondition giá trị của các tham số ảo trong $conditions
     * @return array
     *
     * Khi dùng: $obj->select('id >= :id', ['id' => 5])
     */
    public function find(string $columns = '*', ?string $condition = null, array $paramsCondition = [])
    {
        $sql = "SELECT $columns FROM {$this->table}";

        if ($condition) {
            $sql .= " WHERE $condition";
        }

//        echo $sql . PHP_EOL;
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($paramsCondition);

        return $stmt->fetch();
    }

    /**
     * Hàm thêm dữ liệu
     *
     * @param array $data
     * @return int
     *
     * Khi dùng: $obj->insert([
     *                          'name' => 'Example',
     *                          'price' => 50000
     *                       ])
     */
    public function insert(array $data): int
    {
        // lấy ra tất cả key của mảng dữ liệu
        $keys = array_keys($data);

        /**
         * implode() trong PHP được sử dụng để nối các phần tử của một mảng thành một chuỗi,
         * với một ký tự phân cách tùy chọn.
         */
        $columns = implode(', ', $keys);
        $placeholders = ':' . implode(', :', $keys);

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
//        echo $sql . PHP_EOL;

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($data);

        return $this->pdo->lastInsertId();
    }

    /**
     * Hàm cập nhật dữ liệu
     *
     * @param array $data
     * @param string|null $condition Mệnh đề điều kiện
     * @param array $paramsCondition giá trị của các tham số ảo trong $conditions
     * @return int
     *
     * Khi dùng: $obj->update([
     *                          'name' => 'Example',
     *                          'price' => 50000
     *                        ], 'id = :id', ['id' => 1])
     */
    public function update(array $data, ?string $condition = null, array $paramsCondition = []): int
    {
        $keys = array_keys($data);

        $arraySets  = array_map(fn($key) => "$key = :set_$key", $keys);

        $set = implode(', ', $arraySets);

        $sql = "UPDATE {$this->table} SET {$set}";

        if ($condition) {
            $sql .= " WHERE $condition";
        }

        echo $sql . PHP_EOL;
        $stmt = $this->pdo->prepare($sql);

        /**
         * Dùng &$value trong bindParam() để đảm bảo biến có thể thay đổi.
         */
        // bindParam trong set
        foreach ($data as $key => &$value) {
            $stmt->bindParam(":set_$key", $value);
        }

        // bindParam trong where
        foreach ($paramsCondition as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }

        $stmt->execute();

        return $stmt->rowCount();
    }

    /**
     * Hàm xóa theo điều kiện
     *
     * @param string|null $condition Mệnh đề điều kiện
     * @param array $paramsCondition giá trị của các tham số ảo trong $conditions
     * @return int
     *
     * Khi dùng: $obj->delete('id = :id', ['id' = 1])
     */
    public function delete(?string $condition = null, array $paramsCondition = []): int
    {
        $sql = "DELETE FROM {$this->table}";

        if ($condition) {
            $sql .= " WHERE $condition";
        }

//        echo $sql . PHP_EOL;
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($paramsCondition);

        return $stmt->rowCount();
    }
}