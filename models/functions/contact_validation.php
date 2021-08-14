<?php

session_start();


if(isset($_POST['conName']) && isset($_POST['conEmail']) && isset($_POST['message'])){

    $name = $_POST['conName'];
    $email = $_POST['conEmail'];
    $message = $_POST['message'];

    $regexEmail = "/^\w+[.\d\w]*\@[a-z]{2,10}(\.[a-z]{2,3})+$/"; 
    $regexName = "/^[A-Z][a-z]+(([',. -][A-Z][a-z])?[a-zA-Z]*)*$/"; 

    $errors = [];

    if(!preg_match($regexName, $name)){
        $errors[] = "Name must start with uppercase";
    }

    if(!preg_match($regexEmail, $email)){
        $errors[] = "Bad email format";
    }

    if(count($errors) == 0) {
            
        $content="From: $name \n Email: $email \n Message: $message";
        $recipient = "x4blood87@gmail.com";
        $mailheader = "From: $email \r\n";
        mail($recipient, $content, $mailheader) or die("Error!");

        http_response_code(201);
        echo json_encode(["msg"=> "Successufully added user!"]);

    } else {
  
        echo json_encode(["msg"=> 'Nothing sent!']);
    }
}