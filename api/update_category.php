<?php

require 'conf/init.php';

$id = $_POST['id'];
$name = $_POST['name'];

// $sql = "UPDATE categories SET `name` = :name WHERE `id` = :id";
// $stmt = $pdo->prepare($sql);
// $stmt->execute(['name' => $name, 'id' => $id]);

$sql = "UPDATE categories SET `name` = '$name' WHERE `id` = $id";
$pdo->query($sql);

echo json_encode([
    'success' => true
]);