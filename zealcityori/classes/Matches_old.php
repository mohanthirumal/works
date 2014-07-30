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
				v.city, md.match_date FROM match_details md
				INNER JOIN team_details t1 ON t1.id = md.team1
				INNER JOIN team_details t2 ON t2.id = md.team2
				INNER JOIN venue_details v ON v.id = md.venue_id WHERE display_status = \'future\' ORDER BY md.match_date';
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
		return Db::getInstance()->ExecuteS($sql);
	}
	
	public function getLiveMatch()
	{
		$sql = "SELECT * FROM match_details md WHERE display_status = 'inprogress' ORDER BY md.match_date DESC;";
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
	
}