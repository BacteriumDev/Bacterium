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
				<a href="menuPartidas.php" class="button">Regresar</a>
			</div>
			<h2>Menu partidas</h2>
			<div class="bigbox">
				<div class="box">
				<a href="partidaSolitarioNivel.php" class="button">Partida solitario</a>
				<img src="images/bacteria.png" border="0" align="horizontalcenter">
				</div>
			</div>
			<div class="bigbox">
				<div class="box">
				<a href="crearPartida.php" class="button">Crear partida multijugador</a>
				<img src="images/constructionPartida.png" border="0" align="horizontalcenter">
				</div>
			</div>
			<div class="bigbox">
				<div class="box">
				<a href="partidasActivas.php" class="button">Partidas activas</a>
				<img src="images/mp.png" border="0" align="horizontalcenter">
				</div>
			</div>
				
			<div id="footer">
				<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
			</div>
			
		</div>
	</body>
</html>