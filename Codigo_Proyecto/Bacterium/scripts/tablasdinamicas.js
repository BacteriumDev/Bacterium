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
	if (!(tableRow.style.backgroundColor == '#ff8809'))
	{
	if(tableRow.style.backgroundColor == 'white' && highLight == true){
	  tableRow.style.backgroundColor = '#dcfac9';
	}
	else if(highLight == false)
	{
		//console.log(tableRow.style.backgroundColor);
		if (tableRow.style.backgroundColor == 'rgb(255, 136, 9)'){
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
	//console.log("YEP");
	var textoSalida = e.target.parentNode.getElementsByTagName("td")[0].textContent;
	//document.getElementById('nombreTorneoHolder').textContent = nombreTorneo.toString();
	if (tableRow.style.backgroundColor == 'white' || tableRow.style.backgroundColor == 'rgb(220, 250, 201)')
	{
		bleachRows(tableRow); //limpia todos los rows para que solo uno este seleccionado
	  tableRow.style.backgroundColor = '#ff8809';
	  document.getElementById('fase').value = e.target.parentNode.getElementsByTagName("td")[0].textContent;
	  /*document.getElementById('calendarizar').href = "calendarizarTorneo.php?nombreTorneo="+nombreTorneo.toString();
	  document.getElementById('suspender').href = "suspenderTorneo.php?nombreTorneo="+nombreTorneo.toString();
	  document.getElementById('reanudar').href = "reanudarTorneo.php?nombreTorneo="+nombreTorneo.toString();
	  document.getElementById('listaParticipantes').href = "listaParticipantesTorneo.php?nombreTorneo="+nombreTorneo.toString();
	  document.getElementById('eliminar').href = "eliminarTorneo.php?nombreTorneo="+nombreTorneo.toString();*/
	}
	else 
	{
	  tableRow.style.backgroundColor = 'white';
	 // document.getElementById('nombreTorneoHolder').textContent = '';
	  
	  
	}
	//el toque de abajo ya no fue necesario porque se lo asigno directamente al div del boton
	
	//el toque aqui es que defini un pedacito de html que se llama nombreTorneoHolder
	//tons le cambio el texto a ese mop, para poder usarlo como parte del $_GET al calendarizar y otras cosas
	//la idea es usar el nombre del torneo en conjunto con el id del usuario para trabajar sobre este
}