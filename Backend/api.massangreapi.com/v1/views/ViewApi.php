<?php
abstract class ViewApi {
	//Error code
	public $state;
	
	public abstract function PrintContentType ($body);
}