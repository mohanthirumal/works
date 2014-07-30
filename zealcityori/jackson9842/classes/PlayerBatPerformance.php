<?php
class PlayerBatPerformance
{
	public $id;
	public $match_id;
	public $player_id;
	public $team_id;
	public $inngings;
	public $runs;
	public $balls;
	public $out;
	public $fours;
	public $sixs;
	public $dot_balls;
	public $bat_stricker;
	public $consfour;
	public $conssix;
	
	public function __construct($match_id, $player_id, $inn_id)
	{
		$sql = "SELECT * FROM match_players_performance 
				WHERE match_id = '".$match_id."' AND player_id = '".$player_id."' AND inngings = '".$inn_id."'";
		$result = mysql_fetch_array(mysql_query($sql));
		$this->id = $result['id'];
		$this->match_id = $result['match_id'];
		$this->player_id = $result['player_id'];
		$this->team_id = $result['team_id'];
		$this->inngings = $result['inngings'];
		$this->runs = $result['runs'];
		$this->balls = $result['balls'];
		$this->out = $result['out'];
		$this->fours = $result['fours'];
		$this->sixs = $result['sixs'];
		$this->dot_balls = $result['dot_balls'];
		$this->bat_stricker = $result['bat_stricker'];
		$this->consfour = $this->getConsFour($match_id, $player_id);
		$this->conssix = $this->getConsSix($match_id, $player_id);
	}
	
	public function getConsFour($match_id, $player_id)
	{
		$sql = 'SELECT sum(fourcount) AS four FROM (select *,@id, if(@id+1 = id,@four_count := @four_count + 1,@four_count := 1) AS four,if(@four_count%3=0, 
		@four_num := @four_num+1,0) AS fourcount, @id := id from text_commentary_wagonwheel,(SELECT @four_count := 0, @id := 0, @four_num := 0) test 
		where (run_formate = \'4\' OR run_formate = \'4nb\') AND batman_id = '.$player_id.' AND match_id = '.$match_id.') t GROUP BY batman_id';
		
		$sql = 'SELECT sum(fourcount) AS four FROM (select *,@id, if(run_formate = \'4\' OR run_formate = \'4nb\',@four_count := @four_count + 1,@four_count := 0) AS four,if(@four_count%3=0 AND @four_count <> 0, 1,0) AS fourcount, @id := id from text_commentary_wagonwheel,
				(SELECT @four_count := 0, @id := 0, @four_num := 0) test where batman_id = '.$player_id.' AND match_id = '.$match_id.') t GROUP BY batman_id';
		$rr=mysql_query($sql);
		$result1=mysql_fetch_array($rr);
		return $result1['four'];
	}
	
	public function getConsSix($match_id, $player_id)
	{
		$sql = 'SELECT sum(fourcount) AS four FROM (select *,@id, if(@id+1 = id,@four_count := @four_count + 1,@four_count := 1) AS four,if(@four_count%3=0,
		@four_num := @four_num+1,0) AS fourcount, @id := id from text_commentary_wagonwheel,(SELECT @four_count := 0, @id := 0, @four_num := 0) test 
		where (run_formate = \'6\' OR run_formate = \'6nb\') AND batman_id = '.$player_id.' AND match_id = '.$match_id.') t GROUP BY batman_id';
		
		$sql = 'SELECT sum(fourcount) AS four FROM (select *,@id, if(run_formate = \'6\' OR run_formate = \'6nb\',@four_count := @four_count + 1,@four_count := 0) AS four,if(@four_count%3=0 AND @four_count <> 0, 1,0) AS fourcount, @id := id from text_commentary_wagonwheel,
				(SELECT @four_count := 0, @id := 0, @four_num := 0) test where batman_id = '.$player_id.' AND match_id = '.$match_id.') t GROUP BY batman_id';
		$result2=mysql_fetch_array(mysql_query($sql));
		return $result2['four'];
	}
}