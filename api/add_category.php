<?php

require 'conf/init.php';

$name = $_POST['name'];

$sql = "INSERT INTO categories (`name`) VALUES ('$name')";

$pdo->query($sql);
echo json_encode([
    'success' => true
]);