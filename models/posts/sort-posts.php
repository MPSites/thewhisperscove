<?php
header("Content-Type: application/json");

if(isset($_POST['sort'])){
    $sort = $_POST['sort'];

    include "../../config/connect.php";

    $query = "SELECT p.*, u.username, u.avatar_img, r.role_name, c.category_name FROM posts p INNER JOIN users u ON p.user_id = u.user_id INNER JOIN roles r ON u.role_id = r.role_id INNER JOIN category_post cp on p.post_id = cp.post_id INNER JOIN categories c on cp.category_id = c.category_id";

    switch($sort){
        case "desc":
            $query .= " WHERE p.user_id = u.user_id ORDER BY post_date DESC";
            break;
        case "asc":
            $query .= " WHERE p.user_id = u.user_id ORDER BY post_date ASC";
            break;
        default :
            $query .= " WHERE c.category_id = " . $sort;
            
    }
    
    $posts = executeQuery($query);

    echo json_encode($posts);
} else {
    http_response_code(400); // Bad request
    echo json_encode(["error"=> "No sort parameter sent!"]);
}