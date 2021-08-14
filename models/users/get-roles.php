<?php 

header('Content-Type: application/json');

require_once '../../config/connect.php';

$roles = executeQuery("SELECT * FROM roles");
echo json_encode($roles);