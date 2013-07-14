<?php
session_start();

$saludo = "";

// Comprueba si el usuario se ha conectado
if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
	header( "Location: bacterium_accessdenied.php" );
	exit();
}

include 'dbManager.php';

$idUsuario = $_SESSION['valid_user'];

$sqlquery = 
"SELECT 
	l.Nombre AS nombre, 
	l.Descripcion as descripcion, 
	p.progreso AS progreso, 
	p.objetivo AS objetivo
FROM 
	logros l
JOIN 
	logrospersonales p ON p.Logros_idLogros = l.idLogros
WHERE 
	p.Usuarios_IdUsuarios = $idUsuario";

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
				<a href="estadisticasList.php" class="button">Regresar</a>
			</div>
			
			<h2>Mis logros</h2>
			
			<?php
				$result = mysql_query($sqlquery) or trigger_error(mysql_error()); 
				while($row = mysql_fetch_array($result)){ 
					foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
					echo "<h3>". nl2br( $row['nombre'] ) ."</h3>";
					echo "<h3>". nl2br( $row['descripcion'] ) ."</h3>";
					$progress = ($row['progreso'] * 100)/$row['objetivo'];
					echo "<h3>Progreso: " . $progress  . "% - ". nl2br( $row['progreso'] ) ." de ". nl2br( $row['objetivo'] ) ." completado</h3>";
					echo '<div class="singlebigbox">';
					echo '<div class="box">';
					if($progress == 100)
					{
						echo '<img src="images/trophy.png" border="0" align="middle">';
					}else{
						echo '<img src="images/questionmark.png" border="0" align="middle">';
					}
					echo '</div>';
					echo '</div>';
				}
			?>
			
			<div id="footer">
				<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
			</div>
			
		</div>
	</body>
</html>