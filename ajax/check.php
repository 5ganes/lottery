<?php 
	// require '../clientobjects.php';
	// $ln = $_GET['ln'];
	// $sql = "select count(id) as countType from prize";
	// $countType = $conn->fetchArray($conn->exec($sql));
	// $countType = $countType['countType'];
	// // echo $countType; die();
	
	// $prizeId = rand(1, $countType);
	// $sql = "select count(id) from lottery where lotteryNumber='$ln' or prizeId='$prizeId'";
	// $result = $conn->fetchArray($conn->exec($sql));
	// $check = $result['count(id)'];

	// if($check>0)
	// 	echo 'No';
	// else{
	// 	$sql = "insert into lottery(id, lotteryNumber, prizeId, typeId) values('', '$ln', '$prizeId', 0)";
	// 	$conn->exec($sql);
	// 	$sql = "select "
	// 	echo 'You Won ';
	// }

	
	require '../clientobjects.php';
	$ln = $_GET['ln'];
	$sql = "select id from prize order by id ASC";
	$prizeList = [];
	$prize = $conn->exec($sql);
	while($prizeGet = $conn->fetchArray($prize)){
		$prizeList[] = $prizeGet['id'];
	}
	
	$prizeRandom = rand(0, count($prizeList)-1);
	$prizeId = $prizeList[$prizeRandom];
	$sql = "select count(id) from lottery where lotteryNumber='$ln' or prizeId='$prizeId'";
	$result = $conn->fetchArray($conn->exec($sql));
	$check = $result['count(id)'];

	if($check>0)
		echo 'No';
	else{
		$sql = "insert into lottery(id, lotteryNumber, prizeId, typeId) values('', '$ln', '$prizeId', 0)";
		$conn->exec($sql);
		$prizeTitle = $conn->fetchArray($conn->exec("select title, type from prize where id = '$prizeId'"));
		$typeId = $prizeTitle['type'];
		$prizeType = $conn->fetchArray($conn->exec("select title from type where id = '$typeId'"));
		$prizeName = $prizeTitle['title'];
		$typeName = $prizeType['title'];
		echo "<div>Prize : $prizeName ( $typeName )</div>";
	}
?>