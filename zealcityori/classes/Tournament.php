<?php
class Tournament extends ObjectModel
{
	public $id;
	public $name;
	public $user_id;
	public $creator;
	public $match_id;
	public $entry_fee_id;
	public $entry_fee;
	public $tournament_type_id;
	public $player_id;
	public $players;
	public $endtime;
	public $kitty_id;
	public $kitty;
	public $no_of_changes;
	public $prize_id;
	public $prize_pool;
	public $rule_id;
	public $salary_cap;
	public $recreate;
	public $private;
	public $status;
	public $status_name;
	public $winner_coin;
	public $participent_coin;
	public $joinPlayers;
	protected 	$table = 'coc_tournament';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
		if($id)
		{
			$players = new Players($this->player_id);
			$this->creator = new User($this->user_id);
			$this->players = $players->player;
			$kitty = new Kitty($this->kitty_id);
			$this->kitty = $kitty->percentage;
			$entry_fee = new EntryFee($this->entry_fee_id);
			$this->entry_fee = $entry_fee->amount;
			$this->winner_coin = $entry_fee->winner_coin;
			$this->participent_coin = $entry_fee->participent_coin;
			//$this->prize_pool = new PrizePool($this->prize_id, $this->players, $this->entry_fee, $this->kitty);
			$this->prize_pool = $this->getPrizes();
			$this->updateJoinPlayers();
			$this->tournament_type = new TournamentType($this->tournament_type_id);
			$this->status_name = new Status($this->status);
		}
	}
	
	public function getFields()
	{
		if (isset($this->id))
			$fields['id'] = (int)($this->id);
		$fields['name'] = pSQL($this->name);
		$fields['user_id'] = pSQL($this->user_id);
		$fields['match_id'] = pSQL($this->match_id);
		$fields['entry_fee_id'] = pSQL($this->entry_fee_id);
		$fields['tournament_type_id'] = pSQL($this->tournament_type_id);
		$fields['player_id'] = pSQL($this->player_id);
		$fields['endtime'] = pSQL($this->endtime);
		$fields['kitty_id'] = pSQL($this->kitty_id);
		$fields['no_of_changes'] = pSQL($this->no_of_changes);
		$fields['prize_id'] = pSQL($this->prize_id);
		$fields['rule_id'] = pSQL($this->rule_id);
		$fields['salary_cap'] = pSQL($this->salary_cap);
		$fields['recreate'] = pSQL($this->recreate);
		$fields['private'] = pSQL($this->private);
		$fields['status'] = pSQL($this->status);
		return $fields;
	}
	
	public function add($autodate = true, $nullValues = true)
	{
	 	if (!parent::add($autodate, $nullValues))
			return false;
		$this->updateTournamentPrizes();
		return true;
	}
	
	public function updateTournamentPrizes()
	{
		$prizes = new PrizePool($this->prize_id, $this->player_id, $this->entry_fee_id, 20, true);
		$prize = implode(',', $prizes->prize);
		$sql = 'INSERT INTO coc_tournament_prize(tournament_id, prize) VALUES('.$this->id.', \''.$prize.'\')';
		return Db::getInstance()->Execute($sql);
	}
	
	public function getAllTournament($limit = NULL)
	{
		$now = date('Y-m-d H:i:s');
		global $cookie;
		$user_id = $cookie->user_id;
		$sql = "SELECT t.name, t.id, ifnull(jt.reg_player,0) AS reg_player, t1.team_nickname AS team1, t2.team_nickname AS team2,md.match_date, t.tournament_type_id, 
				t1.flag_url AS team1flag, t2.flag_url AS team2flag, md.type, t.endtime, p.player, ef.amount, t.status".(!empty($user_id)?", jt1.tournament_id":"").", 
				tt.nickname, tp.prize FROM coc_tournament t
				INNER JOIN coc_entry_fee ef ON ef.id = t.entry_fee_id
				INNER JOIN coc_kitty k ON k.id = t.kitty_id
				INNER JOIN coc_players p ON p.id = t.player_id
				INNER JOIN coc_prize_pool pp ON pp.id = t.prize_id
				INNER JOIN coc_tournament_type tt ON tt.id = t.tournament_type_id
				INNER JOIN match_details md ON md.id = t.match_id
				INNER JOIN team_details t1 ON t1.id = md.team1
				INNER JOIN team_details t2 ON t2.id = md.team2
				LEFT JOIN coc_tournament_prize tp ON tp.tournament_id = t.id
				LEFT JOIN (SELECT count(*) AS reg_player,tournament_id FROM coc_joined_tournament GROUP BY tournament_id) jt ON jt.tournament_id = t.id ";
		if(!empty($user_id))
			$sql .= "LEFT OUTER JOIN coc_joined_tournament jt1 ON jt1.tournament_id = t.id AND jt1.user_id = ".$user_id;
		$sql .= " WHERE (t.status = 'Open') AND t.endtime >= '".$now."' AND (tt.name = 'Daily tournament') ORDER BY t.status, endtime ASC, amount DESC";
		if($limit)
			$sql .=" LIMIT ".$limit;
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getAllUserTournament($limit = NULL)
	{
		$now = date('Y-m-d H:i:s');
		global $cookie;
		$user_id = $cookie->user_id;
		$user = new User($user_id);
		$sql = "SELECT t.name, t.id, ifnull(jt.reg_player,0) AS reg_player, t1.team_nickname AS team1, t2.team_nickname AS team2,md.match_date, t.tournament_type_id, 
				t1.flag_url AS team1flag, t2.flag_url AS team2flag, md.type, t.endtime, p.player, ef.amount, t.status".(!empty($user_id)?", jt1.tournament_id":"").", 
				tt.nickname, tp.prize, t.user_id FROM coc_tournament t
				INNER JOIN coc_entry_fee ef ON ef.id = t.entry_fee_id
				INNER JOIN coc_kitty k ON k.id = t.kitty_id
				INNER JOIN coc_players p ON p.id = t.player_id
				INNER JOIN coc_prize_pool pp ON pp.id = t.prize_id
				INNER JOIN coc_tournament_type tt ON tt.id = t.tournament_type_id
				INNER JOIN match_details md ON md.id = t.match_id
				INNER JOIN team_details t1 ON t1.id = md.team1
				INNER JOIN team_details t2 ON t2.id = md.team2
				LEFT JOIN coc_tournament_prize tp ON tp.tournament_id = t.id
				LEFT JOIN (SELECT count(*) AS reg_player,tournament_id FROM coc_joined_tournament GROUP BY tournament_id) jt ON jt.tournament_id = t.id ";
		if(!empty($user->connect['facebook']))
			$sql .= 'LEFT OUTER JOIN coc_tournament_invites ti ON ti.tournament_id = t.id AND ti.facebook_id = '.($user->connect['facebook']).' ';
		if(!empty($user_id))
			$sql .= 'LEFT OUTER JOIN coc_joined_tournament jt1 ON jt1.tournament_id = t.id AND jt1.user_id = '.$user_id.'
					 LEFT OUTER JOIN coc_tournament_email_invites pei ON pei.tournament_id = t.id AND pei.email = \''.$user->email.'\' ';
		$sql .= ' WHERE ';
		if(!empty($user_id) && !empty($user->connect['facebook']))
			$sql .= '(ti.facebook_id = '.($user->connect['facebook']).' OR t.user_id = '.$user->id.' OR pei.email = \''.$user->email.'\') AND ';
		else if(!empty($user_id))
			$sql .= '(t.user_id = 0 OR t.user_id = '.$user->id.' OR pei.email = \''.$user->email.'\') AND ';
		else
			$sql .= '(t.user_id = 0) AND ';
		$sql .= "(t.status = 'Open') AND t.endtime >= '".$now."' AND (tt.id = 3) ORDER BY endtime ASC,t.status";
		if($limit)
			$sql .=" LIMIT ".$limit;
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getAllMyTournament($limit = NULL)
	{
		global $cookie;
		$user_id = $cookie->user_id;
		$sql = 'SELECT t.name AS name, ifnull(jt1.reg_player,0) AS reg_player, t.id, t1.team_nickname AS team1, t2.team_nickname AS team2,md.match_date, 
				t1.flag_url AS team1flag, t2.flag_url AS team2flag, tp.prize, position, 
				t.tournament_type_id, md.type, t.endtime, p.player, ef.amount, t.status FROM coc_tournament t
				INNER JOIN coc_joined_tournament jt ON jt.tournament_id = t.id AND  jt.user_id = '.$user_id.' 
				INNER JOIN coc_entry_fee ef ON ef.id = t.entry_fee_id
				INNER JOIN coc_kitty k ON k.id = t.kitty_id
				INNER JOIN coc_players p ON p.id = t.player_id
				INNER JOIN coc_prize_pool pp ON pp.id = t.prize_id
				INNER JOIN match_details md ON md.id = t.match_id
				INNER JOIN team_details t1 ON t1.id = md.team1
				INNER JOIN team_details t2 ON t2.id = md.team2
				LEFT JOIN coc_tournament_prize tp ON tp.tournament_id = t.id
				LEFT JOIN (SELECT count(*) AS reg_player,tournament_id FROM coc_joined_tournament GROUP BY tournament_id) jt1 ON jt1.tournament_id = t.id
				LEFT JOIN coc_user_runs ptr ON ptr.tournament_id = t.id AND ptr.user_id = '.$user_id.'
				WHERE (t.tournament_type_id = 1 OR t.tournament_type_id = 3) ORDER BY t.endtime DESC';
		if($limit)
			$sql .=" LIMIT ".$limit;
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getOverAllMyTournaments($limit = NULL, $start = NULL, $uid = NULL)
	{
		global $cookie;
		if(!$uid)
			$uid = $cookie->user_id;
		$sql = 'SELECT t.id, t.name AS name, ifnull(jt1.reg_player,0) AS reg_player,
				t.tournament_type_id,t.endtime,p.player,ef.amount, t.status,tp.prize, position, jt.timestamp
				FROM coc_tournament t
				INNER JOIN coc_joined_tournament jt ON jt.tournament_id = t.id AND  jt.user_id = '.(int)$uid.'
				INNER JOIN coc_entry_fee ef ON ef.id = t.entry_fee_id
				INNER JOIN coc_kitty k ON k.id = t.kitty_id
				INNER JOIN coc_players p ON p.id = t.player_id
				INNER JOIN coc_prize_pool pp ON pp.id = t.prize_id
				INNER JOIN match_details md ON md.id = t.match_id
				INNER JOIN team_details t1 ON t1.id = md.team1
				INNER JOIN team_details t2 ON t2.id = md.team2
				LEFT JOIN coc_tournament_prize tp ON tp.tournament_id = t.id
				LEFT JOIN (SELECT count(*) AS reg_player,tournament_id FROM coc_joined_tournament GROUP BY tournament_id) jt1 ON jt1.tournament_id = t.id
				LEFT JOIN coc_user_runs ptr ON ptr.tournament_id = t.id AND ptr.user_id = '.(int)$uid.'
				WHERE (t.tournament_type_id = 1 OR t.tournament_type_id = 3)
				UNION ALL
				SELECT t.id, t.name,ifnull(jt1.reg_player,0) AS reg_player,t.tournament_type_id, t.endtime, p.player AS player, ef.amount, s.name AS status,
				tp.prize, rank AS position, jt.timestamp FROM coc_period_tournament t
				INNER JOIN coc_pt_joined jt ON jt.pt_id = t.id AND jt.user_id = '.(int)$uid.'
				INNER JOIN coc_status s ON s.id = t.`status`
				INNER JOIN coc_players p ON p.id = t.player_id
				INNER JOIN coc_entry_fee ef ON ef.id = t.entry_fee_id
				INNER JOIN coc_kitty k ON k.id = t.kitty_id
				INNER JOIN coc_prize_pool pp ON pp.id = t.prize_id
				INNER JOIN coc_tournament_type tt ON tt.id = t.tournament_type_id
				LEFT JOIN coc_pt_prize tp ON tp.pt_id = t.id
				LEFT JOIN coc_pt_leaderboard ptr ON ptr.pt_id = t.id AND ptr.user_id = '.(int)$uid.'
				LEFT JOIN (SELECT count(*) AS reg_player,pt_id FROM coc_pt_joined GROUP BY pt_id) jt1 ON jt1.pt_id = t.id WHERE
				(tt.id = 5 OR tt.id = 6 OR tt.id = 7 OR tt.id = 8) order by timestamp DESC';
		if($limit)
			$sql .=' LIMIT '.$start.','.$limit;
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function joinTournament($user_id, $tour_id)
	{
		return Db::getInstance()->Execute('INSERT INTO `coc_joined_tournament`
				(`user_id`, `tournament_id`) VALUES('.(int)$user_id.','.(int)$tour_id.')');
	}
	
	public function checkJoinStatus($user_id)
	{
		$sql = 'SELECT * FROM `coc_joined_tournament` WHERE `user_id` = '.(int)($user_id).' AND `tournament_id` = '.(int)($this->id);
		Db::getInstance()->ExecuteS($sql);
		return Db::getInstance()->NumRows();
	}
	
	public function updateMyTournament($teamName, $players, $captain, $coach)
	{
		global $cookie;
		Db::getInstance()->Execute('UPDATE `coc_joined_tournament` SET `teamname` = \''.pSQL($teamName).'\', 
				`captain` = \''.$captain.'\', `coach` = \''.$coach.'\', `no_of_changes` = `no_of_changes` + 1 
				WHERE `user_id` = '.(int)($cookie->user_id).' AND `tournament_id` = '.(int)($this->id).'');
		$this->updateMyteamPlayers($players);
		return Db::getInstance()->Affected_Rows();
	}
	
	private function updateMyteamPlayers($players)
	{	
		global $cookie;
		$result = $this->getMyTournament($cookie->user_id);
		$this->deleteExistPlayers($result['id']);
		$sql = 'INSERT INTO `coc_tournament_player`(`join_id`, `player_id`) VALUES';
		foreach($players as $player)
		{
			$sql .='('.(int)($result['id']).', '.(int)($player).'),';
		}
		$sql = substr($sql, 0, -1);
		Db::getInstance()->Execute($sql);
	}
	
	public function getSelectedPlayers($join_id)
	{
		$sql = 'SELECT GROUP_CONCAT(`player_id`) AS `player_ids` FROM `coc_tournament_player` WHERE `join_id` = '.(int)($join_id);
		return Db::getInstance()->getRow($sql);
	}
	
	private function deleteExistPlayers($join_id)
	{		
		$sql = 'DELETE FROM `coc_tournament_player` WHERE join_id = '.(int)($join_id);
		Db::getInstance()->Execute($sql);
	}
	
	public function getMyTeamPlayers($player_ids)
	{
		$sql = "SELECT *, p.id AS id FROM players p
				LEFT OUTER JOIN players_type pt ON pt.id = p.player_type 
				WHERE p.id IN (".$player_ids.")";
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getMyTournament($user_id)
	{
		$sql = 'SELECT * FROM `coc_joined_tournament` WHERE `user_id` = '.(int)($user_id).' AND `tournament_id` = '.(int)($this->id);
		return Db::getInstance()->getRow($sql);
	}
	
	public function updateJoinPlayers()
	{
		$sql = 'SELECT count(*) AS `count` FROM `coc_joined_tournament` WHERE `tournament_id` = '.(int)($this->id).' GROUP BY `tournament_id`';
		$result = Db::getInstance()->getRow($sql);
		$this->joinPlayers = (int)$result['count'];
	}
	public function getJoinPlayers()
	{
		$sql = 'SELECT cu.username,teamname,jt.user_id AS user_id, uc.connect_id FROM `coc_tournament` ct
				INNER JOIN `coc_joined_tournament` jt ON jt.`tournament_id` = ct.`id`
				INNER JOIN `coc_users` cu ON cu.`id` = jt.`user_id`
				LEFT OUTER JOIN coc_users_connect uc ON uc.user_id = cu.id AND uc.type = \'facebook\' 
				WHERE ct.id ='.(int)($this->id).''; 				
		return Db::getInstance()->ExecuteS($sql);
	}	
	public function getLatestWinners()
	{
		$sql = 'SELECT u.username AS username, t.name AS tournamentname, connect_id FROM `coc_leaderboard` l
				INNER JOIN `coc_users` u ON u.id = l.user_id
				INNER JOIN `coc_tournament` t ON t.id = l.tournament_id
				LEFT OUTER JOIN `coc_users_connect` uc ON uc.user_id = l.user_id AND uc.`type` = \'facebook\' ORDER BY l.id DESC LIMIT 15';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function checkBudjet($players)
	{
		$player = implode(',', $players);
		$sql = 'SELECT sum(coc_salary) AS budjet FROM players WHERE id IN ('.$player.')';
		$result = Db::getInstance()->getRow($sql);
		return $result['budjet'];
	}
	
	public function getTourWinners()
	{
		$sql = "SELECT u.id AS user_id,u.username,uc.connect_id,u.cash,u.coin,ur.runs AS run, prize_money, l.rank FROM coc_user_runs ur
				INNER JOIN coc_users u ON u.id = ur.user_id
				LEFT OUTER JOIN coc_users_connect uc ON uc.user_id = u.id AND uc.`type` = 'facebook'
				LEFT JOIN coc_leaderboard l ON l.tournament_id = ur.tournament_id AND l.user_id = ur.user_id 
				WHERE ur.tournament_id='".(int)$this->id."'";
		return Db::getInstance()->ExecuteS($sql);
	}	
	
	public function getLeader($tour_id)
	{
		$sql = "SELECT cl.user_id,cu.runs,cl.prize_money,cl.rank,cl.tournament_id FROM coc_leaderboard cl
				inner join coc_user_runs cu on cu.user_id = cl.user_id and cu.tournament_id = cl.tournament_id
				where cl.tournament_id = ".$tour_id."";
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function duplicateTournament()
	{
		$tournament = new Tournament();
		$tournament->name = $this->name;
		$tournament->user_id = $this->user_id;
		$tournament->match_id = $this->match_id;
		$tournament->entry_fee_id = $this->entry_fee_id;
		$tournament->tournament_type_id = $this->tournament_type_id;
		$tournament->player_id = $this->player_id;
		$tournament->endtime = $this->endtime;
		$tournament->kitty_id = $this->kitty_id;
		$tournament->no_of_changes = $this->no_of_changes;
		$tournament->prize_id = $this->prize_id;
		$tournament->rule_id = $this->rule_id;
		$tournament->salary_cap = $this->salary_cap;
		$tournament->private = $this->private;
		$tournament->recreate = $this->recreate;
		$tournament->status = $this->status;
		$tournament->add();
		$prize = implode(',', $this->prize_pool->prize);
		$sql = 'UPDATE coc_tournament_prize SET prize = \''.$prize.'\' WHERE tournament_id = '.$tournament->id;
		return Db::getInstance()->Execute($sql);
	}
	
	public function updateStatus($status)
	{
		$sql = 'UPDATE `coc_tournament` SET `status` = \''.$status.'\' WHERE id = '.($this->id);
		return Db::getInstance()->Execute($sql);
	}
	
	public function userDestroy($uid)
	{
		$players = $this->getJoinPlayersList($this->id);
		$players = explode(',', $players);
		if(count($players) > 1)
			return false;
		$sql = 'UPDATE `coc_tournament` SET `status` = \'Destroyed\' WHERE `status` <> \'Destroyed\' AND user_id = '.$uid.' AND id = '.$this->id;
		Db::getInstance()->Execute($sql);
		$sql = 'UPDATE `coc_users` SET `cash` = `cash` + '.(int)($this->entry_fee).' WHERE `id` = ('.$this->user_id.')';
		Db::getInstance()->Execute($sql);
		$user = new User($uid);
		$user->addTransHistory($this->entry_fee, 'Tournament destroyed return money:'.$this->name);
	}
	
	public function checkDestroy()
	{
		$tours = $this->getDestroyTour();
		foreach($tours as $tour)
		{
			$players = $this->getJoinPlayersList($tour['id']);
			$sql = 'UPDATE `coc_tournament` SET `status` = \'Destroyed\' WHERE `status` <> \'Destroyed\' AND id = '.$tour['id'];
			Db::getInstance()->Execute($sql);
			$sql = 'UPDATE `coc_users` SET `cash` = `cash` + '.(int)($tour['amount']).' WHERE `id` IN ('.$players.')';
			Db::getInstance()->Execute($sql);
			$user = new User();
			$players = explode(',', $players);
			foreach($players as $player)
				$user->addTransHistory($tour['amount'], 'Tournament destroyed return money:'.$tour['name'], $player);
		}
	}
	
	public function checkTourTimeExceed()
	{
		$now = date('Y-m-d H:i:s');
		$sql = 'SELECT id FROM coc_tournament WHERE endtime < \''.$now.'\' AND (`status` = \'Open\' OR `status` = \'Closed\')';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function closeTourTimeExceed()
	{
		$now = date('Y-m-d H:i:s');
		$sql = 'UPDATE coc_tournament SET status = \'Closed\' WHERE endtime < \''.$now.'\' AND `status` = \'Open\'';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	private function getDestroyTour()
	{
		$now = date('Y-m-d H:i:s');
		$sql = 'SELECT t1.id AS id, t1.name, t1.amount FROM (SELECT t.id, t.name, ef.amount, p.player,(SELECT count(*) AS joined FROM coc_joined_tournament jt WHERE jt.tournament_id = t.id) AS joined FROM coc_tournament t
				INNER JOIN coc_players p ON p.id = t.player_id
				INNER JOIN coc_entry_fee ef ON ef.id = t.entry_fee_id
				WHERE t.endtime < \''.$now.'\' AND t.entry_fee_id <> 1 AND (`status` = \'Closed\')) t1 WHERE t1.joined < t1.player LIMIT 5';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getJoinPlayersList($id)
	{
		$sql = 'SELECT GROUP_CONCAT(user_id) AS user_id FROM coc_joined_tournament WHERE tournament_id = '.$id;
		$result = Db::getInstance()->getRow($sql);
		return $result['user_id'];
	}
	
	public function getLiveTournament()
	{
		$sql = 'SELECT t.id AS id FROM coc_tournament t
				INNER JOIN match_details m ON m.id = t.match_id
				WHERE display_status = \'inprogress\' AND t.status <> \'Completed\' AND t.status <> \'Destroyed\' ORDER BY m.match_date DESC';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getTourStartTime($id)
	{
		$sql = 'SELECT match_date FROM match_details WHERE id = '.$id;
		$result = Db::getInstance()->ExecuteS($sql);
		return $result[0]['match_date'];
	}
	
	public function updateInvites($invites)
	{
		$invites = explode(',', $invites);
		$sql = 'INSERT INTO coc_tournament_invites(`tournament_id`, `facebook_id`) VALUES';
		foreach($invites as $invite) 
		{
			$sql .= '('.$this->id.', '.$invite.'),';
		}
		$sql = substr($sql, 0, -1);echo $sql;
		Db::getInstance()->Execute($sql);
	}
	
	public function getInvitedList()
	{
		$sql = 'SELECT facebook_id, ti.status FROM coc_tournament t
				INNER JOIN coc_tournament_invites ti ON ti.tournament_id = t.id
				WHERE t.id = '.$this->id;
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getEmailInvitedList()
	{
		$sql = 'SELECT ti.name, ti.status FROM coc_tournament t
				INNER JOIN coc_tournament_email_invites ti ON ti.tournament_id = t.id
				WHERE t.id = '.$this->id;
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getPrizes()
	{
		$sql = 'SELECT prize FROM coc_tournament_prize WHERE tournament_id = '.($this->id);
		$result = Db::getInstance()->ExecuteS($sql);
		if(count($result) == 0)
		{
			$return = new PrizePool($this->prize_id, $this->players, $this->entry_fee, $this->kitty);
		}
		else
		{
			$return->prize = explode(',', $result[0]['prize']);
			$return->total = 0;
			foreach($return->prize as $prize)
				$return->total = $prize + $return->total;
		}
		return $return;
	}
	
	public function addEmailInvite($user_id, $data)
	{
		$sql = 'INSERT INTO coc_tournament_email_invites(tournament_id, user_id, name, email, status) VALUES';
		$mail = new Mail();
		$user = new User($user_id);
		for($i = 0; $i < count($data['name']); $i++)
			if(strlen($data['email'][$i]) > 0)
				if(strlen($data['email'][$i]) > 0)
				{
					$sql .= '('.$this->id.', '.$user_id.', \''.$data['name'][$i].'\', \''.$data['email'][$i].'\', 0),';
					$mail->emailInviteMail($data['email'][$i], 'email-invite', $user->firstname);
				}
		$sql = substr($sql, 0, -1);
		return Db::getInstance()->Execute($sql);
	}
	public function acceptInvite()
	{
		global $cookie;
		$user_id = $cookie->user_id;
		$user = new User($user_id);
		if(!empty($user->connect['facebook']))
		{
			$sql = 'UPDATE coc_tournament_invites SET status = 1 WHERE tournament_id = '.$this->id.' AND facebook_id = '.$user->connect['facebook'];
			Db::getInstance()->Execute($sql);
		}
		$sql = 'UPDATE coc_tournament_email_invites SET status = 1 WHERE tournament_id = '.$this->id.' AND email = \''.$user->email.'\'';
		Db::getInstance()->Execute($sql);
	}
}