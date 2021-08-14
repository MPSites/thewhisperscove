<?php 

	$pages = array('home','forum', 'login', 'about', 'contact', 'post', 'register', 'admin', 'user');

	if(isset($_GET['page']) && !empty($_GET['page']) && in_array($_GET['page'], $pages)){
		$page = $_GET['page'];
	} else {
		$page="home";
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="The Whisper's Cove is meant to be a forum dedicated to the Monkey Island game series and the people around it...">
		<meta name="keywords" content="Monkey Island,lucasarts,pirates,blog,forum,review,gameplay">
		<meta name="author" content="Miloš Parezanović">
		<link rel="shortcut icon" href="assets/favicon/favicon.ico">
		<title>The Whisper's Cove</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	</head>
	<body class="<?php echo $page?>">
	<div id="site">
		<header>
			<?php include 'menu.php'; ?> 
		</header>
			<?php 
				if(isset($_GET['page']) && !empty($_GET['page'])){
					$page = $_GET['page'];
				} else {
					$page="home";
				}
				if($page == "home"){
					echo "";
				} else if(in_array($page, $pages)) {
					echo "<div class='main-banner-box'>
							<span class='page-title'>$page</span>
						</div>";
				}
			?>
		<div class="container">
			