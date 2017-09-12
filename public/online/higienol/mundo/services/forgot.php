<?php
	$correo = $_POST['mail'];
	
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
	
	function randomString()
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$randstring = '';
		for ($i = 0; $i < 6; $i++) {
			$randstring = $randstring.$characters[rand(0, strlen($characters))];
		}
		return $randstring;
	}
	
	$clave = randomString();
	
	$sql="UPDATE usuarios SET clave='$clave' where email = '".$correo."'";
	$result = $conn->query($sql);
	
	$to = $correo;
	$subject = "MUNDO HIGIENOL: Recordar clave";

	$message = '
	<html>
	<head>
	<title>MUNDO HIGIENOL</title>
	</head>
	<body>
	<p>Esta es tu nueva clave temporar de acceso: <strong>'.$clave.'</strong></p>
	<p>Al ingresar podrás setear una nueva clave.</p>
	</body>
	</html>
	';

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <mundohigienol@trenders2.com>' . "\r\n";

	mail($to,$subject,$message,$headers);
		
	echo "0";
?>