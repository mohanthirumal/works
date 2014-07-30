<?php
class FaqsController extends FrontController
{
	protected $title = 'Frequestly Asked Questions';
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
		self::$smarty->display('faqs.tpl');
	}
}
