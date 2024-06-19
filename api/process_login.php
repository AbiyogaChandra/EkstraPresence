<?php 
	require "connection.php";
	session_start();
	
	if (isset($_SESSION['id'])) {
		header('Location: ../index.html');
	}
	
	if (isset($_POST['submitLogin'])) {
		$email = mysqli_real_escape_string($conn, $_POST['inputEmail']);
		$pass = md5($_POST['inputPassword']);
		
		$select = " SELECT * FROM tb_akun WHERE email='$email' ";
		$result = mysqli_query($conn, $select);
		
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_row($result);
			if (password_verify($pass, $row[3])) {
				$id_akun = $row[0];
				$_SESSION['id'] = $id_akun;
				header('Location: ../index.html');
			} else {
				header('Location: ../login.html?errorCode=401');
			}
		} else {
			header('Location: ../login.html?errorCode=401');
		}
	}
?>