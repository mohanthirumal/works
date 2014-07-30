<?php
class DynamicTournamentController extends FrontController
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		$file = 'json/tournaments/tournaments.json';
		if(file_exists($file))
		{
			$joinedTour = $_SESSION['joinedtour'];
			$dailyJoined = explode(',', substr($joinedTour['daily'], 0, -1));
			$periodJoined = explode(',', substr($joinedTour['period'], 0, -1));
			$json = file_get_contents($file);
			$tournaments = json_decode($json, true);
//			foreach($tournaments['daily'] as $key => $allTournament)
//				if(in_array($allTournament['id'], $dailyJoined))
//					$tournaments['daily'][$key]['tournament_id'] = $allTournament['id'];
			self::$smarty->assign('tournaments', $tournaments['daily']);
			self::$smarty->assign('weeklyTournaments', $tournaments['period']);
			self::$smarty->assign('dailyJoined', $dailyJoined);
			self::$smarty->assign('periodJoined', $periodJoined);
			self::$smarty->assign('tourimageurl', FLAG_URL);
		}
	}
		
	public function displayHeader()
	{}
	
	public function displayFooter()
	{}
	
	public function displayContent()
	{
		parent::displayContent();
		$display = self::$smarty->display('dynamictournament.tpl');
	}
}
