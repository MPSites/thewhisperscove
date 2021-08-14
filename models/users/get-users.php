<?php 

header('Content-Type: application/json');

require_once '../../config/connect.php';

$users = executeQuery("SELECT u.user_id, u.username, u.first_name, u.last_name, u.email, r.role_name FROM users u INNER JOIN roles r ON u.role_id = r.role_id");
echo json_encode($users);