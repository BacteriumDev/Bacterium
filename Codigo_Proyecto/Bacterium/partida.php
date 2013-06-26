<?php
session_start();

$saludo = "";

// Comprueba si el usuario se ha conectado
if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
	header( "Location: bacterium_accessdenied.php" );
	exit();
}

$nivel = $_POST['dificultad'];
$saludo = "";
if($nivel == 1)
{
	$saludo = "Facil";
}else if($nivel == 2)
{
	$saludo = "Normal";
}else if($nivel == 3)
{
	$saludo = "Dificil";
}
	include 'dbManager.php';
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
<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">
<link href="stylesheets/loginboxstyle.css" rel="stylesheet" type="text/css">
<script src="scripts/fullscreenManager.js"></script>
<style type="text/css">
	#partida:-webkit-full-screen {
		width: 100%;
		height: 100%;
	}
	#partida:-moz-full-screen {
		width: 100%;
		height: 100%;
	}
	.partida:--webkit-full-screen{
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
</script>

<script>
	var turnojugador = true;

	//var mySet = new Set();	
	var posiciones = {}; //conjunto de posiciones, para el contagio recursivo
	var posiciones_CPU = {};
	/*posiciones[12] = true;
	posiciones["pos12"] = true;
	console.log(posiciones["pos12"]);
	console.log(posiciones[13]);
	if ("pos12" in posiciones){
		console.log("yup");
	}*/

	function validarJugada(x)
	{
		posiciones = {};
		posiciones_CPU = {};
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
		
		if(turnojugador && jug != 1)
		{
			alert("Jugada inválida esta ficha no le pertenece");
		}else if(!turnojugador)
		{
			alert("No puede realizar jugadas durante el turno de la IA");
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
			
			document.getElementById("bac"+x).src=tilesetPath+"jug" + dir + ".PNG";
			document.getElementsByName("direccion"+x)[0].value = dir;
			//alert("nueva dir: " + dir);
			//alert("Turno de la IA");
			//document.getElementById('audiotag1').volume = '<?php echo $volMus/100;?>';
			document.getElementById('audiotag1').play(); //agregado por juanca
			contagio(pos.split("")[0],pos.split("")[1],dir);
			checkGane();
			window.setTimeout(function(){jugadaIA()},1000);
		}
	}
	
	function contagio(i,j,pos)
	{
		num1 = parseInt(i);
		num2 = parseInt(j);
		posiciones["pos"+num1+num2] = true;
		//posiciones_CPU["pos"+num1+num2] = false;
		if(pos == 1)
		{
			//alert("contagio arriba");
			if ("pos"+(num1-1)+num2 in posiciones){
			}else{
			rec_contagio(num1-1,num2,pos);
			}
			//contagio_indirecto_derecha(num1,num2+1);
			//contagio_indirecto_abajo(num1+1,num2);
			//contagio_indirecto_izquierda(num1,num2-1);
		}else if(pos == 2)
		{
			//alert("contagio derecha");
			if ("pos"+num1+(num2+1) in posiciones){
			}else{
			rec_contagio(num1,num2+1,pos);}
			//contagio_indirecto_arriba(num1-1,num2);
			//contagio_indirecto_abajo(num1+1,num2);
			//contagio_indirecto_izquierda(num1,num2-1);
		}else if(pos == 3)
		{
			//alert("contagio abajo");
			if ("pos"+(num1+1)+num2 in posiciones){
			}else{
			rec_contagio(num1+1,num2,pos);
			}
			//contagio_indirecto_derecha(num1,num2+1);
			//contagio_indirecto_arriba(num1-1,num2);
			//contagio_indirecto_izquierda(num1,num2-1);
		}else if(pos == 4)
		{
			//alert("contagio izquierda");
			if ("pos"+num1+(num2-1) in posiciones){
			}else{
			rec_contagio(num1,num2-1,pos);
			}
			//contagio_indirecto_derecha(num1,num2+1);
			//contagio_indirecto_abajo(num1+1,num2);
			//contagio_indirecto_arriba(num1-1,num2);
		}

	}
	
	function contagio_indirecto_arriba(i,j)
	{
		if(i >= 0 && j >= 0 && i < 8 && j < 8)
		{
			var dir = document.getElementsByName("direccion"+i+j)[0].value;
			if(dir == 3)
			{
				document.getElementById("bac"+i+j).src=tilesetPath+"jug" + dir + ".PNG";
				document.getElementsByName("jugador"+i+j)[0].value = 1;
				num1 = parseInt(i);
				num2 = parseInt(j);
				//contagio(num1,num2,dir);
			}
		}
	}
	
	function contagio_indirecto_derecha(i,j)
	{
		//alert("contagio derecha" + i + j);
		if(i >= 0 && j >= 0 && i < 8 && j < 8)
		{
			var dir = document.getElementsByName("direccion"+i+j)[0].value;
			if(dir == 4)
			{
				
				document.getElementById("bac"+i+j).src=tilesetPath+"jug" + dir + ".PNG";
				document.getElementsByName("jugador"+i+j)[0].value = 1;
				num1 = parseInt(i);
				num2 = parseInt(j);
				//contagio(num1,num2,dir);
			}
		}
	}
	
	function contagio_indirecto_abajo(i,j)
	{
		if(i >= 0 && j >= 0 && i < 8 && j < 8)
		{
			var dir = document.getElementsByName("direccion"+i+j)[0].value;
			if(dir == 1)
			{
				document.getElementById("bac"+i+j).src=tilesetPath+"jug" + dir + ".PNG";
				document.getElementsByName("jugador"+i+j)[0].value = 1;
				num1 = parseInt(i);
				num2 = parseInt(j);
				//contagio(num1,num2,dir);
			}
		}
	}
	
	function contagio_indirecto_izquierda(i,j)
	{
		if(i >= 0 && j >= 0 && i < 8 && j < 8)
		{
			var dir = document.getElementsByName("direccion"+i+j)[0].value;
			if(dir == 2)
			{
				document.getElementById("bac"+i+j).src=tilesetPath+"jug" + dir + ".PNG";
				document.getElementsByName("jugador"+i+j)[0].value = 1;
				num1 = parseInt(i);
				num2 = parseInt(j);
				//contagio(num1,num2,dir);
			}
		}
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
			var dir = document.getElementsByName("direccion"+i+j)[0].value;
			//alert("entrando a contagio rec bac"+i+j);
			document.getElementById("bac"+i+j).src=tilesetPath+"jug" + dir + ".PNG";
			document.getElementsByName("jugador"+i+j)[0].value = 1;
			num1 = parseInt(i);
			num2 = parseInt(j);
			//console.log(i,j);
			//posiciones["pos"+num1+num2] = true;
			//if("pos"+num1+num2 in posiciones){
			//}else{
			//posiciones_CPU["pos"+i+j] = false;
			contagio(num1,num2,dir);
			//}			
		}
	}

	function contagio_CPU(i,j,pos)
	{
		num1 = parseInt(i);
		num2 = parseInt(j);
		posiciones_CPU["pos"+num1+num2] = true;
		//posiciones["pos"+num1+num2] = false;
		if(pos == 1)
		{
			//alert("contagio arriba");
			if ("pos"+(num1-1)+num2 in posiciones_CPU){
			}else{
			rec_contagio_CPU(num1-1,num2,pos);
			}
			//contagio_indirecto_derecha(num1,num2+1);
			//contagio_indirecto_abajo(num1+1,num2);
			//contagio_indirecto_izquierda(num1,num2-1);
		}else if(pos == 2)
		{
			//alert("contagio derecha");
			if ("pos"+num1+(num2+1) in posiciones_CPU){
			}else{
			rec_contagio_CPU(num1,num2+1,pos);}
			//contagio_indirecto_arriba(num1-1,num2);
			//contagio_indirecto_abajo(num1+1,num2);
			//contagio_indirecto_izquierda(num1,num2-1);
		}else if(pos == 3)
		{
			//alert("contagio abajo");
			if ("pos"+(num1+1)+num2 in posiciones_CPU){
			}else{
			rec_contagio_CPU(num1+1,num2,pos);
			}
			//contagio_indirecto_derecha(num1,num2+1);
			//contagio_indirecto_arriba(num1-1,num2);
			//contagio_indirecto_izquierda(num1,num2-1);
		}else if(pos == 4)
		{
			//alert("contagio izquierda");
			if ("pos"+num1+(num2-1) in posiciones_CPU){
			}else{
			rec_contagio_CPU(num1,num2-1,pos);
			}
			//contagio_indirecto_derecha(num1,num2+1);
			//contagio_indirecto_abajo(num1+1,num2);
			//contagio_indirecto_arriba(num1-1,num2);
		}

	}
	function rec_contagio_CPU(i,j,poscontagiado)
	{
		//alert("entrando");
		//verificar direccion de flecha
		//
	
		//alert("entrando a contagio rec" + i + j + poscontagiado);
		
		//verificar posicion valida
		if(i >= 0 && j >= 0 && i < 8 && j < 8)
		{
			var dir = document.getElementsByName("direccion"+i+j)[0].value;
			//alert("entrando a contagio rec bac"+i+j);
			document.getElementById("bac"+i+j).src=tilesetPath+"cpu" + dir + ".PNG";
			document.getElementsByName("jugador"+i+j)[0].value = 2;
			num1 = parseInt(i);
			num2 = parseInt(j);
			//console.log(i,j);
			//posiciones["pos"+num1+num2] = true;
			//if("pos"+num1+num2 in posiciones){
			//}else{
			//posiciones["pos"+num1+num2] = false;
			contagio_CPU(num1,num2,dir);
			//}			
		}
	}

	function jugadaIA(){
		while(!turnojugador){
			//console.log('wat');
			//contagio(7,7);

			//logica IA
			//pos Movimiento dificultad: facil
			var x = parseInt(7);// = parseInt(1);
			var y = parseInt(7);// = parseInt(1);
			//console.log(Math.floor((Math.random()*10)%7)+1);
			//if('<?php echo $nivel;?>' == 1){
				//console.log("ez pz");
				var found = false;
				x = Math.floor((Math.random()*10)%7)+1;
				y = Math.floor((Math.random()*10)%7)+1;
				///console.log(x);
				//console.log(y);
				while(!found)
				{			
				x = Math.floor((Math.random()*10)%7)+1;
				y = Math.floor((Math.random()*10)%7)+1;
				var jugCheck = document.getElementsByName("jugador"+x+""+y)[0].value;
				//console.log(jugCheck);
				if(jugCheck == 2){found=true;}
				}
			//}
			//console.log(x+""+y);
			//
			var pos = document.getElementsByName("posxy"+x+y)[0].value;
			var jug = document.getElementsByName("jugador"+x+y)[0].value;
			var dir = document.getElementsByName("direccion"+x+y)[0].value;

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

			document.getElementById("bac"+x+y).src=tilesetPath+"cpu" + dir + ".PNG";
			document.getElementsByName("direccion"+x+y)[0].value = dir;
			
			contagio_CPU(x,y,dir);

			//console.log(pos);
			//console.log(jug);
			//console.log(dir);

			turnojugador = true;
			checkGane();
		}
	}
	function checkGane(){
		var i = 0;
		var j = 0;
		var existenJugador = false;
		var existenCPU = false;
		for (i=0;i<8;i++){
			for(j=0;j<8;j++){
				if(document.getElementsByName("jugador"+i+j)[0].value == 1){
					existenJugador = true;
					console.log('jugador1');
				}
			}
		}
		for (i=0;i<8;i++){
			for(j=0;j<8;j++){
				if(document.getElementsByName("jugador"+i+""+j)[0].value == 2){
					existenCPU = true;
					console.log('CPU1');
				}
			}
		}
		console.log(existenJugador);
		console.log(existenCPU);
		if (existenJugador && existenCPU){
		}else if(existenJugador){
			alert('Ganaste!');
			window.location = "menuPartidas.php";
		}else{
			alert('Perdiste!');
			window.location = "menuPartidas.php";
		}
	}



</script>

</head>

	<body onload="crearTablero()">
	
		<div id="wrapper">
			
			<div id="loginbar" align="right">
				<a href="partidas_hub.php" class="button">Regresar a partidas</a>
			</div>
			
			<h2>Partida en solitario contra IA nivel: <?php echo $saludo ?></h2>
		
		
		<table  id="partida"  align="center" border="1" bordercolor="000000" style="background-color:FFFFFF" width="100">
			<?php 
				for($i = 0; $i < 8; ++$i)
				{
					echo '<tr >';
					for($j = 0; $j < 8; ++$j)
					{
						$numrandom = rand(1,4);
						if($i==0 && $j==0)
						{
							
							echo '<td   onclick="validarJugada('. $i.$j .')"><img src="'.$tilesetPath.'jug'.$numrandom.'.PNG" class="partida"  id="bac'.$i.$j.'"/></td>';
							echo '<input type="hidden" name="posxy'. $i.$j .'" value="'. $i.$j .'">';
							echo '<input type="hidden" name="jugador'. $i.$j .'" value="1">';
							echo '<input type="hidden" name="direccion'. $i.$j .'" value="'.$numrandom.'">';
						}else if($i==7 && $j==7)
						{
							echo '<td onclick="validarJugada('. $i.$j .')"><img src="'.$tilesetPath.'cpu'.$numrandom.'.PNG" class="partida" id="bac'.$i.$j.'"/></td>';
							echo '<input type="hidden" name="posxy'. $i.$j .'" value="'. $i.$j .'">';
							echo '<input type="hidden" name="jugador'. $i.$j .'" value="2">';
							echo '<input type="hidden" name="direccion'. $i.$j .'" value="'.$numrandom.'">';
						}else
						{
							echo '<td onclick="validarJugada('. $i.$j .')"><img src="'.$tilesetPath.'neutral'.$numrandom.'.PNG" class="partida" id="bac'.$i.$j.'"/></td>';
							echo '<input type="hidden" name="posxy'. $i.$j .'" value="'. $i.$j .'">';
							echo '<input type="hidden" name="jugador'. $i.$j .'" value="0">';
							echo '<input type="hidden" name="direccion'. $i.$j .'" value="'.$numrandom.'">';
						}
					}
					echo '</tr>';
				}
			
			
			
			?>
			
		</table>
		<div  id="fullscreen" style="text-align:center" hidden="true">
		<button style="width:54%" class="boton"  onClick="goFullscreen('partida'); return false"> Modo pantalla completa </button>	
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

