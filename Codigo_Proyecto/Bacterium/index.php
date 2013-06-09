<html>
<head>
<title> Ingenieria de software </title>
<meta http-equiv="Content-Type" content="text/html"; charset="ISO-8859-1">
<link href="stylesheets/style.css" rel="stylesheet" type="text/css">
<link href="stylesheets/buttonstyle.css" rel="stylesheet" type="text/css">
<link href="stylesheets/responsiveslides.css" rel="stylesheet" type="text/css">
<link href="stylesheets/menustyler.css" rel="stylesheet" type="text/css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="scripts/responsiveslides.js"></script>
<script src="scripts/ajax_dinamic_content.js"></script>

<script>
  $(function() {
    $(".rslides").responsiveSlides();
  });
  
function makeactive(tab)  
{  
	document.getElementById("tab0").className = "";
	document.getElementById("tab1").className = "";  
	document.getElementById("tab2").className = "";  
	document.getElementById("tab3").className = "";
	document.getElementById("tab4").className = "";
	document.getElementById("tab5").className = "";  
	document.getElementById("tab6").className = "";  
	document.getElementById("tab7").className = "";  	
	document.getElementById("tab"+tab).className = "active";  
	callAjax('includes/index_content.php?content= '+tab, 'contenido', 'getting content for tab '+tab+'. Wait...', 'Error');  
}
</script>

</head>

	<body>

		<div id="wrapper">
			
			<div id="loginbar" align="right">
				<a href="register.php" class="button">Registrarse</a>
				<a href="login.php" class="button">Login</a>
			</div>
			
			<div id="slider" class="rslides_container">
				<ul class="rslides">
					<li><img src="images/1.PNG" alt=""></li>
					<li><img src="images/2.PNG" alt=""></li>
				</ul>
			</div>
			
			<div id='cssmenu'>
				<ul>
					<li onclick="makeactive(0)"><a class="" id="tab0"><span>Inicio</span></a></li>
					<li onclick="makeactive(1)"><a class="" id="tab1"><span>Caracteristicas</span></a>
					<li class='has-sub '><a><span>Torneos</span></a>
						<ul>
						   <li onclick="makeactive(2)"><a class="" id="tab2"><span>Eliminacion simple</span></a></li>
						   <li onclick="makeactive(3)"><a class="" id="tab3"><span>Eliminacion doble</span></a></li>
						   <li onclick="makeactive(4)"><a class="" id="tab4"><span>Liga</span></a></li>
						</ul>
					 </li>
					 <li class='has-sub '><a href="partida.php"><span>Partidas</span></a>
						<ul>
						   <li onclick="makeactive(5)"><a class="" id="tab5"><span>VS. Inteligencia Artificial</span></a></li>
						   <li onclick="makeactive(6)"><a class="" id="tab6"><span>Multijugador</span></a></li>
						</ul>
					 </li>
				   </li>
				   <li onclick="makeactive(7)"><a class="" id="tab7"><span>Acerca</span></a></li>
				</ul>
			</div>
			
			<div id="contenido"></div>
			
		</div>
	</body>
</html>