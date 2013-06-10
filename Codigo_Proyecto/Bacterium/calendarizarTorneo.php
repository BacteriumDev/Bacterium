<?php
	//Aqui hay que mostrar todas las fases del torneo posibles y darle la opcion al usuario de ponerle una fecha a cada una
	session_start();
	include 'dbManager.php';
	if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
		header( "Location: bacterium_accessdenied.php" );
		exit();
	}
	extract( $_REQUEST );
	
	
	$torneosPorID = "SELECT * FROM torneos WHERE `nombre = '$_GET[nombreTorneo]'";
	$sql = "SELECT max_participantes FROM torneos WHERE idAdmin = $_SESSION[valid_user] AND nombre = '$_GET[nombreTorneo]'";
	
	$result = mysql_query($sql) or trigger_error(mysql_error());
	$numParticipantes;
	
	while($row = mysql_fetch_array($result)){ 
		foreach($row AS $key => $value) { 
			$row[$key] = stripslashes($value);
			
		}
		//echo "$value dd \n";
		$numParticipantes = $value;
	}
	
	$numBrackets = ceil(sqrt($numParticipantes));
	//echo "$numBrackets\n";
	
	for ($i = 1; $i <= $numBrackets; $i++){
		//echo "<h2>INSERT INTO fasetorneo(Torneos_idTorneos,numFase) VALUES ($_GET[nombreTorneo],$i)</h2> ";
	}
	
	//print "<h2>$_GET[nombreTorneo]</h2>";
	
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
				</div>
				
				<h2>Calendarizacion de: <?php echo $_GET[nombreTorneo]?></h2>
				<div id="footer">
					<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
				</div>
			</div>
		</body>
</html>