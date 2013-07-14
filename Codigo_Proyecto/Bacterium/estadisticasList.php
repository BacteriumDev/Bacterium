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
						
			<div id="box-wrapper">
			  <div class="twobigbox">
				<div class="box"> 
				<a href="estadisticas.php" class="button">Logros</a>
				<img src="images/achievements.jpg" border="0" align="horizontalcenter">
				</div>
			  </div>
			  <div class="twobigbox">
				<div class="box">
				<a href="ranking.php" class="button">Ranking</a>
				<img src="images/rank.png" border="0" align="horizontalcenter">
				</div>
				</div>
			</div>
			
			<div id="footer">
				<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
			</div>
			
		</div>
	</body>
</html>