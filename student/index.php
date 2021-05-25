<?php

$ERRMSG = "";
session_start();
require './apis/connect.php';

$pdo->query("SET NAMES UTF8");
if(!isset($_SESSION['id'])){
	// logincheck
    header('Location: ../login/index.php');
    exit;
}else{
    $sql = "SELECT * FROM account WHERE id = '". $_SESSION['id'] ."'";
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
									<h1 size="4">簽到表</h1>	
								</header>
							</section>
						</div>
					</section>
					<section id="banner" class="major">
						<div class="inner">
							<div class="table-wrapper" style="margin-left:auto;margin-right:auto;">
										<table class="alt">
											<thead style="font-weight:bold;">
												<tr>
													<th align="center">周一</th>
													<th align="center">週二</th>
													<th align="center">周三</th>
													<th align="center">週四</th>
													<th align="center">周五</th>
												</tr>
											</thead>
											<tbody style="font-weight:bold;">
												<tr>
													<td align="center">力學二</br><font size="2">戴嘉亨</font></td>
													<td align="center">班會</br><font size="2">李宜靜</font></td>
													<td align="center">英語文</br><font size="2">黃姵蓁</font></td>
													<td align="center">家政</br><font size="2">黃姵蓁</font></td>
													<td align="center">數學A</br><font size="2">吳忠福</font></td>
													</tr>
													<td align="center">物質能量</br><font size="2">李惠貞</font></td>
													<td align="center">國語文</br><font size="2">王麗月</font></td>
													<td align="center">數學A</br><font size="2">吳忠福</font></td>
													<td align="center">家政</br><font size="2">黃姵蓁</font></td>
													<td align="center">英語文</br><font size="2">黃姵蓁</font></td>
													</tr>
													<td align="center">數學A</br><font size="2">吳忠福</font></td>
													<td align="center">體育</br><font size="2">龍興強</font></td>
													<td align="center">三創學堂</br><font size="2">XXX</font></td>
													<td align="center">國語文</br><font size="2">王麗月</font></td>
													<td align="center">彈性學習</br><font size="2">XXX</font></td>
													</tr>
													<td align="center">國語文</br><font size="2">王麗月</font></td>
													<td align="center">英語文</br><font size="2">黃姵蓁</font></td>
													<td align="center">三創學堂</br><font size="2">XXX</font></td>
													<td align="center">公民</br><font size="2">曹秀蘭</font></td>
													<td align="center">彈性學習</br><font size="2">XXX</font></td>
													</tr>
													</tr>
													<td align="center"></td>
													<td align="center"></td>
													<td align="center"></td>
													<td align="center"></td>
													<td align="center"></td>
													</tr>
													<td align="center">細胞遺傳</br><font size="2">李宜靜</font></td>
													<td align="center">數學A</br><font size="2">吳忠福</font></td>
													<td align="center">國語文</br><font size="2">王麗月</font></td>
													<td align="center">資訊科技</br><font size="2">陳學剛</font></td>
													<td align="center">公民</br><font size="2">曹秀蘭</font></td>
													</tr>
													<td align="center">英語文</br><font size="2">黃姵蓁</font></td>
													<td align="center">探究B</br><font size="2">李宜靜/陳光榮</font></td>
													<td align="center">資訊科技</br><font size="2">陳學剛</font></td>
													<td align="center">彈性(數)</br><font size="2">吳忠福</font></td>
													<td align="center">音樂</br><font size="2">楊天嘉</font></td>
													</tr>
													<td align="center">音樂</br><font size="2">楊天嘉</font></td>
													<td align="center">探究B</br><font size="2">李宜靜/陳光榮</font></td>
													<td align="center">力學二</br><font size="2">戴嘉亨</font></td>
													<td align="center">體育</br><font size="2">龍興強</font></td>
													<td align="center">社團活動</br><font size="2">XXX</font></td>
													</tr>
													<td align="center">數學(輔)</br><font size="2">吳忠福</font></td>
													<td align="center">國文(輔)</br><font size="2">王麗月</font></td>
													<td align="center">英文(輔)</br><font size="2">黃姵蓁</font></td>
													<td align="center">物理(輔)</br><font size="2">戴嘉亨</font></td>
													<td align="center">社團活動</br><font size="2">XXX</font></td>
													</tr>
												</tbody>
											</table>
										</div>
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