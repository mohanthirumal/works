<?php
class MyTeamController extends FrontController
{
	protected $title = 'My Team';
	public $auth = false;
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		parent::preProcess();
		if ($tour_id = (int)Tools::getValue('id'))
		{
			$type = (int)Tools::getValue('type');
			$user = new User($cookie->user_id);
			if($type == 1 || $type == 3)
			{
				$tournament = new Tournament($tour_id);
				$match = new Matches($tournament->match_id);
				$players = $user->getMyTeamPlayers($tour_id);
				$now = strtotime(date('Y-m-d H:i:s'));
				if(count($players) == 0 && $now < strtotime($tournament->endtime))
					Tools::redirect(__BASE_URI__.'my-tournament/'.$type.'-type/'.$tour_id.'/'.$match->id);
				$score = new RunCalculator();
				$score->type = $match->type;
				$winner = $tournament->getTourWinners();
				//$leader = $tournament->getLeader($tour_id);		
				$playerresult = $tournament->getJoinPlayers();
				$myTournament = $tournament->getMyTournament($user->id);
				
				//$coach = $user->getCoach($myTournament['coach']);
				$coach = new Coach($myTournament['coach']);
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
					$players = $user->getMyTeam($tour_id);
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
			}
			else
			{
				$tournament = new PTournament($tour_id);
				$matchId = (int)Tools::getValue('mid');
				$match = new Matches($matchId);
				$players = $tournament->getMyTourPlayers($match->id);
				if(count($players) == 0 && $tournament->status == 'Open')
					Tools::redirect(__BASE_URI__.'my-tournament/'.$type.'-type/'.$tour_id.'/'.$match->id);
				$score = new RunCalculator();
				$score->type = $match->type;
				$winner = $tournament->getTourWinners($matchId);
				$playerresult = $tournament->getJoinPlayers($matchId);
				$myTournament = $tournament->getMyTournament($user->id, $matchId);
				$coach = new Coach($myTournament['coach']);
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
					$players = $tournament->getMyTeam($tour_id, $match->id);
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
			}
			$now = strtotime(date('Y-m-d H:i:s'));
			if($myTournament['no_of_changes'] < $tournament->no_of_changes && $now < strtotime($tournament->endtime))
				self::$smarty->assign('enableedit', 1);
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
		}
	}
	
	public function process()
	{
		global $cookie;
		
	}
		
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('my-team.tpl');
	}
}
