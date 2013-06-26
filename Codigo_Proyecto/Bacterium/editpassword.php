<?php 
session_start();
$respuesta = "Datos actualizados correctamente";

// Comprueba si el usuario se ha conectado
if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
	header( "Location: bacterium_accessdenied.php" );
	exit();
}

if( isset($actpsswd) ){
	
	$SendInformationToDatabase=mysql_query("UPDATE usuarios SET password='$password' WHERE idUsuarios = $_SESSION[valid_user]");
	(mysql_affected_rows()) ? $respuesta = "Datos actualizados correctamente" : $respuesta = "No se ha podido efectuar el borrado"; 
	//echo $respuesta;
	header( "Location: datosPersonalesEditados.php" );
	exit();
}
?>
<html>
<head>
<title> Ingenieria de software </title>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1">
<link href="stylesheets/style.css" rel="stylesheet" type="text/css">
<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">
<link href="stylesheets/loginboxstyle.css" rel="stylesheet" type="text/css">

<script src="scripts/validatorpass.js"></script>

</head>

	<body>

		<div id="wrapper">
			
			<div id="loginbar" align="right">
				<a href="index.php" class="button">Regresar</a>
			</div>
			
			<div id="logincontent">
				<div id="login">
					<h2>Confirme su password</h2>
					<form class="boxCont" method="POST" onsubmit="return validateFormOnSubmit(this)">
						<div>
							<label for="password">Password</label>
							<input id="bac_password" type="password" name="password" placeholder="Escriba aqui su password" />
						</div>
						
						<div>
							<label for="password">Password</label>
							<input id="bacn_password" type="password" name="npassword" placeholder="Escriba aqui nuevamente su password" />
						</div>
						
						<div>
							<input type="submit" id="actpsswd" name="actpsswd" value="Actualizar Password" class="btn right" />
						</div>
						
					</form>
				</div>
			</div>
		
			
		
		</div>
	</body>
</html>