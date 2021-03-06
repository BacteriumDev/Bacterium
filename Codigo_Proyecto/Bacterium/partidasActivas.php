<?php
	session_start();
	if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
		header( "Location: bacterium_accessdenied.php" );
		exit();
	}	
	
	include 'dbManager.php';
	
	$sqlquerypartidas = 
	"SELECT 
		p.idPartidas,
		p.idAdmin,
		u.alias as aliasadmin,
		p.tipo_partida, 
		p.modo_juego, 
		p.numero_jugadores, 
		p.estado
	FROM
		partidas p 
		JOIN usuarios u ON p.idAdmin = u.idUsuarios
	WHERE
		tipo_partida = 'multiplayer' AND (estado = 'creada' OR estado = 'activa')";
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
		<table id="tabla" cellpadding="6">
		<thead>
			<th>ID Partida</th>
			<th>Administrador</th>
			<th>Tipo</th>
			<th>Modo de juego</th>
			<th>Jugadores</th>
			<th>Estado</th>
			<th>Acci�n</th>
		</thead>
		<tbody>
			<?php
				$result = mysql_query($sqlquerypartidas) or trigger_error(mysql_error()); 
				while($row = mysql_fetch_array($result)){ 
					foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
					echo "<tr>";  
					echo "<td valign='top'>" . nl2br( $row['idPartidas'] ) . "</td>";
					echo "<td valign='top'>" . nl2br( $row['aliasadmin'] ) . "</td>";
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
					echo "<td valign='top'><a href=partidamultiplayer.php?id={$row['idPartidas']}&p={$row['numero_jugadores']}>Entrar</a></td>"; 
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