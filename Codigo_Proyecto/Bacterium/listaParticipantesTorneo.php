<?php
	
	session_start();
	include 'dbManager.php';
	if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
		header( "Location: bacterium_accessdenied.php" );
		exit();
	}
	extract( $_REQUEST );
	
	$sql = "SELECT idTorneos FROM torneos WHERE idAdmin = $_SESSION[valid_user] AND nombre = '$_GET[nombreTorneo]'";
	
	$result = mysql_query($sql) or trigger_error(mysql_error());
	
	$row = mysql_fetch_array($result);
	
	$torneoID = $row[0];
	//echo $row[0];
	
	//$sql = "DELETE FROM torneos WHERE idTorneos = $row[0]";
	
	//$result = mysql_query($sql) or trigger_error(mysql_error());
	
	//header("Location: administrarTorneos.php");
?>

<html>
	<head>
	<title> Ingenieria de software </title>
	<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1">
	<link href="stylesheets/style.css" rel="stylesheet" type="text/css">
	<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">
	<link href="stylesheets/tablestyle.css" rel="stylesheet" type="text/css">
	

	</head>
		<body>
			<div id="wrapper">
				
				<div id="loginbar" align="right">
					<a href="administrarTorneos.php" class="button">Regresar</a>
					<a href="logout.php" class="button">Cerrar sesión</a>
				</div>
				
				<h2>Participantes de: <?php echo $_GET['nombreTorneo'] ?></h2>
				
				<table id="participantes" cellpadding="8" class="center">
				<thead>
					<th>Nombre de usuario</th>
				</thead>
				<tbody>
				
				<?php
					$sql = "SELECT alias FROM usuarios,participantes_torneo WHERE Usuarios_idUsuarios = idUsuarios AND Torneos_idTorneos = $torneoID";
					$result = mysql_query($sql) or trigger_error(mysql_error()); 
					while($row = mysql_fetch_array($result)){
						echo "<tr id=$id onmouseover= \"ChangeColor(this,true)\" 							onmouseout =\"ChangeColor(this,false)\" 
						onClick= \"getRow(event,this)\">";  
						echo "<td valign='top'>" . nl2br( $row['alias']) . "</td>";  
					} 
				?>
				
				</tbody>
				</table>

				<div id="footer">
					<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
				</div>
			</div>
		</body>
</html>
