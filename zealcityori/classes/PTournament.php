<?php
class PTournament extends ObjectModel
{
	public $id;
	public $name;
	public $user_id;
	public $creator;
	public $series_id;
	public $entry_fee_id;
	public $entry_fee;
	public $tournament_type_id;
	public $tournament_type;
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
	public $status;
	public $status_name;
	public $winner_coin;
	public $participent_coin;
	public $joinPlayers;
	public $start_date;
	public $end_date;
	public $date_add;
	public $matches;
	public $recreate;
	public $private;
	protected 	$table = 'coc_period_tournament';
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
			$this->prize_pool = $this->getPrizes();
			$this->updateJoinPlayers();
			$this->matches = $this->getMatches();
			$this->tournament_type = new TournamentType($this->tournament_type_id);
			$status = new Status($this->status);
			$this->status = $status->name;
		}
	}
	
	public function getFields()
	{
		if (isset($this->id))
			$fields['id'] = (int)($this->id);
		$fields['name'] = pSQL($this->name);
		$fields['user_id'] = pSQL($this->user_id);
		$fields['series_id'] = pSQL($this->series_id);
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
		$fields['start_date'] = pSQL($this->start_date);
		$fields['end_date'] = pSQL($this->end_date);
		$fields['date_add'] = pSQL($this->date_add);
		return $fields;
	}
	
	public function add($autodate = true, $nullValues = true)
	{
	 	if (!parent::add($autodate, $nullValues))
			return false;
		$this->updateTournamentPrizes();
		$this->addMatches();
		return true;
	}
	
	public function updateTournamentPrizes()
	{
		$prizes = new PrizePool($this->prize_id, $this->player_id, $this->entry_fee_id, 20, true);
		$prize = implode(',', $prizes->prize);
		$sql = 'INSERT INTO coc_pt_prize(pt_id, prize) VALUES('.$this->id.', \''.$prize.'\')';
		return Db::getInstance()->Execute($sql);
	}
	
	public function getWeeklyTournament($limit = NULL)
	{
		$now = date('Y-m-d H:i:s');
		global $cookie;
		$user_id = $cookie->user_id;
		$sql = 'SELECT t.id, ifnull(jt1.reg_player,0) AS reg_player, t.name,t.tournament_type_id, t.endtime, p.player AS player, ef.amount, t.status, 
				tt.nickname'.(!empty($user_id)?', jt2.pt_id':'').', tp.prize FROM coc_period_tournament t 
				INNER JOIN coc_status s ON s.id = t.`status` 
				INNER JOIN coc_entry_fee ef ON ef.id = t.entry_fee_id 
				INNER JOIN coc_players p ON p.id = t.player_id
				INNER JOIN coc_kitty k ON k.id = t.kitty_id 
				INNER JOIN coc_prize_pool pp ON pp.id = t.prize_id 
				INNER JOIN coc_tournament_type tt ON tt.id = t.tournament_type_id ';
		if(!empty($user_id))
			$sql .= 'LEFT OUTER JOIN coc_pt_joined jt2 ON jt2.pt_id = t.id AND jt2.user_id = '.$user_id.' ';
		$sql .= 'LEFT JOIN coc_pt_prize tp ON tp.pt_id = t.id
				 LEFT JOIN (SELECT count(*) AS reg_player,pt_id FROM coc_pt_joined GROUP BY pt_id) jt1 ON jt1.pt_id = t.id ';
		$sql .= 'WHERE (s.name = \'Open\') AND t.endtime >= \''.$now.'\' AND (tt.id = 5 OR tt.id = 6) ORDER BY endtime ASC, t.status';
		if($limit)
			$sql .=' LIMIT '.$limit;
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getUserWeeklyTournament($limit = NULL)
	{
		$now = date('Y-m-d H:i:s');
		global $cookie;
		$user_id = $cookie->user_id;
		$user = new User($user_id);
		$sql = 'SELECT t.id, ifnull(jt1.reg_player,0) AS reg_player, t.name,t.tournament_type_id, t.endtime, p.player AS player, ef.amount, t.status, 
				tt.nickname'.(!empty($user_id)?', jt2.pt_id':'').', tp.prize, t.user_id FROM coc_period_tournament t 
				INNER JOIN coc_status s ON s.id = t.`status` 
				INNER JOIN coc_entry_fee ef ON ef.id = t.entry_fee_id 
				INNER JOIN coc_players p ON p.id = t.player_id 
				INNER JOIN coc_kitty k ON k.id = t.kitty_id 
				INNER JOIN coc_prize_pool pp ON pp.id = t.prize_id 
				INNER JOIN coc_tournament_type tt ON tt.id = t.tournament_type_id 
				LEFT JOIN coc_pt_prize tp ON tp.pt_id = t.id ';
		if(!empty($user->connect['facebook']))
			$sql .= 'LEFT OUTER JOIN coc_pt_invites ti ON ti.pt_id = t.id AND ti.facebook_id = '.($user->connect['facebook']).' ';
		if(!empty($user_id))
			$sql .= 'LEFT OUTER JOIN coc_pt_joined jt2 ON jt2.pt_id = t.id AND jt2.user_id = '.$user_id.' 
					 LEFT OUTER JOIN coc_pt_email_invites pei ON pei.pt_id = t.id AND pei.email = \''.$user->email.'\' ';
		$sql .= 'LEFT JOIN (SELECT count(*) AS reg_player,pt_id FROM coc_pt_joined GROUP BY pt_id) jt1 ON jt1.pt_id = t.id WHERE ';
		if(!empty($user_id) && !empty($user->connect['facebook']))
			$sql .= '(ti.facebook_id = '.($user->connect['facebook']).' OR t.user_id = '.$user->id.' OR pei.email = \''.$user->email.'\') AND ';
		else if(!empty($user_id))
			$sql .= '(t.user_id = 0 OR t.user_id = '.$user->id.' OR pei.email = \''.$user->email.'\') AND ';
		else
			$sql .= '(t.user_id = 0) AND ';
		$sql .= '(s.name = \'Open\') AND t.endtime >= \''.$now.'\' AND (tt.id = 7 OR tt.id = 8) ORDER BY endtime ASC, t.status';
		if($limit)
			$sql .=' LIMIT '.$limit;
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getAllMyTournament($limit = NULL)
	{
		global $cookie;
		$user_id = $cookie->user_id;
		$sql = 'SELECT t.id, ifnull(jt1.reg_player,0) AS reg_player, t.name,t.tournament_type_id, t.endtime, p.player AS player, ef.amount, t.status, 
				tt.nickname, tp.prize, position FROM coc_period_tournament t 
				INNER JOIN coc_pt_joined jt ON jt.pt_id = t.id AND jt.user_id = '.$user_id.'
				INNER JOIN coc_status s ON s.id = t.`status` 
				INNER JOIN coc_players p ON p.id = t.player_id
				INNER JOIN coc_entry_fee ef ON ef.id = t.entry_fee_id 
				INNER JOIN coc_kitty k ON k.id = t.kitty_id 
				INNER JOIN coc_prize_pool pp ON pp.id = t.prize_id 
				INNER JOIN coc_tournament_type tt ON tt.id = t.tournament_type_id 
				LEFT JOIN coc_pt_prize tp ON tp.pt_id = t.id
				LEFT JOIN coc_pt_user_runs ptr ON ptr.pt_id = t.id AND ptr.user_id = '.$user_id.'
				LEFT JOIN (SELECT count(*) AS reg_player,pt_id FROM coc_pt_joined GROUP BY pt_id) jt1 ON jt1.pt_id = t.id WHERE 
				(tt.id = 5 OR tt.id = 6 OR tt.id = 7 OR tt.id = 8) ORDER BY amount ASC, t.id DESC';
		if($limit)
			$sql .=" LIMIT ".$limit;
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function addMatches()
	{
		$matches = Matches::getMatchFromDate($this->start_date, $this->end_date, $this->series_id);
		$sql = 'INSERT INTO coc_pt_matches(pt_id, match_id, `status`) VALUES';
		foreach($matches as $match)
			$sql .= '('.$this->id.', '.$match['id'].', 1),';
		$sql = substr($sql, 0, -1);
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getMatches()
	{			
		$sql = 'SELECT md.type,md.match_date,t1.flag_url AS t1flag, t2.flag_url AS t2flag, t1.teamname AS t1name, t2.teamname AS t2name, 
				t1.team_nickname AS team1, t2.team_nickname AS team2, md.id AS id, s.name AS status, opening_soon FROM match_details md
				INNER JOIN coc_pt_matches tm ON tm.match_id = md.id AND tm.pt_id = '.$this->id.'
				INNER JOIN team_details t1 ON t1.id = md.team1
				INNER JOIN team_details t2 ON t2.id = md.team2
				INNER JOIN coc_status s ON s.id = tm.status ORDER BY match_date';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function joinTournament($user_id, $tour_id)
	{
		return Db::getInstance()->Execute('INSERT INTO `coc_pt_joined`(`user_id`, `pt_id`) VALUES('.(int)$user_id.','.(int)$tour_id.')');
	}
	
	public function checkJoinStatus($user_id)
	{
		$sql = 'SELECT * FROM `coc_pt_joined` WHERE `user_id` = '.(int)($user_id).' AND `pt_id` = '.(int)($this->id);
		Db::getInstance()->ExecuteS($sql);
		return Db::getInstance()->NumRows();
	}
	
	public function updateMyTournament($teamName, $players, $captain, $coach, $matchId)
	{
		global $cookie;
		$sql = 'INSERT INTO `coc_pt_match_joined`(user_id, pt_id, match_id, teamname, captain, coach, no_of_changes) VALUES
				('.(int)($cookie->user_id).', '.(int)($this->id).', '.(int)($matchId).', \''.pSQL($teamName).'\', \''.$captain.'\', '.($coach).', 1) 
				ON DUPLICATE KEY UPDATE `teamname` = \''.pSQL($teamName).'\',  `captain` = \''.$captain.'\', `coach` = \''.$coach.'\', `no_of_changes` = `no_of_changes` + 1';
		$joinId = Db::getInstance()->Execute($sql);
		$this->updateMyteamPlayers($players, $matchId, $joinId);
		return Db::getInstance()->Affected_Rows();
	}
	
	private function updateMyteamPlayers($players, $matchId, $joinId)
	{	
		global $cookie;
		$result = $this->getMyTournament($cookie->user_id, $matchId);
		$this->deleteExistPlayers($result['id']);
		$sql = 'INSERT INTO `coc_pt_player`(`join_id`, `match_id`, `player_id`) VALUES';
		foreach($players as $player)
		{
			$sql .='('.(int)($result['id']).', '.(int)($matchId).', '.(int)($player).'),';
		}
		$sql = substr($sql, 0, -1);
		Db::getInstance()->Execute($sql);
	}
	
	public function getSelectedPlayers($join_id)
	{
		$sql = 'SELECT GROUP_CONCAT(`player_id`) AS `player_ids` FROM `coc_pt_player` WHERE `join_id` = '.(int)($join_id);
		return Db::getInstance()->getRow($sql);
	}
	
	private function deleteExistPlayers($join_id)
	{		
		$sql = 'DELETE FROM `coc_pt_player` WHERE join_id = '.(int)($join_id);
		Db::getInstance()->Execute($sql);
	}
	
	public function getMyTeamPlayers($player_ids)
	{
		$sql = "SELECT *, p.id AS id FROM players p
				LEFT OUTER JOIN players_type pt ON pt.id = p.player_type 
				WHERE p.id IN (".$player_ids.")";
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getMyTournament($user_id, $matchId)
	{
		$sql = 'SELECT * FROM `coc_pt_match_joined` WHERE `user_id` = '.(int)($user_id).' AND `pt_id` = '.(int)($this->id).' AND match_id = '.(int)$matchId;
		return Db::getInstance()->getRow($sql);
	}
	
	public function getMyTourJoinedMatches($user_id)
	{
		$sql = 'SELECT match_id FROM `coc_pt_match_joined` WHERE `user_id` = '.(int)($user_id).' AND `pt_id` = '.(int)($this->id);
		$results = Db::getInstance()->ExecuteS($sql);
		$return = array();
		foreach($results as $result)
			$return[] = $result['match_id'];
		return $return;
	}
	
	public function updateJoinPlayers()
	{
		$sql = 'SELECT count(*) AS `count` FROM `coc_pt_joined` WHERE `pt_id` = '.(int)($this->id).' GROUP BY `pt_id`';
		$result = Db::getInstance()->getRow($sql);
		$this->joinPlayers = (int)$result['count'];
	}
	public function getJoinPlayers($mid)
	{
		$sql = 'SELECT cu.username,teamname,jt.user_id AS user_id, uc.connect_id FROM `coc_period_tournament` ct
				INNER JOIN `coc_pt_match_joined` jt ON jt.`pt_id` = ct.`id`
				INNER JOIN `coc_users` cu ON cu.`id` = jt.`user_id`
				LEFT OUTER JOIN coc_users_connect uc ON uc.user_id = cu.id AND uc.type = \'facebook\' 
				WHERE ct.id ='.(int)($this->id).' AND jt.match_id = '.(int)($mid);
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
	
	public function getTourWinners($mid)
	{
		$sql = 'SELECT u.id AS user_id,u.username,uc.connect_id,u.cash,u.coin,ur.runs AS run FROM coc_pt_user_runs ur
				INNER JOIN coc_users u ON u.id = ur.user_id
				INNER JOIN `match_details` m ON m.id = ur.match_id
				LEFT OUTER JOIN coc_users_connect uc ON uc.user_id = u.id AND uc.`type` = \'facebook\'
				WHERE m.id = '.(int)($mid).' AND pt_id = '.(int)$this->id;
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
		$tournament = new PTournament();
		$tournament->name = $this->name;
		$tournament->user_id = $this->user_id;
		$tournament->series_id = $this->series_id;
		$tournament->entry_fee_id = $this->entry_fee_id;
		$tournament->tournament_type_id = $this->tournament_type_id;
		$tournament->player_id = $this->player_id;
		$tournament->endtime = $this->endtime;
		$tournament->kitty_id = $this->kitty_id;
		$tournament->no_of_changes = $this->no_of_changes;
		$tournament->prize_id = $this->prize_id;
		$tournament->rule_id = $this->rule_id;
		$tournament->salary_cap = $this->salary_cap;
		$tournament->recreate = $this->recreate;
		$tournament->status = $this->status;
		$tournament->start_date = $this->start_date;
		$tournament->end_date = $this->end_date;
		$tournament->add();
		$prize = implode(',', $this->prize_pool->prize);
		$sql = 'UPDATE coc_pt_prize SET prize = \''.$prize.'\' WHERE pt_id = '.$tournament->id;
		//return Db::getInstance()->Execute($sql);
	}
	
	public function updateStatus($status)
	{
		$sql = 'UPDATE `coc_period_tournament` SET `status` = 2 WHERE id = '.($this->id);
		return Db::getInstance()->Execute($sql);
	}
	
	public function userDestroy($uid)
	{
		$players = $this->getJoinPlayersList($this->id);
		$players = explode(',', $players);
		if(count($players) > 1)
			return false;
		$sql = 'UPDATE `coc_period_tournament` SET `status` = 4 WHERE `status` <> 4 AND user_id = '.$uid.' AND id = '.$this->id;
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
			$sql = 'UPDATE `coc_period_tournament` SET `status` = 4 WHERE `status` <> 4 AND id = '.$tour['id'];
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
		$sql = 'SELECT id FROM coc_period_tournament WHERE endtime < \''.$now.'\' AND (`status` = 1 OR `status` = 2)';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function closeTourTimeExceed()
	{
		$now = date('Y-m-d H:i:s');
		$sql = 'UPDATE coc_period_tournament SET status = 2 WHERE endtime < \''.$now.'\'`status` = 1';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	private function getDestroyTour()
	{
		$now = date('Y-m-d H:i:s');
		$sql = 'SELECT t1.id AS id, t1.name, t1.amount FROM (SELECT t.id, t.name, ef.amount, p.player,(SELECT count(*) AS joined FROM coc_pt_joined jt WHERE jt.pt_id = t.id) AS joined FROM coc_period_tournament t
				INNER JOIN coc_players p ON p.id = t.player_id
				INNER JOIN coc_entry_fee ef ON ef.id = t.entry_fee_id
				WHERE t.endtime < \''.$now.'\' AND t.entry_fee_id <> 1 AND (`status` = 1 OR `status` = 2)) t1 WHERE t1.joined < t1.player LIMIT 3';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getJoinPlayersList($id)
	{
		$sql = 'SELECT GROUP_CONCAT(user_id) AS user_id FROM coc_pt_joined WHERE pt_id = '.$id;
		$result = Db::getInstance()->getRow($sql);
		return $result['user_id'];
	}
	
	public function getLiveTournament()
	{
		$sql = 'SELECT t.id AS id, ptm.match_id FROM coc_period_tournament t
				INNER JOIN coc_pt_matches ptm ON ptm.pt_id = t.id
				INNER JOIN match_details m ON m.id = ptm.match_id
				WHERE display_status = \'inprogress\' AND t.status <> 3 AND t.status <> 4 ORDER BY m.match_date DESC';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getTourStartTime($id)
	{
		$now = strtotime(date('Y-m-d H:i:s'));
		$sql = 'SELECT * FROM match_details WHERE tour_id = '.$id.' AND match_date > '.$now.' LIMIT 1';
		$result = Db::getInstance()->ExecuteS($sql);
		return $result[0]['match_date'];
	}
	public function getWeekStartTime($date)
	{
		$now = strtotime($date);
		$sql = 'SELECT match_date FROM match_details WHERE match_date > '.$now.' LIMIT 1';
		$result = Db::getInstance()->ExecuteS($sql);
		return $result[0]['match_date'];
	}
	
	public function getSeriesEndDate($id)
	{
		$sql = 'SELECT end_date FROM tournament_details WHERE id = '.$id;
		$result = Db::getInstance()->ExecuteS($sql);
		return $result[0]['end_date'];
	}
	
	public function getInvitedList()
	{
		$sql = 'SELECT facebook_id, ti.status FROM coc_period_tournament t
				INNER JOIN coc_pt_invites ti ON ti.pt_id = t.id
				WHERE t.id = '.$this->id;
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getEmailInvitedList()
	{
		$sql = 'SELECT ti.name, ti.status FROM coc_period_tournament t
				INNER JOIN coc_pt_email_invites ti ON ti.pt_id = t.id
				WHERE t.id = '.$this->id;
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getResults()
	{
		$sql = 'SELECT sum(runs) AS run, username, uc.connect_id, l.prize_money, u.id AS user_id, l.rank FROM coc_pt_user_runs r
				INNER JOIN coc_period_tournament t ON t.id = r.pt_id
				INNER JOIN coc_users u ON u.id = r.user_id
				LEFT OUTER JOIN coc_users_connect uc ON uc.user_id = u.id AND uc.`type` = \'facebook\'
				LEFT JOIN coc_pt_leaderboard l ON l.pt_id = t.id AND l.user_id = r.user_id 
				WHERE t.id = '.$this->id.' GROUP BY u.id ORDER BY run DESC';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getMyTourPlayers($mid)
	{
		global $cookie;
		$sql = 'SELECT tp.player_id AS id, p.photo_url, p.player_name FROM `coc_pt_player` tp
				INNER JOIN `coc_pt_match_joined` jt ON jt.id = tp.join_id
				INNER JOIN `match_details` m ON m.id = tp.match_id
				INNER JOIN players p ON p.id = tp.player_id
				WHERE m.id = '.(int)($mid).' AND jt.pt_id = '.(int)$this->id.' AND jt.user_id = '.(int)($cookie->user_id);
		return Db::getInstance()->ExecuteS($sql);
	}
	public function getUserTourPlayers($tour_id, $mid, $uid)
	{
		global $cookie;
		$sql = 'SELECT tp.player_id AS id, p.photo_url, p.player_name FROM `coc_pt_player` tp
				INNER JOIN `coc_pt_match_joined` jt ON jt.id = tp.join_id
				INNER JOIN `match_details` m ON m.id = tp.match_id
				INNER JOIN players p ON p.id = tp.player_id
				WHERE m.id = '.(int)($mid).' AND jt.pt_id = '.(int)$tour_id.' AND jt.user_id = '.(int)($uid);
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getPtJoinPlayers()
	{
		$sql = 'SELECT u.username FROM coc_period_tournament pt
				INNER JOIN coc_pt_joined pj ON pj.pt_id = pt.id
				INNER JOIN coc_users u ON u.id = pj.user_id				
				WHERE pt.id = '.(int)$this->id.'';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function updateInvites($invites)
	{
		$invites = explode(',', $invites);
		$sql = 'INSERT INTO coc_pt_invites(`pt_id`, `facebook_id`) VALUES';
		foreach($invites as $invite) 
		{
			$sql .= '('.$this->id.', '.$invite.'),';
		}
		$sql = substr($sql, 0, -1);
		Db::getInstance()->Execute($sql);
	}
	
	public function getPrizes()
	{
		$sql = 'SELECT prize FROM coc_pt_prize WHERE pt_id = '.($this->id);
		$result = Db::getInstance()->ExecuteS($sql);
		if(count($result) == 0)
		{
			$return = new PrizePool($this->prize_id, $this->players, $this->entry_fee, $this->kitty, true);
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
	
	public function checkMatchStartTime($matchId)
	{
		$sql = 'SELECT match_date FROM match_details md WHERE id = '.(int)$matchId;
		$result = Db::getInstance()->ExecuteS($sql);
		return strtotime('-45 minutes', $result[0]['match_date']);
	}
	
	public function getMyTeam($tour_id, $mid)
	{
		global $cookie;
		$sql = 'SELECT p.id AS id, player_name, ifnull(sum(pp.runs),0) AS runs, ifnull(sum(pp.balls),0) AS balls, ifnull(sum(fours),0) AS fours,
				ifnull(sum(sixs),0) AS sixs, ifnull(sum(wickets),0) AS wickets, ifnull(sum(maiden),0) AS maiden, ifnull(sum(bd.balls),0) AS overs, ifnull(sum(wide),0) AS wide, ifnull(sum(bd.no_balls),0) AS no_balls,
				ifnull(sum(bd.runs),0) AS rungiven,ifnull(sum(pd.caught),0) AS caught,ifnull(sum(pd.stumped),0) AS stumped, ifnull(sum(pd.runout),0) AS runout, photo_url FROM `coc_pt_player` tp
				INNER JOIN `coc_pt_match_joined` jt ON jt.id = tp.join_id
				INNER JOIN `coc_period_tournament` t ON t.id = jt.pt_id
				INNER JOIN `players` p ON p.id = tp.player_id
				LEFT OUTER JOIN `match_players_performance` pp ON pp.match_id = '.(int)$mid.' AND pp.player_id = tp.player_id
				LEFT OUTER JOIN `match_bowler_details` bd ON bd.match_id = '.(int)$mid.' AND bd.player_id = tp.player_id
				LEFT OUTER JOIN `match_players_details` pd ON pd.match_id = '.(int)$mid.' AND pd.player_id = tp.player_id
				WHERE t.id = '.(int)$tour_id.' AND jt.user_id = '.(int)($cookie->user_id).' AND jt.match_id = '.(int)$mid.' GROUP BY p.id';
		return Db::getInstance()->ExecuteS($sql);
	}
	public function getUserTeam($tour_id, $mid, $uid)
	{
		global $cookie;
		$sql = 'SELECT p.id AS id, player_name, ifnull(sum(pp.runs),0) AS runs, ifnull(sum(pp.balls),0) AS balls, ifnull(sum(fours),0) AS fours,
				ifnull(sum(sixs),0) AS sixs, ifnull(sum(wickets),0) AS wickets, ifnull(sum(maiden),0) AS maiden, ifnull(sum(bd.balls),0) AS overs, ifnull(sum(wide),0) AS wide, ifnull(sum(bd.no_balls),0) AS no_balls,
				ifnull(sum(bd.runs),0) AS rungiven,ifnull(sum(pd.caught),0) AS caught,ifnull(sum(pd.stumped),0) AS stumped, ifnull(sum(pd.runout),0) AS runout, photo_url FROM `coc_pt_player` tp
				INNER JOIN `coc_pt_match_joined` jt ON jt.id = tp.join_id
				INNER JOIN `coc_period_tournament` t ON t.id = jt.pt_id
				INNER JOIN `players` p ON p.id = tp.player_id
				LEFT OUTER JOIN `match_players_performance` pp ON pp.match_id = '.(int)$mid.' AND pp.player_id = tp.player_id
				LEFT OUTER JOIN `match_bowler_details` bd ON bd.match_id = '.(int)$mid.' AND bd.player_id = tp.player_id
				LEFT OUTER JOIN `match_players_details` pd ON pd.match_id = '.(int)$mid.' AND pd.player_id = tp.player_id
				WHERE t.id = '.(int)$tour_id.' AND jt.user_id = '.(int)($uid).' AND jt.match_id = '.(int)$mid.' GROUP BY p.id';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function addEmailInvite($user_id, $data)
	{
		$user = new User($user_id);
		$sql = 'INSERT INTO coc_pt_email_invites(pt_id, user_id, name, email, status) VALUES';
		$mail = new Mail();
		for($i = 0; $i < count($data['name']); $i++)
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
			$sql = 'UPDATE coc_pt_invites SET status = 1 WHERE pt_id = '.$this->id.' AND facebook_id = '.$user->connect['facebook'];
			Db::getInstance()->Execute($sql);
		}
		$sql = 'UPDATE coc_pt_email_invites SET status = 1 WHERE pt_id = '.$this->id.' AND email = \''.$user->email.'\'';
		Db::getInstance()->Execute($sql);
	}
}