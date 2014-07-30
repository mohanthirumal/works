<?php
class ChampionshipLeaderboardController extends FrontController
{
	protected $title = 'Championship Leaderboard';
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
		self::$smarty->display('championship-leaderboard.tpl');
	}
}
