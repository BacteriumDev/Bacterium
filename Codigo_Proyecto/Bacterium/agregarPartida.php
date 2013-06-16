<?php
	session_start();
	if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
		header( "Location: bacterium_accessdenied.php" );
		exit();
	}	
	
	include 'dbManager.php';
	
	$sqlquery = "INSERT INTO  partidas(
		idPartidas,
		tipo_partida,
		modo_juego,
		numero_jugadores,
		idAdmin,
		estado,
		idTorneoFK,
		numFaseFK)
	VALUES(
		NULL,'multiplayer','$_POST[tipo]',0,$_SESSION[valid_user],'creada', NULL , NULL);"

	$result = mysql_query($sql) or trigger_error(mysql_error());
?>




<html>
<head>
<title> Ingenieria de software </title>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1">
<link href="stylesheets/style.css" rel="stylesheet" type="text/css">
<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">
<link href="stylesheets/tournyboxstyle.css" rel="stylesheet" type="text/css">

</head>
	<body>
		<div id="wrapper">
			
			<div id="loginbar" align="right">
				<a href="menuPartidas.php" class="button">Regresar</a>
			</div>
			

			<div id="footer">
					<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
			</div>
		</div>
	</body>
</html>