<?php session_start(); 

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
				<a href="logout.php" class="button">Cerrar sesión</a>
			</div>
			<h2>Menu de partidas</h2>
			<div class="bigbox">
				<div class="box">
				<a href="partidas_hub.php" class="button">Jugar partida</a>
				<img src="images/mp.png" border="0" align="horizontalcenter">
				</div>
				</div>
			<div class="bigbox">
				<div class="box">
				<a href="administrarPartidas.php" class="button">Administrar mis partidas</a>
				<img src="images/adminPartidas.png" border="0" align="horizontalcenter">
				</div>
				</div>
			<div class="bigbox">
				<div class="box">
				<a href="menuPartidasEspectador.php" class="button">Modo espectador</a>
				<img src="images/eye.png" border="0" align="horizontalcenter">
				</div>
				</div>
			<div class="bigbox">
				<div class="box">
				<a href="bacterium_hub.php" class="button">Volver al menu principal</a>
				<img src="images/bacteriaCeleste.png" border="0" align="horizontalcenter">
				</div>
				</div>
			
			<div id="footer">
				<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
			</div>
			
		</div>
	</body>
</html>
