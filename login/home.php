<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<section>
		<div align="center">
			<span style="font-size: 40px">Bienvenido</span>
			<br>
			<?php
				session_start(); 
				echo $_SESSION['usuario'];
				session_destroy(); 
			?>
		</div>
	</section>
</body>
</html>