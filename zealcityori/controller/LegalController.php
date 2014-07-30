<?php
class LegalController extends FrontController
{
	protected $title = 'Is it legal to play at Zealcity';
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
		self::$smarty->display('legal.tpl');
	}
}
