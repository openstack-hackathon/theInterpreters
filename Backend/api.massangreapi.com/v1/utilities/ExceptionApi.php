<?php
class ExceptionApi extends Exception
{
	public $state;
	const OK = 1;
	const ESTADO_RECURSO_NO_EXISTE = 2;
	const ESTADO_URL_INCORRECTA = 3;
	const ESTADO_ERROR_BD = 4;
	const ESTADO_METODO_NO_EXISTE = 5;
	
	const OK_MESSAGE = "OK";
	const ESTADO_RECURSO_NO_EXISTE_MESSAGE = "Recurso no existe";
	const ESTADO_URL_INCORRECTA_MESSAGE = "Url mal formada";
	const ESTADO_ERROR_BD_MESSAGE = "Error de base de datos";
	const ESTADO_METODO_NO_EXISTE_MESSAGE = "Metodo no existe";

	public function __construct($state, $message, $code = 400)
	{
		$this->state = $state;
		$this->message = $message;
		$this->code = $code;
	}

}