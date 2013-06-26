<?php
	session_start();
	include '../dbManager.php';
	if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
		header( "Location: bacterium_accessdenied.php" );
		exit();
	}
	
	$chatroom = $_GET['pid'];
	
	$GetChatInformation=mysql_query("SELECT * FROM chat WHERE idPartida = '$chatroom' ORDER BY id ASC");
	
	$order="a";
	
	while($GCI=mysql_fetch_assoc($GetChatInformation))
	{
		$name=$GCI['alias'];
		$message=$GCI['mensaje'];
		if($order=="a")
		{
			$order = "b";
		}else
		{
			$order = "a";
		}
		
		echo "<div class='$order'>$name : $message</div>";
	}

?>