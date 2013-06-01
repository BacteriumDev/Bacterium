<?php
session_start();

$saludo = "";

// Comprueba si el usuario se ha conectado
if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
	header( "Location: bacterium_accessdenied.php" );
	exit();
}else
{
	$saludo = "Usted ha iniciado sesión, bienvenido a Bacterium " .$_SESSION['username'] ."!!"; 
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
			
			<p><?php echo $saludo; ?>
			
		</div>
	</body>
</html>