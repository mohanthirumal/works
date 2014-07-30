<?php
class Matches extends ObjectModel
{
	public 		$id;
	public 		$tour_id;
	public		$tour;
	public 		$match_date;
	public 		$team1;
	public 		$team2;
	public 		$venue_id;
	public		$venue;
	public 		$type;
	public 		$display_status;
	public 		$resultstatus;
	public 		$won_toss;
	public 		$choose;
	public 		$umpires;
	public 		$tv_umpires;
	public 		$match_referee;
	public 		$day;
	public 		$session;
	public 		$session_status;
	public		$team1Details;
	public		$team2Details;
	public		$match_name;
	public		$won_team_id;
	public		$opening_soon;
	protected 	$table = 'match_details';
	protected 	$identifier = 'id';
	
	public function __construct($id = NULL)
	{
		parent::__construct($id);
		if($id)
		{
			$this->team1Details = new Teams($this->team1);
			$this->team2Details = new Teams($this->team2);
			$this->tour = new Tour($this->tour_id);
			$this->venue = new Venue($this->venue_id);
		}
	}
	
	public function getUpcomingMatches($limit = NULL)
	{
		$sql = 'SELECT t1.flag_url AS t1flag, t2.flag_url AS t2flag, t1.teamname AS t1name, t2.teamname AS t2name, 
				t1.team_nickname AS team1, t2.team_nickname AS team2, md.id AS id, v.venue, 
				v.city, md.match_date,md.opening_soon, md.match_name FROM match_details md
				INNER JOIN team_details t1 ON t1.id = md.team1
				INNER JOIN team_details t2 ON t2.id = md.team2
				INNER JOIN venue_details v ON v.id = md.venue_id WHERE display_status = \'future\' ORDER BY md.match_date';
		if($limit)
			$sql .= ' LIMIT '.$limit;
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getApprovedMatches($limit = NULL)
	{
		$sql = 'SELECT t1.flag_url AS t1flag, t2.flag_url AS t2flag, t1.teamname AS t1name, t2.teamname AS t2name, 
				t1.team_nickname AS team1, t2.team_nickname AS team2, md.id AS id, v.venue, 
				v.city, md.match_date,md.opening_soon, md.match_name FROM match_details md
				INNER JOIN team_details t1 ON t1.id = md.team1
				INNER JOIN team_details t2 ON t2.id = md.team2
				INNER JOIN venue_details v ON v.id = md.venue_id WHERE display_status = \'future\' AND opening_soon = 1 ORDER BY md.match_date';
		if($limit)
			$sql .= ' LIMIT '.$limit;
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getRecentMatches($limit = 10)
	{
		$dateStart = strtotime(date('Y-m-d'));
		$tomorrow = mktime(0,0,0,date("m"),date("d")+1,date("Y"));
		$sql = "SELECT t1.flag_url AS t1flag, t2.flag_url AS t2flag, t1.teamname AS t1name, t2.teamname AS t2name, 
				t1.team_nickname AS team1, t2.team_nickname AS team2, md.id AS id, v.venue, 
				v.city, md.match_date FROM match_details md
				INNER JOIN team_details t1 ON t1.id = md.team1
				INNER JOIN team_details t2 ON t2.id = md.team2
				INNER JOIN venue_details v ON v.id = md.venue_id WHERE md.match_date >= ".$dateStart." AND  md.match_date <= ".$tomorrow." 
				ORDER BY md.match_date LIMIT ".$limit.";";
		$sql = 'SELECT t1.flag_url AS t1flag, t2.flag_url AS t2flag, t1.teamname AS t1name, t2.teamname AS t2name, 
				t1.team_nickname AS team1, t2.team_nickname AS team2, md.id AS id, v.venue, 
				v.city, md.match_date FROM match_details md
				INNER JOIN team_details t1 ON t1.id = md.team1
				INNER JOIN team_details t2 ON t2.id = md.team2
				INNER JOIN venue_details v ON v.id = md.venue_id WHERE display_status = \'future\' ORDER BY md.match_date LIMIT 1';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getLiveMatch()
	{
		$sql = "SELECT * FROM match_details md WHERE display_status = 'inprogress' ORDER BY md.match_date DESC;";
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getApprovedLiveMatch()
	{
		$sql = "SELECT id, type FROM match_details md WHERE display_status = 'inprogress' AND opening_soon = 1 ORDER BY md.match_date DESC;";
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getPreviousMatches($limit = 10, $id = NULL)
	{
		$sql = 'SELECT t1.`flag_url` AS `t1flag`, t2.`flag_url` AS `t2flag`, t1.`teamname` AS `t1name`, t2.`teamname` AS `t2name`,
				t1.`team_nickname` AS `team1`, t2.`team_nickname` AS `team2`, s1.`score` AS `t1score`, s2.`score` AS `t2score`,
				s1.`wickets` AS `t1wickets`, s2.`wickets` AS `t2wickets`, s1.`overs` AS `t1overs`, s2.`overs` AS `t2overs`,
				s3.`score` AS `t3score`, s4.`score` AS `t4score`, s3.`wickets` AS `t3wickets`, s4.`wickets` AS `t4wickets`, 
				s3.`overs` AS `t3overs`, s4.`overs` AS `t4overs`, md.`id` AS `match_id`, 
 			    v.`city`, md.`match_date`, v.`venue`, t.`tournament_name`, md.`match_name` FROM `match_details` md
				INNER JOIN tournament_details t ON t.id = md.tour_id
				INNER JOIN `team_details` t1 ON t1.id = md.team1
				INNER JOIN `team_details` t2 ON t2.id = md.team2
				LEFT OUTER JOIN `livescore_details` s1 ON s1.team_id = t1.id AND s1.match_id = md.id AND s1.inngings = 1
				LEFT OUTER JOIN `livescore_details` s2 ON s2.team_id = t2.id AND s2.match_id = md.id AND s2.inngings = 1
				LEFT OUTER JOIN `livescore_details` s3 ON s3.team_id = t1.id AND s3.match_id = md.id AND s3.inngings = 2
				LEFT OUTER JOIN `livescore_details` s4 ON s4.team_id = t2.id AND s4.match_id = md.id AND s4.inngings = 2
				INNER JOIN `venue_details` v ON v.id = md.venue_id WHERE md.display_status = \'finished\'';
		if($id)
			$sql .= ' AND md.id = '.$id;
		$sql .=  'ORDER BY md.match_date DESC LIMIT '.$limit.';';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getMatchResults($limit = NULL)
	{
		$sql = "SELECT * FROM match_details md WHERE display_status = 'finished' ORDER BY md.match_date DESC";
		if($limit)
			$sql .= ' LIMIT '.$limit.';';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getMatchPlayerStats($matchId)
	{
		$sql = 'SELECT p.id AS id, player_name, ifnull((pp.runs),0) AS runs, ifnull((pp.balls),0) AS balls, ifnull((fours),0) AS fours,
				ifnull((sixs),0) AS sixs, ifnull((wickets),0) AS wickets, ifnull((maiden),0) AS maiden, ifnull((bd.balls),0) AS overs, ifnull((wide),0) AS wide, ifnull((bd.no_balls),0) AS no_balls,
				ifnull((bd.runs),0) AS rungiven,ifnull((pd.caught),0) AS caught,ifnull((pd.stumped),0) AS stumped, ifnull((pd.runout),0) AS runout, photo_url
        		FROM `match_details` m
        		INNER JOIN `match_players_details` pd ON pd.match_id = m.id
				INNER JOIN `players` p ON p.id = pd.player_id
		        LEFT OUTER JOIN `match_players_performance` pp ON pp.match_id = m.id AND pp.player_id = pd.player_id
				LEFT OUTER JOIN `match_bowler_details` bd ON bd.match_id = m.id AND bd.player_id = pd.player_id 
       			WHERE m.id = '.(int)$matchId;
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getMatchFromDate($from, $to, $series = NULL)
	{
	
		if(date('Ymd') == date('Ymd', strtotime($from)))
			$from = date('Y-m-d H:i:s');
		$sql = 'SELECT md.type,md.match_date,t1.flag_url AS t1flag, t2.flag_url AS t2flag, t1.teamname AS t1name, t2.teamname AS t2name, 
				t1.team_nickname AS team1, t2.team_nickname AS team2, md.id AS id, opening_soon FROM match_details md
				INNER JOIN team_details t1 ON t1.id = md.team1
				INNER JOIN team_details t2 ON t2.id = md.team2
				INNER JOIN venue_details v ON v.id = md.venue_id 
				WHERE match_date > '.strtotime($from.'+59minutes').' AND match_date < '.strtotime($to.'+23hours +59minutes').' AND (md.opening_soon = 0 OR md.opening_soon = 1) ';
		if($series)
			$sql .= ' AND md.tour_id = '.$series.' ';
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getSeries()
	{
		$now = strtotime(date('Y-m-d'));
		$sql = 'SELECT * FROM tournament_details WHERE end_date > '.$now.' AND create_status = 1';
		return Db::getInstance()->ExecuteS($sql);
	}
}