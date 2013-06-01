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

<script>
  $(function() {
    $(".rslides").responsiveSlides();
  });
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
					<li><a href='index.php'><span>Inicio</span></a></li>
					<li><a href='#'><span>Caracteristicas</span></a>
					<li class='has-sub '><a href='#'><span>Torneos</span></a>
						<ul>
						   <li><a href='#'><span>Eliminacion directa</span></a></li>
						   <li><a href='#'><span>Second chance</span></a></li>
						   <li><a href='#'><span>Liga</span></a></li>
						</ul>
					 </li>
					 <li class='has-sub '><a href='#'><span>Partidas</span></a>
						<ul>
						   <li><a href='#'><span>VS. Inteligencia Artificial</span></a></li>
						   <li><a href='#'><span>VS. Multijugador</span></a></li>
						</ul>
					 </li>
				   </li>
				   <li><a href='#'><span>Acerca</span></a></li>
				</ul>
			</div>
			
			
			
		</div>
	</body>
</html>