<?php

global $pdo;
require_once './ConnectDB.php';

$id = 4;
$sql = 'SELECT * FROM `products` WHERE id = :id';

$stmt = $pdo->prepare($sql);
//$stmt->bindParam(':id', $id);

$stmt->execute(['id' => $id]);

$result = $stmt->fetch();

echo '<pre>';
print_r($result);