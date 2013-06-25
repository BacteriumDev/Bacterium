<?php
	session_start();
	include 'dbManager.php';
	if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
		header( "Location: bacterium_accessdenied.php" );
		exit();
	}
	extract( $_REQUEST );
	
	$sql = "SELECT idTorneos,estado,faseActual FROM torneos WHERE idAdmin = $_SESSION[valid_user] AND nombre = '$_GET[nombreTorneo]'";
	
	$result = mysql_query($sql) or trigger_error(mysql_error());
	
	$row = mysql_fetch_array($result);

	$torneoID = $row[0];
	$faseActual = $row['faseActual'];
	$faseSiguiente = $faseActual+1;
	
	//echo $row[0];
	if ($row[1] == "Inscripcion"){
		header ("Location: administrarTorneos.php?estado=inscripcion");
		exit();
	}
	//verificacion de fechas validas (solo tengo que ver que las fases mayores a la faseActual
	//tengan una fecha posterior a hoy.

	$fecha = date('Y-m-d H:i:s', time());
	$fecha_stamp = strtotime($fecha);

	$sql = "SELECT UNIX_TIMESTAMP(fecha_fase) FROM fasetorneo WHERE Torneos_idTorneos = $torneoID AND numFase = $faseSiguiente";
	
	$result = mysql_query($sql) or trigger_error(mysql_error());
	$row = mysql_fetch_array($result);

	$tiempoVerificar = $row['UNIX_TIMESTAMP(fecha_fase)'];

	if ($tiempoVerificar == FALSE){ //No existe fecha, puede dejarlo seguir sin repercusiones
		//print "$torneoID";		
		//print "$faseActual -- $faseSiguiente \n";
		//print "$tiempoVerificar -- $fecha_stamp";
		//header ("Location: administrarTorneos.php?estado=inscripcion");
		//exit();
	}else{
		/*print '<script type="text/javascript">'; 
		print 'alert("verificar: $tiempoVerificar // fecha_stamp: $fecha_stamp")'; 
		print '</script>';*/
		
		//header ("Location: administrarTorneos.php?estado=inscripcion");
		//exit();

		if($tiempoVerificar <= $fecha_stamp){
			header ("Location: administrarTorneos.php?estado=calendarizacion");
			exit();
		}
	}

	
	//fin verificacion de fechas validas
	
	$sql = "UPDATE torneos SET estado = 'Activo' WHERE idTorneos = $torneoID";
	
	$result = mysql_query($sql) or trigger_error(mysql_error());
	
	header("Location: administrarTorneos.php");
?>
