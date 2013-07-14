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
	
	if($name == "Sistema")
	{
		$SendSuspencionInfo=mysql_query("UPDATE partidas SET votos_suspen = votos_suspen+1 WHERE idPartidas=$pid");
		
		$getvotos=mysql_query("SELECT votos_suspen FROM partidas WHERE idPartidas=$pid");
		$GV=mysql_fetch_assoc($getvotos);
		
		if($GV['votos_suspen'] == 2)
		{
			$SendSuspencion=mysql_query("UPDATE partidas SET estado = 'suspendida', votos_suspen = 0 WHERE idPartidas=$pid");
			$SendInformationToDatabase=mysql_query("INSERT INTO chat VALUES('', $pid, '$name', 'Partida suspendida por voto de los participantes')");
		}
	}
	
	
	

?>