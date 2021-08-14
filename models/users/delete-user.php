<?php

header('Content-Type: application/json');

if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];

    include "../../config/connect.php";
    $delete = "DELETE FROM users WHERE user_id = :user_id";
    $q = $conn->prepare($delete);
    try{
        $q->execute(array(
        ':user_id' => $user_id
    ));

    $query = "SELECT u.user_id, u.username, u.first_name, u.last_name, u.email, r.role_name FROM users u INNER JOIN roles r ON u.role_id = r.role_id";
    $posts = executeQuery($query);
    echo json_encode($posts);
    }
    catch(PDOException $ex){
        echo json_encode(['error'=> 'Problem with database: ' . $ex->getMessage()]);

        include_once '../functions/functions.php';
        log_errors($ex->getMessage());

        http_response_code(500);
    }
    
} else {
    http_response_code(400); 
    echo json_encode(["error"=> "No user_id parameter sent!"]);
}