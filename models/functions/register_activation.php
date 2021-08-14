<?php

session_start();

if(isset($_GET['code'])){
    $code = $_GET['code'];

    require "../../config/connect.php";

    $sql = "SELECT * FROM users WHERE active_code = :code";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":code", $code);

    $stmt->execute();

    if($stmt->rowCount() == 1){
        $user = $stmt->fetch();

        $update = $conn->prepare("UPDATE users SET active = 1 WHERE active_code = :code");
        $update->bindParam(":code", $code);
        $update->execute();

        $_SESSION['success'] = "You have successfully been activated, welcome!";

        header("Location: ../../index.php?page=login");
    } else {
        
        include_once 'functions.php';
        log_errors("WARNING: wrong activation code used!");
        
        $_SESSION['error'] = "Wrong activation code!";
        header("Location: ../../index.php?page=login");
    }
   

}