<?php
session_start();


// Comprueba si el usuario se ha conectado
if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
	header( "Location: bacterium_accessdenied.php" );
	exit();
}

include 'dbManager.php';

$idUsuario = $_SESSION['valid_user'];


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
				<a href="estadisticasList.php" class="button">Regresar</a>
			</div>
			
			<h2>Rankings</h2>
			
			<div align="center">
			<form name="rank" method="post" action="rankingShow.php">
				<table>
					<tr><td>Seleccione un ranking</td><td><select id="ranking" name="ranking">
						<option value="torneo">Por Torneos</option> 
						<option value="partida">Por Partidas</option> 
					</select>
					<td><input type="submit" name="submit" value="Ver Ranking"></td></tr>
				</table>
			</form>
			</div>
			
			
			<div id="footer">
				<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
			</div>
			
		</div>
	</body>
</html>