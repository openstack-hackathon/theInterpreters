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
	<title>Login</title>
	<script src="../js/jquery-1.10.2.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="../js/css/bootstrap.min.css">
	<link href="../js/jquery-ui.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<script type="text/javascript">

	$("document").ready(function(){

		$(".alert").hide();
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
    				window.location.href = "index.php?account_id=" + data.account.account_id + "&person_id=" + data.account.person_id;
    			}else{
    				$(".alert").show();
    			}
    		},
		});
    	});
	});

</script>


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
          			<a class="navbar-brand" href="http://localhost/proyect/php/campana.php">
          				<span class="glyphicon glyphicon-plus-sign"></span> Causa
          			</a>
        		</div>
        		
      		</div>
    	</nav>
    	<br><br>

	<div class="container">

		<div class="page-header">
  			<h1 align="center">Inicio de Sesión</h1>
		</div>

  <div class="row" id="pwd-container">

    <div class="col-md-4"></div>
    
    <div class="col-md-4">
      <section class="login-form">

		<img src="../img/home1.jpg"  width="140px" class="img-fluid center-block"/><br/>

        <form method="post" action="#" role="login">
          
          <input id="usuario" type="text" name="usuario" placeholder="user" required class="form-control input-lg" />
          <br/>
          <input type="password" class="form-control input-lg" id="password" placeholder="password" required="" />
          <br/>
          
          <div class="pwstrength_viewport_progress"></div>
          
          
          <button id="entrar" type="button" name="go" class="btn btn-lg btn-danger btn-block">Login</button>
          <br/>
          <div class="alert alert-danger" role="alert">
          	<strong>Lo siento!</strong> Tu información es incorrecta. Intentalo de nuevo.
          </div>
          
        </form>
        
      </section>  
      </div>
            

  </div>
  
</div>

</body>
</html>