<?php
abstract class Module
{
	protected static $_INSTANCE = array();
	
	public function __construct()
	{
	}
	
	public function execHook($class, $method)
	{
		$output = '';
		if (($moduleInstance = Module::getInstanceByName($class)) AND is_callable(array($moduleInstance, $method)))
				$output .= call_user_func(array($moduleInstance, $method));
		return $output;
	}
	
	public static function getInstanceByName($moduleName)
	{
		if (!isset(self::$_INSTANCE[$moduleName]))
		{
			include_once('modules/'.$moduleName.'/'.$moduleName.'.php');
			if (class_exists($moduleName, false))
				return self::$_INSTANCE[$moduleName] = new $moduleName;
		}
		return self::$_INSTANCE[$moduleName];
	}
	
	public static function display($file, $template)
	{
		global $smarty;
		$result = $smarty->fetch(_MODULE_DIR_.basename($file, '.php').'/'.$template);
		return $result;
	}
}