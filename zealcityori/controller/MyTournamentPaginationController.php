<?php
class MyTournamentPaginationController extends FrontController
{
	private $content;
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		if($cookie->logged)
			if($start = Tools::getValue('start'))
			{
				$tournament = new Tournament();
				$allMyTournaments = $tournament->getOverAllMyTournaments(15, $start);
				foreach($allMyTournaments as $key => $allTournament)
				{
					$prizes = explode(',', $allTournament['prize']);
					$allMyTournaments[$key]['prize'] = array_sum($prizes);
				}
				self::$smarty->assign('mytournaments', $allMyTournaments);
			}
	}
	
	public function displayHeader()
	{}
	
	public function displayFooter()
	{}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('my-tournament-pagination.tpl');
	}
}
