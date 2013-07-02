<?php
session_start();

// Comprueba si el usuario se ha conectado
if( !isset($_SESSION['valid_user']) || !isset($_SESSION['authorized']) || $_SESSION['authorized'] != 'yes' ){
	header( "Location: bacterium_accessdenied.php" );
	exit();
}
extract( $_REQUEST );
include 'dbManager.php';

$sqlfetchdata = "SELECT * FROM usuarios WHERE idUsuarios = $_SESSION[valid_user]";
$resultset = mysql_query($sqlfetchdata) or trigger_error(mysql_error());
$row = mysql_fetch_assoc( $resultset );

$aliasd = $row['alias'];
$emaild = $row['email'];
$paisd = $row['pais'];
$edadd = $row['edad'];
$acercad = $row['acerca'];
$mdd = $row['miembro_desde'];

if( isset($editPersonal) ){
	
	$SendInformationToDatabase=mysql_query("UPDATE usuarios SET alias='$userName', email='$email', pais='$country', edad=$age, acerca='$about' WHERE idUsuarios = $_SESSION[valid_user]");
	(mysql_affected_rows()) ? $respuesta = "Datos actualizados correctamente" : $respuesta = "No se ha podido efectuar el borrado"; 
	//echo $respuesta;
	header( "Location: datosPersonalesEditados.php" );
	exit();
}

if( isset($editPassword) )
{
	header( "Location: editpassword.php" );
	exit();
}

?>

<html>
<head>
<title> Ingenieria de software </title>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1">
<link href="stylesheets/style.css" rel="stylesheet" type="text/css">
<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">
<link href="stylesheets/loginboxstyle.css" rel="stylesheet" type="text/css">

<script src="scripts/validatorreg.js"></script>

</head>

	<body>

		<div id="wrapper">
			
			<div id="loginbar" align="right">
				<a href="usuarioEdit.php" class="button">Regresar</a>
			</div>
			
			<div id="logincontent">
				<div id="login">
					<h2>Su informacion personal</h2>
					<form class="boxCont" method="POST" onsubmit="return validateFormOnSubmit(this)" action="datosPersonalesEdit.php">
						<div>
							<label for="userName">Usuario</label>
							<input id="bac_userName" type="text" name="userName" placeholder="Escriba aqui su nombre de usuario" value="<?php echo $aliasd ?>"/>
						</div>
						
						<div>
							<label for="email">Email</label>
							<input id="bac_email" type="text" name="email" placeholder="Escriba aqui su correo electrónico" value="<?php echo $emaild ?>"/>
						</div>
						
						
						<div>
							<label for="country">País</label>
							<select id="bac_country" name="country">
								  <option value="AF" <?php if($paisd == "AF"){echo "selected";}?>>Afganistán</option> 
								  <option value="AL" <?php if($paisd == "AL"){echo "selected";}?>>Albania</option> 
								  <option value="DE" <?php if($paisd == "DE"){echo "selected";}?>>Alemania</option> 
								  <option value="AD" <?php if($paisd == "AD"){echo "selected";}?>>Andorra</option> 
								  <option value="AO" <?php if($paisd == "AO"){echo "selected";}?>>Angola</option> 
								  <option value="AI" <?php if($paisd == "AI"){echo "selected";}?>>Anguilla</option> 
								  <option value="AQ" <?php if($paisd == "AQ"){echo "selected";}?>>Antártida</option> 
								  <option value="AG" <?php if($paisd == "AG"){echo "selected";}?>>Antigua y Barbuda</option> 
								  <option value="AN" <?php if($paisd == "AN"){echo "selected";}?>>Antillas Holandesas</option> 
								  <option value="SA" <?php if($paisd == "SA"){echo "selected";}?>>Arabia Saudí</option> 
								  <option value="DZ" <?php if($paisd == "DZ"){echo "selected";}?>>Argelia</option> 
								  <option value="AR" <?php if($paisd == "AR"){echo "selected";}?>>Argentina</option> 
								  <option value="AM" <?php if($paisd == "AM"){echo "selected";}?>>Armenia</option> 
								  <option value="AW" <?php if($paisd == "AW"){echo "selected";}?>>Aruba</option> 
								  <option value="AU" <?php if($paisd == "AU"){echo "selected";}?>>Australia</option> 
								  <option value="AT" <?php if($paisd == "AT"){echo "selected";}?>>Austria</option>  
								  <option value="AZ" <?php if($paisd == "AZ"){echo "selected";}?>>Azerbaiyán</option>  
								  <option value="BS" <?php if($paisd == "BS"){echo "selected";}?>>Bahamas</option>  
								  <option value="BH" <?php if($paisd == "BH"){echo "selected";}?>>Bahrein</option>  
								  <option value="BD" <?php if($paisd == "BD"){echo "selected";}?>>Bangladesh</option>  
								  <option value="BB" <?php if($paisd == "BB"){echo "selected";}?>>Barbados</option>  
								  <option value="BE" <?php if($paisd == "BE"){echo "selected";}?>>Bélgica</option>  
								  <option value="BZ" <?php if($paisd == "BZ"){echo "selected";}?>>Belice</option>  
								  <option value="BJ" <?php if($paisd == "BJ"){echo "selected";}?>>Benin</option>  
								  <option value="BM" <?php if($paisd == "BM"){echo "selected";}?>>Bermudas</option>  
								  <option value="BY" <?php if($paisd == "BY"){echo "selected";}?>>Bielorrusia</option>  
								  <option value="MM" <?php if($paisd == "MM"){echo "selected";}?>>Birmania</option>  
								  <option value="BO" <?php if($paisd == "BO"){echo "selected";}?>>Bolivia</option>  
								  <option value="BA" <?php if($paisd == "BA"){echo "selected";}?>>Bosnia y Herzegovina</option>  
								  <option value="BW" <?php if($paisd == "BW"){echo "selected";}?>>Botswana</option>  
								  <option value="BR" <?php if($paisd == "BR"){echo "selected";}?>>Brasil</option>  
								  <option value="BN" <?php if($paisd == "BN"){echo "selected";}?>>Brunei</option>  
								  <option value="BG" <?php if($paisd == "BG"){echo "selected";}?>>Bulgaria</option>  
								  <option value="BF" <?php if($paisd == "BF"){echo "selected";}?>>Burkina Faso</option>  
								  <option value="BI" <?php if($paisd == "BI"){echo "selected";}?>>Burundi</option>  
								  <option value="BT" <?php if($paisd == "BT"){echo "selected";}?>>Bután</option>  
								  <option value="CV" <?php if($paisd == "CV"){echo "selected";}?>>Cabo Verde</option>  
								  <option value="KH" <?php if($paisd == "KH"){echo "selected";}?>>Camboya</option>  
								  <option value="CM" <?php if($paisd == "CM"){echo "selected";}?>>Camerún</option>  
								  <option value="CA" <?php if($paisd == "CA"){echo "selected";}?>>Canadá</option>  
								  <option value="TD" <?php if($paisd == "TD"){echo "selected";}?>>Chad</option>  
								  <option value="CL" <?php if($paisd == "CL"){echo "selected";}?>>Chile</option>  
								  <option value="CN" <?php if($paisd == "CN"){echo "selected";}?>>China</option>  
								  <option value="CY" <?php if($paisd == "CY"){echo "selected";}?>>Chipre</option>  
								  <option value="VA" <?php if($paisd == "VA"){echo "selected";}?>>Ciudad del Vaticano (Santa Sede)</option>  
								  <option value="CO" <?php if($paisd == "CO"){echo "selected";}?>>Colombia</option>  
								  <option value="KM" <?php if($paisd == "KM"){echo "selected";}?>>Comores</option>  
								  <option value="CG" <?php if($paisd == "CG"){echo "selected";}?>>Congo</option>  
								  <option value="CD" <?php if($paisd == "CD"){echo "selected";}?>>Congo, República Democrática del</option>  
								  <option value="KR" <?php if($paisd == "KR"){echo "selected";}?>>Corea</option>  
								  <option value="KP" <?php if($paisd == "KP"){echo "selected";}?>>Corea del Norte</option>  
								  <option value="CI" <?php if($paisd == "CI"){echo "selected";}?>>Costa de Marfíl</option>  
								  <option value="CR" <?php if($paisd == "CR"){echo "selected";}?>>Costa Rica</option>  
								  <option value="HR" <?php if($paisd == "HR"){echo "selected";}?>>Croacia (Hrvatska)</option>  
								  <option value="CU" <?php if($paisd == "CU"){echo "selected";}?>>Cuba</option>  
								  <option value="DK" <?php if($paisd == "DK"){echo "selected";}?>>Dinamarca</option>  
								  <option value="DJ" <?php if($paisd == "DJ"){echo "selected";}?>>Djibouti</option>  
								  <option value="DM" <?php if($paisd == "DM"){echo "selected";}?>>Dominica</option>  
								  <option value="EC" <?php if($paisd == "EC"){echo "selected";}?>>Ecuador</option>  
								  <option value="EG" <?php if($paisd == "EG"){echo "selected";}?>>Egipto</option>  
								  <option value="SV" <?php if($paisd == "SV"){echo "selected";}?>>El Salvador</option>  
								  <option value="AE" <?php if($paisd == "AE"){echo "selected";}?>>Emiratos Árabes Unidos</option>  
								  <option value="ER" <?php if($paisd == "ER"){echo "selected";}?>>Eritrea</option>  
								  <option value="SI" <?php if($paisd == "SI"){echo "selected";}?>>Eslovenia</option>  
								  <option value="ES" <?php if($paisd == "ES"){echo "selected";}?>>España</option>  
								  <option value="US" <?php if($paisd == "US"){echo "selected";}?>>Estados Unidos</option>  
								  <option value="EE" <?php if($paisd == "EE"){echo "selected";}?>>Estonia</option>  
								  <option value="ET" <?php if($paisd == "ET"){echo "selected";}?>>Etiopía</option>  
								  <option value="FJ" <?php if($paisd == "FJ"){echo "selected";}?>>Fiji</option>  
								  <option value="PH" <?php if($paisd == "PH"){echo "selected";}?>>Filipinas</option>  
								  <option value="FI" <?php if($paisd == "FI"){echo "selected";}?>>Finlandia</option>  
								  <option value="FR" <?php if($paisd == "FR"){echo "selected";}?>>Francia</option>  
								  <option value="GA" <?php if($paisd == "GA"){echo "selected";}?>>Gabón</option>  
								  <option value="GM" <?php if($paisd == "GM"){echo "selected";}?>>Gambia</option>  
								  <option value="GE" <?php if($paisd == "GE"){echo "selected";}?>>Georgia</option>  
								  <option value="GH" <?php if($paisd == "GH"){echo "selected";}?>>Ghana</option>  
								  <option value="GI" <?php if($paisd == "GI"){echo "selected";}?>>Gibraltar</option>  
								  <option value="GD" <?php if($paisd == "GD"){echo "selected";}?>>Granada</option>  
								  <option value="GR" <?php if($paisd == "GR"){echo "selected";}?>>Grecia</option>  
								  <option value="GL" <?php if($paisd == "GL"){echo "selected";}?>>Groenlandia</option>  
								  <option value="GP" <?php if($paisd == "GP"){echo "selected";}?>>Guadalupe</option>  
								  <option value="GU" <?php if($paisd == "GU"){echo "selected";}?>>Guam</option>  
								  <option value="GT" <?php if($paisd == "GT"){echo "selected";}?>>Guatemala</option>  
								  <option value="GY" <?php if($paisd == "GY"){echo "selected";}?>>Guayana</option>  
								  <option value="GF" <?php if($paisd == "GF"){echo "selected";}?>>Guayana Francesa</option>  
								  <option value="GN" <?php if($paisd == "GN"){echo "selected";}?>>Guinea</option>  
								  <option value="GQ" <?php if($paisd == "GQ"){echo "selected";}?>>Guinea Ecuatorial</option>  
								  <option value="GW" <?php if($paisd == "GW"){echo "selected";}?>>Guinea-Bissau</option>  
								  <option value="HT" <?php if($paisd == "HT"){echo "selected";}?>>Haití</option>  
								  <option value="HN" <?php if($paisd == "HN"){echo "selected";}?>>Honduras</option>  
								  <option value="HU" <?php if($paisd == "HU"){echo "selected";}?>>Hungría</option>  
								  <option value="IN" <?php if($paisd == "IN"){echo "selected";}?>>India</option>  
								  <option value="ID" <?php if($paisd == "ID"){echo "selected";}?>>Indonesia</option>  
								  <option value="IQ" <?php if($paisd == "IQ"){echo "selected";}?>>Irak</option>  
								  <option value="IR" <?php if($paisd == "IR"){echo "selected";}?>>Irán</option>  
								  <option value="IE" <?php if($paisd == "IE"){echo "selected";}?>>Irlanda</option>  
								  <option value="BV" <?php if($paisd == "BV"){echo "selected";}?>>Isla Bouvet</option>  
								  <option value="CX" <?php if($paisd == "CX"){echo "selected";}?>>Isla de Christmas</option>  
								  <option value="IS" <?php if($paisd == "IS"){echo "selected";}?>>Islandia</option>  
								  <option value="KY" <?php if($paisd == "KY"){echo "selected";}?>>Islas Caimán</option>  
								  <option value="CK" <?php if($paisd == "CK"){echo "selected";}?>>Islas Cook</option>  
								  <option value="CC" <?php if($paisd == "CC"){echo "selected";}?>>Islas de Cocos o Keeling</option>  
								  <option value="FO" <?php if($paisd == "FO"){echo "selected";}?>>Islas Faroe</option>  
								  <option value="HM" <?php if($paisd == "HM"){echo "selected";}?>>Islas Heard y McDonald</option>  
								  <option value="FK" <?php if($paisd == "FK"){echo "selected";}?>>Islas Malvinas</option>  
								  <option value="MP" <?php if($paisd == "MP"){echo "selected";}?>>Islas Marianas del Norte</option>  
								  <option value="MH" <?php if($paisd == "MH"){echo "selected";}?>>Islas Marshall</option>  
								  <option value="UM" <?php if($paisd == "UM"){echo "selected";}?>>Islas menores de Estados Unidos</option>  
								  <option value="PW" <?php if($paisd == "PW"){echo "selected";}?>>Islas Palau</option>  
								  <option value="SB" <?php if($paisd == "SB"){echo "selected";}?>>Islas Salomón</option>  
								  <option value="SJ" <?php if($paisd == "SJ"){echo "selected";}?>>Islas Svalbard y Jan Mayen</option>  
								  <option value="TK" <?php if($paisd == "TK"){echo "selected";}?>>Islas Tokelau</option>  
								  <option value="TC" <?php if($paisd == "TC"){echo "selected";}?>>Islas Turks y Caicos</option>  
								  <option value="VI" <?php if($paisd == "VI"){echo "selected";}?>>Islas Vírgenes (EE.UU.)</option>  
								  <option value="VG" <?php if($paisd == "VG"){echo "selected";}?>>Islas Vírgenes (Reino Unido)</option>  
								  <option value="WF" <?php if($paisd == "WF"){echo "selected";}?>>Islas Wallis y Futuna</option>  
								  <option value="IL" <?php if($paisd == "IL"){echo "selected";}?>>Israel</option>  
								  <option value="IT" <?php if($paisd == "IT"){echo "selected";}?>>Italia</option>  
								  <option value="JM" <?php if($paisd == "JM"){echo "selected";}?>>Jamaica</option>  
								  <option value="JP" <?php if($paisd == "JP"){echo "selected";}?>>Japón</option>  
								  <option value="JO" <?php if($paisd == "JO"){echo "selected";}?>>Jordania</option>  
								  <option value="KZ" <?php if($paisd == "KZ"){echo "selected";}?>>Kazajistán</option>  
								  <option value="KE" <?php if($paisd == "KE"){echo "selected";}?>>Kenia</option>  
								  <option value="KG" <?php if($paisd == "KG"){echo "selected";}?>>Kirguizistán</option>  
								  <option value="KI" <?php if($paisd == "KI"){echo "selected";}?>>Kiribati</option>  
								  <option value="KW" <?php if($paisd == "KW"){echo "selected";}?>>Kuwait</option>  
								  <option value="LA" <?php if($paisd == "LA"){echo "selected";}?>>Laos</option>  
								  <option value="LS" <?php if($paisd == "LS"){echo "selected";}?>>Lesotho</option>  
								  <option value="LV" <?php if($paisd == "LV"){echo "selected";}?>>Letonia</option>  
								  <option value="LB" <?php if($paisd == "LB"){echo "selected";}?>>Líbano</option>  
								  <option value="LR" <?php if($paisd == "LR"){echo "selected";}?>>Liberia</option>  
								  <option value="LY" <?php if($paisd == "LY"){echo "selected";}?>>Libia</option>  
								  <option value="LI" <?php if($paisd == "LI"){echo "selected";}?>>Liechtenstein</option>  
								  <option value="LT" <?php if($paisd == "LT"){echo "selected";}?>>Lituania</option>  
								  <option value="LU" <?php if($paisd == "LU"){echo "selected";}?>>Luxemburgo</option>  
								  <option value="MK" <?php if($paisd == "MK"){echo "selected";}?>>Macedonia, Ex-República Yugoslava de</option>  
								  <option value="MG" <?php if($paisd == "MG"){echo "selected";}?>>Madagascar</option>  
								  <option value="MY" <?php if($paisd == "MY"){echo "selected";}?>>Malasia</option>  
								  <option value="MW" <?php if($paisd == "MW"){echo "selected";}?>>Malawi</option>  
								  <option value="MV" <?php if($paisd == "MV"){echo "selected";}?>>Maldivas</option>  
								  <option value="ML" <?php if($paisd == "ML"){echo "selected";}?>>Malí</option>  
								  <option value="MT" <?php if($paisd == "MT"){echo "selected";}?>>Malta</option>  
								  <option value="MA" <?php if($paisd == "MA"){echo "selected";}?>>Marruecos</option>  
								  <option value="MQ" <?php if($paisd == "MQ"){echo "selected";}?>>Martinica</option>  
								  <option value="MU" <?php if($paisd == "MU"){echo "selected";}?>>Mauricio</option>  
								  <option value="MR" <?php if($paisd == "MR"){echo "selected";}?>>Mauritania</option>  
								  <option value="YT" <?php if($paisd == "YT"){echo "selected";}?>>Mayotte</option>  
								  <option value="MX" <?php if($paisd == "MX"){echo "selected";}?>>México</option>  
								  <option value="FM" <?php if($paisd == "FM"){echo "selected";}?>>Micronesia</option>  
								  <option value="MD" <?php if($paisd == "MD"){echo "selected";}?>>Moldavia</option>  
								  <option value="MC" <?php if($paisd == "MC"){echo "selected";}?>>Mónaco</option>  
								  <option value="MN" <?php if($paisd == "MN"){echo "selected";}?>>Mongolia</option>  
								  <option value="MS" <?php if($paisd == "MS"){echo "selected";}?>>Montserrat</option>  
								  <option value="MZ" <?php if($paisd == "MZ"){echo "selected";}?>>Mozambique</option>  
								  <option value="NA" <?php if($paisd == "NA"){echo "selected";}?>>Namibia</option>  
								  <option value="NR" <?php if($paisd == "NR"){echo "selected";}?>>Nauru</option>  
								  <option value="NP" <?php if($paisd == "NP"){echo "selected";}?>>Nepal</option>  
								  <option value="NI" <?php if($paisd == "NI"){echo "selected";}?>>Nicaragua</option>  
								  <option value="NE" <?php if($paisd == "NE"){echo "selected";}?>>Níger</option>  
								  <option value="NG" <?php if($paisd == "NG"){echo "selected";}?>>Nigeria</option>  
								  <option value="NU" <?php if($paisd == "NU"){echo "selected";}?>>Niue</option>  
								  <option value="NF" <?php if($paisd == "NF"){echo "selected";}?>>Norfolk</option>  
								  <option value="NO" <?php if($paisd == "NO"){echo "selected";}?>>Noruega</option>  
								  <option value="NC" <?php if($paisd == "NC"){echo "selected";}?>>Nueva Caledonia</option>  
								  <option value="NZ" <?php if($paisd == "NZ"){echo "selected";}?>>Nueva Zelanda</option>  
								  <option value="OM" <?php if($paisd == "OM"){echo "selected";}?>>Omán</option>  
								  <option value="NL" <?php if($paisd == "NL"){echo "selected";}?>>Países Bajos</option>  
								  <option value="PA" <?php if($paisd == "PA"){echo "selected";}?>>Panamá</option>  
								  <option value="PG" <?php if($paisd == "PG"){echo "selected";}?>>Papúa Nueva Guinea</option>  
								  <option value="PK" <?php if($paisd == "PK"){echo "selected";}?>>Paquistán</option>  
								  <option value="PY" <?php if($paisd == "PY"){echo "selected";}?>>Paraguay</option>  
								  <option value="PE" <?php if($paisd == "PE"){echo "selected";}?>>Perú</option>  
								  <option value="PN" <?php if($paisd == "PN"){echo "selected";}?>>Pitcairn</option>  
								  <option value="PF" <?php if($paisd == "PF"){echo "selected";}?>>Polinesia Francesa</option>  
								  <option value="PL" <?php if($paisd == "PL"){echo "selected";}?>>Polonia</option>  
								  <option value="PT" <?php if($paisd == "PT"){echo "selected";}?>>Portugal</option>  
								  <option value="PR" <?php if($paisd == "PR"){echo "selected";}?>>Puerto Rico</option>  
								  <option value="QA" <?php if($paisd == "QA"){echo "selected";}?>>Qatar</option>  
								  <option value="UK" <?php if($paisd == "UK"){echo "selected";}?>>Reino Unido</option>  
								  <option value="CF" <?php if($paisd == "CF"){echo "selected";}?>>República Centroafricana</option>  
								  <option value="CZ" <?php if($paisd == "CZ"){echo "selected";}?>>República Checa</option>  
								  <option value="ZA" <?php if($paisd == "ZA"){echo "selected";}?>>República de Sudáfrica</option>  
								  <option value="DO" <?php if($paisd == "DO"){echo "selected";}?>>República Dominicana</option>  
								  <option value="SK" <?php if($paisd == "SK"){echo "selected";}?>>República Eslovaca</option>  
								  <option value="RE" <?php if($paisd == "RE"){echo "selected";}?>>Reunión</option>  
								  <option value="RW" <?php if($paisd == "RW"){echo "selected";}?>>Ruanda</option>  
								  <option value="RO" <?php if($paisd == "RO"){echo "selected";}?>>Rumania</option>  
								  <option value="RU" <?php if($paisd == "RU"){echo "selected";}?>>Rusia</option>  
								  <option value="EH" <?php if($paisd == "EH"){echo "selected";}?>>Sahara Occidental</option>  
								  <option value="KN" <?php if($paisd == "KN"){echo "selected";}?>>Saint Kitts y Nevis</option>  
								  <option value="WS" <?php if($paisd == "WS"){echo "selected";}?>>Samoa</option>  
								  <option value="AS" <?php if($paisd == "AS"){echo "selected";}?>>Samoa Americana</option>  
								  <option value="SM" <?php if($paisd == "SM"){echo "selected";}?>>San Marino</option>  
								  <option value="VC" <?php if($paisd == "VC"){echo "selected";}?>>San Vicente y Granadinas</option>  
								  <option value="SH" <?php if($paisd == "SH"){echo "selected";}?>>Santa Helena</option>  
								  <option value="LC" <?php if($paisd == "LC"){echo "selected";}?>>Santa Lucía</option>  
								  <option value="ST" <?php if($paisd == "ST"){echo "selected";}?>>Santo Tomé y Príncipe</option>  
								  <option value="SN" <?php if($paisd == "SN"){echo "selected";}?>>Senegal</option>  
								  <option value="SC" <?php if($paisd == "SC"){echo "selected";}?>>Seychelles</option>  
								  <option value="SL" <?php if($paisd == "SL"){echo "selected";}?>>Sierra Leona</option>  
								  <option value="SG" <?php if($paisd == "SG"){echo "selected";}?>>Singapur</option>  
								  <option value="SY" <?php if($paisd == "SY"){echo "selected";}?>>Siria</option>  
								  <option value="SO" <?php if($paisd == "SO"){echo "selected";}?>>Somalia</option>  
								  <option value="LK" <?php if($paisd == "LK"){echo "selected";}?>>Sri Lanka</option>  
								  <option value="PM" <?php if($paisd == "PM"){echo "selected";}?>>St. Pierre y Miquelon</option>  
								  <option value="SZ" <?php if($paisd == "SZ"){echo "selected";}?>>Suazilandia</option>  
								  <option value="SD" <?php if($paisd == "SD"){echo "selected";}?>>Sudán</option>  
								  <option value="SE" <?php if($paisd == "SE"){echo "selected";}?>>Suecia</option>  
								  <option value="CH" <?php if($paisd == "CH"){echo "selected";}?>>Suiza</option>  
								  <option value="SR" <?php if($paisd == "SR"){echo "selected";}?>>Surinam</option>  
								  <option value="TH" <?php if($paisd == "TH"){echo "selected";}?>>Tailandia</option>  
								  <option value="TW" <?php if($paisd == "TW"){echo "selected";}?>>Taiwán</option>  
								  <option value="TZ" <?php if($paisd == "TZ"){echo "selected";}?>>Tanzania</option>  
								  <option value="TJ" <?php if($paisd == "TJ"){echo "selected";}?>>Tayikistán</option>  
								  <option value="TF" <?php if($paisd == "TF"){echo "selected";}?>>Territorios franceses del Sur</option>  
								  <option value="TP" <?php if($paisd == "TP"){echo "selected";}?>>Timor Oriental</option>  
								  <option value="TG" <?php if($paisd == "TG"){echo "selected";}?>>Togo</option>  
								  <option value="TO" <?php if($paisd == "TO"){echo "selected";}?>>Tonga</option>  
								  <option value="TT" <?php if($paisd == "TT"){echo "selected";}?>>Trinidad y Tobago</option>  
								  <option value="TN" <?php if($paisd == "TN"){echo "selected";}?>>Túnez</option>  
								  <option value="TM" <?php if($paisd == "TM"){echo "selected";}?>>Turkmenistán</option>  
								  <option value="TR" <?php if($paisd == "TR"){echo "selected";}?>>Turquía</option>  
								  <option value="TV" <?php if($paisd == "TV"){echo "selected";}?>>Tuvalu</option>  
								  <option value="UA" <?php if($paisd == "UA"){echo "selected";}?>>Ucrania</option>  
								  <option value="UG" <?php if($paisd == "UG"){echo "selected";}?>>Uganda</option>  
								  <option value="UY" <?php if($paisd == "UY"){echo "selected";}?>>Uruguay</option>  
								  <option value="UZ" <?php if($paisd == "UZ"){echo "selected";}?>>Uzbekistán</option>  
								  <option value="VU" <?php if($paisd == "VU"){echo "selected";}?>>Vanuatu</option>  
								  <option value="VE" <?php if($paisd == "VE"){echo "selected";}?>>Venezuela</option>  
								  <option value="VN" <?php if($paisd == "VN"){echo "selected";}?>>Vietnam</option>  
								  <option value="YE" <?php if($paisd == "YE"){echo "selected";}?>>Yemen</option>  
								  <option value="YU" <?php if($paisd == "YU"){echo "selected";}?>>Yugoslavia</option>  
								  <option value="ZM" <?php if($paisd == "ZM"){echo "selected";}?>>Zambia</option>  
								  <option value="ZW" <?php if($paisd == "ZW"){echo "selected";}?>>Zimbabue</option>
							</select>
						</div>
						
						<div>
							<label for="age">Edad</label>
							<input id="bac_age" type="text" name="age" placeholder="Escriba aquí su edad" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" maxlength="2" value="<?php echo $edadd ?>"/>
						</div>
						
						<div>
							<label for="about">Datos adicionales</label>
							<input id="bac_about" type="text" name="about" placeholder="Acerca de usted" value="<?php echo $acercad ?>"/>
						</div>
						
						<h3> Miembro desde: <?php echo $mdd ?></h3>
						
						<div>
							<input type="submit" id="editPersonal" name="editPersonal" value="Actualizar datos" class="btn right" />
							<input type="submit" id="editPassword" name="editPassword" value="Actualizar password" class="btn left" />
						</div>
					</form>
				</div>
			</div>
		
		</div>
	</body>
</html>