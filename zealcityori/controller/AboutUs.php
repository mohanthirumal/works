<?php
class AboutUs extends FrontController
{
	protected $title = 'About us';
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
		self::$smarty->display('about-us.tpl');
	}
}
