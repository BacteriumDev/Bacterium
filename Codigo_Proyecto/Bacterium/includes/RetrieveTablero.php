<?php
	session_start();
	include '../dbManager.php';
	if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
		header( "Location: bacterium_accessdenied.php" );
		exit();
	}
	
	$pid = $_GET['pid'];
	
	$GetTableroInformation=mysql_query("SELECT tablero FROM partidas WHERE idPartidas=$pid");
	$GTI=mysql_fetch_assoc($GetTableroInformation);
	
	$estadotablero = $GTI['tablero'];

	$indiceJugador = 3;
	$indiceDireccion = 4;

	$array = str_split($estadotablero);

	
	$indice = 0;
	$turno = $array[0];
	for($i = 0; $i < 65; $i++){
		$tablerojug[$indice] = $array[$indiceJugador];
		$tablerodir[$indice] = $array[$indiceDireccion];		
		$indiceJugador = $indiceJugador + 4;
		$indiceDireccion = $indiceDireccion + 4;
		$indice++;
	}
	$sql = "SELECT conf_modo_pantalla,conf_tileset,conf_vol_fx,conf_vol_mus FROM usuarios WHERE idUsuarios = $_SESSION[valid_user]";
	$result = mysql_query($sql) or trigger_error(mysql_error());
	$row = mysql_fetch_array($result);
	//set to form
	
	$modoPantalla 	= $row['conf_modo_pantalla'];
	$tileset 	= $row['conf_tileset'];
	$volFX 		= $row['conf_vol_fx'];
	$volMus 	= $row['conf_vol_mus'];

	
	//echo document.getElementById('audiotag1').volume
	$tilesetPath;
	if ($tileset == "Basicas"){
		$tilesetPath = "images/partida/";
	}else{
		$tilesetPath = "images/partida/metalicas1/";
	}
	
	$indice=0;
	
	for($i = 0; $i < 8; ++$i)
	{
		echo '<tr>';
		for($j = 0; $j < 8; ++$j)
		{
			//$numrandom = rand(1,4);
			if($tablerojug[$indice] == 1)
			{
				
				echo '<td onclick="validarJugada('. $i.$j .')"><img src="'.$tilesetPath.'jug'.$tablerodir[$indice].'.png" id="bac'.$i.$j.'"/></td>';
				echo '<input type="hidden" name="posxy'. $i.$j .'" value="'. $i.$j .'">';
				echo '<input type="hidden" name="jugador'. $i.$j .'" value="1">';
				echo '<input type="hidden" name="direccion'. $i.$j .'" value="'.$tablerodir[$indice].'">';
			}else if($tablerojug[$indice] == 2)
			{
				echo '<td onclick="validarJugada('. $i.$j .')"><img src="'.$tilesetPath.'cpu'.$tablerodir[$indice].'.png" id="bac'.$i.$j.'"/></td>';
				echo '<input type="hidden" name="posxy'. $i.$j .'" value="'. $i.$j .'">';
				echo '<input type="hidden" name="jugador'. $i.$j .'" value="2">';
				echo '<input type="hidden" name="direccion'. $i.$j .'" value="'.$tablerodir[$indice].'">';
			}else
			{
				echo '<td onclick="validarJugada('. $i.$j .')"><img src="'.$tilesetPath.'neutral'.$tablerodir[$indice].'.png" id="bac'.$i.$j.'"/></td>';
				echo '<input type="hidden" name="posxy'. $i.$j .'" value="'. $i.$j .'">';
				echo '<input type="hidden" name="jugador'. $i.$j .'" value="0">';
				echo '<input type="hidden" name="direccion'. $i.$j .'" value="'.$tablerodir[$indice].'">';
			}
			$indice++;
		}
		echo '</tr>';
	}
	
?>
