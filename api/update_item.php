<?php

require 'conf/init.php';

$id = $_POST['id'];
$category_id = $_POST['category_id'];

// $sql = "UPDATE categories SET `name` = :name WHERE `id` = :id";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['name' => $name, 'id' => $id]);

$sql = "UPDATE items SET `category_id` = '$category_id' WHERE `id` = $id";
$pdo->query($sql);

echo json_encode([
    'success' => true
]);