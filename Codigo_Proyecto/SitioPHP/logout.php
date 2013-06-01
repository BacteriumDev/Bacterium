<?php 

$respuesta = "";

session_start();

$old_user = $_SESSION['valid_user'];
unset($_SESSION['authorized']);
unset($_SESSION['valid_user']);
unset($_SESSION['username']);
session_destroy();

if(!empty($old_user))
{
	$respuesta = "Sesion finalizada correctamente";
}else
{
	$respuesta = "Error al finalizar sesion, ha accesado a esta seccion de manera no autorizada";
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
				<a href="index.php" class="button">Regresar</a>
			</div>
			
			<p><?php echo $respuesta; ?>
			
		</div>
	</body>
</html>