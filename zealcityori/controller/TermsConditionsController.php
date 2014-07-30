<?php
class TermsConditionsController extends FrontController
{
	protected $title = 'Terms and Conditions';
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
		self::$smarty->display('terms-conditions.tpl');
	}
}
