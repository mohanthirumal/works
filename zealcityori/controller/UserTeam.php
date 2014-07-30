<?php
class UserTeam extends FrontController
{
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		//parent::preProcess();
		if($user_id = (int)Tools::getValue('user_id'))
		{
			$tour_id = (int)Tools::getValue('tour_id');
			$type = (int)Tools::getValue('type');
			$mid = (int)Tools::getValue('mid');
			$user = new User($user_id);
			if($type == 1 || $type == 3)
			{
				$tournament = new Tournament($tour_id);
				$match = new Matches($tournament->match_id);
				$players = $user->getUserTeam($tour_id, $user->id);
				$myTournament = $tournament->getMyTournament($user->id);
			}
			else
			{
				$tournament = new PTournament($tour_id);
				$match = new Matches($mid);
				$players = $tournament->getUserTeam($tour_id, $match->id, $user->id);
				$myTournament = $tournament->getMyTournament($user->id, $match->id);
			}
			$score = new RunCalculator();
			$score->type = $match->type;
			
			$coach = $user->getCoach($myTournament['coach']);
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
				'user' => $user,
				'players' => $players,
				'tournament' => $tournament,
				'match' => $match,
				'coach' => $coach
			));	
			$team = new Teams($match->won_team_id);
			$winCoach = $team->getCoach($match->type);
			if($winCoach['coach_id'] == $myTournament['coach'])
				self::$smarty->assign('coach_run', 20);
			self::$smarty->assign('imageurl1', FLAG_URL);
		}		
	}
	
	public function displayHeader()
	{}
	
	public function displayFooter()
	{}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('user-team.tpl');
	}
}
