<?php
	$conn = mysqli_connect('localhost', 'root', '', 'db_ekstrapresence') or die(mysqli_error());
 
	if(!$conn){
		die("Failed to connect");
	}
?>