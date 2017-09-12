<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="images/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="images/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
	<link rel="manifest" href="images/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>YLMM</title>

	<link rel="stylesheet" type="text/css" href="public/css/general.css" />
	<link rel="stylesheet" type="text/css" href="public/css/video.css" />

	<link rel="stylesheet" type="text/css" href="public/css/my-login.css" />
	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<script type="text/javascript" src="public/js/jquery.js"></script>
	<script type="text/javascript" src="public/js/video.js"></script>
</head>
<body>

	<?php include "includes/top.php"; ?>
	

	<div class="page">
		<div class="titulo">
			<h4>Cargá tu video</h4>
			<div class="green-line center"></div>
		</div>

		<div class="main">
			<div class="registro center">
				<div class="contenedor center">
					<div class="inner">
            <div class="videothumb"></div>
            
            <div class="form-group">
                <label class="col-md-4 control-label">Nombre:</label>
                <div class="col-md-8"><input class="form-control" id="name" name="name" type="text" style="text-align: center"/></div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Mail:</label>
                <div class="col-md-8"><input class="form-control" id="name" name="name" type="text" style="text-align: center"/></div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Contraseña:</label>
                <div class="col-md-8"><input class="form-control" id="password" name="password" type="text" style="text-align: center"/></div>
            </div>
            <div class="form-group">
                <label class="col-md-5 control-label">Seleccione su foto de perfil:</label>
                <div class="col-md-7"><input class="form-control" id="profile_pic" name="profile_pic" type="file" accept="image/*" onchange="handleFiles(this.files)"/></div>
            </div>      
            <div class="form-group">
                <label class="col-md-5 control-label">Foto de Perfil:</label>
                <div class="col-md-7" id="image" ><div class=" holderjs-fluid" id="" style="color: rgb(170, 170, 170); width:190px; height: 190px; line-height: 190px; background-color: rgb(238, 238, 238);">Sin imagen</div></div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Provincia:</label>
                <div class="col-md-8"><input class="form-control" id="province" name="province" type="text" style="text-align: center"/></div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Localidad:</label>
                <div class="col-md-8"><input class="form-control" id="location" name="location" type="text" style="text-align: center"/></div>
            </div>
						<button id="guardarVideo">GUARDAR</button>			
					</div>
				</div>
				
			</div>
		</div>

	</div>


</body> 