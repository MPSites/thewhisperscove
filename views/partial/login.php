<?php 

    if(isset($_POST['login'])){
        if(empty($_POST) === false){
            $email = $_POST['email'];
            $password = $_POST['password'];
    
            if(empty($email) === true || empty($password) === true){
                $errors[] = 'Please enter a email and password';
            } else if(email_exists($email) === false){
                $errors[] ='We can\'t find that email. Have you registered?';
            } else if(user_active($email) === false){
                $errors[] ='You haven\'t activated your account!';
            } else {
                
                $login = login($email,$password);
                //print_r($login);
                if($login === false){
                    $errors[] = 'That email/password combination is incorrect';
                } else {
                    $_SESSION['user'] = $login;
                    header('Location: index.php?page=home');
                    exit();
                }
            };
        } else {
            $errors[] = 'No data recevied';
        }   
    };

    
    
?>  
    <div class="main-content">
        <div class="form-container">
            <div class="form-inner">
                <ul>
                    <li><h2>Login</h2></li>
                    <li>Log in to your account</li>
                    <?php 
                
                    if(empty($errors) === false){
                        echo output_errors($errors);
                    } 

                    if(isset($_SESSION['success'])){
                        $success = $_SESSION['success'];
                        echo ("<li class='errorOk'>" . $success . "</li>");
                        session_destroy();
                    }

                    if(isset($_SESSION['error'])){
                        $error = $_SESSION['error'];
                        echo ("<li class='error'>" . $error . "</li>");
                        session_destroy();
                    }
                    
                    ?>
                    <li><form action="" method="post" id="login-form" ></li>
                    <li><input name="email" type="email" id="" class="" placeholder="Your email" autofocus></li>
                    <li><input name="password" type="password" id="" class="" placeholder="Password"></li>
                    <li>
                        <button name="login" class="btn-login" type="submit">Log in</button>
                        </form>
                    </li> 
                </ul>
            </div>
            <div class="form-inner">
                <ul>
                    <li class="line"></li>
                    <li>Don't have an account already? Click below to register.</li>
                </ul>
                <a href="index.php?page=register"><button name="register" type="submit" class="btn-reg">Register</button></a>
            </div>
        </div> 
    </div>
</div>

    
    

