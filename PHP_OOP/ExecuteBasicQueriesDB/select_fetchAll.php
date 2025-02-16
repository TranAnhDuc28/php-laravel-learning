<?php

global $pdo;
require_once './ConnectDB.php';

$id = 4;
$sql = 'SELECT * FROM `products`';

$stmt = $pdo->prepare($sql);

$stmt->execute();

$results = $stmt->fetchAll();

echo '<pre>';
print_r($results);

foreach ($results as $row) {
    echo $row['name'] . ' - ' . $row['price'] . PHP_EOL;
}