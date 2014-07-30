<?php
class ConnectController extends FrontController
{
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		parent::preProcess();		
	}
	
	public function process()
	{
		$user = $this->facebookConnect();
		$id = Tools::getValue('id');
		self::$smarty->assign('id', $id);
	}
	
	public function displayHeader()
	{}
	
	public function displayFooter()
	{}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('connect.tpl');
	}
}
