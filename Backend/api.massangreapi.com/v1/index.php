<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept,Authorization');

require_once 'views/ViewJson.php';
require_once 'utilities/ExceptionApi.php';
require_once 'utilities/DBConnection.php';
require_once 'models/ModelAccount.php';
require_once 'models/ModelAppointment.php';
require_once 'models/ModelCampaign.php';
require_once 'models/ModelDonor.php';
require_once 'models/ModelDonorHospital.php';
require_once 'models/ModelPerson.php';

//Dentro de index.php
//require './utilities/DBConnection.php';
//print DBConnection::GetInstance()->GetDB()->errorCode();

//Exceptions
$view = new ViewJson();

set_exception_handler(function ($exception) use ($view) {
	$body = array(
			"state" => $exception->state,
			"message" => $exception->getMessage()
	);
	if ($exception->getCode()) {
		$view->state = $exception->getCode();
	} else {
		$view->state = 500;
	}

	$view->PrintContentType($body);
});

//Get resource
$request = explode('/', $_GET['PATH_INFO']);
$resource = array_shift($request);
//print $resource;
$existentResources = array('account', 'person', 'donor', 'donor_hospital', 'campaign', 'appointment');

//Resource validation
if(!in_array($resource, $existentResources)) {
	throw new ExceptionApi(ExceptionApi::ESTADO_RECURSO_NO_EXISTE, ExceptionApi::ESTADO_RECURSO_NO_EXISTE_MESSAGE, 404);
}

$method = strtolower($_SERVER['REQUEST_METHOD']);
//print $method;
switch ($method) {
	case 'get':
		$view->PrintContentType(ModelAccount::get($request));
		break;
	case 'post':
		switch ($resource) {
			case "account":
				$view->PrintContentType(ModelAccount::post($request));
				break;
			case "person":
				$view->PrintContentType(ModelPerson::post($request));
			break;
			case "donor":
				$view->PrintContentType(ModelDonor::post($request));
				break;
			case "donor_hospital":
				$view->PrintContentType(ModelDonorHospital::post($request));
				break;
			case "campaign":
				$view->PrintContentType(ModelCampaign::post($request));
				break;
			case "appointment":
				$view->PrintContentType(ModelAppointment::post($request));
				break;
		}
		break;
	case 'put':
		$view->PrintContentType(ModelAccount::put($request));
		break;
	case 'delete':
		$view->PrintContentType(ModelAccount::delete($request));
		break;
	default:
		throw new ExceptionApi(ExceptionApi::ESTADO_METODO_NO_EXISTE, ExceptionApi::ESTADO_METODO_NO_EXISTE_MESSAGE, 400);
		break;
}