<?php 
session_start();
$respuesta = "Datos actualizados correctamente";

// Comprueba si el usuario se ha conectado
if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
	header( "Location: bacterium_accessdenied.php" );
	exit();
}

	include 'dbManager.php';

	$idpartida = $_GET['id'];
	$SendInformationToDatabase=mysql_query("UPDATE partidas SET estado='creada', numero_jugadores = 0 WHERE idPartidas = $idpartida");
	(mysql_affected_rows()) ? $respuesta = "Datos de partida actualizados correctamente" : $respuesta = "No se ha podido efectuar la operacion"; 

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
				<a href="administrarPartidas.php" class="button">Regresar</a>
			</div>
			
			<div id="footer">
				<h3><?php echo $respuesta; ?></h3>
			</div>
			
		</div>
	</body>
</html>