<?php
function __autoload($class_name) {
	$className = $class_name;
	$classDir = 'classes/';
	$controllerDir = 'controller/';
	$file_in_classes = file_exists($classDir.$className.'.php');
	$file_in_controller = file_exists($controllerDir.$className.'.php');
	if($file_in_classes && $file_in_controller)
	{
		require_once($classDir.$className.'.php');
		require_once($controllerDir.$className.'.php');
	}
	if(!$file_in_classes && $file_in_controller)
	{
		require_once($controllerDir.$className.'.php');
	}
	if($file_in_classes && !$file_in_controller)
	{
		require_once($classDir.$className.'.php');
	}
}