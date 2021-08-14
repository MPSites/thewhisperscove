    <div class="form-container acc-form">
        <div class="form-inner">
            <ul class="acc-form">
                <li><h2>Contact us</h2></li>
                    <?php 
                        if(isset($_SESSION['errors'])){
                            $error = $_SESSION['error'];
                            echo ("<li class='error'>" . $error . "</li>");
                            session_destroy();
                        }
                        
                        if (isset($_SESSION['success'])){
                            $success = $_SESSION['success'];
                            echo ("<li class='errorOk'>" . $success . "</li>");
                            session_destroy();
                        } 
                    ?>
                <li><form action="" method="POST" id="post-form"></li>
                <li><input id="contact_title" type="text" placeholder="Title" required></li> 
                <li><textarea id="contact_body" placeholder="Your content goes here..." required></textarea></li>
                <li><input id="contact_email" type="email" placeholder="your@email.com" required></li> 
                <li>
                    <button id="contact_submit" type="submit" class="btn-login" onclick="validate_contact()" >Submit</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>