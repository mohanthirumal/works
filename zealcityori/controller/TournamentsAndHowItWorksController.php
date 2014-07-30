<?php
class TournamentsAndHowItWorksController extends FrontController
{
	protected $title = 'Tournaments and how it works?';
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
		self::$smarty->display('tournament-and-how-it-works.tpl');
	}
}
