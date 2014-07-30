<?php
class XtraCashController extends FrontController
{
	protected $title = 'Xtra Cash';
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
		self::$smarty->display('xtra-cash.tpl');
	}
}
