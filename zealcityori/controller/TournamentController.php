<?php
class TournamentController extends FrontController
{
	protected $title = 'Tournaments - Create tournaments, Cash tournaments, free roll tournaments for fantasy cricket';
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		parent::preProcess();
		if (Tools::isSubmit('success'))
			$this->errors[] = 'Tournament updated successfully';
	}
	
	public function setMedia()
	{
		parent::setMedia();
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
		$joinedTour['daily'] = '';
		$joinedTour['period'] = '';
		
		//Get Logged in user tournaments
		if($cookie->logged)
		{
			//Get Logged User tournaments
			$allUserTournaments = $tournament->getAllUserTournament();
			$listTour = array();
			$count = 0;
			foreach($allUserTournaments as $key => $allTournament)
			{
				$prizes = explode(',', $allTournament['prize']);
				$tourPrize = array_sum($prizes);
				$listTour[$allTournament['match_date']][$allTournament['prize']]['flag1'] = $allTournament['team1flag'];
				$listTour[$allTournament['match_date']][$allTournament['prize']]['flag2'] = $allTournament['team2flag'];
				$listTour[$allTournament['match_date']][$allTournament['prize']]['prize'] = $tourPrize;
				$listTour[$allTournament['match_date']][$allTournament['prize']]['entryfee'] = $allTournament['amount'];
				$listTour[$allTournament['match_date']][$allTournament['prize']]['type'] = $allTournament['prize'];
				$listTour[$allTournament['match_date']][$allTournament['prize']]['tour'][$count] = $allTournament;
				if(isset($prizes[1]))
					$listTour[$allTournament['match_date']][$allTournament['prize']]['prizetype'] = 'Prize Pool';
				else
					$listTour[$allTournament['match_date']][$allTournament['prize']]['prizetype'] = 'Win';
				$count++;
			}
			self::$smarty->assign('usertournaments', $listTour);
			
			//Get Logged User Weekly tournaments
			$weeklyUserTournaments = $ptournament->getUserWeeklyTournament();
			$weeklyTournaments = $ptournament->getWeeklyTournament();
			$listPeriodTour = array();
			$count = 0;
			foreach($weeklyUserTournaments as $key => $allTournament)
			{
				$prizes = explode(',', $allTournament['prize']);
				$tourPrize = array_sum($prizes);
				$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['prize'] = $tourPrize;
				$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['entryfee'] = $allTournament['amount'];
				$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['type'] = $allTournament['tournament_type_id'];
				$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['tour'][$count] = $allTournament;
				if(isset($prizes[1]))
					$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['prizetype'] = 'Prize Pool';
				else
					$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['prizetype'] = 'Win';
				$count++;
			}
			self::$smarty->assign('userweeklytournaments', $listPeriodTour);
			
		}
		//Get all daily tournaments
		$allTournaments = $tournament->getAllTournament();
		$listTour = array();
		$count = 5;
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
		self::$smarty->assign('tournaments', $listTour);
		
		//Get all weekly tournaments
		$weeklyTournaments = $ptournament->getWeeklyTournament();
		$listPeriodTour = array();
		$count = 0;
		foreach($weeklyTournaments as $key => $allTournament)
		{
			$prizes = explode(',', $allTournament['prize']);
			$tourPrize = array_sum($prizes);
			$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['prize'] = $tourPrize;
			$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['entryfee'] = $allTournament['amount'];
			$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['type'] = $allTournament['tournament_type_id'];
			$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['tour'][$count] = $allTournament;
			if(isset($prizes[1]))
				$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['prizetype'] = 'Prize Pool';
			else
				$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['prizetype'] = 'Win';
			$count++;
	
			if(isset($allTournament['tournament_id']))
				$joinedTour['period'] .= $allTournament['id'].',';
		}
		self::$smarty->assign('weeklyTournaments', $listPeriodTour);
		$_SESSION['joinedtour'] = $joinedTour;
		self::$smarty->assign('tourimageurl', FLAG_URL);
		self::$smarty->assign('nextMatch', $nextMatch[0]);
		$now = date('Y-m-d H:i:s');		
		self::$smarty->assign('now', $now);
		if($cookie->logged)
		{
			$allMyTournaments = $tournament->getOverAllMyTournaments(15, 0);
			foreach($allMyTournaments as $key => $allTournament)
			{
				$prizes = explode(',', $allTournament['prize']);
				$allMyTournaments[$key]['prize'] = array_sum($prizes);
			}
			self::$smarty->assign('mytournaments', $allMyTournaments);
			self::$smarty->assign('cookie', $cookie);
		}
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('tournament.tpl');
	}
}
