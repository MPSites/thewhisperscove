<?php

header('Content-Type: application/json');

if(isset($_POST['user_id'],$_POST['category_id'],$_POST['title'],$_POST['content'])){
    require_once '../../config/connect.php';

    $user_id = $_POST['user_id'];
    $cat_id = $_POST['category_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
   

    $q = $conn->prepare("INSERT INTO posts (title, content, user_id) VALUES (:title, :content, :user_id)");



    try {
        
        if($q->execute( array(
            ':title' => $title,
            ':content' => $content,
            ':user_id' => $user_id
        )) === true){
            $last_id = $conn->lastInsertId();
        }
        $cat_post = $conn->prepare("INSERT INTO category_post (post_id, category_id) VALUES (:post_id, :category_id)");
        $cat_post->execute( array(
            ':post_id' => $last_id,
            ':category_id' => $cat_id
            
        ));

        http_response_code(201);
        echo json_encode(["msg"=> "Successufully added post!"]);
       
    }
    catch(PDOException $ex){
        echo json_encode(['error'=> 'Problem with database: ' . $ex->getMessage()]);

        include_once '../functions.php';
        log_errors($ex->getMessage());
        
        http_response_code(500);
    }
} else {
    http_response_code(400);
}