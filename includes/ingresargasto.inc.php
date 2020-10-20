<?php
if (isset($_POST["submit"])) {
	
	$descripcion = $_POST["descripcion"];
	$previsto = $_POST["previsto"];
	$real = $_POST["real"];
	$diferencia = $_POST["diferencia"];

	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';

	if (valoresVaciosGast($descripcion, $previsto, $real, $diferencia) !== false) {
		header("location: ../index.php?error=campovacio");
		exit();
	}

	insertarGasto($conn, $descripcion, $previsto, $real, $diferencia);
	
}else{
	header("location: ../registrarse.php");
}