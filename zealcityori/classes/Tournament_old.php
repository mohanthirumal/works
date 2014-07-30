<?php
class Tournament extends ObjectModel
{
	public $id;
	public $name;
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
	public $status;
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
			$this->players = $players->player;
			$kitty = new Kitty($this->kitty_id);
			$this->kitty = $kitty->percentage;
			$entry_fee = new EntryFee($this->entry_fee_id);
			$this->entry_fee = $entry_fee->amount;
			$this->winner_coin = $entry_fee->winner_coin;
			$this->participent_coin = $entry_fee->participent_coin;
			$this->prize_pool = new PrizePool($this->prize_id, $this->players, $this->entry_fee, $this->kitty);
			$this->updateJoinPlayers();
		}
	}
	
	public function getAllTournament($limit = NULL)
	{
		$now = date('Y-m-d H:i:s');
		global $cookie;
		$user_id = $cookie->user_id;
		$sql = "SELECT t.id, ifnull(jt.reg_player,0) AS reg_player, t1.team_nickname AS team1, t2.team_nickname AS team2,md.match_date, t.tournament_type_id, 
				t1.flag_url AS team1flag, t2.flag_url AS team2flag, md.type, t.endtime, p.player, ef.amount, t.status".(!empty($user_id)?", jt1.tournament_id":"")." FROM coc_tournament t
				INNER JOIN coc_entry_fee ef ON ef.id = t.entry_fee_id
				INNER JOIN coc_kitty k ON k.id = t.kitty_id
				INNER JOIN coc_players p ON p.id = t.player_id
				INNER JOIN coc_prize_pool pp ON pp.id = t.prize_id
				INNER JOIN coc_tournament_type tt ON tt.id = t.tournament_type_id
				INNER JOIN match_details md ON md.id = t.match_id
				INNER JOIN team_details t1 ON t1.id = md.team1
				INNER JOIN team_details t2 ON t2.id = md.team2
				LEFT JOIN (SELECT count(*) AS reg_player,tournament_id FROM coc_joined_tournament GROUP BY tournament_id) jt ON jt.tournament_id = t.id ";
		if(!empty($user_id))
			$sql .= "LEFT OUTER JOIN coc_joined_tournament jt1 ON jt1.tournament_id = t.id AND jt1.user_id = ".$user_id;
		$sql .= " WHERE (t.status = 'Open' OR t.status = 'Closed') AND t.endtime >= '".$now."' ORDER BY amount ASC,id DESC";
		if($limit)
			$sql .=" LIMIT ".$limit;
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getAllMyTournament($limit = NULL)
	{
		global $cookie;
		$user_id = $cookie->user_id;
		$sql = 'SELECT t.name AS name, ifnull(jt1.reg_player,0) AS reg_player, t.id, t1.team_nickname AS team1, t2.team_nickname AS team2,md.match_date, t1.flag_url AS team1flag, t2.flag_url AS team2flag, 
				t.tournament_type_id, md.type, t.endtime, p.player, ef.amount, t.status FROM coc_tournament t
				INNER JOIN coc_joined_tournament jt ON jt.tournament_id = t.id
				INNER JOIN coc_entry_fee ef ON ef.id = t.entry_fee_id
				INNER JOIN coc_kitty k ON k.id = t.kitty_id
				INNER JOIN coc_players p ON p.id = t.player_id
				INNER JOIN coc_prize_pool pp ON pp.id = t.prize_id
				INNER JOIN coc_tournament_type tt ON tt.id = t.tournament_type_id
				INNER JOIN match_details md ON md.id = t.match_id
				INNER JOIN team_details t1 ON t1.id = md.team1
				INNER JOIN team_details t2 ON t2.id = md.team2
				LEFT JOIN (SELECT count(*) AS reg_player,tournament_id FROM coc_joined_tournament GROUP BY tournament_id) jt1 ON jt1.tournament_id = t.id
				WHERE jt.user_id = '.$user_id.' ORDER BY t.endtime DESC ';
		if($limit)
			$sql .=" LIMIT ".$limit;
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
		//$sql = 'SELECT `username`, sum(`run`) AS `run`,`teamname` FROM `coc_users` u
//				INNER JOIN `coc_joined_tournament` jt ON jt.`user_id` = u.`id`
//				INNER JOIN `coc_tournament` t ON t.`id` = jt.`tournament_id`
//				INNER JOIN `coc_tournament_player` tp ON tp.`join_id` = jt.`id`
//				INNER JOIN `coc_match_points` mp ON mp.`player_id` = tp.`player_id` AND mp.`match_id` = t.`match_id`
//				WHERE t.id = '.(int)$this->id.' AND t.status = \'Completed\' GROUP BY u.`id` ORDER BY `run` DESC;';
				
		$sql = "SELECT (test.run+test.captain_run+test.coach_run) AS run,test.coach_run,test.user_id, test.username, test.winner_coin, test.connect_id FROM 
			(select t.id as tournament_id,jt.user_id,tp.player_id,jt.captain,sum(mp.run) AS run,
			u.username as username,u.id,u.coin,ef.winner_coin,(SELECT sum(run) AS run FROM coc_match_points WHERE player_id = jt.captain AND match_id=t.match_id) AS captain_run,
     		if(st.team_id=md.won_team_id,20,0) AS coach_run, uc.connect_id from coc_tournament as t
			left outer  join coc_joined_tournament as jt on jt.tournament_id=t.id
			left outer join coc_tournament_player as tp on tp.join_id=jt.id
			left outer join coc_match_points as mp on mp.player_id=tp.player_id
			left outer join coc_users as u on u.id=jt.user_id
			left outer join squard_team st on st.coach_id=jt.coach
			left outer join match_details md on md.won_team_id=st.team_id and md.id = t.match_id
			left outer join coc_entry_fee as ef on ef.id=t.entry_fee_id 
			left outer join coc_users_connect uc ON uc.user_id = u.id AND uc.type = 'facebook' 
			where t.id='".(int)$this->id."' and mp.match_id=t.match_id 			
			and t.status = 'Completed' 
			group by user_id order by run desc) test order by run DESC";
		return Db::getInstance()->ExecuteS($sql);
	}	
	
	public function duplicateTournament()
	{
		$sql = 'INSERT INTO coc_tournament(name, match_id, entry_fee_id, tournament_type_id, player_id, endtime, kitty_id, no_of_changes, prize_id, 
				rule_id, salary_cap, recreate, status) VALUES(\''.$this->name.'\', '.$this->match_id.', '.$this->entry_fee_id.', '.$this->tournament_type_id.', '.$this->player_id.', \''.$this->endtime.'\', 
				'.$this->kitty_id.', '.$this->no_of_changes.', '.$this->prize_id.', '.$this->rule_id.', '.$this->salary_cap.', '.$this->recreate.', \''.$this->status.'\')';
		return Db::getInstance()->Execute($sql);		
	}
	
	public function updateStatus($status)
	{
		$sql = 'UPDATE `coc_tournament` SET `status` = \''.$status.'\' WHERE id = '.($this->id);
		return Db::getInstance()->Execute($sql);
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
		}
	}
	
	private function getDestroyTour()
	{
		$now = date('Y-m-d H:i:s');
		$sql = 'SELECT t1.id AS id, t1.amount FROM (SELECT t.id, ef.amount, p.player,(SELECT count(*) AS joined FROM coc_joined_tournament jt WHERE jt.tournament_id = t.id) AS joined FROM coc_tournament t
				INNER JOIN coc_players p ON p.id = t.player_id
				INNER JOIN coc_entry_fee ef ON ef.id = t.entry_fee_id
				WHERE t.endtime < \''.$now.'\' AND t.entry_fee_id <> 1 AND (`status` = \'Open\' OR `status` = \'Closed\')) t1 WHERE t1.joined < t1.player';
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
				WHERE display_status = \'inprogress\' ORDER BY m.match_date DESC';
		return Db::getInstance()->ExecuteS($sql);
	}
}