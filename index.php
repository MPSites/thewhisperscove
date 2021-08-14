<?php

include 'config/init.php';
include 'views/fixed/header.php';

if (isset($_GET['page'])){
    switch ($_GET['page']){
    case "home": include "views/pages/home.php";
    break;
    case "forum": include "views/pages/forum.php";
    break;
    case "post": include "views/pages/post.php";
    break;
    case "login": include "views/partial/login.php";
    break;
    case "register": include "views/partial/register.php";
    break;
    case "user": include "views/pages/user.php";
    break;
    case "admin": include "views/pages/admin.php";
    break;
    case "logout": include "views/partial/logout.php";
    break;
    case "about": include "views/pages/about.php";
    break;
    case "contact": include "views/pages/contact.php";
    break;
    default : include "views/pages/home.php";
    break;
    }
}   else {
        include "views/pages/home.php";
    }

include 'views/fixed/footer.php';

?>	
	
		
			
