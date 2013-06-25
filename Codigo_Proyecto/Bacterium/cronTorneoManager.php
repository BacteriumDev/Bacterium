<?php
	// cron -> * * * * * /usr/bin/php5 /var/www/Bacterium/cronTorneoManager.php
	ini_set('display_errors', 'On');
	include 'dbManager.php';

	$fecha = date('Y-m-d H:i:s', time());
	$fecha_stamp = strtotime($fecha);

	print "<h1>$fecha</h1>";
	print "<h1>$fecha_stamp</h1>";
	
	extract($_REQUEST );
	
	$sql = "SELECT idTorneos,estado,UNIX_TIMESTAMP(inscripcion_fecha_final),faseActual FROM torneos";
	$result = mysql_query($sql) or trigger_error(mysql_error());

	$i = 0;
	$id_Torneos_ins = array();
	$id_Torneos_act_uno = array(); //arreglo que obtiene los torneos activos pero que no estan en alguna fase.
	$id_Torneos_act_gen = array(); //arreglo que obtiene los torneos activos en general

	//obtiene los torneos cuyo estado sea de inscripcion y que su tiempo de inscripcion haya terminado
	while($row = mysql_fetch_array($result)){
		$fechaFinIns = $row['UNIX_TIMESTAMP(inscripcion_fecha_final)'];
		print "<h3>$fechaFinIns</h3>";
		if ($row['estado'] == 'Inscripcion'){
			if ($fechaFinIns < $fecha_stamp){
				$id_Torneos_ins[$i] = $row['idTorneos'];
				print "<h2> Existe ins </h2>";			
			}
			
			
			
		}else if($row['estado'] == 'Activo'){
			//agrega a lista de torneos activos para verificar su estado de fases despues
			if ($row['faseActual'] <= 0){
				$id_Torneos_act_uno[$i] = $row['idTorneos'];
				print "<h2> Existe act_uno </h2>";
			}else{
				$id_Torneos_act_gen[$i] = $row['idTorneos'];
				print "<h2> Existe act_gen </h2>";
			}
			
			
		}else{
			print "<h2> No existe </h2>";
		}
		$i++;
	}
	//actualiza los torneos que terminaron su fecha de inscripcion
	foreach($id_Torneos_ins as &$torneoID){
		$sql = "UPDATE torneos SET estado = 'Activo' WHERE idTorneos = $torneoID";
		$result = mysql_query($sql) or trigger_error(mysql_error());	
	}
	//verifica los torneos que estan activos, pero todavia no han sido activados para su primera fase
	foreach($id_Torneos_act_uno as &$torneoID){
		//verificar que la fecha de la primera fase de este torneo sea menor (osea, ya paso) a la actual (ojo con los nulls del sql)
		$sql = "SELECT UNIX_TIMESTAMP(fecha_fase) FROM fasetorneo WHERE Torneos_idTorneos = $torneoID AND numFase = 1";
		$result = mysql_query($sql) or trigger_error(mysql_error());
		$row = mysql_fetch_array($result);

		$tiempoVerificar = $row['UNIX_TIMESTAMP(fecha_fase)'];
		
		if ($tiempoVerificar == FALSE) //si no hay fecha para la primera fase, no haga nada
		{
			print "No hay fecha para la primera fase";
		}else{
			print "<h3>La fecha de la primera fase es $tiempoVerificar </h3>";
			//existe una fecha para la primera fase => verifique si la fecha ya "paso"
			if ($tiempoVerificar < $fecha_stamp){
				print "<h3>Pase a la primera fase</h3>";
				$sql = "UPDATE torneos SET faseActual = 1 WHERE idTorneos = $torneoID";
				$result = mysql_query($sql) or trigger_error(mysql_error());
				//aqui falta la creacion de las partidas con los usuarios OJO
				
			}	
		}
	}
	//verificar para los activos, para ir avanzando las fases (desde iniciar a terminar)
	foreach($id_Torneos_act_gen as &$torneoID){
		//verificar que hay que setear la primera fase if faseActual = 0
		//se obtiene el numero de fase actual del torneo
		$sql = "SELECT faseActual FROM torneos WHERE idTorneos = $torneoID";
		$result = mysql_query($sql) or trigger_error(mysql_error());
		$row = mysql_fetch_array($result);
		
		$faseActual = $row['faseActual'];
		$faseSiguiente = $faseActual+1;
		
		$sql = "SELECT UNIX_TIMESTAMP(fecha_fase) FROM fasetorneo WHERE Torneos_idTorneos = $torneoID AND numFase = $faseSiguiente";
		$result = mysql_query($sql) or trigger_error(mysql_error());
		$row = mysql_fetch_array($result);

		$tiempoVerificar = $row['UNIX_TIMESTAMP(fecha_fase)'];
		print "<h3>$faseActual</h3>";
		print "<h3>$faseSiguiente</h3>";
		print "<h3>$tiempoVerificar</h3>";
		//ahora tengo que verificar que la fecha de la faseSiguiente no ha "pasado"
		//hago lo mismo que en el caso inicial. verifico si es FALSE y sino updateo
		if ($tiempoVerificar == FALSE) //si no hay fecha para la fase, no haga nada
		{
			print "No hay fecha para la siguiente fase";
		}else{
			print "<h3>La fecha de la siguiente fase es $tiempoVerificar </h3>";
			//existe una fecha para la siguiente fase => verifique si la fecha ya "paso"
			if ($tiempoVerificar < $fecha_stamp){
				print "<h3>Pase a la siguiente fase</h3>";
				$sql = "UPDATE torneos SET faseActual = $faseSiguiente WHERE idTorneos = $torneoID";
				$result = mysql_query($sql) or trigger_error(mysql_error());
				//aqui falta la creacion de las partidas con los usuarios OJO
				
			}	
		}
		//falta verificar si ya termino el torneo
	}

?>
