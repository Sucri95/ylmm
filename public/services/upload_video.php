<?php
	header("Access-Control-Allow-Origin: *");
 	mysql_connect("localhost","ylmm","udaondo1288");
 	mysql_select_db("ylmm");
 	$data = array();
	$user_id = $_POST['bandaid'];
	$video_id = $_POST['videoid'];
	$titulo = $_POST['titulo'];
	$imagen = 'https://img.youtube.com/vi/'.$video_id.'/hqdefault.jpg';
	
  	$q=mysql_query("SELECT * FROM videos WHERE video_id ='$video_id'");
  	while ($row=mysql_fetch_object($q)){
  		$data[]=$row;
  	}

  	if(count($data) > 0){
  		$response = 0;
  	}else{
  		$ql=mysql_query("INSERT INTO `videos` (`user_id`,`video_id`,`titulo`,`imagen`) VALUES ('$user_id','$video_id','$titulo','$imagen')");
	    if($ql)
	     	$response = 1;
	    else
	    	$response = "error";
  	}
  	echo $response;
?>