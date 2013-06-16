<?php
	//Aqui hay que mostrar todas las fases del torneo posibles y darle la opcion al usuario de ponerle una fecha a cada una
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
	
	$id_Torneo = $row['idTorneos'];
	
	$sql = "SELECT numfase,fecha_fase FROM fasetorneo WHERE Torneos_idTorneos = $row[0] ORDER BY numfase";
	
	$result = mysql_query($sql) or trigger_error(mysql_error());
	
?>

<html>
	<head>
		<title> Ingenieria de software </title>
		<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1">
		<link href="stylesheets/style.css" rel="stylesheet" type="text/css">
		<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">
		<link href="stylesheets/tablestyle.css" rel="stylesheet" type="text/css">
		<script src="scripts/tablasdinamicas.js"></script>
	</head>
	
		<body>
			<div id="wrapper">
				
				<div id="loginbar" align="right">
					<a href="administrarTorneos.php" class="button">Regresar</a>
				</div>
				
				<h2>Calendarizacion de: <?php echo $_GET[nombreTorneo]?></h2>
				
				<table id="Fases del torneo" cellpadding="8" class="center">
				<thead>
					<th>Numero de fase</th>
					<th>Fecha</th> 
				</thead>
				<tbody>
				
				<?php
				$id = 0;
				$clickedId; //dafuq? no creo que funcione
				$result = mysql_query($sql) or trigger_error(mysql_error()); 
				while($row = mysql_fetch_array($result)){ 
					foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } //quitarle el onmouseover y onmouseout
					echo "<tr id=$id onmouseover= \"ChangeColor(this,true)\" onmouseout =\"ChangeColor(this,false)\" 
					onClick= \"getRow(event,this)\">";  
					echo "<td valign='top'>" . nl2br( $row['numfase']) . "</td>";  
					echo "<td valign='top'>" . nl2br( $row['fecha_fase']) . "</td>";
					echo "</tr>";
					$id++;
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