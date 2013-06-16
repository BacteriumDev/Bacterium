function validateNombreTorneo(fld) {
    var error = "";
    var illegalChars = /^[a-zA-ZÁÉÍÓÚáéíóúÑñüÜ ]+$/; // allow letters, numbers, and underscores
 
    if (fld.value == "") {
        fld.style.background = 'Yellow'; 
        error = "No ingresó un nombre válido.\n";
    } else if ((fld.value.length < 6) || (fld.value.length > 20)) {
        fld.style.background = 'Yellow'; 
        error = "Digite un nombre de usuario entre 6 y 20 caracteres.\n";
    } else if (!illegalChars.test(fld.value)) {
        fld.style.background = 'Yellow'; 
        error = "Nombre no válido, ingrese únicamente letras.\n";
	} else {
        fld.style.background = 'White';
    } 
    return error;
}

function validateNumMaxParticipantes(fld){
	var error = "";
	if (fld.value == ""){
		fld.style.background = 'Yellow';
		error = "No especifico un numero de participantes maximo\n";
	}else if ((fld,value < 2) || (fld.value > 64)){
		fld.style.background = 'Yellow';
		error = "El numero de participantes no esta dentro del intervalo 2-64\n"
	}else{
		fld.style.background = 'White';
	}
	return error;
}


function validateEmpty(fld) {
    var error = "";
  
    if (fld.value.length == 0) {
        fld.style.background = 'Yellow'; 
        error = "Datos requeridos.\n"
		
	
    } else {
        fld.style.background = 'White';
    }
    return error;   
}


function trim(s)
{
	return s.replace(/^\s+|\s+$/, '');
} 


function validateFormOnSubmit(theForm) {
	var reason = "";

	reason += validateNombreTorneo(theForm.bac_NombreTorneo);
	reason += validateNumMaxParticipantes(theForm.bac_NumMaxParticipantes);
	reason += validateEmpty(theForm.bac_NombreTorneo);
	reason += validateEmpty(theForm.bac_NumMaxParticipantes);
	  
	if (reason != "") {
		alert("Algunos datos necesitan ser verificados:\n" + reason);
		return false;
	}
	return true;
}