<?php
class TournamentInvitesController extends FrontController
{
	protected $title = 'Tournament Invites';
	public $auth = false;
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		parent::preProcess();
		if($cookie->logged)
		{
			$tournament = new Tournament();
			$ptournament = new PTournament();
			$weeklyUserTournaments = $ptournament->getUserWeeklyTournament();
			foreach($weeklyUserTournaments as $key => $allTournament)
			{
				$prizes = explode(',', $allTournament['prize']);
				$weeklyUserTournaments[$key]['prize'] = array_sum($prizes);
			}
			$allUserTournaments = $tournament->getAllUserTournament();
			foreach($allUserTournaments as $key => $allTournament)
			{
				$prizes = explode(',', $allTournament['prize']);
				$allUserTournaments[$key]['prize'] = array_sum($prizes);
			}
			self::$smarty->assign('weeklyTournaments', $weeklyUserTournaments);
			self::$smarty->assign('allUserTournaments', $allUserTournaments);
			self::$smarty->assign('userid', $cookie->user_id);
		}
	}
	
	public function process()
	{
		global $cookie;
		parent::process();
		$user = new User($cookie->user_id);	
		
	}

	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('tournament-invites.tpl');
	}
	
	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS('css/create-tournament.css', 'all');
		Tools::addJS(array(__BASE_URI__.'js/tournament.js'));
	}
}
