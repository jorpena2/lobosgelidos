<!--
	Developed by: Jorge Peris a.k.a. Raspo
				  						-->

<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Lobos gélidos</title>
		<link rel="icon" type="image/png" href="favicon.ico">
		<link rel="stylesheet" type="text/css" href="styleIndex2.css">
		<script src="bower_components/angular/angular.min.js"></script>
		<script src="bower_components/lodash/dist/lodash.min.js"></script>
		<script src="bower_components/moment/min/moment.min.js"></script>
	</head>

	<body>

		<header>

				<div id="login">

					<form method="post" action="login.php">

					</form>

				</div>

				<div id="wowlogo">
					<a href="index.html">
						<img src="legionlogo.png">
					</a>
				</div>

				<div id="title">

					<h1>LOBOS GÉLIDOS</h1>

				</div>
			</div>

		</header>

		<div id="body">

			<nav id="navigation">
				
				<ul>
					<li><a href="index.html">Inicio</a></li 
					><li><a href="roster.html">Nosotros</a></li
					><li><a href="progress.html">Progreso</a></li
					><li><a href="join.html">¡Únete!</a></li>
				</ul>

			</nav>

			<div id="board">

				<h2>¡Bienvenidos a la página oficial de Lobos Gélidos!</h2>

				<p>Somos una hermandad española de los servidores Minahonda-Éxodar de World of Warcraft. Nacida a finales de la expansión Warlords of Draenor, comenzamos a raidear en Legion, en la banda
				Pesadilla Esmeralda. Actualmente, contamos con un roster de al rededor de 17 personas fijas y seguimos buscando gente para poder comenzar con el Bastión Nocturno en dificultad Mítica. Si estás interesad@ en formar parte de nuestra increíble familia, no dudes en ponerte en contacto con nosotros desde <a href="join.html">¡Únete!</a></p>

				<br>

				<br>

				<h3>Novedades</h3>

				<?php

					session_start();

					$servername = "localhost";
					$username = "root";
					$pass = "shellingford";
					$dbname = "Lobos_gelidos";

					$conn = new mysqli($servername, $username, $pass, $dbname);

					if ($conn->connect_error) {
					    die("Connection failed: " . $conn->connect_error);
					} 
/*
					function login_verify($user, $password, &$result){
						$sql = "SELECT * FROM Users WHERE Username = '?' and Password = '?'";
						$sth -> bind_param("ss", $user, $password);
						$result = $sth -> execute();
						$count = 0;

						while ($row = $result->fetch_assoc()){
							$count++;
							$result = $row;
						}
						if($count == 1)
							return 1;
						else
							return 0;
					}

					if(!isset($_SESSION['userid']))
					{
					    if(isset($_POST['login']))
					    {
					        if(verificar_login($_POST['user'],$_POST['password'],$result) == 1)
					        {
					            $_SESSION['userid'] = $result->idusuario;
					            header("location:index.php");
					        }
					        else
					        {
					            echo '<div class="error">Su usuario es incorrecto, intente nuevamente.</div>';
					        }
					    }
					}*/


					$sql = "SELECT * FROM Board ORDER BY Timestamp DESC";

					$result = $conn->query($sql);

					if($result -> num_rows > 0){

						while($row = $result->fetch_assoc()){

							echo "<hr><br>";

							echo "<h4>";
							echo $row['Title'];
							echo "</h4>";

							/*echo "<span class='delete'><a onclick='confirmation(".$row['Id'].")' >
							<img src='delete_64.png'></a></span>";*/

							echo "<span class='delete'>
							<img onclick='confirmation(".$row['Id'].")' src='delete_64.png'></span>";

							echo "<p>" . $row['Timestamp'] . "</p>";
							echo "<img src='". $row['Image'] . "' class='boardImg'";

							echo "<br><p>" . $row['Content'] . "</p>";

							echo "<br>";
						}
					}

					else{
						echo "No results";
					}

					$conn -> close();

				?>

			</div>		

		</div>

		<span id="bordSpan">

			<div id="form">

				<form method="post" name="boardForm" action="boardSubmit.php" enctype="multipart/form-data">
					Título de la entrada:<br>
					<input type="text" name="postTitle" maxlength="100"><br>
					Texto:<br>
					<textarea name="postBody" rows="10" cols="70" style="resize: none"></textarea><br> <!-- Wysiwyg -->
					Imagen:<br>
					<input type="file" id="postPicture" name="postPicture" value="Buscar..." accept="image/*"><br><br>
					<input type="submit" value="Enviar" name="submit"><br>
				</form>

			</div>

		</span>

		<script>
			
			function confirmation(id){
				var choice = window.confirm("¿Estás seguro de que quieres borrar este post?");
				if(choice){
					window.location.href = "deletePost.php?id=" + id + "";
				}
			}

		</script>


	</body>
</html>