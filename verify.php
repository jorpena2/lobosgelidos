<!DOCTYPE html>

<html>

	<body>

		<?php

			$servername = "localhost";
			$username = "root";
			$pass = "shellingford";
			$dbname = "Lobos_gelidos";

			$name = $_POST["name"];
			$surname = $_POST["surname"];
			$nickname = $_POST["nickname"];
			$password = $_POST["password"];
			$email = $_POST["email"];

			$conn = new mysqli($servername, $username, $pass, $dbname);

			if($conn->connect_error){
				die("Connection failed: " . $conn->connect_error); # Connection error
			}

			/*

			$sql = "INSERT INTO Users (Nombre, Apellidos, Nick, Email, Password) VALUES ('$name', '$surname', '$nickname', '$password', '$email')";

			
			if ($conn->query($sql) === TRUE) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}*/

			$sth = $conn -> prepare('INSERT INTO Users (Name, Surname, Username, Email, Password) VALUES (?, ?, ?, ?, ?)');
			$sth -> bind_param("sssss", $name, $surname, $nickname, $password, $email);
			$sth -> execute();

			echo $name;
			echo $surname;
			echo $nickname;
			echo $password;
			echo $email;

			$conn -> close();

		?>

	</body>

</html>