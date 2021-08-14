<?php

header("Content-Type: application/json");

if(isset($_GET['limit'])){
    require_once "../../config/connect.php";
    include "../functions/functions.php";

    $limit = $_GET['limit'];
    $posts = get_posts($limit);
    $num_of_pages = get_pagination_count();

    echo json_encode([
        "posts" => $posts,
        "num_of_pages" => $num_of_pages
    ]);
} else {
    echo json_encode(["message"=> "Limit not passed."]);
    http_response_code(400);
}