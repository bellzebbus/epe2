<?php 
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Epe 2</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" method="POST" action="#">
					<span class="login100-form-title p-b-49">
						Recuperar Clave
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Ingrese el un usuario">
						<span class="label-input100">Usuario:</span>
						<input class="input100" type="text" name="username" placeholder="Usuario">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate="Ingrese la contraseña">
						<span class="label-input100">E-mail:</span>
						<input class="input100" type="email" name="email" placeholder="E-mail">
						<span class="focus-input100" data-symbol="&#64;"></span>
					</div>
					
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								Recuperar
							</button>
						</div>
					</div>
					<div class="flex-col-c p-t-155">
						<a href="login.php" class="txt2">
							Iniciar Sesión
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>