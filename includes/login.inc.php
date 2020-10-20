<?php

if (isset($_POST["submit"])) {
	
	$usuario = $_POST["username"];
	$contra = $_POST["pass"];

	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';

	if (valoresVaciosLog($usuario, $contra) !== false) {
		header("location: ../login.php?error=campovacio");
		exit();
	}

	iniciarSesion($conn, $usuario, $contra);
	
}else{
	header("location: ../login.php?error=aaaa");
	exit();
}