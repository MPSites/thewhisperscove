<?php
 
 require_once 'config.php';

 belezi_pristup();

 try {
     $conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8",USERNAME,PASSWORD);
     $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $ex){
        
        echo "Something went wrong!";

    }
    
    function executeQuery($query){
        global $conn;
        return $conn->query($query)->fetchAll();
    }

    function executeQueryOneRow($query){
        global $conn;
        return $conn->query($query)->fetch();
    }

    function belezi_pristup(){
        $open = fopen(LOG_FAJL, "a");
        if($open) {
            if(empty($_SESSION['user'])){
                $user = "Guest";
            }
            else {
                $user = $_SESSION['user']->username;
            }
            $date = date('d-m-Y H:i:s');
            fwrite($open, "{$_SERVER['PHP_SELF']}\t{$user}\t{$date}\t{$_SERVER['REMOTE_ADDR']}\t\n");
            fclose($open);
        }
    }

?>