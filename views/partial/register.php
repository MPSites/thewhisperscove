<?php
if(isset($_POST['register'])){

    if(empty($errors) === true ){
        if(user_exists($_POST['username']) === true){
            $errors[] = 'Sorry, the username \'' . $_POST['username'] . '\' is already taken.';
        }

        if(preg_match("/\\s/", $_POST['username']) == true){
            $errors[] = 'Your username must not contain any spaces.';
        }

        if(strlen($_POST['password']) < 6){
            $errors[] = 'Your password must be atleast 6 characters.';
        }

        if($_POST['password'] != $_POST['confirm_password']){
            $errors[] = 'Your passwords do not match';
        }

        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
            $errors[] = 'A valid email address is required';
        }

        if(email_exists($_POST['email']) === true){
            $errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use';
        }

    }
}
?>

<?php

    if(empty($_POST) === false && empty($errors) === true){
        $register_data = array (
            'username' =>  $_POST['username'],
            'password' =>   $_POST['password'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' =>  $_POST['email']
        );

        register_user($register_data);
        //header('location: index.php?page=register');
        exit();
    } else {

?>
    <div class="main-content">
        <div class="form-container">
            <div class="form-inner">
                <ul>
                    <li><h2>Register</h2></li>
                    <li>Register your account</li>
                    
                    <?php 
                    if(empty($errors) === false){
                        echo output_errors($errors);
                    }
                    
                    if(isset($_GET['success']) && !empty($_GET['success'])){
                        echo "<li class='errorOk'>You've been registerd succesfully!</li>";
                    }
                    ?>
                    
                    <li><form action="" method="POST" id="reg-form"></li>
                    <li><input name="username" type="text" placeholder="Username" required></li> 
                    <li><input name="password" type="password" placeholder="Password" required></li>
                    <li><input name="confirm_password" type="password" placeholder="Confirm password" required></li>
                    <li><input name="first_name" type="text" placeholder="First name"></li>
                    <li><input name="last_name" type="text" placeholder="Last name"></li>
                    <li><input name="email" type="text" placeholder="Email address" required></li>
                    <li>
                        <button name="register" type="submit" class="btn-reg">Create account</button>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="form-inner">
                <ul>
                    <li class="line"></li>
                    <li>Having issues with your account?</li>
                    <li><a href="index.php?page=login">I already have an account, send me back to login panel.</a></li>
                </ul>
            </div>
        </div>

        <?php
        }
        ?>	
    </div>
</div>
