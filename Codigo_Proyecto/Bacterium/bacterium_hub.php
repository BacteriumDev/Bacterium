<?php
session_start();

$saludo = "";

// Comprueba si el usuario se ha conectado
if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
	header( "Location: bacterium_accessdenied.php" );
	exit();
}else
{
	$saludo = "Bienvenido a Bacterium " .$_SESSION['alias'] ."!!"; 
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
				<a href="#" class="button"><?php echo $_SESSION['alias'] ?> - Configuraciones</a>
				<a href="logout.php" class="button">Cerrar sesión</a>
			</div>
			
			<h2><?php echo $saludo; ?></h2>
			
			<div id="box-wrapper">
			  <div class="bigbox">
				<div class="box"> 
				<a href="partida.php" class="button">Partidas</a>
				<img src="images/mp.png" border="0" align="horizontalcenter">
				</div>
			  </div>
			  <div class="bigbox">
				<div class="box">
				<a href="menuTorneos.php" class="button">Torneos</a>
				<img src="images/trophy.png" border="0" align="horizontalcenter">
				</div>
				</div>
			  <div class="bigbox">
				<div class="box">
				<a href="#" class="button">Estadisticas</a>
				<img src="images/stats_image.png" border="0" align="horizontalcenter">
				</div>
			  </div>
			</div>
			
			<div id="footer">
				<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
			</div>
			
		</div>
	</body>
</html>