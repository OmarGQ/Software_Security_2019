<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="cambio.js"></script>
	<link rel="stylesheet" type="text/css" href="2.css">
	<title></title>
</head>
<body>
	<?php
		session_start();
		if($_SESSION['usuario'] == ""){
			header('Location: espirada.html');
		}
	?>
	<div class="container">
	    <div class="helper">
	        <div class="content">
	            <form id="form1" name="form1" method="post">
					<table width="100%" class="log">
						<tr align="center">
							<td height="90">
								<span style="font-size: 30px">Acceder</span>
								<br>
								<?php
									echo "<span>".$_SESSION['usuario']."</span>";
								?>
							</td>
						</tr>
						<tr>
							<td height="100">
								<span style="font-size: 22px">Contraseña: </span>
								<input type="password" name="pass" id="pass">
							</td>
						</tr>
						<tr>
							<td height="75" align="right">
								<input name="Submit" type="submit" value="Submit" style="width: 90px; height: 30px; border-radius: 30px; background-color: lightblue">
							</td>
						</tr>
					</table>
				</form>
				<?php
					if (isset ($_POST['Submit'])) {
						$password = $_POST['pass'];
						if ($password == "") {
							echo "<span style='color: red'>No se ingreso ningun dato</span>";
						}else{
							$usuario = array();
							$cont = array();
							$dbh = new PDO('mysql:host=localhost;dbname=cetianosunidos', "cetianosunidos", "baa27c2e5");
							$dbh->query("SET NAMES 'utf8'");	
							$sql="select password from LoginSS where password = '".$password."' && user = '".$_SESSION['usuario']."'";
							$sql2="select count(password) from LoginSS where password = '".$password."' && user = '".$_SESSION['usuario']."'";
							foreach ($dbh->query($sql2) as $res)
							{
								$cont[]=$res;
							}
							if ($cont[0]['count(password)'] != 0) {
								foreach ($dbh->query($sql) as $res)
								{
									$usuario[]=$res;
								}
								$dbh=null;
								#session_start(); 
			    				#$_SESSION['usuario'] = $usuario[0]['user'];
			    				$_SESSION['estado'] = 'Autenticado';
			    				header('Location: home.php');
							}else{
								echo "<span style='color: red'>Contraseña incorrecta</span>";
							}						}
					}
				?>
	        </div>
	    </div>
	</div>
</body>
</html>