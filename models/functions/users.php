<?php 

function register_user($register_data){
    global $conn;
    $username = $register_data['username'];
    $password = md5($register_data['password']);
    $first_name = $register_data['first_name'];
    $last_name = $register_data['last_name'];
    $email = $register_data['email'];

    $active = 0; 

    // radjeno kao na vezbama sa primerom konstante
    define("USER_ROLE", 2);

    $role = USER_ROLE;

    // AKTIVACIONI KOD - prepisano sa vezbi
    $code = sha1(md5(md5(time().md5($email).rand(1, 10000000))));

    $sql = "INSERT INTO users (username, password, first_name, last_name, email, active, role_id, active_code) VALUES (:username, :password, :first_name, :last_name, :email, :active, :role, :code)";
    $q = $conn->prepare($sql);
    
    try{

        $q->execute(array(
            ':username' => $username,
            ':password' => $password,
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':active' => $active,
            ':role' => $role,
            ':code' => $code
        ));

        $_SESSION['success'] = "You have successfully been registered";

        // SLANJE EMAIL-a - prepisano za vezbi
       // mail($email, "Registracija", "Potvrdite registraciju: http://localhost/php1_sajt/logic/register_activation.php?code=".$code);

        // ILI AKO NE RADI MAIL, GADJATI DIREKTNO URL: 
        header("location: models/functions/register_activation.php?code=" . $code );

    }catch(PDOException $ex){
        
        include_once '../functions/functions.php';
        log_errors($ex->getMessage());
    }
    
}

function logged_in(){
    if(isset($_SESSION['user_id'])){
        return true;
    } else {
        return false;
    }
}


function user_exists($username){
    global $conn;
    $sql="SELECT * FROM users WHERE username = :username";
    $q = $conn->prepare($sql);
    $q->execute(array(
        ':username' => $username,
    ));
    $count = $q->rowCount();
    if($count == 1){
        return true;
    } else {
        return false;
    }
}

function email_exists($email){
    global $conn;
    $sql ="SELECT * FROM users WHERE email = :email";
    $q = $conn->prepare($sql);
    $q->execute(array(
        ':email' => $email
    ));
    $count = $q->rowCount();
    if($count == 1){
        return true;
    }   else {
        return false;
    }
}

function user_active($email){
    global $conn;
    $sql="SELECT * FROM users WHERE email = :email AND active = 1";
    $q = $conn->prepare($sql);
    $q->execute(array(
        ':email' => $email
    ));

    $count = $q->rowCount();
    if($count == 1){
        return true;
    } else{
        return false;
    }
}

function user_id_from_username($email){
    global $conn;
    $sql="SELECT user_id FROM users WHERE email = :email";
    $q = $conn->prepare($sql);
    $q->execute(array(
        ':email' => $email
    ));
    $r = $q->fetch();
    return $r->user_id;
}

function login($email, $password){
    global $conn;
    $user_id = user_id_from_username($email);
    $password = md5($password);

    $sql="SELECT user_id, u.username, u.first_name, u.last_name, u.email, u.role_id, u.avatar_img, r.role_name FROM users u INNER JOIN roles r ON u.role_id = r.role_id WHERE email = :email AND password = :password";
    $q = $conn->prepare($sql);
    $q->execute(array(
        ':email' => $email,
        'password' => $password
    ));

    $count = $q->rowCount();
    if($count == 1){
        $r = $q->fetch();
        return $r;
    } else{
        return false;
    }

}

function user_count(){
    $q = executeQuery("SELECT COUNT(user_id) AS count FROM users WHERE active = 1");
    return $q[0]->count;
}


function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>