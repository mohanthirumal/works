<?php
class WhatsNewInZealcityController extends FrontController
{
	protected $title = 'What\'s new In Zealcity?';
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
		self::$smarty->display('whats-new-in-zealcity.tpl');
	}
}
