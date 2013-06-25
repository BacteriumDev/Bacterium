<?php
session_start();

// Comprueba si el usuario se ha conectado
if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
	header( "Location: bacterium_accessdenied.php" );
	exit();
}
?>
<html>
<head>
<title> Ingenieria de software </title>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1">
<link href="stylesheets/style.css" rel="stylesheet" type="text/css">
<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">

</head>

	<body>

		<div id="wrapper">
			
			<div id="loginbar" align="right">
				<a href="bacterium_hub.php" class="button">Regresar</a>
			</div>
			
			<h2>Configuraciones de usuario</h2>
			
			<div id="box-wrapper">
			  <div class="bigbox2">
				<div class="box"> 
				<a href="datosPersonalesEdit.php" class="button">Datos personales</a>
				<img src="images/person.png" border="0" align="horizontalcenter">
				</div>
			  </div>
			  <div class="bigbox2">
				<div class="box">
				<a href="configurarOpciones.php" class="button">Configuraciones de partida</a>
				<img src="images/gear.png" border="0" align="horizontalcenter">
				</div>
			</div>

			
			<div id="footer">
				<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
			</div>
			
		</div>
	</body>
</html>
