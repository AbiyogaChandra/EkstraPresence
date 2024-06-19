<?php 
	require "connection.php";
	session_start();
	
	if (!(isset($_SESSION['email']))) {
		header('Location: ../index.html');
	}
	
	if (isset($_POST['submitMeet'])) {
		$date = date("Y-m-d", strtotime($_POST['meeting-date']));
		$topic = mysqli_real_escape_string($conn, $_POST['meeting-topic']);
		
		$query = "INSERT INTO tb_pertemuan(date, topic, id_ekstrakurikuler) VALUES(CAST('$date' as DATE), '$topic', '1')";
		$result = mysqli_query($conn, $query);
	}
?>