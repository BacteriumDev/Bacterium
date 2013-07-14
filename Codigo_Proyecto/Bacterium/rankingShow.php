<?php
session_start();


// Comprueba si el usuario se ha conectado
if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
	header( "Location: bacterium_accessdenied.php" );
	exit();
}

include 'dbManager.php';

$tipo = $_POST['ranking'];
$sqlquery;
$ganados;
$participaciones;

if($tipo == "torneo")
{
	$sqlquery = 
	"SELECT alias, pais, edad, acerca, torneos, torneos_ganados
	FROM  usuarios
	ORDER BY torneos_ganados DESC";
	$ganados = "torneos_ganados";
	$participaciones = "torneos";
}
else if($tipo == "partida")
{
	$sqlquery = 
	"SELECT alias, pais, edad, acerca, partidas, partidas_ganadas
	FROM  usuarios
	ORDER BY partidas_ganadas DESC";
	$ganados = "partidas_ganadas";
	$participaciones = "partidas";
}



?>
<html>
<head>
<title> Ingenieria de software </title>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1">
<link href="stylesheets/style.css" rel="stylesheet" type="text/css">
<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">
<link href="stylesheets/table.css" rel="stylesheet" type="text/css">

</head>

	<body>

		<div id="wrapper">
			
			<div id="loginbar" align="right">
				<a href="estadisticasList.php" class="button">Regresar</a>
			</div>
			
			<h2>Rankings</h2>
			
		<table id="tabla" cellpadding="7">
		<thead>
			<th>Posicion</th>
			<th>Nombre</th>
			<th>Pais</th>
			<th>Edad</th>
			<th>Acerca</th>
			<th>Ganados</th>
			<th>Participaciones</th>
			<th>Ratio</th>
		</thead>
		<tbody>
			<?php
				$consecutivo = 1;
				$resultset = mysql_query( $sqlquery ) or die( mysql_error() ); 
				while($rowset = mysql_fetch_array($resultset)){ 
					foreach($rowset AS $key => $value) { $rowset[$key] = stripslashes($value); } 
					echo "<tr>";  
					echo "<td valign='top'>" . nl2br( $consecutivo ) . "</td>"; 
					echo "<td valign='top'>" . nl2br( $rowset['alias'] ) . "</td>"; 
					echo "<td valign='top'>" . nl2br( $rowset['pais'] ) . "</td>";
					echo "<td valign='top'>" . nl2br( $rowset['edad'] ) . "</td>";					
					echo "<td valign='top'>" . nl2br( $rowset['acerca'] ) . "</td>";  
					echo "<td valign='top'>" . nl2br( $rowset[$ganados] ) . "</td>";  
					echo "<td valign='top'>" . nl2br( $rowset[$participaciones] ) . "</td>";  
					$ratio = 0;
					if($rowset[$participaciones] != 0)
					{
						$ratio = $rowset[$ganados] / $rowset[$participaciones];
					}
					echo "<td valign='top'>" . nl2br( $ratio ) . "</td>";  
					echo "</tr>"; 
					$consecutivo++;
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