<?php
	session_start();
	if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
		header( "Location: bacterium_accessdenied.php" );
		exit();
	}
	
	$fecha = date('Y-m-d', time());
	$hora  = date('H:i:s', time());

	$horaInicio = "00:00:00";
	$horaFin	   = "23:59:00";
	
	
	ini_set('display_errors','On');
	
	
	
	//En estas variables del POST se van a guardar los datos para crear el torneo
	$_POST['NombreTorneo'];
	$_POST['TipoEliminacion'];
	$_POST['TipoParticipacion'];
	$_POST['NumMaxParticipantes'];
	$_POST['IdAdmin'];
	$_POST['Estado'];
	$_POST['InsFechaInicio'];
	$_POST['InsHoraInicio'];
	$_POST['InsFechaFin'];
	$_POST['InsHoraFin'];
	
	$_POST[IdAdmin] = $_SESSION[valid_user];
	$_POST[Estado]  = "Creado";
	
	
	
?>




<html>
<head>
<title> Ingenieria de software </title>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1">
<link href="stylesheets/style.css" rel="stylesheet" type="text/css">
<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">
<link href="stylesheets/tournyboxstyle.css" rel="stylesheet" type="text/css">

</head>
	<body>
		<div id="wrapper">
			
			<div id="loginbar" align="right">
				<a href="menuTorneos.php" class="button">Regresar</a>
			</div>
			
			<div id="tournycontent">
				<div id="tourny">
					<h2>Complete la informacion del torneo a crear</h2>
					<form class="boxCont"form action="AgregarTorneo.php" method="post">
						<div>
							<label for="NombreTorneo">Nombre de torneo:</label> 
							<input id="NombreTorneo" type="text" name="NombreTorneo" placeholder="Escriba aqui el nombre del nuevo torneo" autofocus />
						</div>
						<div>
							<label for="TipoEliminacion">Tipo de eliminacion:</label> 
												<select name="TipoEliminacion" >
													<option>Eliminacion Simple</option>
													<option>Eliminacion Doble</option>
													<option>Liguilla</option>
													
												</select>
						</div>
						<div>
							<label for="TipoParticipacion">Tipo de participacion:</label>						
													<select name="TipoParticipacion">
														<option>Individual</option>
														<option>Parejas</option>
													</select>
						</div>
						<div>
							<label for="NumMaxParticipantes">Numero maximo de participantes:</label>
							<input id="NumMaxParticipantes" input type="number" name= "NumMaxParticipantes" placeholder=2 min="2" max= "64"/>
						</div>
						<!--<div>Estado: <input type="text" name="Estado" /></div>
						<<div>idAdmin: <input type="text" name="IdAdmin" /></div> -->
						<div>
							<label for="InsFechaInicio">Fecha de inicio de inscripcion:</label>
							<input id="InsFechaInicio" input type="date"  name="InsFechaInicio"	value = <?php echo"$fecha";?> min = <?php echo"$fecha";?> /> 
						</div>
						<div>
							<label for="InsHoraInicio">Hora de inicio de inscripcion:</label>
							<input type="time"  name="InsHoraInicio" 		value = <?php echo"$horaInicio";?>  />
						</div>
						<div>
							<label for="InsFechaFin">Fecha de fin de inscripcion:</label>
							<input type="date"  name="InsFechaFin" 		value = <?php echo"$fecha";?> min = <?php echo"$fecha";?> /> 						
						</div>
						<div>
							<label for="InsHoraFin">Hora de fin de inscripcion:</label> 
							<input type="time"  name="InsHoraFin" 				value = <?php echo"$horaFin";?> />
						</div>
						
						
						<div>
							<input type="submit" value="Continuar" class="btn right"/>
						</div>
					</form>
				</div>
			</div>
			<div id="footer">
					<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
			</div>
		</div>
	</body>
</html>
