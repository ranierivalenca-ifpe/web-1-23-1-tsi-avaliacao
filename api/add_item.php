<?php

require 'conf/init.php';

$name = $_POST['name'];
$description = $_POST['description'];
$category_id = $_POST['category'];

$sql = "INSERT INTO items (`name`, `description`, `category_id`) VALUES ('$name', '$description', '$category_id')";

$pdo->query($sql);
echo json_encode([
    'success' => true
]);