<?php
	/************** SQL CONNECTION **************/
	
		$servername = "localhost";
		$username = "mundo";
		$password = "udaondo1288";
		$dbname = "mundo";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		$conn->set_charset("utf8");

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

	/************** SQL CONNECTION **************/

	$nombre = $_POST["nombre"];
	$apellido = $_POST["apellido"];
	$email = $_POST["mail"];
	$clave = $_POST["clave"];
	$status = 0;
	$userExist = false;
	$initScore = 0;
	
	$sql="SELECT * FROM usuarios";
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
		$sqlBis="INSERT INTO usuarios (nombre, apellido, email, clave, creado) VALUES ('".$nombre."', '".$apellido."', '".$email."', '".$clave."', now())";
		$conn->query($sqlBis);

		$id = $conn->insert_id;
		
		$sqlTris="INSERT INTO diamanduo (uid, l1, l2, l3, l4, l5, l6, l7, l8, l9, l10, l11, l12) VALUES ('".$id."', '".$initScore."', '".$initScore."', '".$initScore."', '".$initScore."', '".$initScore."', '".$initScore."', '".$initScore."', '".$initScore."', '".$initScore."', '".$initScore."', '".$initScore."', '".$initScore."')";
		$conn->query($sqlTris);
		
		$to = $email;
		$subject = "MUNDO HIGIENOL: Gracias por registrarte";

		$message = '
		<html>
		<head>
		<title>MUNDO HIGIENOL</title>
		</head>
		<body>
		<a href="http://www.higienol.com.ar/mundohigienol/" style="border: 0;">
			<img src="http://www.trenders2.com/mundo13/images/pages/registro/mail.png" alt="Mundo Higienol - Gracias por registrarte" style="margin: 0; border: 0;" />
		</a>
		</body>
		</html>
		';

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <mundohigienol@trenders2.com>' . "\r\n";

		mail($to,$subject,$message,$headers);

		echo $id;
	}
		
	$conn->close();
?>