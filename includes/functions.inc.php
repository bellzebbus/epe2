<?php
header('Content-Type: text/html; charset=UTF-8');
function valoresVacios($nombre, $apellidos, $email, $usuario, $contra, $contra2){
	$resultado;
	if (empty($nombre) || empty($apellidos) || empty($email) || empty($usuario) || empty($contra) || empty($contra2))  {
		$resultado = true;
	}else{
		$resultado = false;
	}
	return $resultado;
}
function valoresVaciosGast($descripcion, $previsto, $rreal, $diferencia){
	$resultado;
	if (empty($descripcion) || empty($previsto) || empty($rreal) || empty($diferencia))  {
		$resultado = true;
	}else{
		$resultado = false;
	}
	return $resultado;
}

function usuarioInvalido($usuario){
	$resultado;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $usuario))  {
		$resultado = true;
	}else{
		$resultado = false;
	}
	return $resultado;
}

function emailInvalido($email){
	$resultado;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))  {
		$resultado = true;
	}else{
		$resultado = false;
	}
	return $resultado;
}
function comprobarcontrasena($contra, $contra2){
	$resultado;
	if ($contra !== $contra2)  {
		$resultado = true;
	}else{
		$resultado = false;
	}
	return $resultado;
}
function usuarioExistente($conn, $usuario, $email){
	$sql = "select * from usuario where username = ? or email = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../registrarse.php?error=hubounerrorconlabasededatos");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ss", $usuario, $email);
	mysqli_stmt_execute($stmt);

	$resultadosDB = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultadosDB)) {
		return $row;
	}else{
		$resultado = false;
		return $resultado;
	}

	mysqli_stmt_close($stmt);
}

function crearUsuario($conn, $nombre, $apellidos, $email, $usuario, $contra){

	$sql = "insert into usuario (username, nombre, apellidos, email, contrasena) values (?, ?, ?, ?, ?);";

	$stmt = mysqli_stmt_init($conn);
	
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../registrarse.php?error=fallolaquery");
		exit();
	}
	
	$contra_encriptada = md5($contra);
	mysqli_stmt_bind_param($stmt, "sssss", $usuario , $nombre, $apellidos, $email, $contra_encriptada);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	header("location: ../login.php?error=ninguno");
	exit();

}
function valoresVaciosLog($usuario, $contra){
	$resultado;
	if (empty($usuario) || empty($contra))  {
		$resultado = true;
	}else{
		$resultado = false;
	}
	return $resultado;
}

function iniciarSesion($conn, $usuario, $contra){
	$usuarioExiste = usuarioExistente($conn, $usuario, $email);

	if ($usuarioExiste === false) {
		header("location: ../login.php?error=Loginvalido");
		exit();
	}
	$contra_encriptada = $usuarioExiste["contrasena"];
	if (md5($contra) != $contra_encriptada) {
		header("location: ../login.php?error=Loginvalido");
		exit();
	}elseif (md5($contra) == $contra_encriptada) {
	
		session_start();
		$_SESSION["username"] = $usuarioExiste["username"];
		header("location: ../index.php");
		exit();
	}
}

function rellenarGastos($conn){
	$sql = "select descripcion, previsto, rreal, diferencia from gasto;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../index.php?error=hubounerrorconlabasededatos");
		exit();
	}

	mysqli_stmt_execute($stmt);

	$resultadosDB = mysqli_stmt_get_result($stmt);

	return $resultadosDB;

	mysqli_stmt_close($stmt);

}

function sumaGastos($conn){
	$sql = "select sum(previsto) as gastoprevisto, sum(rreal) as gastoreal from gasto;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../index.php?error=hubounerrorconlabasededatos");
		exit();
	}

	mysqli_stmt_execute($stmt);

	$resultadosSuma = mysqli_stmt_get_result($stmt);

	return $resultadosSuma;

	mysqli_stmt_close($stmt);

}

function sumaGanancias($conn){
	$sql = "select sum(previsto) as gastoprevisto, sum(rreal) as gastoreal from ganancia;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../index.php?error=hubounerrorconlabasededatos");
		exit();
	}

	mysqli_stmt_execute($stmt);

	$resultadosSuma = mysqli_stmt_get_result($stmt);

	return $resultadosSuma;

	mysqli_stmt_close($stmt);

}

function rellenarGanancias($conn){

	$sql = "select descripcion, previsto, rreal, diferencia from ganancia;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../index.php?error=hubounerrorconlabasededatos");
		exit();
	}

	mysqli_stmt_execute($stmt);

	$resultadosDB = mysqli_stmt_get_result($stmt);

	return $resultadosDB;

	mysqli_stmt_close($stmt);
}

function rellenarProducto($conn){

	$sql = "select p.id as id, p.modelo as modelo, p.nombre as producto, f.nombre as fabricante, c.nombre as categoria, p.precio as precio from producto p join fabricante f on p.id_fabricante = f.id join categoria c on p.id_categoria = c.id;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../index.php?error=hubounerrorconlabasededatos");
		exit();
	}

	mysqli_stmt_execute($stmt);

	$resultadosDB = mysqli_stmt_get_result($stmt);

	return $resultadosDB;

	mysqli_stmt_close($stmt);
}

function insertarGasto($conn, $descripcion, $previsto, $real, $diferencia){

	$sql = "insert into gasto (descripcion, previsto, rreal, diferencia) values (?, ?, ?, ?);";

	$stmt = mysqli_stmt_init($conn);
	
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../index.php?error=fallolaquery");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "sddd", $descripcion , $previsto, $real, $diferencia);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	header("location: ../index.php#gasto");
	exit();

}

function insertarGanancia($conn, $descripcion, $previsto, $real, $diferencia){

	$sql = "insert into ganancia (descripcion, previsto, rreal, diferencia) values (?, ?, ?, ?);";

	$stmt = mysqli_stmt_init($conn);
	
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../index.php?error=fallolaquery");
		exit();
	}
	
	$contra_encriptada = md5($contra);
	mysqli_stmt_bind_param($stmt, "sddd", $descripcion , $previsto, $real, $diferencia);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	
	header("location: ../index.php#ganancia");
	exit();

}


