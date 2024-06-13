<?php 
	require "connection.php";
	//session_start();
	
	if (isset($_SESSION['email'])) {
		header('Location: ../index.html');
	}
	
	if (isset($_POST['submitRegister'])) {
		$nis = $_POST['inputNIS'];
		$nis = (($nis >= 0) || ($nis <= 99999)) ? $nis : 0;
		$name = mysqli_real_escape_string($conn, $_POST['inputName']);
		$email = mysqli_real_escape_string($conn, $_POST['inputEmail']);
		$pass = md5($_POST['inputPassword']);
		$pass = password_hash($pass, PASSWORD_DEFAULT);
		
		echo $nis . "<br>";
		echo $name . "<br>";
		echo $email . "<br>";
		echo $pass . "<br>";
		
		$select = " SELECT * FROM tb_akun WHERE email='$email' ";
		$result = mysqli_query($conn, $select);
		
		if (mysqli_num_rows($result) > 0) {
			
		} else {
			$insert = "INSERT INTO tbl_user(username, email, password) VALUES('$username', '$email', '$pass')";
		}
	}
?>