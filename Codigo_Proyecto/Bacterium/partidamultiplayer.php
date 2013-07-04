<?php
session_start();

// Comprueba si el usuario se ha conectado
if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
	header( "Location: bacterium_accessdenied.php" );
	exit();
}

$idpartida = (int) $_GET['id'];
$idjugadorturno = (int) $_GET['p'];
$idjugadorturno++;


include 'dbManager.php';

$actualizarJugadores=mysql_query("UPDATE partidas SET numero_jugadores=$idjugadorturno WHERE idPartidas=$idpartida");

$GetTablero=mysql_query("SELECT tablero FROM partidas WHERE idPartidas = '$idpartida'");
$GT=mysql_fetch_assoc($GetTablero);

$estadotablero = $GT['tablero'];

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
//print_r($tablerojug);

	//seteado de opciones de configuracion
	//get from DB
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
?>

<html>
<head>
<title> Ingenieria de software </title>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1">
<link href="stylesheets/style.css" rel="stylesheet" type="text/css">
<link href="stylesheets/chatstyle.css" rel="stylesheet" type="text/css">
<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">
<script src="scripts/ajax_dinamic_content.js"></script>
<script src="scripts/fullscreenManager.js"></script>
<style type="text/css">
	#tableromp:-webkit-full-screen {
		width: 100%;
		height: 100%;
	}
	#tableromp:-moz-full-screen {
		width: 100%;
		height: 100%;
	}
	.tableromp:--webkit-full-screen{
		width: 100%;

		height: 50%;
	}
</style>
<audio id="audiotag1" src="audio/action.wav" preload="auto"></audio>
<audio id="audiotag2" src="audio/music.wav" preload="auto" loop="true" autoplay="autoplay"></audio>

<script>
	//var usarConf = confirm('cosas');
	document.getElementById('audiotag1').volume = '<?php echo $volFX/100;?>'; //fiiiix
	document.getElementById('audiotag2').volume = '<?php echo $volMus/100;?>';
	if ('<?php echo $volMus;?>' == 0){
		document.getElementById('audiotag2').pause();
	}
	//console.log( '<?php echo $row[conf_vol_fx];?>');
	var tilesetPath = '<?php echo $tilesetPath;?>';
	console.log(tilesetPath); // global con el path al tileset usado

	var posiciones = {};

	function getRules(){
		alert("El objetivo del juego consiste en capturar todas las fichas de su oponente.\nPara esto debera dar click en las fichas de su color correspondiente, rotandolas en el sentido de las manecillas del reloj.\n\nAl rotar las fichas puede capturar fichas de cualquier color, siempre y cuando esten siendo apuntadas o apunten a alguna ficha involucrada en su movimiento.\n\nAdemas, el juego le puede proveer ayuda sobre el mejor movimmiento que puede realizar cuando este jugando en una partida en solitario.\nPara hacer uso de esta ayuda, haga click en el boton de 'Mostrar movimiento optimo' dentro de una partida en solitario.");
	}

	function obtener()
	{  
		callAjax('includes/Retrieve.php?pid=<?php Print($idpartida); ?>', 'canvas', 'retrieving...', 'Error');
		//setInterval("obtener()", 1 * 1000);			
	}
	
	function obtenerTablero()
	{
		callAjax('includes/RetrieveTablero.php?pid=<?php Print($idpartida); ?>', 'tableromp', 'retrieving...', 'Error');
		//alert("Ahora es su turno");
		turnojugador = true;
	}

	function SendTablero()
	{
		var idpar = <?php Print($idpartida); ?>;
		var turno = <?php Print($idjugadorturno); ?>;
		var tablero = turno + "||";
		
		var jug;
		var dir;
		for(var i = 0; i < 8; i++)
		{
			for(var j = 0; j < 8; j++)
			{
				jug = document.getElementsByName("jugador"+i+""+j)[0].value;
				dir = document.getElementsByName("direccion"+i+""+j)[0].value;
				tablero = tablero + jug + dir + "||";
			}
		}
		
		//alert("includes/SendTablero.php?partida="+idpar+"&tablero="+tablero);
		var xmlhttp;
		
		if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
		
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){}
		}
		xmlhttp.open("GET","includes/SendTablero.php?partida="+idpar+"&tablero="+tablero+"&turno="+turno, true);
		xmlhttp.send();
	}
	
	function Send()
	{
		//alert("funcion send");
		var idpar = <?php Print($idpartida); ?>;
		var nombre = "<?php Print($_SESSION['alias']); ?>";
		
		m = document.getElementById("message").value;
		n = nombre
		//alert("send" + idpar + " " + nombre);
		var xmlhttp;
		
		if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
		
		xmlhttp.onreadystatechange = function()
		{
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){}
		}
		//alert(""+ idpar + n + m);
		
		//alert("Send.php?message="+m+"&name="+n+"&partida="+<?php echo $idpartida ?>);
		xmlhttp.open("GET","includes/Send.php?message="+m+"&name="+n+"&partida="+idpar, true);
		xmlhttp.send();
	}

	var turnojugador = new Boolean();

	function validarJugada(x)
	{
		posiciones = {};
		if(x == 0)
		{
			x = "00";
		}else if(x == 1)
		{
			x = "01";
		}else if(x == 2)
		{
			x = "02";
		}else if(x == 3)
		{
			x = "03";
		}else if(x == 4)
		{
			x = "04";
		}else if(x == 5)
		{
			x = "05";
		}else if(x == 6)
		{
			x = "06";
		}else if(x == 7)
		{
			x = "07";
		}
		var pos = document.getElementsByName("posxy"+x)[0].value;
		var jug = document.getElementsByName("jugador"+x)[0].value;
		var dir = document.getElementsByName("direccion"+x)[0].value;
		//alert("DATOS A VALIDAR\n" + "Posicion: " + pos + "\n" + "Jugador: " + jug + "\n" + "Direccion: " + dir);		
		

		
		if(turnojugador && jug != <?php Print($idjugadorturno); ?>)
		{
			alert("Jugada inv�lida esta ficha no le pertenece");
		}else if(!turnojugador)
		{
			alert("No puede realizar jugadas cuando no es su turno");
		}else
		{
			turnojugador = false;
			if(dir == 1)
			{
				dir = 2;
			}else if(dir == 2)
			{
				dir = 3;
			}else if(dir == 3)
			{
				dir = 4;
			}else if(dir == 4)
			{
				dir = 1;
			}
			
			if(<?php Print($idjugadorturno); ?> == 1)
			{
				document.getElementById("bac"+x).src=tilesetPath+"jug" + dir + ".png";
				document.getElementsByName("direccion"+x)[0].value = dir;
				//alert("nueva dir: " + dir);
				//alert("Turno de la IA");
				document.getElementById('audiotag1').play(); //agregado por juanca
				contagio(pos.split("")[0],pos.split("")[1],dir);
			}else
			{
				document.getElementById("bac"+x).src="images/partida/cpu" + dir + ".png";
				document.getElementsByName("direccion"+x)[0].value = dir;
				//alert("nueva dir: " + dir);
				//alert("Turno de la IA");
				document.getElementById('audiotag1').play(); //agregado por juanca
				contagio(pos.split("")[0],pos.split("")[1],dir);
			}
			
			SendTablero();
		}
	}
	
	function contagio(i,j,pos)
	{
		num1 = parseInt(i);
		num2 = parseInt(j);
		posiciones["pos"+num1+num2] = true;
		if(pos == 1)
		{
		if("pos"+(num1-1)+num2 in posiciones){
		}else{
			//alert("contagio arriba");
			rec_contagio(num1-1,num2,pos);
			//contagio_indirecto_derecha(num1,num2+1);
			//contagio_indirecto_abajo(num1+1,num2);
			//contagio_indirecto_izquierda(num1,num2-1);
		}}else if(pos == 2)
		{
		if("pos"+num1+(num2+1) in posiciones){
		}else{
			//alert("contagio derecha");
			rec_contagio(num1,num2+1,pos);
			//contagio_indirecto_arriba(num1-1,num2);
			//contagio_indirecto_abajo(num1+1,num2);
			//contagio_indirecto_izquierda(num1,num2-1);
		}}else if(pos == 3)
		{
		if("pos"+(num1+1)+num2 in posiciones){
		}else{
			//alert("contagio abajo");
			rec_contagio(num1+1,num2,pos);
			//contagio_indirecto_derecha(num1,num2+1);
			//contagio_indirecto_arriba(num1-1,num2);
			//contagio_indirecto_izquierda(num1,num2-1);
		}}else if(pos == 4)
		{
		if("pos"+num1+(num2-1) in posiciones){
		}else{
			//alert("contagio izquierda");
			rec_contagio(num1,num2-1,pos);
			//contagio_indirecto_derecha(num1,num2+1);
			//contagio_indirecto_abajo(num1+1,num2);
			//contagio_indirecto_arriba(num1-1,num2);
		}}

	}
	
	
	function rec_contagio(i,j,poscontagiado)
	{
		//alert("entrando");
		//verificar direccion de flecha
		//
	
		//alert("entrando a contagio rec" + i + j + poscontagiado);
		
		//verificar posicion valida
		if(i >= 0 && j >= 0 && i < 8 && j < 8)
		{
			if(<?php Print($idjugadorturno); ?> == 1){
				var dir = document.getElementsByName("direccion"+i+j)[0].value;
				//alert("entrando a contagio rec bac"+i+j);
				document.getElementById("bac"+i+j).src=tilesetPath+"jug" + dir + ".png";
				document.getElementsByName("jugador"+i+j)[0].value = 1;
				num1 = parseInt(i);
				num2 = parseInt(j);
				contagio(num1,num2,dir);			
			}else
			{
				var dir = document.getElementsByName("direccion"+i+j)[0].value;
				//alert("entrando a contagio rec bac"+i+j);
				document.getElementById("bac"+i+j).src="images/partida/cpu" + dir + ".png";
				document.getElementsByName("jugador"+i+j)[0].value = 2;
				num1 = parseInt(i);
				num2 = parseInt(j);
				contagio(num1,num2,dir);			
			}
		}
	}

	function iniciar()
	{
		//obtenerTablero();
	}

</script>

</head>

	<body onload="obtenerTablero()">

		<div id="wrapper">
			
			<div id="loginbar" align="right">
				<a href="partidas_hub.php?partida=<?php echo $idpartida ?>" class="button">Salir y regresar a partidas</a>
			</div>
			
			<h2>Partida multiplayer</h2>
			
		<table id="tableromp" align="center" border="1" bordercolor="000000" style="background-color:FFFFFF" width="100">
			<?php 
					$indice = 0;
					for($i = 0; $i < 8; ++$i)
					{
						echo '<tr>';
						for($j = 0; $j < 8; ++$j)
						{
							//$numrandom = rand(1,4);
							if($tablerojug[$indice] == 1)
							{
								
								echo '<td onclick="validarJugada('. $i.$j .')"><img src="'.$tilesetPath.'jug'.$tablerodir[$indice].'.png" class="partida" id="bac'.$i.$j.'"/></td>';
								echo '<input type="hidden" name="posxy'. $i.$j .'" value="'. $i.$j .'">';
								echo '<input type="hidden" name="jugador'. $i.$j .'" value="1">';
								echo '<input type="hidden" name="direccion'. $i.$j .'" value="'.$tablerodir[$indice].'">';
							}else if($tablerojug[$indice] == 2)
							{
								echo '<td onclick="validarJugada('. $i.$j .')"><img src="'.$tilesetPath.'cpu'.$tablerodir[$indice].'.png" class="partida" id="bac'.$i.$j.'"/></td>';
								echo '<input type="hidden" name="posxy'. $i.$j .'" value="'. $i.$j .'">';
								echo '<input type="hidden" name="jugador'. $i.$j .'" value="2">';
								echo '<input type="hidden" name="direccion'. $i.$j .'" value="'.$tablerodir[$indice].'">';
							}else
							{
								echo '<td onclick="validarJugada('. $i.$j .')"><img src="'.$tilesetPath.'neutral'.$tablerodir[$indice].'.png" class="partida" id="bac'.$i.$j.'"/></td>';
								echo '<input type="hidden" name="posxy'. $i.$j .'" value="'. $i.$j .'">';
								echo '<input type="hidden" name="jugador'. $i.$j .'" value="0">';
								echo '<input type="hidden" name="direccion'. $i.$j .'" value="'.$tablerodir[$indice].'">';
							}
							$indice++;
						}
						
						echo '</tr>';
					}
			
			
			
			?>
			
		</table>

		<div id="canvas"></div>
		<div align="center">
			<input type="text" id="message" size="50" maxlength="50" placeholder="Message"/>
			<input type="button" id="send" value="Enviar" onclick="Send()"/>
			<input type="button" id="activar" value="Ver chat" onclick="obtener()"/>
			<input type="button" id="turno" value="Mi turno" onclick="obtenerTablero()"/>
		</div>
		<div  id="ayudaReglas" style="text-align:center" >
		<button style="width:54%" class="boton"  onClick="getRules(); return false"> Mostrar reglas del juego</button>	
		</div>
		<div  id="fullscreen" style="text-align:center" hidden="true">
		<button style="width:54%" class="boton"  onClick="goFullscreen('tableromp'); return false"> Modo pantalla completa </button>	
		</div>
			<div id="footer">
					<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
			</div>
		
		</div>
	</body>
</html>

<script>
	if('<?php echo $modoPantalla;?>' == "Pantalla Completa"){
		document.getElementById('fullscreen').hidden = false;
	}
	
</script>
