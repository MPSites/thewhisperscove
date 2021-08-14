<?php

header('Content-Type: application/json');

if(isset($_POST['user_id'],$_POST['username'],$_POST['password'],$_POST['confirm_password'],$_POST['email'],$_POST['role'])){
    
    require_once '../../config/connect.php';

    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $active = $_POST['active'];

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
    } else {

    
        $q = $conn->prepare("UPDATE users SET username = :username, password = :password, first_name = :first_name, last_name = :last_name, email = :email , role_id = :role_id, active = :active WHERE user_id = :user_id");
            
            try 
            {
                
                $q->execute( array(
                    ':user_id' => $user_id,
                    ':username' => $username,
                    ':password' => $password,
                    ':first_name' => $first_name,
                    ':last_name' => $last_name,
                    ':email' => $email,
                    ':role_id' => $role,
                    ':active' => $active
                ));

                http_response_code(201);
                echo json_encode(["msg"=> "Successufully updated user!"]);
            
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
    echo json_encode(["msg"=> "Please fill the form with new values"]);
}