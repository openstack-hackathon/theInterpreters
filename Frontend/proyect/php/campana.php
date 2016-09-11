<?php 
  session_start();
  $account_id = "";
  $person_id = "";

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

  <script type="text/javascript">
    var person = null;
    var person_id = 0;

    $("document").ready(function(){
      $( "#startDate" ).datepicker();
      $( "#endDate" ).datepicker();

      function LoadData() {
        person_id = $("#hiddenPersonId").val();

        if(person_id > 0) {
          $.ajax({
                type: "POST",
                url: "http://10.43.24.251/api.massangreapi.com/v1/person/get",
                data: JSON.stringify({ person: { person_id: person_id }}),
                success: function (data) {
                //alert("#tabs-"+id_sitio);
                 var valor = parseInt(data.state);
                 
                  if (valor == 1 && data.person.person_id != null) {
                    if(data.person.person_id > 0) {
                      $("#InputPatienName").val(data.person.first_name + " " + data.person.fathers_name + " " + data.person.mothers_name);
                      $("#InputBlood").val(data.person.blood_type_id);
                    } else{
                      alert("Persona no encontrada");
                    }           
                  }
                }
          });
        
          $.ajax({
                type: "POST",
                url: "http://10.43.24.251/api.massangreapi.com/v1/campaign/getByPerson",
                data: JSON.stringify({ campaign: { person_id: person_id } }),
                success: function (data) {
                //alert("#tabs-"+id_sitio);
                 var valor = parseInt(data.state);
                 
                  if (valor == 1 && data.campaign.length > 0) {
                    campaign = data.campaign[0];

                    $("#InputHospital").val(campaign.hospital_id);
                    $("#InputComents").val(campaign.comments);
                    $("#startDate").val(campaign.start_date.split(" ")[0]);
                    $("#endDate").val(campaign.end_date.split(" ")[0]);
                    $("#beneficiaryIdentifier").val(campaign.beneficiary_identifier);
                    if(campaign.open_flag == 1) {
                      $('#openFlag').prop('checked', true);
                    } else {
                      $('#openFlag').prop('checked', false);
                    }
                  }
                }
          });
        }
      }

      //Load page
      LoadData();
    });
  </script>

	<body>blood_type_id
		
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

    	<div class="container">
    		
    		<div class="page-header" >
  				<h1 align="center">Comparte tu causa</h1>
			</div>

      <div >
        <div class="panel panel-danger" style="width: 100%;" align="center">
          <div class="panel-heading" align="center">Causa</div>
            <br><br>

            <div style="padding-right: 25px; padding-left: 25px;">

            <form>
              <div class="form-group">
                <label for="InputPatienName">Nombre del paciente</label>
                <input type="text" class="form-control" id="InputPatienName" placeholder="Nombre completo" disabled ="true">
              </div>

              <div class="form-group">
                  <label for="InputHospital">Hopital</label>
                      <div>
                        <select class="form-control ng-pristine ng-untouched ng-valid ng-valid-required" id="InputHospital">
                          <option value="0"></option>
                          <option value="1">Hospital 1</option>
                          <option value="2">Hospital 2</option>
                          <option value="3">Hospital 3</option>
                          <option value="4">Hospital 4</option>
                          <option value="5">Hospital 5</option>
                          <option value="6">Hospital 6</option>
                          <option value="7">Hospital 7</option>
                          <option value="8">Hospital 8</option>
                          <option value="9">Hospital 9</option>
                          <option value="10">Hospital 10</option>
                        </select>
                      </div>
              </div>

               <div class="form-group>
                  <label for="InputBlood">Tipo de Sangre</label>
                      <div>
                        <select class="form-control ng-pristine ng-untouched ng-valid ng-valid-required" id="InputBlood" disabled="true">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                        </select>
                      </div>
              </div>
              
              <!--<div class="form-group col-md-5 no-padding-r">
              
                  <label for="InputCantidad">Cantidad de donadores</label>
                      <div>
                        <select class="form-control ng-pristine ng-untouched ng-valid ng-valid-required" id="InputCantidad">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                        </select>
                      </div>
                      
              </div>-->

              <div class="form-group">
                <label for="startDate">Fecha de inicio</label>
                <div>
                  <input type="text" class="form-control" id="startDate" placeholder="Fecha">
                </div>
              </div>

              <div class="form-group">
                <label for="endDate">Fecha de fin</label>
                <div>
                  <input type="text" class="form-control" id="endDate" placeholder="Fecha">
                </div>
              </div>

              <div class="form-group">
                <label for="beneficiaryIdentifier">Identificador para donar (Opcional)</label>
                <div>
                  <input type="text" class="form-control" id="beneficiaryIdentifier" placeholder="Identificador">
                </div>
              </div>

              <div class="form-group">
                <label for="openFlag">¿Continúa abierto?</label>                
                  <input type="checkbox" class="form-control" id="openFlag" placeholder="Abierto" checked="true">                
              </div>

              <div class="form-group">
                <label for="InputComents">Comentarios</label>
                <textarea required="" maxlength="140" ng-model="need.extraInformation" id="InputComents" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched ng-untouched ng-valid-maxlength" rows="5" placeholder="Comentarios, datos de contacto, habitación, edad del paciente">
                  
                </textarea>
              </div>
              
              <p class="text-center ng-binding" style="font-size:12px;">
                "Al presionar el botón de "Crear Campaña" aceptas el "
                <a style="text-decoration:underline;" href="" target="_blank" class="ng-binding">
                  aviso de privacidad
                </a>
              </p>

              <button type="submit" class="btn btn-danger btn-block">Crear Campaña</button>
              <br>
            </form>
            </div>
        </div>
      </div>
    	</div>
      <div>
          <input type="hidden" id="hiddenAccountId" value='<?php echo $account_id ?>'>
          <input type="hidden" id="hiddenPersonId" value='<?php echo $person_id ?>'>
      </div>
	</body>

</html>