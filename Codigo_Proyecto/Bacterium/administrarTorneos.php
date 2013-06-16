<?php
	session_start();
	include 'dbManager.php';
	if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
		header( "Location: bacterium_accessdenied.php" );
		exit();
	}
	
	
	
	extract( $_REQUEST );

	$sql = "SELECT nombre,max_participantes,tipo_eliminacion,tipo_participacion,estado FROM torneos WHERE idAdmin = $_SESSION[valid_user] ORDER BY nombre";
	
	$result = mysql_query($sql) or trigger_error(mysql_error());
	
	if (isset($_GET[nombreTorneo])){
		$_POST['nombreTorneo'] = $_GET[nombreTorneo];
	}
	
	print "<h1>$_POST[nombreTorneo]</h1>";
	?>	
	<p id="nombreTorneoHolder" hidden = true></p>
	 <script type="text/javascript">
	
	function whiteRow(row) //pone un row en blanco
	{
		row.style.backgroundColor = 'white';
	}
	function bleachRows(tableRow) //limpia todos los rows a blanco
	{
		var rows = tableRow.parentNode.getElementsByTagName("tr");
		//console.log(rows);
		for(var i=0;i<rows.length;i++){
			//console.log(rows[i]);
			whiteRow(rows[i]);
		}
	}
	function ChangeColor(tableRow, highLight)
    {
		//console.log(tableRow.style.backgroundColor);
		if (!(tableRow.style.backgroundColor == '#794044'))
		{
		if(tableRow.style.backgroundColor == 'white' && highLight == true){
		  tableRow.style.backgroundColor = '#dcfac9';
		}
		else if(highLight == false)
		{
			//console.log(tableRow.style.backgroundColor);
			if (tableRow.style.backgroundColor == 'rgb(121, 64, 68)'){
				//console.log("No borrar");
			}
			else{
				tableRow.style.backgroundColor = 'white';
				//console.log("borrar");
			}
		}
		}else{
			//console.log("NOOO");
		}
	}
	var nombreTorneo;
	function getRow(e, tableRow){
		var nombreTorneo = e.target.parentNode.getElementsByTagName("td")[0].textContent;
		document.getElementById('nombreTorneoHolder').textContent = nombreTorneo.toString();
		if (tableRow.style.backgroundColor == 'white' || tableRow.style.backgroundColor == 'rgb(220, 250, 201)')
		{
			bleachRows(tableRow); //limpia todos los rows para que solo uno este seleccionado
		  tableRow.style.backgroundColor = '#794044';
		  document.getElementById('cosa').href = "calendarizarTorneo.php?nombreTorneo="+nombreTorneo.toString();
		}
		else 
		{
		  tableRow.style.backgroundColor = 'white';
		  document.getElementById('nombreTorneoHolder').textContent = '';
		  
		  
		}
		//el toque de abajo ya no fue necesario porque se lo asigno directamente al div del boton
		
		//el toque aqui es que defini un pedacito de html que se llama nombreTorneoHolder
		//tons le cambio el texto a ese mop, para poder usarlo como parte del $_GET al calendarizar y otras cosas
		//la idea es usar el nombre del torneo en conjunto con el id del usuario para trabajar sobre este
	}
	</script>
	<html>
	<head>
	<title> Ingenieria de software </title>
	<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1">
	<link href="stylesheets/style.css" rel="stylesheet" type="text/css">
	<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">
	<link href="stylesheets/tablestyle.css" rel="stylesheet" type="text/css">
	

	</head>
		<body>
			<div id="wrapper">
				
				<div id="loginbar" align="right">
					<a href="menuTorneos.php" class="button">Regresar</a>
					<a href="#" class="button"><?php echo $_SESSION['alias'] ?> - Configuraciones</a>
					<a href="logout.php" class="button">Cerrar sesión</a>
				</div>
				
				<h2>Mis torneos</h2>

				<table id="torneos" cellpadding="8" class="center">
				<thead>
					<th>Nombre</th>
					<th>Maximo de participantes</th> 
					<th>Tipo de eliminacion</th>
					<th>Tipo de participacion</th>
					<th>Estado</th>
				</thead>
				<tbody>
		<?php
			$id = 0;
			$clickedId; //dafuq? no creo que funcione
			$result = mysql_query($sql) or trigger_error(mysql_error()); 
			while($row = mysql_fetch_array($result)){ 
				foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } //quitarle el onmouseover y onmouseout
				echo "<tr id=$id onmouseover= \"ChangeColor(this,true)\" onmouseout =\"ChangeColor(this,false)\" 
				onClick= \"getRow(event,this)\">";  
				echo "<td valign='top'>" . nl2br( $row['nombre']) . "</td>";  
				echo "<td valign='top'>" . nl2br( $row['max_participantes']) . "</td>";  
				echo "<td valign='top'>" . nl2br( $row['tipo_eliminacion']) . "</td>";  
				echo "<td valign='top'>" . nl2br( $row['tipo_participacion']) . "</td>";  
				echo "<td valign='top'>" . nl2br( $row['estado']) . "</td>";
				echo "</tr>";
				$id++;
			}
		?>
		
				
				</tbody>
				</table>
				
				<div id="box-wrapper">
				  <div class="bigbox">
					<div class="box" > 
					<a id="cosa" href="#" class="button">Calendarizar</a>
					<img src="images/google-calendar-icon.png" border="0" align="horizontalcenter">
					</div>
				  </div>
				  <div class="bigbox">
					<div class="box">
					<a href="#" class="button">Suspender Torneo</a>
					<img src="images/bth_stop_sign.png" border="0" align="horizontalcenter">
					</div>
					</div>
				  <div class="bigbox">
					<div class="box">
					<a href="#" class="button">Reanudar torneo</a>
					<img src="images/go.jpg" border="0" align="horizontalcenter">
					</div>
				  </div>
				  <div class="bigbox">
					<div class="box">
					<a href="#" class="button">Ver lista de participantes</a>
					<img src="images/list.jpg" border="0" align="horizontalcenter">
					</div>
				  </div>
				</div>
			
				<div id="footer">
					<h3> Universidad de Costa Rica - I Semestre 2013<br>Ingenieria de Software 2 </h3>
				</div>
			</div>
		</body>
	</html>
<?php

	if ( isset($_GET['estado'] )){
		print '<script type="text/javascript">'; 
		print 'alert("El torneo que selecciono no puede ser suspendido o reanudado.")'; 
		print '</script>';
	}
	//Aqui hay que hacer un listado de los torneos del usuario y permitirle modificar la calendarizacion y otras cosas
?>