<?php 
	require "connection.php";
	session_start();
	
	if (!(isset($_SESSION['id']))) {
		header('Location: ../index.html');
	}
	
	if (isset($_POST['submitMeet'])) {
		$date = $_POST['meeting-date'];
		$time = $_POST['meeting-time'];
		$datetime = date("Y-m-d H:i:s", strtotime("$date $time"));
		$topic = mysqli_real_escape_string($conn, $_POST['meeting-topic']);
		
		$query = "INSERT INTO tb_pertemuan(datetime, topic, id_ekstrakurikuler) VALUES(CAST('$datetime' as DATETIME), '$topic', '1')";
		$result = mysqli_query($conn, $query);
	}
	
	header('Location: ../process_create_pertemuan.php');
?>