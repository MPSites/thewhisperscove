<?php 
  
  if(isset($_GET['page'])){
    $page = $_GET['page'];
    } else {
        $page="home";
    }

?>

<nav id="main-nav">
    <div class="nav-wrapper">
        <div class="menu-icon">
            <i class="fa fa-bars fa-2x" aria-hidden="true"></i>    
        </div>
        <a href="index.php?page=home">
            <div class="head-logo">
                <span class="nav-logo"></span>
            </div>
        </a>
        <div class="nav-menu">
            <ul>
                <?php 
                include 'models/functions/get-links.php';

                $menu = get_menu();
                //print_r($menu);
                
                    foreach($menu as $link) : 
                
                ?>
                    <li class="<?php echo ($page == "$link->link_name" ? "active" : "");?>" ><a href="<?= $link->href ?>"><?= $link->link_name ?></a></li>

                    <?php endforeach; ?>
                    
                <li><a href="doc.pdf" target="_blank">Documentation</a></li>
                <?php 
                
                    if(isset($_SESSION['user'])) :
                        $user = $_SESSION['user'];
                        if($_SESSION['user']->role_id == 2) :
                ?>    
                    <li class="my-acc <?php echo ($page == "loggedin" ? "active" : "");?>"> <a href="index.php?page=user">My Account</a></li>
                    <li class="acc-nav">
                    <span>User Account:</span>
                    <span class="nav-user"><a href="index.php?page=user"><?= $user->username ?></a></span>
                    </li>
                        <?php endif; ?>
                    
                    <?php if($_SESSION['user']->role_id == 1) : ?>

                    <li class="my-acc <?php echo ($page == "loggedin" ? "active" : "");?>"> <a href="index.php?page=admin">My Account</a></li>
                    <li class="acc-nav">
                    <span>Admin Account:</span>
                    <span class="nav-user"><a href="index.php?page=admin"><?= $user->username ?></a></span>
                    </li>
                        <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

