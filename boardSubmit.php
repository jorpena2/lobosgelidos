<!DOCTYPE html>

<html>

	<body>

		<?php

			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["postPicture"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["postPicture"]["tmp_name"]);
			    if($check !== false) {
			        echo "File is an image - " . $check["mime"] . ".<br>";
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			}
 
			// Check file size
			if ($_FILES["postPicture"]["size"] > 5000000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["postPicture"]["tmp_name"], $target_file)) {
			        echo "The file ". basename( $_FILES["postPicture"]["name"]). " has been uploaded.<br>";

			        $servername = "localhost";
					$username = "root";
					$pass = "shellingford";
					$dbname = "Lobos_gelidos";

					$title = $_POST["postTitle"];
					$body = $_POST["postBody"];

					$conn = new mysqli($servername, $username, $pass, $dbname);

					if($conn->connect_error){
						die("Connection failed: " . $conn->connect_error); # Connection error
					}

					$sth = $conn -> prepare('INSERT INTO Board (Content, Image, Title) VALUES (?, ?, ?)');
					$sth -> bind_param("sss", $body, $target_file, $title);
					$sth -> execute();

					echo $title;
					//echo $body;
					echo $img;	

			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}

			$conn -> close();

		?>

	</body>

</html>