<?php

header('Content-Type: application/json');

require_once '../../config/connect.php';

$posts = executeQuery("SELECT p.*, u.username, u.avatar_img, r.role_name FROM posts p INNER JOIN users u ON p.user_id = u.user_id INNER JOIN roles r ON u.role_id = r.role_id WHERE p.user_id = u.user_id");

echo json_encode($posts);