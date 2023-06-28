<?php

require 'conf/init.php';

$id = $_POST['id'];

$sql = "DELETE FROM categories WHERE `id` = $id";
$pdo->query($sql);

echo json_encode([
    'success' => true
]);