<?php
class DynamicResultController extends FrontController
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $smarty, $cookie;	
		if ($tour_id = (int)Tools::getValue('id'))
		{
			$user = new User($cookie->user_id);
			$tournament = new Tournament($tour_id);
			$match = new Matches($tournament->match_id);
			$score = new RunCalculator();
			$score->type = $match->type;
			$livescore = new LiveScore();
			$playerresult = $tournament->getJoinPlayers();
			$team = new Teams($match->won_team_id);
			$winCoach = $team->getCoach($match->type);
			foreach($playerresult as $key => $users)
			{
				$userPlayers = $user->getUserTeam($tour_id, $users['user_id']);
				$myTournament = $tournament->getMyTournament($users['user_id']);
				$playerresult[$key]['run'] = 0;
				foreach($userPlayers as $key1 => $player)
				{
					$player['consfour'] = $livescore->getConsFour($match->id, $player['id']);
					$player['conssix'] = $livescore->getConsSix($match->id, $player['id']);
					$run = $score->calculate($player);
					if($player['id'] == $myTournament['captain'])
					{
						$run['batting'] = $run['batting'] * 2;
						$run['battingbonus'] = $run['battingbonus'] * 2;
						$run['bowling'] = $run['bowling'] * 2;
						$run['fielding'] = $run['fielding'] * 2;
					}
					$playerresult[$key]['run'] += $run['batting']+$run['battingbonus']+$run['bowling']+$run['fielding'];
				}
				if($winCoach['coach_id'] == $myTournament['coach'] && $match->won_team_id != 0)
					$playerresult[$key]['run'] += 20;
			}
			usort($playerresult, array('DynamicResultController','compareOrder'));
			self::$smarty->assign('playerresult', $playerresult);
			self::$smarty->assign('tournament', $tournament);
			self::$smarty->assign('user', $user);
		}
	}
	
	private function compareOrder($a, $b)
	{
	  return $b['run'] - $a['run'];
	}
	
	public function displayHeader()
	{}
	
	public function displayFooter()
	{}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('dynamicresult.tpl');
	}
}
