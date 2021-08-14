<?php

header('Content-Type: application/json');

if(isset($_POST['post_id'])){
    $post_id = $_POST['post_id'];

    include "../../config/connect.php";
    

    try
    {
        $query = "SELECT p.*, c.category_id FROM posts p INNER JOIN category_post cp ON p.post_id = cp.post_id INNER JOIN categories c ON cp.category_id = c.category_id WHERE p.post_id = :post_id";
        $q = $conn->prepare($query);

        $q->execute(array(
            ':post_id' => $post_id
        ));

        $post_data = $q->fetchAll();
        $cat_data = executeQuery("SELECT * FROM categories");
        $data = array('post' => $post_data, 'cats' => $cat_data);
        echo json_encode($data);
    }
    catch(PDOException $ex){
        echo json_encode(['error'=> 'Problem with database: ' . $ex->getMessage()]);

        include_once '../functions/functions.php';
        log_errors($ex->getMessage());
        
        http_response_code(500);
    }
    
} else {
    http_response_code(400); 
    echo json_encode(["error"=> "No post_id parameter sent!"]);
}