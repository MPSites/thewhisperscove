<?php

define("POST_PER_PAGE", 5);

function get_categories(){
    $categories = executeQuery("SELECT * FROM categories");
    return $categories;
}

function get_posts($limit = 0){
    global $conn;
    try{
        
        $select = $conn->prepare("SELECT p.*, u.username, u.avatar_img, r.role_name FROM posts p INNER JOIN users u ON p.user_id = u.user_id INNER JOIN roles r ON u.role_id = r.role_id WHERE p.user_id = u.user_id ORDER BY p.post_date DESC LIMIT :limit, :offset");
        $limit = ((int) $limit) * POST_PER_PAGE;


        $select->bindParam(":limit", $limit, PDO::PARAM_INT); 

        $offset = POST_PER_PAGE;
        $select->bindParam(":offset", $offset, PDO::PARAM_INT);

        $select->execute(); 

        $posts = $select->fetchAll();

        return $posts;
    }
    catch(PDOException $ex){
        return null;
    }
}

function get_num_of_posts(){
    return executeQueryOneRow("SELECT COUNT(*) AS num_of_posts FROM posts");
}

function get_pagination_count(){
    $result = get_num_of_posts();
    $num_of_posts = $result->num_of_posts;

    return ceil($num_of_posts / POST_PER_PAGE);
}

function front_top(){
    $posts = executeQuery("SELECT p.*, u.username, u.avatar_img, r.role_name FROM posts p INNER JOIN users u ON p.user_id = u.user_id INNER JOIN roles r ON u.role_id = r.role_id WHERE u.role_id = 1 LIMIT 0,3");

    return $posts;
}

function log_errors($error){

    $file = fopen("../../data/error_log.txt", 'a');
    $text ="Error: " . $error . " on " . date("Y/m/d h:i:sa") . "\n";
    fwrite($file, $text);
    fclose($file);
}

