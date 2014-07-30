<?php
class PlayerBowlPerformance
{
	public $id;
	public $match_id;
	public $player_id;
	public $team_id;
	public $innginngs;
	public $maiden;
	public $balls;
	public $runs;
	public $wickets;
	public $caught;
	public $stumped;
	public $runout;
	public $wide;
	public $noball;
	
	public function __construct($match_id, $player_id, $inn_id)
	{
		/*$sql = "select bd.id,bd.match_id,bd.team_id,bd.innginngs,bd.player_id,bd.maiden,bd.balls,bd.runs,ifnull(sum(wide),0) AS wide,
				ifnull(sum(bd.no_balls),0) AS no_balls,bd.wickets,pd.caught,pd.stumped,pd.runout FROM match_bowler_details as bd
				left outer join match_players_details as pd on pd.player_id=bd.player_id and pd.match_id=bd.match_id and pd.team_id=bd.team_id				
				WHERE bd.match_id = '".$match_id."' AND bd.player_id = '".$player_id."' AND bd.innginngs = '".$inn_id."'";*/
		$sql = "select bd.id,pd.match_id,pd.team_id,pd.player_id,bd.innginngs,bd.maiden,bd.balls,bd.runs,bd.wickets,ifnull(sum(wide),0) AS wide,
				ifnull(sum(bd.no_balls),0) AS no_balls,pd.caught,pd.stumped,pd.runout from  match_players_details pd
				left outer join match_bowler_details bd on bd.player_id=pd.player_id and bd.match_id=pd.match_id and bd.team_id=pd.team_id
				where pd.match_id = '".$match_id."'  AND pd.player_id = '".$player_id."' ";
		$result = mysql_fetch_array(mysql_query($sql));
		$this->id = $result['id'];
		$this->match_id = $result['match_id'];
		$this->player_id = $result['player_id'];
		$this->team_id = $result['team_id'];
		$this->innginngs = $result['innginngs'];
		$this->maiden = $result['maiden'];
		$this->balls = $result['balls'];
		$this->runs = $result['runs'];
		$this->wickets = $result['wickets'];
		$this->stumped = $result['stumped'];
		$this->caught = $result['caught'];
		$this->runout = $result['runout'];
		$this->wide = $result['wide'];
		$this->noball = $result['no_balls'];
	}
}