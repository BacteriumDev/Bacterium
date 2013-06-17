<?php
	//Aqui hay que mostrar todas las fases del torneo posibles y darle la opcion al usuario de ponerle una fecha a cada una
	session_start();
	include 'dbManager.php';
	if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
		header( "Location: bacterium_accessdenied.php" );
		exit();
	}
	extract( $_REQUEST );
	if (!isset($_GET['nombreTorneo'])){
		header("Location: administrarTorneos.php");
		exit();
	}
	if ( isset($_POST['FechaFase']) && isset($_POST['HoraFase']) && !empty($_POST['fase'])){
		
		$datetimeFase = "$_POST[FechaFase] $_POST[HoraFase]";
		$tiempoFase 	= strtotime($datetimeFase);
		
		$sql = "SELECT idTorneos,UNIX_TIMESTAMP(inscripcion_fecha_final) FROM torneos WHERE idAdmin = $_SESSION[valid_user] AND nombre = '$_GET[nombreTorneo]'";
	
		$result = mysql_query($sql) or trigger_error(mysql_error());
		
		$row = mysql_fetch_array($result);
		
		$id_Torneo = $row[0];
		$fechaInsFinUNIX = $row['UNIX_TIMESTAMP(inscripcion_fecha_final)'];
		
		//verificacion de correctitud de la fecha con respecto a las otras fases
		
		$sql = "SELECT Torneos_idTorneos,numFase,UNIX_TIMESTAMP(fecha_fase) FROM fasetorneo WHERE Torneos_idTorneos = $id_Torneo";
		
		$result = mysql_query($sql) or trigger_error(mysql_error());
		
		$error = 0;
		while($row = mysql_fetch_array($result)){ 
			//foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }
						
			if($_POST['fase'] == $row['numFase']){//si la fase a  modificar es la misma, no compare nada
			}
			else if($_POST['fase'] < $row['numFase']){//si la fase a modificar es menor a la fase a comparar 
				
				$tiempoVerificar = $row['UNIX_TIMESTAMP(fecha_fase)'];
			
				if($tiempoVerificar == FALSE){
					//no existe una fecha para esta fase, entonces no compare
				}else if($tiempoFase > $tiempoVerificar){ //si el tiempo de la fase es mayor al tiempo de una fase posterior -> error
					$error = 1;
				}
				
				
			}
			else if($_POST['fase'] > $row['numFase']){//si la fase a modificar es mayor a la fase a comparar 
				$tiempoVerificar = $row['UNIX_TIMESTAMP(fecha_fase)'];
				
				if($tiempoVerificar == FALSE){
					//no existe una fecha para esta fase, entonces no compare
				}else if($tiempoFase < $tiempoVerificar){ //si el tiempo de la fase es menor al tiempo de una fase anterior -> error
					$error = 2;
				}
				
			}
			
		}
		
		if($tiempoFase < $fechaInsFinUNIX){
				$error = 3;
		}
		
		
		
		//
		if ($error <= 0){
			$sql = "UPDATE fasetorneo SET fecha_fase = '$datetimeFase' WHERE Torneos_idTorneos = $id_Torneo AND numFase = $_POST[fase]";
			
			$result = mysql_query($sql) or trigger_error(mysql_error());
		}else{
			print '<script type="text/javascript">';
			if($error == 1){
				print 'alert("La fecha de la fase es invalida: Es mayor o igual a alguna fecha de una fase posterior")'; 
			}else if($error == 2){
				print 'alert("La fecha de la fase es invalida: Es menor o igual a alguna fecha de una fase anterior")'; 
			}else if($error == 3){
				print 'alert("La fecha de la fase es invalida: Es menor o igual a las fechas indicadas para el proceso de inscripcion")'; 
			}else{
				print 'alert("La fecha de la fase es invalida--indefinido")'; 
			}			
			print '</script>';
		}
		/*$_GET['FechaFase'] = $_POST['FechaFase'];
		$_GET['HoraFase'] = $_POST['HoraFase'];
		$vars = "fecha="+$_POST['FechaFase']+"&hora="+$_POST['HoraFase'];
		$url = "Location: ModificarFechaFase.php?";
		header($url);
		
		
		exit();*/
		
		
	}
	
	
	
	
	$sql = "SELECT idTorneos,tipo_eliminacion,max_participantes,inscripcion_fecha_inicio,inscripcion_fecha_final FROM torneos WHERE idAdmin = $_SESSION[valid_user] AND nombre = '$_GET[nombreTorneo]'";
	
	$result = mysql_query($sql) or trigger_error(mysql_error());
	
	$row = mysql_fetch_array($result);
	
	$horaInicio = "00:00:00";
	
	$id_Torneo = $row['idTorneos'];
	$tipoTorneo = $row['tipo_eliminacion'];
	$maxParticipantes = $row['max_participantes'];
	$fechaInsInicio = date("Y-m-d H:i:s",strtotime($row['inscripcion_fecha_inicio']));
	$fechaInsFin = date("Y-m-d H:i:s",strtotime($row['inscripcion_fecha_final']));
	
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
		<link href="stylesheets/tablestyle2.css" rel="stylesheet" type="text/css">
		<script src="scripts/tablasdinamicas.js"></script>
	</head>
	
		<body>
			<div id="wrapper">
				
				<div id="loginbar" align="right">
					<a href="administrarTorneos.php" class="button">Regresar</a>
				</div>
				
				<h2>Calendarizacion de: <?php echo $_GET[nombreTorneo]?></h2>
				<h3>Tipo de torneo: <?php echo $tipoTorneo  ?></h3>
				<h3>Numero maximo de participantes: <?php echo $maxParticipantes ?> </h3>
				<h3>A partir de estos datos se calculó el numero de fases apropiado para este torneo </h3>
				<h3>Fecha de inicio de la inscripcion: <?php echo $fechaInsInicio?> </h3>				
				<h3>Fecha de fin de la inscripcion: <?php echo $fechaInsFin?> </h3>
				<div id="content"  >
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
					
				<form id="meta" class="boxCont"   method="post">
					<div>
						<label for="FechaFase">Fecha para la fase seleccionada:</label>
						<input id="FechaFase" input type="date"  name="FechaFase"	value = <?php echo"$fechaInsFin";?> min = <?php echo"$fechaInsFin";?> /> 
					</div>
					<div>
						<label for="HoraFase">Hora de inicio de la fase:</label>
						<input type="time"  name="HoraFase" 		value = <?php echo"$horaInicio";?>  />
					</div>
					<div>
						<label for="fase">Numero de fase a modificar:</label>
						<input id="fase" input type="number" name="fase" readonly>
					</div>
					<div>
							<input id="inputFecha" type="submit" value="Modificar fecha" class="btn right"/>
					</div>
				</form>				
				</div>
				
				<div id="footer">
					<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
				</div>
			</div>
		</body>
</html>