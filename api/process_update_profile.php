<?php 
	require "connection.php";
	session_start();
	
	if (!(isset($_SESSION['id']))) {
		header('Location: ../login.html');
	}
	
	if (isset($_POST['submitProfile'])) {
		$id = $_SESSION['id'];
		if (isset($_POST['full-name'])) {
			$select = " SELECT * FROM tb_akun WHERE id='$id' ";
			$result = mysqli_query($conn, $select);
			$row = mysqli_fetch_row($result);
			
			$id_profil = $row[4];
			
			$nama = mysqli_real_escape_string($conn, $_POST['full-name']);
			$query = "UPDATE tb_profil SET nama='$nama' WHERE id='$id_profil'";
			$result = mysqli_query($conn, $query);
		}
		if (isset($_POST['ekstrakurikuler'])) {
			$query = "DELETE FROM tb_ekstra_terikut WHERE id_akun='$id' AND NOT id_ekstra IN('" . implode( "', '", $_POST['ekstrakurikuler'] ) . "')";
			$result = mysqli_query($conn, $query);
			foreach ($_POST['ekstrakurikuler'] as $ekstra) {
				$query = "DELETE FROM tb_ekstra_terikut WHERE id_akun='$id' AND id_ekstra='$ekstra'";
				$result = mysqli_query($conn, $query);
				$query = "INSERT INTO tb_ekstra_terikut(id_akun, id_ekstra) VALUES('$id', '$ekstra')";
				$result = mysqli_query($conn, $query);
			}
		}
		if (isset($_POST['password'])) {
			//$password = md5($_POST['password']);
			//$password = password_hash($password, PASSWORD_DEFAULT);
			//$query = "UPDATE tb_akun SET password='$password' WHERE id='$id'";
			//$result = mysqli_query($conn, $query);
		}
	}
	header('Location: ../pengaturan.html');
?>