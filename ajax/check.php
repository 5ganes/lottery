<?php 
	require '../clientobjects.php';
	$ln = $_GET['ln'];
	$sql = "select id from prize order by id ASC";
	//$prizeList = [];
	$prize = $conn->exec($sql);
	while($prizeGet = $conn->fetchArray($prize)){
		$prizeList[] = $prizeGet['id'];
	}
	
	$prizeRandom = rand(0, count($prizeList)-1);
	$prizeId = $prizeList[$prizeRandom];
	$sql = "select count(id) from lottery where lotteryNumber='$ln' or prizeId='$prizeId'";
	$result = $conn->fetchArray($conn->exec($sql));
	$check = $result['count(id)'];

	$lotteryFull = $conn->fetchArray($conn->exec("select count(id) from lottery"));
	$prizeFull = $conn->fetchArray($conn->exec("select count(id) from prize")); 

	if($lotteryFull['count(id)'] == $prizeFull['count(id)']){
		echo 'Full';
	}
	else if($check == 0){
		$sql = "insert into lottery(id, lotteryNumber, prizeId, typeId) values('', '$ln', '$prizeId', 0)";
		$conn->exec($sql);
		$prizeTitle = $conn->fetchArray($conn->exec("select title, type from prize where id = '$prizeId'"));
		$typeId = $prizeTitle['type'];
		$prizeType = $conn->fetchArray($conn->exec("select title from type where id = '$typeId'"));
		$prizeName = $prizeTitle['title'];
		$typeName = $prizeType['title'];
		echo "<div>Prize : $prizeName ( $typeName )</div>";
	}
	else{
		echo 'No';
	}
?>