<?php
	session_start();
	if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
		header( "Location: bacterium_accessdenied.php" );
		exit();
	}	
?>




<html>
<head>
<title> Ingenieria de software </title>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1">
<link href="stylesheets/style.css" rel="stylesheet" type="text/css">
<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">
<link href="stylesheets/tournyboxstyle.css" rel="stylesheet" type="text/css">

</head>
	<body>
		<div id="wrapper">
			
			<div id="loginbar" align="right">
				<a href="menuPartidas.php" class="button">Regresar</a>
			</div>
			
			<div id="tournycontent">
				<div id="tourny">
					<h2>Complete la informacion de la partida a crear</h2>
					<form class="boxCont"form action="agregarPartida.php" method="post">
						<div>
							<label for="TipoPartida">Tipo de partida:</label> 
								<select name="Tipo de partida" >
									<option>2 jugadores (1 vs. 1)</option>
									<option>4 jugadores (1 vs. 1 vs. 1 vs. 1)</option>
									<option>4 jugadores (2 vs. 2)</option>
								</select>
						</div>

						
						
						<div>
							<input type="submit" value="Continuar" class="btn right"/>
						</div>
					</form>
				</div>
			</div>
			<div id="footer">
					<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
			</div>
		</div>
	</body>
</html>