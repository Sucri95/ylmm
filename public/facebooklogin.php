<?php
	header("Access-Control-Allow-Origin: *");
 	mysql_connect("localhost","ylmm","udaondo1288");
 	mysql_select_db("ylmm");
 	$data = array();
	$fbid = $_POST['fbid'];
	$nombre = $_POST['nombre'];
	$imagen = $_POST['imagen'];
	$email = $_POST['email'];
	$tipo = 'persona';

  	$q=mysql_query("SELECT * FROM user WHERE email = '$email'");
  	while ($row=mysql_fetch_object($q)){
  		$data[]=$row;
  	}

  	if(count($data) > 0){

  		$q=mysql_query("SELECT * FROM user WHERE email ='$email' AND idfb='$fbid'");
		while ($row=mysql_fetch_object($q)){
			$data2[]=$row;
		}
		if(count($data2) > 0){
			$response = "login";
		}else{
			$ql=mysql_query("UPDATE user SET idfb='$fbid', nombre='$nombre', imagen='$imagen' WHERE email='$email'");
		    if($ql)
		        $response = "update";
		    else
		        $response = "error";
		}

  	}else{

  		$ql=mysql_query("INSERT INTO `user` (`idfb`,`nombre`,`email`,`imagen`,`tipo`) VALUES ('$fbid','$nombre','$email','$imagen','$tipo')");
	    if($ql)
	     	$response = "signup";
	    else
	    	$response = "error";

  	}
  	echo $response;
?>