<?php
	session_start();
	include '../dbManager.php';
	if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
		header( "Location: bacterium_accessdenied.php" );
		exit();
	}
	
	$name=mysql_real_escape_string($_GET['name']);
	$message=mysql_real_escape_string($_GET['message']);
	$pid=mysql_real_escape_string($_GET['partida']);
	
	
	
	$SendInformationToDatabase=mysql_query("INSERT INTO chat VALUES('', $pid, '$name', '$message')");

?>