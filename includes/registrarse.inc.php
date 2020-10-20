<?php

if (isset($_POST["submit"])) {
	
	$nombre = $_POST["name"];
	$apellidos = $_POST["lastname"];
	$email = $_POST["email"];
	$usuario = $_POST["username"];
	$contra = $_POST["pass"];
	$contra2 = $_POST["pass2"];

	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';

	if (valoresVacios($nombre, $apellidos, $email, $usuario, $contra, $contra2) !== false) {
		header("location: ../registrarse.php?error=campovacio");
		exit();
	}

	if (usuarioInvalido($usuario) !== false) {
		header("location: ../registrarse.php?error=usuarioinvalido");
		exit();
	}
	if (emailInvalido($email) !== false) {
		header("location: ../registrarse.php?error=emailinvalido");
		exit();
	}

	if (comprobarcontrasena($contra, $contra2) !== false) {
		header("location: ../registrarse.php?error=contraseñasnocoinciden");
		exit();
	}
	if (usuarioExistente($conn, $usuario, $email) !== false) {
		header("location: ../registrarse.php?error=usuarioyaexiste");
		exit();
	}

	crearUsuario($conn, $nombre, $apellidos, $email, $usuario, $contra);
	
}else{
	header("location: ../registrarse.php");
}