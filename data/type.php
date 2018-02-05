<?php
class Type{
	
	function save($id, $title, $publish, $weight){
		global $conn;
		
		$id = cleanQuery($id);
		$title = cleanQuery($title);
		$publish = cleanQuery($publish);
		$weight = cleanQuery($weight);
		
		if($id > 0)
		$sql = "UPDATE type
						SET
							title = '$title',
							publish = '$publish',
							weight = '$weight'
						WHERE
							id = '$id'";
		else
		$sql = "INSERT INTO type 
						SET
							title = '$title',
							publish = '$publish',
							weight = '$weight',
							onDate = NOW()";
		
		$conn->exec($sql);
		if($id > 0)
			return $conn -> affRows();
		return $conn->insertId();
	}
	
	function getById($id){
		global $conn;

		$id = cleanQuery($id);

		$sql = "SElECT * FROM type WHERE id = '$id'";
		$result = $conn->exec($sql);
		
		return $result;
	}
	
	function delete($id){  
		global $conn;
		
		$id = cleanQuery($id);
		
		$result = $this->getById($id);
		$row = $conn->fetchArray($result);
		
		$file = "../" . CMS_GROUPS_DIR . $row['image'];
		
		if (file_exists($file) && !empty($row['image']))
			unlink($file);
			
		$sql = "DELETE FROM type WHERE id = '$id'";
		$conn->exec($sql);
	}
	
	function getLastWeight(){
		global $conn;
		//$categoryId = cleanQuery($categoryId);
		
		$sql = "SElECT weight FROM type ORDER BY weight DESC LIMIT 1";
		$result = $conn->exec($sql);
		$numRows = $conn -> numRows($result);
		if($numRows > 0){
			$row = $conn->fetchArray($result);
			return $row['weight'] + 10;
		}
		else
			return 10;
	}
}
?>
