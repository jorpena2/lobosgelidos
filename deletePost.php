<!DOCTYPE html>

<html>

	<body>

		<?php

		$id = $_GET['id'];

		$servername = "localhost";
		$username = "root";
		$pass = "shellingford";
		$dbname = "Lobos_gelidos";

		$conn = new mysqli($servername, $username, $pass, $dbname);

		if($conn->connect_error){
			die("Connection failed: " . $conn->connect_error); # Connection error
		}

		$sth = $conn -> prepare('DELETE FROM Board WHERE Id = ?');
		$sth -> bind_param("i", $id);
		$sth -> execute();

		header('Location: ' . $_SERVER["HTTP_REFERER"] );
		exit;
		?>

	</body>

</html>