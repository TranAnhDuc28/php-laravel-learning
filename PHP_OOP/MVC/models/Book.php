<?php

class Book extends BaseModel
{
    protected $table = 'books';

    public function getAll() {
        $sql = "
            SELECT 
                b.id as b_id,
                b.title as b_title,
                b.author as b_author,
                b.img_cover as b_img_cover,
                b.published_year as b_published_year,
                b.created_at as b_created_at,
                b.updated_at as b_updated_at,
                c.id as c_id,
                c.name as c_name
            FROM books b 
            JOIN categories c ON b.category_id = c.id
            ORDER BY b.id DESC;
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * @param $id
     * @return array
     */
    public function getById($id) {
        $sql = "
            SELECT 
                b.id as b_id,
                b.title as b_title,
                b.author as b_author,
                b.img_cover as b_img_cover,
                b.published_year as b_published_year,
                b.created_at as b_created_at,
                b.updated_at as b_updated_at,
                c.id as c_id,
                c.name as c_name
            FROM books b 
            JOIN categories c ON b.category_id = c.id
            WHERE b.id = :id
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }
}