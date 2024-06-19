<?php 
	require "connection.php";
	session_start();
	
	if (isset($_SESSION['id'])) {
		header('Location: ../index.html');
	}
	
	if (isset($_POST['submitRegister'])) {
		$nis = $_POST['inputNIS'];
		$nis = (($nis >= 0) || ($nis <= 99999)) ? $nis : 0;
		$name = mysqli_real_escape_string($conn, $_POST['inputName']);
		$email = mysqli_real_escape_string($conn, $_POST['inputEmail']);
		$pass = md5($_POST['inputPassword']);
		$pass = password_hash($pass, PASSWORD_DEFAULT);
		
		$select = " SELECT * FROM tb_akun WHERE email='$email' ";
		$result = mysqli_query($conn, $select);
		
		if (mysqli_num_rows($result) > 0) {
			header('Location: ../register.html?errorCode=409');
		} else {
			$insert_profil = "INSERT INTO tb_profil(nama) VALUES('$name')";
			if (mysqli_query($conn, $insert_profil)) {
				$id_profil = mysqli_insert_id($conn);
				$insert = "INSERT INTO tb_akun(nis, email, password, id_profil) VALUES('$nis', '$email', '$pass', '$id_profil')";
				if (mysqli_query($conn, $insert)) {
					$id_akun = mysqli_insert_id($conn);
					$_SESSION['id'] = $id_akun;
					header('Location: ../index.html');
				}
			}
		}
	}
?>