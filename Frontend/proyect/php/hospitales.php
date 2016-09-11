<?php 
	session_start();
	$account_id = null;
	$person_id = null;

	if (isset($_GET["account_id"]) && isset($_GET["person_id"])) {
		$account_id = $_GET["account_id"];
		$person_id = $_GET["person_id"];

		$_SESSION['account_id'] = $account_id;
		$_SESSION['person_id'] = $person_id;
	}

	if (isset($_SESSION["account_id"]) && isset($_SESSION["person_id"])) {
		$account_id = $_SESSION["account_id"];
		$person_id = $_SESSION["person_id"];
	}

	if (isset($_GET["cerrar"])) {
		if (isset($_SESSION["account_id"]) && isset($_SESSION["person_id"])) {
			$account_id = null;
			$person_id = null;

			unset($_SESSION["account_id"]);
			unset($_SESSION["person_id"]);
		}
	}

 ?>
<!DOCTYPE html>
<html  lang="en">
	<head>
	<meta charset="utf-8">
	<title>Campaña</title>
	<script src="../js/jquery-1.10.2.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="../js/css/bootstrap.min.css">
	<link href="../js/jquery-ui.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<style type="text/css">
   		body { background-color: #E74C3C !important; } 

	</style>

	<body>

		<nav class="navbar navbar-inverse navbar-fixed-top">
      		<div class="container">
        		<div class="navbar-header">
          			<a class="navbar-brand" href="index.php">
          				<span class="glyphicon glyphicon-home"></span> Home
          			</a>
          			<a class="navbar-brand" href="requisitos.php">
          				<span class="glyphicon glyphicon-tint"></span> Dona
          			</a>
          			<a class="navbar-brand" href="perfil.php">
          				<span class="glyphicon glyphicon-tint"></span> Perfil
          			</a>
          			<a class="navbar-brand" href="campana.php">
          				<span class="glyphicon glyphicon-plus-sign"></span> Causa
          			</a>
        		</div>
        		
      		</div>
    	</nav>
    	<br><br>

    	<div class="conteiner">

			<div class="page-header" >
  				<h1 align="center">Hospitales</h1>
			</div>

			<div class="row" style="margin-left: 3%;">

			<div class="panel panel-default row" style="width: 98%;">
    			<div class="panel-body">
    				
    				<div class="">
						<div class="panel panel-danger" align="center">
    						<div class="panel-heading" align="center">Hospitales</div>
							
    						<table style="width:70%">
							  <tr>
							    <th>Hospital_Name</th>
							    <th>Latitud</th> 
							    <th>Longitud</th>
								<th>URL</th>
							  </tr>
							  <tr>
								<td>Centro Médico Nacional de Occidente</td>
								<td>20.6862210</td>
								<td>-103.3293930</td>  
								<td><a href="https://www.google.com.mx/maps/@20.6862210,-103.3293930,"</a>Map</td>
							  </tr>
							  <tr>
							     <td>Hospital General de Occidente</td>
								<td>20.7177030</td>
								<td>-103.3718932</td>
								<td><a href="https://www.google.com.mx/maps/@20.7177030,-103.3718932,"</a>Map</td>
							  </tr>
							  <tr>
							    <td>Hospital San Javier Guadalajara</td>
								<td>20.6879100</td>
								<td>-103.3920630</td>
								<td><a href="https://www.google.com.mx/maps/@20.6879100,-103.3920630,"</a>Map</td>
							  </tr>
							  <tr>
							  	<td>Centro Médico Puerta de Hierro</td>
							  	<td>20.7084421</td>
							  	<td>-103.4169038</td>
							  	<td><a href="https://www.google.com.mx/maps/@20.7084421,-103.4169038,"</a>Map</td>
							  </tr>	
							  <tr>
							  	<td>Hospital Civil Juan I. Menchaca</td>
								<td>20.7586378</td>
								<td>-103.4820726</td>
								<td><a href="https://www.google.com.mx/maps/@20.7586378,-103.4820726,"</a>Map</td>
							  </tr>
							</table>

    					</div>
					</div>
				</div>
    			</div>
				
    		</div>

    	</div>
		
	</body>
</html>