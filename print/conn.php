<?php
	$conn = new mysqli(DB_SERVER, DB_USERNAME, '', 'db_print');
	
	if(!$conn){
		die("Error: Can't connect to database");
	}
?>