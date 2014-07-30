<?php
class JoinTournament extends FrontController
{
	private $content;
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
			$type = (int)Tools::getValue('type');
			if($type == 1 || $type == 3)
				$tournament = new Tournament($tour_id);
			else
				$tournament = new PTournament($tour_id);
			$user = new User($cookie->user_id);
			if(BlockUser::checkBlockedUsers())
				$this->errors[] = 'Sorry, your IP has been blocked from joining the tournament';
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
					if($tournament->entry_fee == 0)
						die(Tools::jsonEncode(array('hasErrors' => false, 'id' => $tournament->id, 'type' => $type)));
					if($user->addTransHistory($tournament->entry_fee, 'Joined tournament :'.$tournament->name))
						if($user->reduceCash($tournament->entry_fee))
						{
							$user->updateLevelEntry($tournament->entry_fee);
							if($type == 3 || $type == 7 || $type == 8)
								$tournament->acceptInvite();
							$bonus = new Bonus();
							$bonusCash = ((3/100) * $tournament->entry_fee);
							$bonus->updateBonus($bonusCash);
							if(($tournament->joinPlayers == ($tournament->players - 1)))
							{
								if($tournament->recreate == 1)
									$tournament->duplicateTournament();
								$tournament->updateStatus('Closed');
							}
							die(Tools::jsonEncode(array('hasErrors' => false, 'id' => $tournament->id, 'type' => $type)));
						}
		}
		else if ($tour_id = (int)Tools::getValue('tour_id'))
		{
			$type = (int)Tools::getValue('type');
			if($type == 5  || $type == 6 || $type == 7 || $type == 8)
			{
				$tournament = new PTournament($tour_id);
				$match = $tournament->getMatches();
				$players = $tournament->getPtJoinPlayers();
			}
			else
			{
				$tournament = new Tournament($tour_id);
				$match = new Matches($tournament->match_id);
				$players = $tournament->getJoinPlayers();
			}

		//	$tournament = new Tournament($tour_id);
			
			self::$smarty->assign('imageurl', FLAG_URL.'teamsflags/');
			$now = date('Y-m-d H:i:s');
			self::$smarty->assign(array(
				'tournament' => $tournament,
				'match' => $match
			));
			
			self::$smarty->assign(array(
				'players' => $players,
				'now' => $now
			));			
		}
		else if($share = (int)Tools::getValue('share'))
		{
			$this->content = $share;
			self::$smarty->assign('contenttype', $this->content);
		}
	}
	
	public function displayHeader()
	{}
	
	public function displayFooter()
	{}
	
	public function displayContent()
	{
		parent::displayContent();
		if($this->content == 1 || $this->content == 2)
			self::$smarty->display('join-like-tournament.tpl');
		else
			self::$smarty->display('join-tournament.tpl');
	}
}
