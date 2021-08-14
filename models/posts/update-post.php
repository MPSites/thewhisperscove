<?php

header('Content-Type: application/json');

if(isset($_POST['post_id'],$_POST['title'],$_POST['content'],$_POST['category'])){
    
    require_once '../../config/connect.php';

    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];


    if($category == "0"){
        echo json_encode(["msg"=> "Your must choose the post's category!"]);
        die();
    } else {


        $sql = "UPDATE posts SET title = :title, content = :content WHERE post_id = :id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":id", $post_id);

        try {

            $insert = $stmt->execute();

            $sql = "UPDATE category_post SET category_id = :id WHERE post_id = :p_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $category);
            $stmt->bindParam(":p_id", $post_id);

            $insert = $stmt->execute();

            http_response_code(201);
            echo json_encode(["msg"=> "Successufully updated post!"]);

        } catch(PDOException $ex) {
            
            echo json_encode(["msg"=> 'Problem with database: ' . $ex->getMessage()]);

            include_once '../functions/functions.php';
            log_errors($ex->getMessage());

            http_response_code(500);
        }
            
    }


    
            
} else {
    http_response_code(400);
    echo json_encode(["msg"=> "Please fill the form with new values"]);
}