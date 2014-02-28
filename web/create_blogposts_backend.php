<?php
	require('connect.php');
	if(empty($_POST) === false){
		
		$fields = array('title', 'description', 'tags');
		
		foreach($_POST as $key=>$value){
			if(empty($value) && in_array($key, $fields) === true){	//value of each field in the form
				$errors[] = 'Fields marked with an asterisk are required';
				break 1;
			}
		}

		// echo "got the info";//.empty($_POST).empty($errors);
		if(empty($_POST) === false && empty($errors) === true){
			// echo "POSTED";
			$register_data = array(
				'title' 			=> 	$_POST['title'],
				'description' 		=> 	$_POST['description'],
				'timestamp' 		=> 	time(),
				'tags'				=> 	$_POST["tags"],
				'likes'				=> 	0
			);

			$fields = "" . implode (", ", array_keys($register_data)) . "";
			$data = "'" . implode ("', '", $register_data) . "'";
			
			$query = "INSERT INTO blogposts ($fields) VALUES ($data)";
			$res = mysql_query($query) or die($query."<br/><br/>".mysql_error());
			// echo $result;
			
			$result["status"] = 1;
			$result["message"] = "Blog posted successfully";
			$result["error"] = $errors;
			$result = json_encode($result);
			echo $result;
		}
		else if(empty($errors) === false){
							
			$result["status"] = -1;
			$result["message"] = "Blog post unsuccessful";
			$result["error"] = $errors;
			$result = json_encode($result);
			echo $result;
		}
	}else {
		$result["status"] = -1;
		$result["message"] = "No data received";
		$result["error"] = "";
		$result = json_encode($result);
		echo $result;
	}
?>
