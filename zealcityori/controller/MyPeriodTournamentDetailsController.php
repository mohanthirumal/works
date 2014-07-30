<?php
class MyPeriodTournamentDetailsController extends FrontController
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
		if(!$cookie->isLogged())
			Tools::redirect(__BASE_URI__);
		parent::preProcess();
		global $cookie;
		$user = new User($cookie->user_id);	
		$id = (int)Tools::getValue('id');
		$type = (int)Tools::getValue('type');
		if($id == 0 || $type == 0)
			Tools::redirect(__BASE_URI__.'404.php');
		if (Tools::isSubmit('myteam'))
		{
			$this->updateTournament();
		}	
		if ($tour_id = (int)Tools::getValue('id'))
		{
			global $cookie;
			$user = new User($cookie->user_id);	
			$id = (int)Tools::getValue('id');
			$type = (int)Tools::getValue('type');
			if($id == 0 || $type == 0)
				Tools::redirect(__BASE_URI__.'404.php');
			if($type == 3)
			{
				$tournament = new Tournament($id);
				$match = new Matches($tournament->match_id);
				$players = $user->getMyTeamPlayers($tournament->id);
				$now = strtotime(date('Y-m-d H:i:s'));
				$score = new RunCalculator();
				$score->type = $match->type;
				$winner = $tournament->getTourWinners();
				$myTournament = $tournament->getMyTournament($user->id);
				$coach = new Coach($myTournament['coach']);
				$invites = $tournament->getInvitedList();
				$emailinvites = $tournament->getEmailInvitedList();
				self::$smarty->assign('invites', $invites);
				self::$smarty->assign('emailinvites', $emailinvites);
				$playerresult = array();
				$playerresult = $tournament->getJoinPlayers();
				$file = 'json/match'.$match->id.'.json';
				if(file_exists($file))
				{
					$json = file_get_contents($file);
					$matchPlayers = json_decode($json, true);
					foreach($players as $key => $player)
					{
						if(isset($matchPlayers[$player['id']]))
							$players[$key] = $matchPlayers[$player['id']];
						if($player['id'] == $myTournament['captain'])
						{
							if(isset($matchPlayers[$player['id']]))
							{
								$players[$key]['coc']['batting'] = $matchPlayers[$player['id']]['coc']['batting'] * 2;
								$players[$key]['coc']['battingbonus'] = $matchPlayers[$player['id']]['coc']['battingbonus'] * 2;
								$players[$key]['coc']['bowling'] = $matchPlayers[$player['id']]['coc']['bowling'] * 2;
								$players[$key]['coc']['fielding'] = $matchPlayers[$player['id']]['coc']['fielding'] * 2;
								$players[$key]['captain'] = 1;
							}
							else
								$players[$key]['captain'] = 1;
						}
					}
				}
				else
				{
					$livescore = new LiveScore();
					$players = $user->getMyTeam($id);
					foreach($players as $key => $player)
					{
						$players[$key]['consfour'] = $livescore->getConsFour($match->id, $player['id']);
						$players[$key]['conssix'] = $livescore->getConsSix($match->id, $player['id']);
					}
					foreach($players as $key => $player)
					{
						$players[$key]['coc'] = $score->calculate($player);
						if($player['id'] == $myTournament['captain'])
						{
							$players[$key]['coc']['batting'] = $players[$key]['coc']['batting'] * 2;
							$players[$key]['coc']['battingbonus'] = $players[$key]['coc']['battingbonus'] * 2;
							$players[$key]['coc']['bowling'] = $players[$key]['coc']['bowling'] * 2;
							$players[$key]['coc']['fielding'] = $players[$key]['coc']['fielding'] * 2;
							$players[$key]['captain'] = 1;
						}	
					}
				}
				self::$smarty->assign(array(
					'players' => $players,
					'tournament' => $tournament,
					'match' => $match,
					'winners' => $winner,
					'playerresult' => $playerresult,
					'myTournament' => $myTournament,
					'coach' => $coach->coach_name
				));
				$team = new Teams($match->won_team_id);
				$winCoach = $team->getCoach($match->type);
				if($winCoach['coach_id'] == $myTournament['coach'])
					self::$smarty->assign('coach_run', 20);
				self::$smarty->assign('imageurl1', FLAG_URL);
				self::$smarty->assign('matchescount', '1 Match');
				if($myTournament['no_of_changes'] < $tournament->no_of_changes && $now < strtotime($tournament->endtime))
					self::$smarty->assign('enableedit', 1);
			}
			else
			{
				$tournament = new PTournament($id);
				$matches = $tournament->getMatches();
				$joinmatches = $tournament->getMyTourJoinedMatches($user->id);
				foreach($matches as $key => $match)
					if(in_array($match['id'], $joinmatches))
						$matches[$key]['joined'] = 1;
				$results = $tournament->getResults();
				self::$smarty->assign('results', $results);
				self::$smarty->assign('matches', $matches);
				self::$smarty->assign('matchescount', count($matches).' Matches');
				
			}
			if(!$tournament->id)
				Tools::redirect(__BASE_URI__.'404.php');
			$invites = $tournament->getInvitedList();
			$emailinvites = $tournament->getEmailInvitedList();
			self::$smarty->assign('invites', $invites);
			self::$smarty->assign('emailinvites', $emailinvites);
			self::$smarty->assign('tournament', $tournament);
			self::$smarty->assign('user', $user);
			if($new = (int)Tools::getValue('join'))
				self::$smarty->assign('new', $new);
			$now = strtotime(date('Y-m-d H:i:s'));
			self::$smarty->assign('now', $now);	
		}
	}
	
	public function process()
	{
		parent::process();
		
	}
	
	public function updateTournament()
	{
		global $cookie;
		
	}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('my-period-tournament-details.tpl');
	}
	
	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS(__BASE_URI__.'css/tournament-details.css', 'all');
		Tools::addJS(array(__BASE_URI__.'js/tournament.js'));
	}
}
