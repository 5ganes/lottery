<?php
	require '../clientobjects.php';
	$sql = "delete from lottery";
	$conn->fetchArray($conn->exec($sql));
?>