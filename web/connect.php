<?php

	$connect_error = 'Sorry, we\'re experienceing connection problems';
	$host = "mysql6.000webhost.com";
	$database = "a1595368_blogs";
	$user = "a1595368_bloggy";
	$password = "root123";

	mysql_connect($host, $user, $password) or die($connect_error);
	mysql_select_db($database) or die($connect_error);
	
?>
