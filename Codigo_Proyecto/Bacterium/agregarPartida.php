<?php
	session_start();
	if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
		header( "Location: bacterium_accessdenied.php" );
		exit();
	}	
	
	include 'dbManager.php';
	
	//definir turno
	$turno = 1;
	$tablero = "";
	$tablero = $turno . "||";
	for($i = 0; $i < 8; ++$i)
	{
		for($j = 0; $j < 8; ++$j)
		{
			$numrandom = rand(1,4);
			if($i==0 && $j==0)
			{
				$tablero = $tablero . "1" . $numrandom . "||";
			}else if($i==7 && $j==7)
			{
				$tablero = $tablero . "2" . $numrandom . "||";
			}else
			{
				$tablero = $tablero . "0" . $numrandom . "||";
			}
		}
	}
	
	$sqlquery = "INSERT INTO  partidas(
		idPartidas,
		tipo_partida,
		modo_juego,
		numero_jugadores,
		idAdmin,
		estado,
		idTorneoFK,
		numFaseFK,
		tablero,
		turno)
	VALUES(
		NULL,'multiplayer','$_POST[tipo]',0,$_SESSION[valid_user],'creada', NULL , NULL, '$tablero', 1)";

	$result = mysql_query($sqlquery) or trigger_error(mysql_error());
	
	$sqlquerypartidas = 
	"SELECT 
		idPartidas, 
		tipo_partida, 
		modo_juego, 
		numero_jugadores, 
		estado 
	FROM
		partidas
	WHERE
		idAdmin = $_SESSION[valid_user] AND tipo_partida = 'multiplayer'";
?>




<html>
<head>
<title> Ingenieria de software </title>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1">
<link href="stylesheets/style.css" rel="stylesheet" type="text/css">
<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">
<link href="stylesheets/tournyboxstyle.css" rel="stylesheet" type="text/css">
<link href="stylesheets/table.css" rel="stylesheet" type="text/css">

</head>
	<body>
		<div id="wrapper">
			
			<div id="loginbar" align="right">
				<a href="menuPartidas.php" class="button">Regresar</a>
			</div>
		<div id="content">
		<table id="tabla" cellpadding="5">
		<thead>
			<th>ID Partida</th>
			<th>Tipo</th>
			<th>Modo de juego</th>
			<th>Jugadores</th>
			<th>Estado</th>
			<!--<th>Acción</th>-->
		</thead>
		<tbody>
			<?php
				$result = mysql_query($sqlquerypartidas) or trigger_error(mysql_error()); 
				while($row = mysql_fetch_array($result)){ 
					foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
					echo "<tr>";  
					echo "<td valign='top'>" . nl2br( $row['idPartidas'] ) . "</td>";  
					echo "<td valign='top'>" . nl2br( $row['tipo_partida'] ) . "</td>";
					$modo = "Default";
					$dato = $row['modo_juego'];
					if($dato == 1)
					{
						$modo = "Multiplayer 1vs1";
					}else if($dato == 2)
					{
						$modo = "Multiplayer 1vs1vs1vs1";
					}else if($dato == 3)
					{
						$modo = "Multiplayer 2vs2";
					}
					echo "<td valign='top'>" . nl2br( $modo ) . "</td>"; 
					echo "<td valign='top'>" . nl2br( $row['numero_jugadores'] ) . "</td>";
					echo "<td valign='top'>" . nl2br( $row['estado'] ) . "</td>";
					//echo "<td valign='top'><a href=#?id={$row['idPartidas']}>Entrar</a></td>"; 
					echo "</tr>"; 
				}
			?>
		</tbody>
	</table>
	</div>
			

			<div id="footer">
					<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
			</div>
		</div>
	</body>
</html>