<?php
class JoinTournament extends FrontController
{
	public function __construct()
	{	
		parent::__construct();
	}
	
	public function preProcess()
	{
		global $cookie;
		//parent::preProcess();
		if(Tools::getValue('action') == 'join')
		{
			$tour_id = (int)Tools::getValue('tour_id');
			$tournament = new Tournament($tour_id);
			$user = new User($cookie->user_id);
			if($tournament->checkJoinStatus($user->id) > 0)
				$this->errors[] = 'You have already joined this tournament';
			if($user->cash < $tournament->entry_fee)
				die(Tools::jsonEncode(array('hasErrors' => true, 'errors' => 'cash')));
				//$this->errors[] = 'You dont have sufficient cash';
			if($tournament->joinPlayers >= $tournament->players)
				$this->errors[] = 'Player limit exceeds';
			$now = strtotime(date('Y-m-d H:i:s'));
			if($now > strtotime($tournament->endtime))
				$this->errors[] = 'Tournament Expired';
			if (count($this->errors))
				die(Tools::jsonEncode(array('hasErrors' => true, 'errors' => $this->errors)));
			else
				if($tournament->joinTournament($user->id, $tournament->id))
					if($user->reduceCash($tournament->entry_fee))
					{
						$bonus = new Bonus();
						$bonusCash = ((3/100) * $tournament->entry_fee);
						$bonus->updateBonus($bonusCash);
						$user->addZealCoin($tournament->participent_coin);
						if(($tournament->joinPlayers == ($tournament->players - 1)))
						{
							if($tournament->recreate == 1)
								$tournament->duplicateTournament();
							$tournament->updateStatus('Closed');
						}
						die(Tools::jsonEncode(array('hasErrors' => false, 'id' => $tournament->id)));
					}
		}
		else if ($tour_id = (int)Tools::getValue('tour_id'))
		{
			$tournament = new Tournament($tour_id);
			$match = new Matches($tournament->match_id);
			self::$smarty->assign('imageurl', FLAG_URL.'teamsflags/');
			$now = date('Y-m-d H:i:s');
			self::$smarty->assign(array(
				'tournament' => $tournament,
				'match' => $match
			));
			$players = $tournament->getJoinPlayers();
			self::$smarty->assign(array(
				'players' => $players,
				'now' => $now
			));			
		}
	}
	
	public function displayHeader()
	{}
	
	public function displayFooter()
	{}
	
	public function displayContent()
	{
		parent::displayContent();
		self::$smarty->display('join-tournament.tpl');
	}
}
