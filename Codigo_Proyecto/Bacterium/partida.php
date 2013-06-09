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
		}
	}

</script>

</head>

	<body onload="crearTablero()">

		<div id="wrapper">
			
			<div id="loginbar" align="right">
				<a href="index.php" class="button">Regresar</a>
			</div>
			
			
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




		
		</div>
	</body>
</html>