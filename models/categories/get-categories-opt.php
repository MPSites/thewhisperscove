<?php 

header('Content-Type: application/json');

require_once '../../config/connect.php';

$cats = executeQuery("SELECT * FROM categories");
echo json_encode($cats);