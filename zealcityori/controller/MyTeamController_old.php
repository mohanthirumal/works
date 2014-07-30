<?php
class MyTeamController extends FrontController
{
	protected $title = 'My Team';
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		parent::preProcess();		
	}
	
	public function process()
	{
		global $cookie;
		if ($tour_id = (int)Tools::getValue('id'))
		{
			$user = new User($cookie->user_id);
			$tournament = new Tournament($tour_id);
			$match = new Matches($tournament->match_id);			
			$players = $user->getMyTeam($tour_id);
			$score = new RunCalculator();
			$score->type = $match->type;
			$winner = $tournament->getTourWinners();
			$playerresult = $tournament->getJoinPlayers();
			$myTournament = $tournament->getMyTournament($user->id);
			$coach = $user->getCoach($myTournament['coach']);
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
			
			self::$smarty->assign(array(
				'players' => $players,
				'tournament' => $tournament,
				'match' => $match,
				'winners' => $winner,
				'playerresult' => $playerresult,
				'myTournament' => $myTournament,
				'coach' => $coach
			));
			$team = new Teams($match->won_team_id);
			$winCoach = $team->getCoach($match->type);
			if($winCoach['coach_id'] == $myTournament['coach'])
				self::$smarty->assign('coach_run', 20);
			self::$smarty->assign('imageurl', FLAG_URL);
		}
	}
		
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('my-team.tpl');
	}
}
