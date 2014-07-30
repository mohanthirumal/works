<?php
class IndexController extends FrontController
{
	protected $title = 'home';
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		parent::preProcess();
//		if(!$cookie->isLogged())
//			Tools::redirect(__BASE_URI__.'home');
	}
	
	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS('css/slider.css', 'all');
		Tools::addCSS(__BASE_URI__.'css/tournament.css?1', 'all');
		Tools::addJS(array(__BASE_URI__.'js/script-clicker.js'));
	}
	
	public function process()
	{
		global $cookie;
		parent::process();
		$tournament = new Tournament();
		$ptournament = new PTournament();
		$matches = new Matches();
		$nextMatch = $matches->getApprovedMatches(1);
		$allTournaments = $tournament->getAllTournament();
		$listTour = array();
		$count = 5;
		$joinedTour['daily'] = '';
		$joinedTour['period'] = '';
		foreach($allTournaments as $key => $allTournament)
		{
			$prizes = explode(',', $allTournament['prize']);
			$tourPrize = array_sum($prizes);
			$listTour[$allTournament['match_date']][$allTournament['prize']]['flag1'] = $allTournament['team1flag'];
			$listTour[$allTournament['match_date']][$allTournament['prize']]['flag2'] = $allTournament['team2flag'];
			$listTour[$allTournament['match_date']][$allTournament['prize']]['prize'] = $tourPrize;
			$listTour[$allTournament['match_date']][$allTournament['prize']]['entryfee'] = $allTournament['amount'];
			$listTour[$allTournament['match_date']][$allTournament['prize']]['type'] = $allTournament['prize'];
			if($allTournament['amount'] == 0)
				$listTour[$allTournament['match_date']][$allTournament['prize']]['tour'][0] = $allTournament;
			else
				$listTour[$allTournament['match_date']][$allTournament['prize']]['tour'][$count] = $allTournament;
			if(isset($prizes[1]))
				$listTour[$allTournament['match_date']][$allTournament['prize']]['prizetype'] = 'Prize Pool';
			else
				$listTour[$allTournament['match_date']][$allTournament['prize']]['prizetype'] = 'Win';
			$count++;
			if(isset($allTournament['tournament_id']))
				$joinedTour['daily'] .= $allTournament['id'].',';
		}
		$_SESSION['joinedtour'] = $joinedTour;
		self::$smarty->assign('tournaments', $listTour);
		
		self::$smarty->assign('tourimageurl', FLAG_URL);
		if(isset($nextMatch[0]))
			self::$smarty->assign('nextMatch', $nextMatch[0]);
		$now = date('Y-m-d H:i:s');
		self::$smarty->assign('now', $now);
		
		if($cookie->logged)
		{
			self::$smarty->assign('cookie', $cookie);
		}
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('index.tpl');
	}
}
