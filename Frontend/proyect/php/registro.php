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
<html lang="en">
	<head>
	<meta charset="utf-8">
	<title>Registro</title>
	<script src="../js/jquery-1.10.2.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="../js/css/bootstrap.min.css">
	<link href="../js/jquery-ui.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script type="text/javascript">
		$("document").ready(function(){

			$(".alert").hide();
			 $("#entrar").click(function(){
           		$.ajax({
                    type: "POST",
                    url: "http://10.43.24.251/api.massangreapi.com/v1/account/signup",
                    data: { email: $("#inputEmail").val(),password: $("#inputPassword").val(), 
                    first_name: $("#inputName").val(), fathers_name: $("#inputLastName").val()},
                    success: function (data) {
                    //alert("#tabs-"+id_sitio);
                     var valor = parseInt(data);

                     if(valor==1){
                        window.location.href = "index.php";
                        
                     }else{

                       $(".alert").show();
                     }
                   
                     }
            	});
    		});

		});
	</script>

	</head>

	<style type="text/css">
   		body { background-color: #E74C3C !important; } 

	</style>


	<body>

		<nav class="navbar navbar-inverse navbar-fixed-top" style="color:red;">
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

		<div class="container">

			<div class="page-header">
  				<h1 align="center">Registro de Usuario</h1>
			</div>

			<div >
			<div class="panel panel-danger" style="width: 100%;" align="center">
      			<div class="panel-heading" align="center">Registro de Usuario</div>
      			<br><br>

      			<form class="form-horizontal">
  					<div class="form-group">
    					<label for="inputEmail" class="col-sm-4 control-label">Email</label>
    					<div class="col-sm-5">
	      					<input type="email" class="form-control" id="inputEmail" placeholder="Email">
    					</div>
  					</div>
  					<div class="form-group">
    					<label for="inputPassword" class="col-sm-4 control-label">Contraseña</label>
    					<div class="col-sm-5">
      						<input type="password" class="form-control" id="inputPassword" placeholder="Password">
    					</div>
  					</div>
  					<div class="form-group">
    					<label for="inputName" class="col-sm-4 control-label">Nombre</label>
    					<div class="col-sm-5">
      						<input type="text" class="form-control" id="inputName" placeholder="Nombre">
    					</div>
  					</div>
  					<div class="form-group">
    					<label for="inputLastName" class="col-sm-4 control-label">Apellido</label>
    					<div class="col-sm-5">
      						<input type="text" class="form-control" id="inputLastName" placeholder="Apellido">
    					</div>
  					</div>
  					<div class="form-group">
    					<div class="col-sm-offset-4 col-sm-5">
      						<button type="submit" class="btn btn-danger btn-block">Crear Cuenta</button>
    					</div>
  					</div>
				</form>
    		</div>
    		</div>
			
		</div>
		
	</body>
</html>