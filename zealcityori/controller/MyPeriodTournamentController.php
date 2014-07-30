<?php
class MyPeriodTournamentController extends FrontController
{
	protected $title = 'My Tournament';
	protected $tournament;
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		parent::preProcess();
		if (Tools::isSubmit('myteam'))
		{
			$this->updateTournament();
		}	
		if ($tour_id = (int)Tools::getValue('id'))
		{
			$this->tournament = new Tournament($tour_id);
			$user = new User($cookie->user_id);
			$match = new Matches($this->tournament->match_id);
			$team1 = new Teams($match->team1);
			$team2 = new Teams($match->team2);
			$team1Players = $team1->getSquardPlayers($match->type);
			$team2Players = $team2->getSquardPlayers($match->type);
			$coach = array();
			$coach[0] = $team1->getCoach($match->type);
			$coach[0]['team'] = $team1->team_nickname;
			$coach[1] = $team2->getCoach($match->type);
			$coach[1]['team'] = $team2->team_nickname;
			$myTournament = $this->tournament->getMyTournament($user->id);
			if($this->tournament->checkJoinStatus($user->id) == 0)
			{
				$this->errors[] = 'You are not allowed to view this tournament';
				return false;
			}
			else if($myTournament['no_of_changes'] > 0)
			{
				$myTeamPlayersId = $this->tournament->getSelectedPlayers($myTournament['id']);
				$myTeamPlayersId = explode(',', $myTeamPlayersId['player_ids']);
				self::$smarty->assign('myTeamPlayersId', $myTeamPlayersId);
				self::$smarty->assign('myTournament', $myTournament);
			}
			self::$smarty->assign('tourimageurl', FLAG_URL);
			self::$smarty->assign(array(
				'tournament'=>$this->tournament,
				'tour_id'=> $tour_id,
				'team1' => $team1,
				'team2' => $team2,
				'team1players' => $team1Players,
				'team2players' => $team2Players,
				'match' => $match,
				'coaches' => $coach
			));
		}		
	}
	
	public function updateTournament()
	{
		global $cookie;
		$tour_id = (int)Tools::getValue('tour_id');
		$user = new User($cookie->user_id);
		$this->tournament = new Tournament($tour_id);
		if($this->tournament->checkJoinStatus($user->id) == 0)
			$this->errors[] = 'You are not allowed to update this tournament';
		$myTournament = $this->tournament->getMyTournament($user->id);
		if($this->tournament->no_of_changes <= $myTournament['no_of_changes'])
			$this->errors[] = 'You are not allowed to update this tournament';
		$teamName = Tools::getValue('txtteamname');
		$players = array();
		if($playersList = Tools::getValue('players'))
			$players = $playersList;
		if(count($players) > 11)
			$this->errors[] = 'Player exist the limit';
		if(count($players) < 11)
			$this->errors[] = 'You must select 11 players';
		$now = strtotime(date('Y-m-d H:i:s'));
		if($now > strtotime($this->tournament->endtime))
			$this->errors[] = 'Tournament Expired';
		if($this->tournament->checkBudjet($players) > $this->tournament->salary_cap)
			$this->errors[] = 'Budjet Exceeds';
		$captain = (int)Tools::getValue('ddcaptain');
		$coach = (int)Tools::getValue('coach');
		if (count($this->errors) > 0)
			return false;
		if($this->tournament->updateMyTournament($teamName, $players, $captain, $coach))
				Tools::redirect(__BASE_URI__.'tournament?success');
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('my-period-tournament.tpl');
	}
}
