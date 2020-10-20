<?php
session_start();

$Gastosprevistos = 0;
$Gastosreales = 0;
$Gananciasprevistas = 0;
$Gananciasreales= 0;

if (!isset($_SESSION['username'])) {
	header("location: ../epe2/login.php?error=debeiniciarsesionprimero");
	exit();
}

require "includes/dbh.inc.php";
require "includes/functions.inc.php";

?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/tabla.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	
	
</head>
<body>
	<section style="background-image: url('images/bg-01.jpg')";>
 		 <span>Bienvenido!</span>
 		 <header>
		  <h1>Epe2</h1>
		  <nav>
		    <a href="#gastos">Gastos</a>
		    <a href="#ganancias">Ganancias</a>
		    <a href="#productos">Productos</a>
		    <a href="contacto.php">Contacto</a>
		    <?php 
		    	if (isset($_SESSION['username'])) {
		    		echo "<a href='includes/cerrarsesion.inc.php'>Cerrar Sesion</a>";
		    	}
		    ?>
		  </nav>
		</header>
	</section>

	<div id="gastos">
		<div class="limiter">
		<div class="container-login100 p-t-100 p-l-100 p-r-100 p-b-50">
			<h1 class="p-l-100 p-r-100 fs-70">Gastos</h1>
			<div class="wrap-table100 ">
				<form class="login100-form validate-form" action="includes/ingresargasto.inc.php" method="POST">
					<div>
						<?php 
							$suma = sumaGastos($conn);
							while ($row = mysqli_fetch_assoc($suma)) {

								$Gastosprevistos =+ floatval($row["gastoprevisto"]);
								$Gastosreales =+ floatval($row["gastoreal"]);
							}
							echo "<h3>Previsto: ".$Gastosprevistos."$</h3>";
							echo "<h3>Real: ".$Gastosreales."$</h3>";
						?>
					</div>

					<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column1">Descripcion</th>
								<th class="column2">Previsto</th>
								<th class="column3">Real</th>
								<th class="column6">Diferencia</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$resultadosQR = rellenarGastos($conn);
							while ($row = mysqli_fetch_assoc($resultadosQR)) {
								echo "<tr>";
								echo "<td class='column1'>".$row["descripcion"]."</td>";
								echo "<td class='column2'>".$row["previsto"]."</td>";
								echo "<td class='column3'>".$row["rreal"]."</td>";
								echo "<td class='column6'>".$row["diferencia"]."</td>";
								echo "</tr>";
							}
						?>
							<tr>
								<td class="column1">
									<div class="wrap-input100 validate-input">
										<input class="input100" type="text" name="descripcion" placeholder="Inserte Descripcion">
										<span class="focus-input100" data-symbol="&#x27AA;"></span>
									</div>
								</td>
								<td class="column2">
									<div class="wrap-input100 validate-input">
										<input class="input100" type="text" name="previsto" placeholder="Inserte Previsto">
										<span class="focus-input100" data-symbol="&#x27AA;"></span>
									</div>
								</td>
								<td class="column3">
									<div class="wrap-input100 validate-input">
										<input class="input100" type="text" name="real" placeholder="Inserte Real">
										<span class="focus-input100" data-symbol="&#x27AA;"></span>
									</div>
								</td>
								<td class="column6">
									<div class="wrap-input100 validate-input">
										<input class="input100" type="text" name="diferencia" placeholder="Inserte Diferencia">
										<span class="focus-input100" data-symbol="&#x27AA;"></span>
									</div>
							</tr>
						</tbody>
					</table>
					<div class="container-login100-form-btn p-t-50">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" name="submit">
								Ingresar Gasto
							</button>
						</div>
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="ganancias">
		<div class="limiter">
		<div class="container-login100 p-t-100 p-l-100 p-r-100 p-b-50">
			<h1 class="p-l-100 p-r-100 fs-70">Ganancias</h1>
			<div class="wrap-table100 ">
				<form class="login100-form validate-form" action="includes/ingresarganancia.inc.php" method="POST">
					<div>
						<?php 
							$suma = sumaGanancias($conn);
							while ($row = mysqli_fetch_assoc($suma)) {
								$Gananciasprevistas =+ floatval($row["gastoprevisto"]);
								$Gananciasreales =+ floatval($row["gastoreal"]);
							}
							echo "<h3>Previsto: ".$Gananciasprevistas."$</h3>";
							echo "<h3>Real: ".$Gananciasreales."$</h3>";
						?>
					</div>
					<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column1">Descripcion</th>
								<th class="column2">Previsto</th>
								<th class="column3">Real</th>
								<th class="column6">Diferencia</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$resultadosQR = rellenarGanancias($conn);
							while ($row = mysqli_fetch_assoc($resultadosQR)) {
								echo "<tr>";
								echo "<td class='column1'>".$row["descripcion"]."</td>";
								echo "<td class='column2'>".$row["previsto"]."</td>";
								echo "<td class='column3'>".$row["rreal"]."</td>";
								echo "<td class='column6'>".$row["diferencia"]."</td>";
								echo "</tr>";
							}
						?>
							<tr>
								<td class="column1">
									<div class="wrap-input100 validate-input">
										<input class="input100" type="text" name="descripcion" placeholder="Inserte Descripcion">
										<span class="focus-input100" data-symbol="&#x27AA;"></span>
									</div>
								</td>
								<td class="column2">
									<div class="wrap-input100 validate-input">
										<input class="input100" type="text" name="previsto" placeholder="Inserte Previsto">
										<span class="focus-input100" data-symbol="&#x27AA;"></span>
									</div>
								</td>
								<td class="column3">
									<div class="wrap-input100 validate-input">
										<input class="input100" type="text" name="real" placeholder="Inserte Real">
										<span class="focus-input100" data-symbol="&#x27AA;"></span>
									</div>
								</td>
								<td class="column6">
									<div class="wrap-input100 validate-input">
										<input class="input100" type="text" name="diferencia" placeholder="Inserte Diferencia">
										<span class="focus-input100" data-symbol="&#x27AA;"></span>
									</div>
							</tr>
						</tbody>
					</table>
					<div class="container-login100-form-btn p-t-50">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" name="submit">
								Ingresar Ganancia
							</button>
						</div>
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="productos">
		<div class="limiter">
		<div class="container-login100 p-t-100 p-l-100 p-r-100 p-b-50">
			<h1 class="p-l-100 p-r-100 fs-70">Productos</h1>
			<div class="wrap-table100 ">
					<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column1">Id</th>
								<th class="column2">Modelo</th>
								<th class="column3">Producto</th>
								<th class="column4">Fabricante</th>
								<th class="column5">Categoria</th>
								<th class="column6">Precio</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$resultadosQR = rellenarProducto($conn);
							while ($row = mysqli_fetch_assoc($resultadosQR)) {
								echo "<tr>";
								echo "<td class='column1'>".$row["id"]."</td>";
								echo "<td class='column2'>".$row["modelo"]."</td>";
								echo "<td class='column3'>".$row["producto"]."</td>";
								echo "<td class='column4'>".$row["fabricante"]."</td>";
								echo "<td class='column5'>".$row["categoria"]."</td>";
								echo "<td class='column6'>".$row["precio"]."</td>";
								echo "</tr>";
							}
						?>
						</tbody>
					</table>
					</div>
			</div>
		</div>
	</div>

</body>
</html>