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
	<title>Perfil</title>
	<script src="../js/jquery-1.10.2.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="../js/css/bootstrap.min.css">
	<link href="../js/jquery-ui.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script type="text/javascript">

  		$("document").ready(function(){

  			$( "#datepicker" ).datepicker();

  			$("#alertS").hide();
    		$("#alertW").hide();
    		$("#guardar").click(function(){
    			$.ajax({
    				type: "POST",
    				url: "http://10.43.24.251/api.massangreapi.com/v1/person/update",
    				dataType: "json",
    				contentType: "text/plain",
    				crossDomain: true,
    				data: JSON.stringify({"person": {
    					"person_id": 16, "first_name": $("#inputName").val(), "fathers_name": $("#inputLastName").val(),
    					"mothers_name": $("#inputLastName2").val(), "genre": $("#inputSex").val(), "blod_type_id": $("#inputBlodtype").val(),
    					"birth_date": $("#datepicker").val(), "email": $("#inputEmail").val(), "telephone": $("#inputTel").val(),
    					"weight": 0, "image": "", "valid_flag": 1
							}
						}),
    				success: function(data){
    					var valor = parseInt(data.state);
    					//alert(valor);
    					if (valor == 1) {
    						$("#alertS").show();
    					}else{
    						$("#alertW").show();
    					}
    				},
    			}); 
    		});
  		});

	</script>
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

			<div class="alert alert-success" role="alert" id="alertS">
          		<strong>Bien echo!</strong> Tu información se ha actualizado.
          	</div>

          	<div class="alert alert-danger" role="alert" id="alertW">
          		<strong>Lo siento!</strong> Tu información no se ha podido actualizar. Intentalo de nuevo.
          	</div>

			<div class="page-header" >
  				<h1 align="center">Mi Perfil</h1>
			</div>

			<div class="row" style="margin-left: 10%;">

			<div class="panel panel-default row" style="width: 90%;">
    			<div class="panel-body">
    				
    				<div class="col-sm-4">
						<div class="panel panel-danger" align="center">
    						<div class="panel-heading" align="center">Foto de Perfil</div>
    						<br>
    						<div style="width: 200px; height: 200px;">
    							<img src="../img/home1.jpg" class="img-circle img-responsive" id="inputImg">
    						</div>
    					</div>
					</div>

					<div class="col-sm-8">
						<div class="panel panel-danger" align="center">
    						<div class="panel-heading" align="center">Datos de Usuario</div>
    						<br>

    							<form class="form-horizontal">

  						<div class="form-group">
    						<label for="inputName" class="col-sm-3 control-label">Nombre</label>
    						<div class="col-sm-7">
      							<input type="text" class="form-control" id="inputName" placeholder="Nombre">
    						</div>
  						</div>
  				
  						<div class="form-group">
    						<label for="inputLastName" class="col-sm-3 control-label">Apellido Paterno</label>
    						<div class="col-sm-7">
      							<input type="text" class="form-control" id="inputLastName" placeholder="Apellido Paterno">
    						</div>
  						</div>

  						<div class="form-group">
    						<label for="inputLastName2" class="col-sm-3 control-label">Apellido Materno</label>
    						<div class="col-sm-7">
      							<input type="text" class="form-control" id="inputLastName2" placeholder="Apellido Materno">
    						</div>
  						</div>
  						
  						<div class="form-group">
    						<label for="inputEmail" class="col-sm-3 control-label">Email</label>
    						<div class="col-sm-7">
	      						<input type="email" class="form-control" id="inputEmail" placeholder="Email">
    						</div>
  						</div>
  						
  						<div class="form-group">
    						<label for="inputTel" class="col-sm-3 control-label">Telefono</label>
    						<div class="col-sm-7">
	      						<input type="text" class="form-control" id="inputTel" placeholder="Telefono">
    						</div>
  						</div>
  						
  						<div class="form-group">
    						<label for="inputPassword" class="col-sm-3 control-label">Contraseña</label>
    						<div class="col-sm-7">
      							<input type="password" class="form-control" id="inputPassword" placeholder="Password">
    						</div>
  						</div>
  						
  						<div class="form-group">
    						<label for="inputBlodtype" class="col-sm-3 control-label">Tipo de Sangre</label>
    						<div class="col-sm-7">
      							<select class="form-control" id="inputBlodtype">
  									<option>1</option>
  									<option>2</option>
  									<option>3</option>
  									<option>4</option>
  									<option>5</option>
								</select>
    						</div>
  						</div>
    					
    					<div class="form-group">
    						<label for="datepicker" class="col-sm-3 control-label">Fecha de nacimiento</label>
    						<div class="col-sm-7">
      							<input type="text" class="form-control" id="datepicker" placeholder="Fecha">
    						</div>
  						</div>
  						
  						<div class="form-group">
    						<label for="inputSex" class="col-sm-3 control-label">Sexo</label>
    						<div class="col-sm-7">
      							<select class="form-control" id="inputSex">
  									<option id="M" value="M">Hombre</option>
  									<option id="F" value="F">Mujer</option>
								</select>
    						</div>
  						</div>
    					<br>
    					<br>

    					<div class="form-group">
    					<div class="col-sm-offset-1 col-sm-9">
      						<button type="button" id="guardar" class="btn btn-danger btn-block">Guardar / Actualizar</button>
    					</div>
  					</div>
						
					</form>

    					</div>
    				</div>
				</div>
    			</div>
				
    		</div>

    		</div>
  			</div>
		</div>	
	</body>
</html>