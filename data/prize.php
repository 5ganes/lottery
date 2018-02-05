<?php
class Prize{
	
	function save($id, $title, $type, $description, $onDate, $publish, $weight){
		global $conn;
		
		$id = cleanQuery($id);
		$title = cleanQuery($title);
		$type = cleanQuery($type);
		$description = cleanQuery($description);
		$publish = cleanQuery($publish);
		$weight = cleanQuery($weight);
		
		if($id > 0)
		$sql = "UPDATE prize
						SET
							title = '$title',
							type = '$type',
							description='$description',
							publish = '$publish',
							weight = '$weight'
						WHERE
							id = '$id'";
		else
		$sql = "INSERT INTO prize 
						SET
							title = '$title',
							type = '$type',
							description='$description',
							publish = '$publish',
							weight = '$weight',
							onDate = NOW()";
		// echo $sql; die();
		$conn->exec($sql);
		if($id > 0)
			return $conn -> affRows();
		return $conn->insertId();
	}
	
	function saveImage($id){
		global $conn;
		global $_FILES;
		
		if ($_FILES['image']['size'] <= 0)
			return;
		
		$id = cleanQuery($id);
		$filename = $_FILES['image']['name'];
		
		/*$ext = end(explode(".", $filename));
		$image = $id . "." . $ext;*/
		$image = $filename;
		
		copy($_FILES['image']['tmp_name'], "../". CMS_GROUPS_DIR . $image);
		
		$sql = "UPDATE prize SET image = '$image' WHERE id = '$id'";
		$conn->exec($sql);
	}
	
	function getById($id){
		global $conn;

		$id = cleanQuery($id);

		$sql = "SElECT * FROM prize WHERE id = '$id'";
		$result = $conn->exec($sql);
		
		return $result;
	}
	
	function updateImage($id, $image){
		global $conn;
		
		$id = cleanQuery($id);
		$image = cleanQuery($image);
		
		$sql = "UPDATE diary SET image = '$image' WHERE id = '$id'";
		$conn->exec($sql);
	}
	
	function delete($id){  
		global $conn;
		
		$id = cleanQuery($id);
		
		$result = $this->getById($id);
		$row = $conn->fetchArray($result);
		
		$file = "../" . CMS_GROUPS_DIR . $row['image'];
		
		if (file_exists($file) && !empty($row['image']))
			unlink($file);
			
		$sql = "DELETE FROM prize WHERE id = '$id'";
		$conn->exec($sql);
	}
	
	function getLastWeight(){
		global $conn;
		//$categoryId = cleanQuery($categoryId);
		
		$sql = "SElECT weight FROM prize ORDER BY weight DESC LIMIT 1";
		$result = $conn->exec($sql);
		$numRows = $conn -> numRows($result);
		if($numRows > 0){
			$row = $conn->fetchArray($result);
			return $row['weight'] + 10;
		}
		else
			return 10;
	}

	function deleteImage($id)
	{
		global $conn;
		
		$id = cleanQuery($id);
		$result = $this->getById($id);
		$row = $conn->fetchArray($result);
		$image = "../". CMS_GROUPS_DIR . $row['image'];
		
		if (file_exists($image))
			unlink($image);
		
		$sql = "UPDATE prize SET image = '' WHERE id = '$id'";
		$conn->exec($sql);
	}
	
}
?>
