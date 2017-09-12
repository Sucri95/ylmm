<?php
	$correo = $_POST['mail'];
	$clave = $_POST['clave'];
	
	$claveOk;
	$uId;
	
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
	
	$sql="SELECT * FROM usuarios WHERE email = '".$correo."'";
	
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc())
	{
		$uId = $row['id'];
		$claveOk = $row['clave'];
	}
	
	if($clave == $claveOk)
	{
		echo $uId;
	}
	else
	{
		echo "0";
	}
?>