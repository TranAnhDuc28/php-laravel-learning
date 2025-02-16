<?php

global $pdo;
require_once './connectDB.php';

$name = "New Item";
$price = 99.99;

$sql = "INSERT INTO products (name, price) VALUES (:name, :price)";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':price', $price, PDO::PARAM_STR);

$stmt->execute();

echo "Item inserted successfully with ID: " . $pdo->lastInsertId();
