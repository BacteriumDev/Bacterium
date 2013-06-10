<?php
	session_start();
	foreach($_POST as $key => $valor){
		//$_POST[$key] = stripslashes($valor);
		//print "<h1>$_POST[$key] de $key</h1>";
		if (empty($_POST[$key]) || $_POST[$key] == null){
			$tipoValor = $key;
			//$_GET['ErrorTorneo'] = "El valor $tipoValor esta vacio";
			//print "<h1>$_POST[ErrorTorneo]</h1>";
			header("Location: crearTorneo.php?empty=$key");
			exit();
		}
	
	}//necesario?
	
	
	
	
	
	$datetimeInicio = "$_POST[InsFechaInicio] $_POST[InsHoraInicio]";
	$datetimeFin = "$_POST[InsFechaFin] $_POST[InsHoraFin]";
	
	$tiempoInicio 	= strtotime($datetimeInicio); // convierte el date a un timestamp de unix comparable
	$tiempoFin	 	= strtotime($datetimeFin);    // ver arriba
	
	if ($tiempoFin <= $tiempoInicio){
		//quiere decir que el tiempo para que finalice la inscripcion es menor al tiempo en el que inicia
		header("Location: crearTorneo.php?tiempoFin='MayorIgual'");
	}else{
	
		
		include 'dbManager.php';

		$sql = "INSERT INTO torneos(nombre,tipo_eliminacion,tipo_participacion,max_participantes,estado,idAdmin,inscripcion_fecha_inicio,inscripcion_fecha_final)
				VALUES('$_POST[NombreTorneo]','$_POST[TipoEliminacion]','$_POST[TipoParticipacion]',$_POST[NumMaxParticipantes],'Creado',$_SESSION[valid_user]
				,'$datetimeInicio','$datetimeFin')";
		
		$result = mysql_query($sql) or trigger_error(mysql_error());
		//ahora "cortamos el else para introducir un poco de html"
		//***24-mayo*** meter codigo para crear las fases con sqrt y ceilling (estan en calendarizacion)
		
		extract( $_REQUEST );
	
	
		$torneosPorID = "SELECT * FROM torneos WHERE `nombre = '$_POST[NombreTorneo]'";
		$sql = "SELECT max_participantes FROM torneos WHERE idAdmin = $_SESSION[valid_user] AND nombre = '$_POST[NombreTorneo]'";
		
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
			//echo "<h2>INSERT INTO fasetorneo(Torneos_idTorneos,numFase) VALUES ($_POST[NombreTorneo],$i)</h2> ";
			$sql = "SELECT idTorneos FROM torneos WHERE nombre = '$_POST[NombreTorneo]'";
			$result = mysql_query($sql) or trigger_error(mysql_error());
			while($row = mysql_fetch_array($result)){ 
				foreach($row AS $key => $value) { 
					$row[$key] = stripslashes($value);
					
				}
				//echo "$value dd \n";
				$idTorneo = $value;
			}
			//echo "<h1>INSERT INTO fasetorneo(Torneos_idTorneos,numFase) VALUES ($idTorneo,$i)</h1>";
			$sql = "INSERT INTO fasetorneo(Torneos_idTorneos,numFase) VALUES ($idTorneo,$i)"; // funciona!. inserta fases del torneo cuando se crea
			$result = mysql_query($sql) or trigger_error(mysql_error());
		}
		//***25-mayo*** insert de fases
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
							<a href="#" class="button"><?php echo $_SESSION['username'] ?> - Configuraciones</a>
							<a href="logout.php" class="button">Cerrar sesión</a>
						</div>
						<h2>Desea llevar a cabo la calendarizacion de este torneo ahora?</h2>
						<!--<button type="button" onclick="window.location.href='calendarizarTorneo.php?nombreTorneo='+<?php //echo "'$_POST[NombreTorneo]'";?>">Si</button>			
						<button type="button" onclick="window.location.href='administrarTorneos.php'">No gracias</button>!-->
						<div id="box-wrapper">
						  <div class="bigbox">
							<div class="box"> 
							<a href="calendarizarTorneo.php?nombreTorneo=<?php echo "$_POST[NombreTorneo]";?>"+ class="button">Si</a>
							<img src="images/bacteriaCeleste.png" border="0" align="horizontalcenter">
							</div>
						  </div>
						  <div class="bigbox">
							<div class="box">
							<a href="administrarTorneos.php" class="button">No</a>
							<img src="images/bacteriaOrange.png" border="0" align="horizontalcenter">
							</div>
							</div>
						</div>
					</div>
				</body>
			</html>
		<?php
	}
	
	//falta manejar los datos y crear el torneo, tambien hay que ver si los datos son "validos", sino se le tira un error
	//y se devuelve a la pagina de crearTorneo.php
?>