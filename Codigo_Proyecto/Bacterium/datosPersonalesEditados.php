<?php 
session_start();
$respuesta = "Datos actualizados correctamente";

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
				<a href="datosPersonalesEdit.php" class="button">Regresar</a>
			</div>
			
			<div id="footer">
				<h3><?php echo $respuesta; ?></h3>
			</div>
			
		</div>
	</body>
</html>