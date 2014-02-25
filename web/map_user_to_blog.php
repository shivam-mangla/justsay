<?php
	require('connect.php');

	if(empty($_POST) === false){
		
		$fields = array('user_id', 'blogpost_id');
		
		foreach($_POST as $key=>$value){
			if(empty($value) && in_array($key, $fields) === true){	//value of each field in the form
				$errors[] = 'Fields marked with an asterisk are required';
				break 1;
			}
		}

		// echo "got the info";//.empty($_POST).empty($errors);
		if(empty($_POST) === false && empty($errors) === true){
			echo "POSTED";
			$register_data = array(
				'user_id' 			=> 	$_POST['user_id'],
				'blogpost_id' 		=> 	$_POST['blogpost_id']
			);

			$fields = "" . implode (", ", array_keys($register_data)) . "";
			$data = "'" . implode ("', '", $register_data) . "'";
			
			$query = "INSERT INTO `blog_user_map` ($fields) VALUES ($data)";
			$result = mysql_query($query) or die($query."<br/><br/>".mysql_error());
			// echo $result;
			
			$result["status"] = 1;
			$result["message"] = "Blog mapped successfully";
			$result["error"] = $errors;
		}
		else if(empty($errors) === false){
							
			$result["status"] = -1;
			$result["message"] = "Blog mapping unsuccessful";
			$result["error"] = $errors;
		}
	}else {
		$result["status"] = -1;
		$result["message"] = "No data received";
		$result["error"] = "";
	}
?>
