<?php

if(isset($_SESSION['user'])){
    if($_SESSION['user']->role_id != 2){
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
?>
        <div id="acc-wrapper">
            <div class="account-sidebar">
                <div class="side-box side-avatar">

                    <?php 
                        if(isset($_SESSION['user'])) :
                            $user = $_SESSION['user'];
                    ?>

                    <img src="assets/img/user_images/<?= $user->avatar_img; ?>">
                    <span class="acc-name"><?php echo $user->first_name .  " " . $user->last_name; ?></span>
                    <span class="acc-role"><?= $user->role_name; ?></span>
                    
                        <?php endif; ?>

                </div>
                <div class="side-box acc-side-box">
                    <ul>
                        <li><a href="#" class="acc-opt" data-use="mpost" data-user_id="<?= $user->user_id ?>">My Posts</a></li>
                        <li><a href="#" class="acc-opt" data-use="npost" data-user_id="<?= $user->user_id ?>">New Post</a></li>
                        <li><a href="index.php?page=logout">Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="account-content-area">
                <div class="container">
                    <div id="acc-content">
                        
                        <!-- acc-content -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>