<?php
    if(isset($_SESSION['user'])){
        if($_SESSION['user']->role_id != 1){
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

                    <img src="assets/img/user_images/<?= $user->avatar_img ?>">
                    <span class="acc-name"><?php echo $user->first_name . " " . $user->last_name; ?></span>
                    <span class="acc-role"><?= $user->role_name; ?></span>
                        <?php endif; ?>
                </div>
                <div class="side-box acc-side-box">
                    <ul>
                        <li><a href="#" class="acc-opt" data-use="users">Users</a></li>
                        <li><a href="#" class="acc-opt" data-use="add">Add user</a></li>
                        <li><a href="#" class="acc-opt" data-use="mpost" data-user_id="<?= $user->user_id ?>">My Posts</a></li>
                        <li><a href="#" class="acc-opt" data-use="npost" data-user_id="<?= $user->user_id ?>">New Post</a></li>
                        <li><a href="#" class="acc-opt" data-use="top">Topics</a></li>
                        <li><a href="#" class="acc-opt" data-use="ntop">Add Topic</a></li>
                        <li><a href="index.php?page=logout">Logout</a></li>
                    </ul>
                </div>
                <div class="side-box acc-users">
                    <h3 class="side-title">Users</h3>
                    <?php
                    $user_count = user_count();
                    $suffix = ($user_count != 1) ? 's' : '' ;
                    ?>
                    <ul>
                        <li>
                            We currently have <?php echo $user_count; ?> registered user<?= $suffix ?>.
                        </li>
                    </ul>
                    <h3 class="side-title">Visited pages (%)</h3>
                    <ul>
                    <?php 
                    
                        include 'views/partial/page-stats.php'; 
                        $stat = ispis_procenta();
                        foreach($stat as $item) :
                    ?>
                        <li><?= $item; ?></li>

                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="account-content-area">
                <div class="container">
                    <div id="acc-content">
                            <h1>Action area</h1>
                            <p>Place where things happen...</p>

                        
                        <!-- acc-content -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>