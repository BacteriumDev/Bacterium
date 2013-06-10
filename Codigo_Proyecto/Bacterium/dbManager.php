<?php
	//session_start();
	
	$hostname = "localhost";
	$username = "root";
	$dbname = "inge";
	$password = "password";
	$conexion_log = mysql_connect($hostname, $username, $password) or die( mysql_error() );
	mysql_select_db($dbname) or die( mysql_error() );
	
	extract( $_REQUEST );
?>