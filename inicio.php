<?php

session_start();

if (isset($_SESSION['username'])) {
	$_SESSION['msg'] = "Debes iniciar session primero";
	header("location : index.html");

}
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location : index.html");			
}


?>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>Esta es una prueba</h1>
	<?php if (isset($_SESSION['success'])) : ?>
	<div>
		<h3>
			<?php 
				echo $_SESSION['success'];
				unset($_SESSION['success']);
			?>
		</h3>
	</div>
<?php endif ?>

<?php if (isset($_SESSION['success'])) : ?>
	<h3>Welcome <?php echo $_SESSION['username'];?></h3>
	<button><a href="index.html?logout='1'"></a></button>
<?php endif ?>
</body>
</html>