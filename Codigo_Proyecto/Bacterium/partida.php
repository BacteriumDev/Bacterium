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




?>

<html>
<head>
<title> Ingenieria de software </title>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1">
<link href="stylesheets/style.css" rel="stylesheet" type="text/css">
<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">

<script>
	var turnojugador = true;

	function validarJugada(x)
	{
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
			//turnojugador = false;
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
			
			document.getElementById("bac"+x).src="images/partida/jug" + dir + ".png";
			document.getElementsByName("direccion"+x)[0].value = dir;
			//alert("nueva dir: " + dir);
			//alert("Turno de la IA");
			contagio(pos.split("")[0],pos.split("")[1],dir);
		}
	}
	
	function contagio(i,j,pos)
	{
		num1 = parseInt(i);
		num2 = parseInt(j);
		if(pos == 1)
		{
			//alert("contagio arriba");
			rec_contagio(num1-1,num2,pos);
			//contagio_indirecto_derecha(num1,num2+1);
			//contagio_indirecto_abajo(num1+1,num2);
			//contagio_indirecto_izquierda(num1,num2-1);
		}else if(pos == 2)
		{
			//alert("contagio derecha");
			rec_contagio(num1,num2+1,pos);
			//contagio_indirecto_arriba(num1-1,num2);
			//contagio_indirecto_abajo(num1+1,num2);
			//contagio_indirecto_izquierda(num1,num2-1);
		}else if(pos == 3)
		{
			//alert("contagio abajo");
			rec_contagio(num1+1,num2,pos);
			//contagio_indirecto_derecha(num1,num2+1);
			//contagio_indirecto_arriba(num1-1,num2);
			//contagio_indirecto_izquierda(num1,num2-1);
		}else if(pos == 4)
		{
			//alert("contagio izquierda");
			rec_contagio(num1,num2-1,pos);
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
				document.getElementById("bac"+i+j).src="images/partida/jug" + dir + ".png";
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
				
				document.getElementById("bac"+i+j).src="images/partida/jug" + dir + ".png";
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
				document.getElementById("bac"+i+j).src="images/partida/jug" + dir + ".png";
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
				document.getElementById("bac"+i+j).src="images/partida/jug" + dir + ".png";
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
			document.getElementById("bac"+i+j).src="images/partida/jug" + dir + ".png";
			document.getElementsByName("jugador"+i+j)[0].value = 1;
			num1 = parseInt(i);
			num2 = parseInt(j);
			contagio(num1,num2,dir);			
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
			
		<table align="center" border="1" bordercolor="000000" style="background-color:FFFFFF" width="100">
			<?php 
				for($i = 0; $i < 8; ++$i)
				{
					echo '<tr>';
					for($j = 0; $j < 8; ++$j)
					{
						$numrandom = rand(1,4);
						if($i==0 && $j==0)
						{
							
							echo '<td onclick="validarJugada('. $i.$j .')"><img src="images/partida/jug'.$numrandom.'.png" id="bac'.$i.$j.'"/></td>';
							echo '<input type="hidden" name="posxy'. $i.$j .'" value="'. $i.$j .'">';
							echo '<input type="hidden" name="jugador'. $i.$j .'" value="1">';
							echo '<input type="hidden" name="direccion'. $i.$j .'" value="'.$numrandom.'">';
						}else if($i==7 && $j==7)
						{
							echo '<td onclick="validarJugada('. $i.$j .')"><img src="images/partida/cpu'.$numrandom.'.png" id="bac'.$i.$j.'"/></td>';
							echo '<input type="hidden" name="posxy'. $i.$j .'" value="'. $i.$j .'">';
							echo '<input type="hidden" name="jugador'. $i.$j .'" value="2">';
							echo '<input type="hidden" name="direccion'. $i.$j .'" value="'.$numrandom.'">';
						}else
						{
							echo '<td onclick="validarJugada('. $i.$j .')"><img src="images/partida/neutral'.$numrandom.'.png" id="bac'.$i.$j.'"/></td>';
							echo '<input type="hidden" name="posxy'. $i.$j .'" value="'. $i.$j .'">';
							echo '<input type="hidden" name="jugador'. $i.$j .'" value="0">';
							echo '<input type="hidden" name="direccion'. $i.$j .'" value="'.$numrandom.'">';
						}
					}
					echo '</tr>';
				}
			
			
			
			?>
			
		</table>

		

			<div id="footer">
					<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
			</div>
		
		</div>
	</body>
</html>