<?php
class PrivacyPolicyController extends FrontController
{
	protected $title = 'Privacy Policy';
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		parent::preProcess();
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('privacy-policy.tpl');
	}
}
