<?php

header('Content-Type: application/json');

if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];

    include "../../config/connect.php";

    try
    {
        $query = "SELECT u.user_id, u.username, u.first_name, u.last_name, u.email, r.role_id, r.role_name FROM users u INNER JOIN roles r ON u.role_id = r.role_id WHERE user_id = :user_id";
        $q = $conn->prepare($query);

        $q->execute(array(
            ':user_id' => $user_id
        ));

        $user_data = $q->fetchAll();
        $roles = executeQuery("SELECT * FROM roles");

        $data = array('user' => $user_data, 'roles' => $roles);

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
    echo json_encode(["error"=> "No user_id parameter sent!"]);
}