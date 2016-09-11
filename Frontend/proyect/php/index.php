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
	<title>Index</title>
	<script src="../js/jquery-1.10.2.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="../js/css/bootstrap.min.css">
	<link href="../js/jquery-ui.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<script type="text/javascript">

	$("document").ready(function(){

		//$("#alertS").hide();
    	$("#alertW").hide();
		$("#entrar").click(function(){
		$.ajax({
			type: "POST",
			url: "http://10.43.24.251/api.massangreapi.com/v1/account/login",
    		dataType: "json",
    		contentType: "text/plain",
    		crossDomain: true,
    		data: JSON.stringify({"account":{
    				"email": $("#usuario").val(), "password": $("#password").val()
    			}
    		}),
    		success:function(data){
    			var valor = parseInt(data.state);

    			if (valor == 1 && data.account.account_id != null) {
    				$("#alertS").show();
    				window.location.href = "index.php?account_id=" + data.account.account_id + "&person_id=" + data.account.person_id;
    			}else{
    				//alert("12")
    				$("#alertW").show();
    			}
    		},
		});
    	});

    	$("#registro").click(function(){
    		window.location.href = "registro.php";
    	});

    	$("#cerrar").click(function() {
    		window.location.href = "index.php?cerrar=1";
    	});
	});

</script>

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
        		<div id="navbar" class="navbar-collapse collapse">
          			<form id="formLogin" class="navbar-form navbar-right" >
          				<div style='<?php echo(($account_id == null)? "display: block;" : "display: none;") ?>'>
	            			<div class="form-group">
	              				<input id="usuario" type="text" placeholder="Email" class="form-control">
	            			</div>
	            			<div class="form-group">
	              				<input id="password" type="password" placeholder="Password" class="form-control">
	            			</div>
	            				<button id="entrar" type="button" class="btn btn-danger">Inicia Sesión</button>
	            				<button id="registro" type="button" class="btn btn-danger">Registrate</button>
        				</div>
        				<div style='<?php echo(($account_id != null)? "display: block;" : "display: none;") ?>'>
        					<button id="cerrar" type="button" class="btn btn-danger">Cerrar Sesión</button>
        				</div>
          			</form>
        		</div><!--/.navbar-collapse -->
      		</div>
    	</nav>

    	<div class="jumbotron" style="background-image: url(''); text-align:center;">
			<h1>Droplets</h1>
			<p>Conviertete en un Dropler y transforma una vida.</p>
		</div>

    	<div class="conteiner" >
    		<img src="../img/home1.jpg" style="display: block; margin-left: auto; margin-right: auto; height:200px;">
    		<!--
    		<div class="alert alert-success" role="alert" id="alertS">
          		<strong>Bien echo!</strong> Tu información se ha actualizado.
          	</div>

          	<div class="alert alert-danger" role="alert" id="alertW" style="width: 40%; margin-left: 25%">
          		<strong>Lo siento!</strong> Tu información no se ha podido actualizar. Intentalo de nuevo.
          	</div>
			-->
			
    	</div>
		
		
	</body>
</html>