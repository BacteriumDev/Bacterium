function validateUsername(fld) {
    var error = "";
    var illegalChars = /^[a-zA-Z�������������� ]+$/; // allow letters, numbers, and underscores
 
    if (fld.value == "") {
        fld.style.background = 'Yellow'; 
        error = "No ingres� un nombre v�lido.\n";
    } else if ((fld.value.length < 1) || (fld.value.length > 25)) {
        fld.style.background = 'Yellow'; 
        error = "Digite un nombre de usuario mas corto.\n";
    } else if (!illegalChars.test(fld.value)) {
        fld.style.background = 'Yellow'; 
        error = "Nombre no v�lido, ingrese �nicamente letras.\n";
    } else {
        fld.style.background = 'White';
    } 
    return error;
}

function validatePhone(fld) {
    var error = "";
    var stripped = fld.value.replace(/[\(\)\.\-\ ]/g, '');     

	if(fld.value.length != 0)
	{
		if (isNaN(parseInt(stripped))) {
			error = "N�mero de tel�fono no v�lido.\n";
			fld.style.background = 'Yellow';
		} else if (!(stripped.length == 8)) {
			error = "N�mero de tel�fono no v�lido, debe tener 8 d�gitos.\n";
			fld.style.background = 'Yellow';
		} 
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

function validateEmail(fld) {
    var error="";
    var tfld = trim(fld.value);                        // value of field with whitespace trimmed off
    var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
    var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;
    
    if (fld.value == "") {
        fld.style.background = 'Yellow';
        error = "No ingres� un email v�lido.\n";
    } else if (!emailFilter.test(tfld)) {              //test email for illegal characters
        fld.style.background = 'Yellow';
        error = "Por favor ingrese un email v�lido.\n";
    } else if (fld.value.match(illegalChars)) {
        fld.style.background = 'Yellow';
        error = "Email con caracteres incorrectos.\n";
    } else {
        fld.style.background = 'White';
    }
    return error;
}

function validateFormOnSubmit(theForm) {
	var reason = "";

	reason += validateUsername(theForm.bac_userName);
	reason += validateEmail(theForm.bac_email);
	reason += validateEmpty(theForm.bac_password);
	reason += validateEmpty(theForm.bacn_password);
	  
	if (reason != "") {
		alert("Algunos datos necesitan ser verificados:\n" + reason);
		return false;
	}
	return true;
}