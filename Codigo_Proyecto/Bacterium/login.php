<?php
extract($_REQUEST);

$resultado="";

if( isset($signIn) ){
	
	// Conectar a la base de datos
	include 'dbManager.php';
	//$conexion_log = mysql_connect("localhost", "root", "%P7aGcfZz8") or die( mysql_error() ); 
	//mysql_select_db("inge") or die( mysql_error() );

	$sql = "SELECT * from usuarios WHERE alias='$userName' AND password='$password'";
	$resultset = mysql_query( $sql ) or die( $mysql_error() );
	$num_rows = mysql_num_rows($resultset);
	$row = mysql_fetch_assoc( $resultset );
	
	if( $num_rows >= 1 ){ // si la consulta al menos recupera un registro
		session_start();
		$_SESSION['authorized'] = 'yes';
		$_SESSION['valid_user'] = $row['idUsuarios'];
		$_SESSION['alias'] = $row['alias'];
		
		mysql_close($conexion_log);	// cerrar la conexión actual a la base de datos, ya que desde el header de las páginas administrativas se vuelve a conectar.
		
		header( "Location: bacterium_hub.php" );
		exit();
	}else{ // error de credenciales inválidas
		$resultado = "Los datos suministrados son inválidos";
	}
}
?>

<html>
<head>
<title> Ingenieria de software </title>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1">
<link href="stylesheets/style.css" rel="stylesheet" type="text/css">
<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">
<link href="stylesheets/loginboxstyle.css" rel="stylesheet" type="text/css">

<script src="scripts/validatorlog.js"></script>

</head>

	<body>

		<div id="wrapper">
			
			<div id="loginbar" align="right">
				<a href="index.php" class="button">Regresar</a>
			</div>
			
			<div id="logincontent">
				<div id="login">
					<h2>Inicie sesión para continuar</h2>
					<form class="boxCont" method="POST" onsubmit="return validateFormOnSubmit(this)">
						<div>
							<label for="userName">Usuario</label>
							<input id="bac_userName" type="text" name="userName" placeholder="Escriba aqui su nombre de usuario" autofocus />
						</div>
						
						<div>
							<label for="password">Password</label>
							<input id="bac_password" type="password" name="password" placeholder="Escriba aqui su password" />
						</div>
						
						<div>
							<input type="submit" id="signIn" name="signIn" value="Iniciar sesión" class="btn left" />
						</div>
						
						<div>
							<p><? echo $resultado ?></p>
						</div>
						
					</form>
				</div>
			</div>
		
			
		
		</div>
	</body>
</html>