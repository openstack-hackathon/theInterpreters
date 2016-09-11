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
	<title>Requisitos</title>
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
  				<h1 align="center">Requisitos</h1>
			</div>
    		
    		<div style="margin-left: 8%;">
    			<div class="panel panel-danger" style="width: 90%;" align="center">
    				<div class="panel-heading" align="center">Que debes saber</div>
    				<br>

					<div class="row" style="margin-left: 10px; margin-right: 10px;">
						<div class="panel panel-default">
    					<div class="panel-body">
    						<img src="../img/user_id_icon.jpg" class="img-rounded img-responsive col-sm-2" style="width: 80px; height: 40px;">
    						<label>Presenta tu identificación oficial</label>
    					</div>
    					</div>
					</div>

					<div class="row" style="margin-left: 10px; margin-right: 10px;">
						<div class="panel panel-default">
    					<div class="panel-body">
    						<img src="../img/edad.jpg" class="img-rounded img-responsive col-sm-2" style="width: 80px; height: 40px;">
    						<label>Debes tener entre 18 y 65 años</label>
    					</div>
    					</div>
					</div>

					<div class="row" style="margin-left: 10px; margin-right: 10px;">
						<div class="panel panel-default">
    					<div class="panel-body">
    						<img src="../img/enfermedades.jpg" class="img-rounded img-responsive col-sm-2" style="width: 80px; height: 40px;">
    						<label class="col-sm-10">No haber estado enfermo de gripe, tos, diarrea o infección dental en los últimos 14 días</label>
    					</div>
    					</div>
					</div>

					<div class="row" style="margin-left: 10px; margin-right: 10px;">
						<div class="panel panel-default">
    					<div class="panel-body">
    						<img src="../img/ayuno.png" class="img-rounded img-responsive col-sm-2" style="width: 80px; height: 40px;">
    						<label class="col-sm-10">Ayunar mínimo 4 horas (evitando alimentos con grasa 24 horas antes de la donación)</label>
    					</div>
    					</div>
					</div>

					<div class="row" style="margin-left: 10px; margin-right: 10px;">
						<div class="panel panel-default">
    					<div class="panel-body">
    						<img src="../img/medicinas.jpg" class="img-rounded img-responsive col-sm-2" style="width: 80px; height: 40px;">
    						<label class="col-sm-10">No haber tomado medicamentos en los últimos 5 días</label>
    					</div>
    					</div>
					</div>

					<div class="row" style="margin-left: 10px; margin-right: 10px;">
						<div class="panel panel-default">
    					<div class="panel-body">
    						<img src="../img/operacion.jpg" class="img-rounded img-responsive col-sm-2" style="width: 80px; height: 40px;">
    						<label class="col-sm-10">No haber sido operado en los últimos 6 meses</label>
    					</div>
    					</div>
					</div>

					<div class="row" style="margin-left: 10px; margin-right: 10px;">
						<div class="panel panel-default">
    					<div class="panel-body">
    						<img src="../img/bebidas.jpg" class="img-rounded img-responsive col-sm-2" style="width: 80px; height: 40px;">
    						<label class="col-sm-10">No haber ingerido bebidas alcohólicas en 72 horas previas a la donación</label>
    					</div>
    					</div>
					</div>

					<div class="row" style="margin-left: 10px; margin-right: 10px;">
						<div class="panel panel-default">
    					<div class="panel-body">
    						<img src="../img/tatuajes.jpg" class="img-rounded img-responsive col-sm-2" style="width: 80px; height: 40px;">
    						<label class="col-sm-10">No haber estado en tratamiento de endodoncia, acupuntura o haberse practicado tatuajes o perforaciones en los últimos 12 meses</label>
    					</div>
    					</div>
					</div>

					<div class="row" style="margin-left: 10px; margin-right: 10px;">
						<div class="panel panel-default">
    					<div class="panel-body">
    						<img src="../img/peso.jpg" class="img-rounded img-responsive col-sm-2" style="width: 80px; height: 40px;">
    						<label class="col-sm-10">Pesar más de 50 kilos</label>
    					</div>
    					</div>
					</div>

    			</div>
    		</div>
    	</div>

	</body>
</html>