<?php

$ERRMSG = "";

require './apis/connect.php';
session_start();
session_destroy();

$pdo->query("SET NAMES UTF8");
if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
	// loginchec
    header('Location: ../login/index.php');
    exit;
}else{
    $sql = "SELECT * FROM account WHERE id = '". $_SESSION['user_id'] ."'";
    foreach ($pdo->query($sql) as $row) {
        $account = $row['username'];
        $name = $row['name'];
        $permission = $row['permission'];
    }
}


?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>LCHS MEET - Build By li0122/xig1517</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<a href="index.php" class="logo"><strong>LCHS MEET</strong> <span>by li0122/xig1517</span></a>
						<nav>
							<a href="#menu">Menu</a>
						</nav>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<ul class="links">
							<li><a href="index.html">Home</a></li>
							<li><a href="landing.html">Landing</a></li>
							<li><a href="generic.html">Generic</a></li>
							<li><a href="elements.html">Elements</a></li>
						</ul>
						<ul class="actions stacked">
							<li><a href="#" class="button primary fit">Get Started</a></li>
							<li><a href="#" class="button fit">Log In</a></li>
						</ul>
					</nav>

				<!-- Banner -->
					<section id="banner" class="major">
						<div class="inner">
							<section>
								<header class="major">
									<h1 size="5">Hi!<?php echo $name;?></h1>
								</header>
								<div class="content"> <!-- 課表 -->
								</div>
							</section>
						</div>
					</section>
			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>