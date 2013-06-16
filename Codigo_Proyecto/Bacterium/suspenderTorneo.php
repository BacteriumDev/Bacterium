<?php
	
	session_start();
	include 'dbManager.php';
	if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
		header( "Location: bacterium_accessdenied.php" );
		exit();
	}
	extract( $_REQUEST );
	
	$sql = "SELECT idTorneos,estado FROM torneos WHERE idAdmin = $_SESSION[valid_user] AND nombre = '$_GET[nombreTorneo]'";
	
	$result = mysql_query($sql) or trigger_error(mysql_error());
	
	$row = mysql_fetch_array($result);
	
	if ($row[1] == "Inscripcion"){
		header ("Location: administrarTorneos.php?estado=inscripcion");
		exit();
	}
	
	
	$sql = "UPDATE torneos SET estado = 'suspendido' WHERE idTorneos = $row[0]";
	
	$result = mysql_query($sql) or trigger_error(mysql_error());
	
	header("Location: administrarTorneos.php");
?>