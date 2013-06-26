<?php
	session_start();
	include '../dbManager.php';
	if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
		header( "Location: bacterium_accessdenied.php" );
		exit();
	}
	
	$pid=mysql_real_escape_string($_GET['partida']);
	$tablero=$_GET['tablero'];
	
	
	
	$SendInformationToDatabase=mysql_query("UPDATE partidas SET tablero='$tablero' WHERE idPartidas=$pid");

?>