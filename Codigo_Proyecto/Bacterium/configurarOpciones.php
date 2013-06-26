<?php
session_start();

// Comprueba si el usuario se ha conectado
if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
	header( "Location: bacterium_accessdenied.php" );
	exit();
}

include 'dbManager.php';
	$modoPantalla;
	$tileset;
	$volFX;
	$volMus;
	if (isset($_POST['ModoPantalla']) && isset($_POST['Tileset']) && isset($_POST['volFX']) && isset($_POST['volMus']) ){
		//echo "holy";
		//set to DB
		$sql = "UPDATE usuarios SET conf_modo_pantalla = '$_POST[ModoPantalla]', conf_tileset = '$_POST[Tileset]', conf_vol_fx = $_POST[volFX], conf_vol_mus = $_POST[volMus] WHERE idUsuarios = $_SESSION[valid_user] ";
		$result = mysql_query($sql) or trigger_error(mysql_error());
		//$row = mysql_fetch_array($result);
		//set to form
		$modoPantalla 	= $_POST['ModoPantalla'];
		$tileset 	= $_POST['Tileset'];
		$volFX 		= $_POST['volFX'];
		$volMus 	= $_POST['volMus'];

		print '<script type="text/javascript">'; 
		print 'alert("Cambios aplicados correctamente")'; 
		print '</script>';
	}else{
		//get from DB
		$sql = "SELECT conf_modo_pantalla,conf_tileset,conf_vol_fx,conf_vol_mus FROM usuarios WHERE idUsuarios = $_SESSION[valid_user]";
		$result = mysql_query($sql) or trigger_error(mysql_error());
		$row = mysql_fetch_array($result);
		//set to form
		$modoPantalla 	= $row['conf_modo_pantalla'];
		$tileset 	= $row['conf_tileset'];
		$volFX 		= $row['conf_vol_fx'];
		$volMus 	= $row['conf_vol_mus'];
		
	} 
	
	$_POST['ModoPantalla'];
	$_POST['Tileset'];
	$_POST['volFX'];
	$_POST['volMus'];
?>

<html>
<head>
<title> Ingenieria de software </title>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1">
<link href="stylesheets/style.css" rel="stylesheet" type="text/css">
<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">
<link href="stylesheets/tournyboxstyle.css" rel="stylesheet" type="text/css">
<audio id="audiotag1" src="audio/action.wav" preload="auto"></audio>
<audio id="audiotag2" src="audio/music.wav" preload="auto"></audio>
<script>
	function tilesetChange(tileset){
		console.log(tileset);
		switch(tileset){
			case 0:
				document.getElementById("muestraTileset").src = "images/partida/jug1.png";
				break;
			case 1:
				document.getElementById("muestraTileset").src = "images/partida/metalicas1/jug1.png";
				break;
		}
	}
	function playTestVolumeFX(vol){
		console.log(vol);
		document.getElementById('audiotag1').volume = vol/100;
		document.getElementById('audiotag1').play();
	}
	function playTestVolumeMusic(vol){
		console.log(vol);
		document.getElementById('audiotag2').volume = vol/100;
		document.getElementById('audiotag2').play();
	}
</script>

</head>

	<body>

		<div id="wrapper">
			
			<div id="loginbar" align="right">
				<a href="usuarioEdit.php" class="button">Regresar</a>
			</div>
			<div id="tournycontent">
				<div id="tourny">
			<h2>Configuracion personal de juego</h2>
			<form class="boxCont" method="POST" form action="configurarOpciones.php">
				<div>
					<label for="ModoPantalla">Desea activar la opcion para entrar al modo de pantalla completa:</label> 
					<select style="width:15%" name="ModoPantalla">
						<option value="Modo Ventana" <?php if($modoPantalla == "Modo Ventana"){echo "selected";} ?>>No  </option>						
						<option value="Pantalla Completa" <?php if($modoPantalla == "Pantalla Completa"){echo "selected";} ?>>Si</option>
						
					<select/>
				</div>
				<div>
					<label for="Tileset"> Tipo de fechas a usar: </label>
					<select name="Tileset" onChange="tilesetChange(this.selectedIndex);">
						<option <?php if($tileset == "Basicas"){echo "selected";} ?>>Basicas</option>
						<option <?php if($tileset == "Metalicas"){echo "selected";} ?>>Metalicas</option>
					</select> 
				</div>
				<div>
					<label for="muestra"> Muestra del tipo de flechas: </label>
					<img id="muestraTileset" src= "<?php if($tileset=='Basicas'){echo 'images/partida/jug1.png';}else{echo 'images/partida/metalicas1/jug1.png';} ?>"/>
				</div>
				<div>
					<label for="volFX"> Volumen de los efectos de sonido: </label>
					<input name="volFX" type="range" min="0" max="100" value="<?php echo $volFX;?>" onMouseUp="playTestVolumeFX(this.value);"/>
				</div>
				
				<div>
					<label for="volMus"> Volumen de la musica: </label>
					<input name="volMus" type="range" min="0" max="100" value="<?php echo $volMus;?>" onMouseUp="playTestVolumeMusic(this.value);"/>
				</div>
				
				<div>
				<input type="submit" value="Modificar configuracion" class="btn right"/>
				</div>
			</form>
			
			
		</div>
		
	</body>
</html>

<?php
			/*if(!isset($_POST['ModoPantalla'] && !isset($_POST['Tileset'] && !isset($_POST['volFX'] && !isset($_POST['volMus'])
		//if (isset($_POST['ModoPantalla'])
		{
			print '<script type="text/javascript">'; 
			print 'alert("Algun campo esta vacio, intente de nuevo crear el torneo")'; 
			print '</script>';
		}*/
		?>
