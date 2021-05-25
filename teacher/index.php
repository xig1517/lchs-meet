<?php

$ERRMSG = "";


session_start();
session_destroy();

require '../apis/connect.php';

if(isset($_POST['LOGIN']))
{
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

    $sql = "SELECT * FROM account WHERE username = :username";
	$stmt = $pdo->prepare($sql);
	
    $stmt->bindValue(':username', $username);
	$stmt->execute(); // run
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user == false){
        $ERRMSG = "帳號或密碼錯誤";
    }else{
        $validPassword = password_verify($passwordAttempt, $user['password']);
        if($validPassword){
            $_SESSION['id'] = $user['id']; //登入者id
            $_SESSION['time'] = time(); //登入時間
            $p = $user['permission']; //權限
            
            if($p == 0){
                header('Location: ../admin/index.php');
            }else if($p == 1){
                header('Location: ../teacher/index.php');
            }else{
                header('Location: ../student/index.php');
            }
            exit;
        }else{
            $ERRMSG = "帳號或密碼錯誤;";
        }
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
									<h1 size="5">501@LCHS-MEET<font size="1">(Without Li0122)</font></h1>
								</header>
								<div class="content">
								<?php echo $ERRMSG; ?>
									<form method="post" action="#">
										<div class="row gtr-uniform">
											<div class="col-6 col-12-xsmall">
												<input type="text" name="username" id="username"  placeholder="密碼" />
											</div>
											<div class="col-6 col-12-xsmall">
												<input type="password" name="password" id="password"  placeholder="密碼" />
											</div>
											<div class="col-12">
												<ul class="actions">
													<li><input type="submit" name="LOGIN" id="LOGIN" value="LOGIN" class="primary" /></li>
												</ul>
											</div>
										</div>
									</form>
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
