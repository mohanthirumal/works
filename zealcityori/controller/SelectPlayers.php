<?php
class SelectPlayers extends FrontController
{
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		//parent::preProcess();
		if ($tour_id = (int)Tools::getValue('tour_id'))
		{
			$tournament = new Tournament($tour_id);
			$match = new Matches($tournament->match_id);
			$team1 = new Teams($match->team1);
			$team2 = new Teams($match->team2);
			$team1players = $team1->getSquardPlayers($match->type);
			$team2players = $team2->getSquardPlayers($match->type);
			self::$smarty->assign(array(
				'team1' => $team1,
				'team2' => $team2,
				'team1players' => $team1players,
				'team2players' => $team2players,
				'match' => $match
			));
		}		
	}
	
	public function displayHeader()
	{}
	
	public function displayFooter()
	{}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('select-players.tpl');
	}
}