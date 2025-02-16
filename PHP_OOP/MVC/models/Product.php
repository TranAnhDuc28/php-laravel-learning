<?php

class Product extends BaseModel
{
    protected $table = 'products';

    public function getTop5Latest()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC LIMIT 5";

        echo $sql . PHP_EOL;
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

}