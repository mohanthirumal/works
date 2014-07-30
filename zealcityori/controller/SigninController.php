<?php
class SigninController extends FrontController
{
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		$user = new User();
		if($user->loginFailureAttempt())
			self::$smarty->assign('showcaptcha', 1);
	}
	
	public function displayHeader()
	{}
	
	public function displayFooter()
	{}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('login.tpl');
	}
}
