<?php
	$email = $_POST['email'];
	$clave = $_POST['clave'];
	
	$claveOk;
	$uId;
	$uTipo;
	$uNombre;
	$uFoto;
	
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
	
	$sql="SELECT * FROM user WHERE email = '".$email."'";
				
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc())
	{
		$uId = $row['id'];
		$uTipo = $row['tipo'];
		$uNombre = $row['nombre'];
		$uFoto = $row['imagen'];
		
		$claveOk = $row['password'];
	}
	
	if($clave == $claveOk)
	{
		echo $uId."*".$uTipo."*".$uNombre."*".$uFoto;
	}
	else
	{
		echo "0";
	}
?>