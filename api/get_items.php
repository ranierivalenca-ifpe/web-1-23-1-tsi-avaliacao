<?php

require 'conf/init.php';

$sql = "SELECT * FROM items";
$data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data, JSON_PRETTY_PRINT);