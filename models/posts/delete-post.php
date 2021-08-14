<?php

if(isset($_POST['post_id']) && isset($_POST['user_id'])){
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    include "../../config/connect.php";
    $delete = "DELETE FROM posts WHERE post_id = :post_id";
    $q = $conn->prepare($delete);
    $q->execute(array(
        ':post_id' => $post_id
    ));
    $query = "SELECT p.post_id, p.title, p.post_date, c.category_name AS cat_name FROM posts p INNER JOIN category_post cp ON p.post_id = cp.post_id INNER JOIN categories c ON cp.category_id = c.category_id WHERE p.user_id ='$user_id'";
    $posts = executeQuery($query);
    echo json_encode($posts);
} else {
    http_response_code(400); 
    echo json_encode(["error"=> "No user_id parameter sent!"]);
}