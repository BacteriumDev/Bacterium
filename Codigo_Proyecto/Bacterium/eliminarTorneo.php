<?php
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
	
	$id_Torneo = $row[0];
	
	//echo $row[0];
	
	$sql = "	DELETE FROM torneos WHERE idTorneos = $row[0]";
	
	$result = mysql_query($sql) or trigger_error(mysql_error());
	
	$sql = "DELETE FROM fasetorneo WHERE Torneos_idTorneos = $id_Torneo";
	
	$result = mysql_query($sql) or trigger_error(mysql_error());
	
	$sql = "DELETE FROM participantes_torneo WHERE Torneos_idTorneos = $id_Torneo";
	
	$result = mysql_query($sql) or trigger_error(mysql_error());
	
	header("Location: administrarTorneos.php");
?>