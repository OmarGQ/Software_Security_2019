<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="cambio.js"></script>
	<link rel="stylesheet" type="text/css" href="2.css">
	<title></title>
</head>
<body>
	<div class="container">
	    <div class="helper">
	        <div class="content">
	            <form id="form1" name="form1" method="post">
					<table width="100%" class="log">
						<tr align="center">
							<td height="90"><span style="font-size: 30px">Acceder</span></td>
						</tr>
						<tr>
							<td height="100">
								<span style="font-size: 22px">Usuario: </span>
								<input type="text" name="user" id="user">
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
						$user = $_POST['user'];
						if ($user == "") {
							echo "<span style='color: red'>No se ingreso ningun usuario</span>";
						}else{
							$usuario = array();
							$cont = array();
							$dbh = new PDO('mysql:host=localhost;dbname=cetianosunidos', "cetianosunidos", "baa27c2e5");
							$dbh->query("SET NAMES 'utf8'");	
							$sql="select user from LoginSS where user = '".$user."'";
							$sql2="select count(user) from LoginSS where user = '".$user."'";
							foreach ($dbh->query($sql2) as $res)
							{
								$cont[]=$res;
							}
							if ($cont[0]['count(user)'] != 0) {
								foreach ($dbh->query($sql) as $res)
								{
									$usuario[]=$res;
								}
								$dbh=null;
								session_start(); 
			    				$_SESSION['usuario'] = $usuario[0]['user'];
			    				header('Location: pass.php');
							}else{
								echo "<span style='color: red'>Usuario no registrado</span>";
							}
						}
					}
				?>
	        </div>
	    </div>
	</div>
</body>
</html>