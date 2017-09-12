<?php
	/************** SQL CONNECTION **************/
	
		$servername = "localhost";
		$username = "ylmm";
		$password = "udaondo1288";
		$dbname = "ylmm";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn->set_charset("utf8");

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

	/************** SQL CONNECTION **************/

	$nombre = $_POST["nombre"];
	$provincia = $_POST["provincia"];
	$email = $_POST["email"];
	$clave = $_POST["clave"];
	$imagen = "";
	$tipo = $_POST["tipo"];
	$status = 0;
	$userExist = false;
	
	
	
	$sql="SELECT * FROM user";
	$result = $conn->query($sql);
	
	while($row = $result->fetch_assoc())
	{
		if($row['email'] == $email)
		{
			$userExist = true;
		}
	}
	
	if($userExist)
	{
		echo "0";
	}
	else
	{
		$sqlBis="INSERT INTO user (nombre, email, imagen, provincia, password, tipo) VALUES ('".$nombre."', '".$email."', '".$imagen."', '".$provincia."', '".$clave."', '".$tipo."')";
		$conn->query($sqlBis);

		$id = $conn->insert_id;

		$to = $email;
		$subject = "YLMM: Gracias por registrarte";

		$message = '
		<html>
		<head>
		<title>YLMM</title>
		</head>
		<body>
		<div class="width: 600px; margin: 0; padding: 0; background-color: #c9d5ea;">
		<p>Mensaje de bienvenida</p>
		</div>
		</body>
		</html>
		';

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <no-replay@ylmm.com.ar>' . "\r\n";

		mail($to,$subject,$message,$headers);

		echo $id;
	}

	$conn->close();
?>