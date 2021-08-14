<?php

if(isset($_POST['id'])){
    $id = $_POST['id'];

    include "../../config/connect.php";
    $delete = "DELETE FROM categories WHERE category_id = :id";
    $q = $conn->prepare($delete);
    $q->execute(array(
        ':id' => $id
    ));
    $query = "SELECT * FROM categories";
    $cats = executeQuery($query);
    echo json_encode($cats);
} else {
    http_response_code(400); 
    echo json_encode(["error"=> "No category_id parameter sent!"]);
}