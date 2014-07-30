<?php
class CreateTournamentController extends FrontController
{
	protected $title = 'Create Tournament';
	public $auth = true;
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		parent::preProcess();
		global $cookie;
		if(Tools::getValue('action') == 'createteam')
		{
			$user = new User($cookie->user_id);
			$tournamentName = Tools::getValue('tournamentName');
			$players = Tools::getValue('players');
			$tournament_date = Tools::getValue('datetime');
			$entryfee = Tools::getValue('entryfee1');
			$prize = Tools::getValue('prize');
			$type = Tools::getValue('type');
			$entryFee = new EntryFee($entryfee);
			$player = new Players($players);
			$type = Tools::getValue('type');
			$privatetour = Tools::getValue('privatetour', 1);
			if($user->cash < $entryFee->amount)
			{
				$this->errors[] = 'Insufficient Cash';
				return false;
			}
			if($type == 3)
			{
				$match = Tools::getValue('match');
				$tournament = new Tournament();
				$endtime = $tournament->getTourStartTime($match);
				$tournament->name = $tournamentName;
				$tournament->user_id = $user->id;
				$tournament->player_id = $player->id;
				$tournament->match_id = $match;
				$tournament->entry_fee_id = $entryfee;
				$tournament->tournament_type_id = $type;
				$tournament->endtime = date('Y-m-d H:i:s', strtotime('-45 minutes', $endtime));
				$tournament->kitty_id = 3;
				$tournament->no_of_changes = 10;
				$tournament->prize_id = $player->prize_id;
				$tournament->rule_id = 1;
				$tournament->salary_cap = 100000;
				$tournament->recreate = 0;
				$tournament->status = 'Open';
				$tournament->private = $privatetour;
				$tournament->add();
				$tournament = new Tournament($tournament->id);
			}
			else if($type == 8)
			{
				$series = Tools::getValue('series');
				$tournament = new PTournament();
				$endtime = $tournament->getTourStartTime($series);
				$endDate = date('Y-m-d',$tournament->getSeriesEndDate($series));
				$tournament->name = $tournamentName;
				$tournament->user_id = $cookie->user_id;
				$tournament->series_id = $series;
				$tournament->player_id = $player->id;
				$tournament->entry_fee_id = $entryfee;
				$tournament->tournament_type_id = $type;
				$tournament->endtime = date('Y-m-d H:i:s', strtotime('-45 minutes', $endtime));
				$tournament->kitty_id = 1;
				$tournament->no_of_changes = 10;
				$tournament->prize_id = $player->prize_id;
				$tournament->rule_id = 1;
				$tournament->salary_cap = 100000;
				$tournament->recreate = 0;
				$tournament->status = 1;
				$tournament->start_date = date('Y-m-d');
				$tournament->end_date = $endDate;
				$tournament->private = $privatetour;
				$tournament->add();
				$tournament = new PTournament($tournament->id);
			}
			else if($type == 7)
			{
				$series = Tools::getValue('series');
				$weekly = Tools::getValue('weekly');
				$week = Tools::getWeeksDate($weekly);
				$weekDate = explode('-', $week);
				$startDate = date('Y-m-d', strtotime($weekDate[0]));
				$endDate = date('Y-m-d', strtotime($weekDate[1]));
				$tournament = new PTournament();
				$endtime = $tournament->getWeekStartTime($startDate);
				$tournament->name = $tournamentName;
				$tournament->user_id = $cookie->user_id;
				$tournament->series_id = 0;
				$tournament->player_id = $player->id;
				$tournament->entry_fee_id = $entryfee;
				$tournament->tournament_type_id = $type;
				$tournament->endtime = date('Y-m-d H:i:s', strtotime('-45 minutes', $endtime));
				$tournament->kitty_id = 1;
				$tournament->no_of_changes = 10;
				$tournament->prize_id = $player->prize_id;
				$tournament->rule_id = 1;
				$tournament->salary_cap = 100000;
				$tournament->recreate = 0;
				$tournament->status = 1;
				$tournament->start_date = $startDate;
				$tournament->end_date = $endDate;
				$tournament->private = $privatetour;
				$tournament->add();
				$tournament = new PTournament($tournament->id);
			}
			
					
			
			//$tournament->updateInvites($invites);
			//$description = $user->username.' has invited you to join his tournament';
			//$tournament->updateInviteNotifications($invites, $user->id, $description, $tournament->endtime);
			
			if($tournament->joinTournament($user->id, $tournament->id))
				if($user->addTransHistory($tournament->entry_fee, 'Joined tournament :'.$tournament->name))
					if($user->reduceCash($tournament->entry_fee))
						header('Location: my-period-tournament-details/'.$tournament->tournament_type_id.'-type/'.$tournament->id.'/?join=1');
		}
	}
	
	public function process()
	{
		parent::process();
		global $cookie;
		$user = new User($cookie->user_id);	
		if(Tools::getValue('action') == 'getmatchdate')
		{
			$match_id = (int)Tools::getValue('match_id');
			$match = new Matches($match_id);
			$date = strtotime('-30 minute', $match->match_date);
			$dateJava = date('Y/m/d H:i:s', $date);
			$datePHP = date('Y-m-d H:i:s', $date);
			die(Tools::jsonEncode(array('hasErrors' => false, 'date' => array($dateJava, $datePHP))));
		}
		$matches = new Matches();
		$cash = $user->cash;
		$players = new Players();
		$entryfee = new EntryFee();
		$user = new User($cookie->user_id);
		$prizes = PrizePool::getUserPrizePoolList();
		$series = $matches->getSeries();
		$matches = $matches->getApprovedMatches();
		$players = $players->getPlayers();
		$entryfee = $entryfee->getEntryFee();
		$timestamp = strtotime('now');
		$weeks = Tools::getWeeks(4);
		self::$smarty->assign('user', $user);
		self::$smarty->assign('weeks', $weeks);
		self::$smarty->assign('series', $series);
		self::$smarty->assign('matches', $matches);
		self::$smarty->assign('players', $players);
		self::$smarty->assign('entryfee', $entryfee);
		self::$smarty->assign('cash1', $cash);
		self::$smarty->assign('prizes', $prizes);
	}

	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('create-tournament.tpl');
	}
	
	public function setMedia()
	{
		parent::setMedia();
		Tools::addCSS('css/create-tournament.css', 'all');
		Tools::addJS(array(__BASE_URI__.'js/tournament.js'));
		Tools::addJS(array(__BASE_URI__.'js/validate.js'));
	}
}
