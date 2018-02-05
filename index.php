<?php
	require 'clientobjects.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lottery Game - LIONS CLUB</title>
	<?php require 'baselocation.php';?>
	<link rel="stylesheet" type="text/css" href="css/lottery.css">
	<script type="text/javascript" src="js/lottery.js"></script>
</head>
<body>
	<div class="container">
		<header>
			<h2>Lottery Simulation Game</h2>
		</header>
		<section>
			<article>
				<h2>Start Lottery</h2>
				<a href="#" id="start"><img src="images/start.png"></a>

				<div class="reset">
					<h2>Reset Lottery</h2>
					<a href="#" id="reset"><img style="width: 140px;" src="images/reset.png"></a>
				</div>
			</article>
			<article>
				<div>
					<img id="load" src="images/loading.gif">
				</div>
				<div>
					<div id="result"></div>
				</div>
			</article>
		</section>
		<footer>
			<p>© Copyright 2018. Lions Club. All Right Reserved.</p>
		</footer>
	</div>
</body>
</html>