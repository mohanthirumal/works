<?php
class SignupController extends FrontController
{
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
	}
	
	public function displayHeader()
	{}
	
	public function displayFooter()
	{}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('signup.tpl');
	}
}
