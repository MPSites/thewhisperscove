<?php

header('Content-Type: application/json');

if(isset($_POST['category_name'])){
    require_once '../../config/connect.php';

    $name = $_POST['category_name'];
   

    $q = $conn->prepare("INSERT INTO categories (category_name) VALUES (:name)");

    try {
        
        $q->execute(array(
            ':name' => $name
        ));

        http_response_code(201);
        echo json_encode(["msg"=> "Successufully added category!"]);
       
    }
    catch(PDOException $ex){
        echo json_encode(['error'=> 'Problem with database: ' . $ex->getMessage()]);

        include_once '../functions/functions.php';
        log_errors($ex->getMessage());
        
        http_response_code(500);
    }
} else {
    http_response_code(400);
}