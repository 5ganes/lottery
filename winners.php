<?php
	require 'clientobjects.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lottery Game - LIONS CLUB</title>
	<?php //require 'baselocation.php';?>
	<link rel="stylesheet" type="text/css" href="css/lottery.css">
	<!-- <script type="text/javascript" src="js/lottery.js"></script> -->
	<style type="text/css">
		section article:nth-child(2) {
		    width: 71%;
		    padding: 2% 2%;
		}
	</style>
</head>
<body>
	<div class="container">
		<header>
			<div>
				<h2>Lottery Simulation Game</h2>
			</div>
			<div><div><a href="index.php">Go to Lottery System</a></div></div>
		</header>
		<section>
			<article>
				
			</article>
			<article>
				<div>
					<div id="result" style="border-radius: 10px;padding: 3% 2% 5% 3%;">
						<h2 style="font-size: 30px;">Winners' List</h2>
						<article style="padding: 0;">
							<table border="2" width="700" cellpadding="8" cellspacing="0">
								<tr>
									<th class="title" width="50">SN</th>
									<th class="title" width="100">Number</th>
									<th class="title" width="300">Prize Title</th>
									<th class="title" width="250">Prize Type</th>
								</tr>
								<?php
								$winner = $conn->exec("select * from lottery order by id ASC"); $count = 1;
								while($winnerGet = $conn->fetchArray($winner)){?>
									<tr>
										<td class="data"><?php echo $count++; ?></td>
										<td  class="data"><?php echo $winnerGet['lotteryNumber'] ?></td>
										<td class="data">
											<?php
											$prizeTitle = $conn->fetchArray($prize->getById($winnerGet['prizeId'])); echo $prizeTitle['title'];
											?>
										</td>
										<td class="data">
											<?php
											$typeTitle = $conn->fetchArray($prizeType->getById($prizeTitle['type'])); echo $typeTitle['title'];
											?>
										</td>
									</tr>
								<?php }?>
							</table>
						</article>
					</div>
				</div>
			</article>
		</section>
		<footer>
			<p>&copy;Copyright 2018. Lions Club. All Right Reserved.</p>
		</footer>
	</div>
	<input type="hidden" name="" id="count" value="0">
</body>
</html>