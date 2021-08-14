<?php

header('Content-Type: application/json');

if(isset($_POST['username'],$_POST['password'],$_POST['confirm_password'],$_POST['email'],$_POST['role'])){
    
    require_once '../../config/connect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    if(strlen($password) < 6){
        echo json_encode(["msg"=> "Your password must be atleast 6 characters!"]);
        die();
    }

    if($password == $confirm_password){
        $password = md5($password);
    }else{
        echo json_encode(["msg"=> "Your password's dont match!"]);
        die();
    }

    if($role == "0"){
        echo json_encode(["msg"=> "Your must choose the user's role!"]);
        die();
    }

    $sql="SELECT * FROM users WHERE email = :email";
    $q = $conn->prepare($sql);
    $q->execute(array(
        ':email' => $email,
    ));
    $r = $q->fetch();
    
    if($r != null){
        echo json_encode(["msg"=> "That email already exists!"]);
        die();
    }    
    
    
    $sql="SELECT * FROM users WHERE username = :username";
    $q = $conn->prepare($sql);
    $q->execute(array(
        ':username' => $username,
    ));
    $r = $q->fetch();

    if($r != null){
        echo json_encode(["msg"=> "That user already exists!"]);
        die();
    } else {
        $q = $conn->prepare("INSERT INTO users (username, password, email, role_id) VALUES (:username, :password, :email, :role_id)");
            
            try 
            {
                
                $q->execute( array(
                    ':username' => $username,
                    ':password' => $password,
                    ':email' => $email,
                    ':role_id' => $role
                ));

                http_response_code(201);
                echo json_encode(["msg"=> "Successufully added user!"]);
            
            }
            catch(PDOException $ex){
                echo json_encode(["msg"=> 'Problem with database: ' . $ex->getMessage()]);

                include_once '../functions/functions.php';
                log_errors($ex->getMessage());

                http_response_code(500);
            }
    }


    
            
} else {
    http_response_code(400);
    echo json_encode(["msg"=> "Fields with * are required!"]);
}