<?php
class LiveScore extends ObjectModel
{
	public $id;
	public $batting;
	public $bowling;
	public $currentInnings;
	public $score;
	public $wickets;
	public $overs;
	public $match;
	public $innings;
	public $status;
	
	public function __construct($match_id = NULL)
	{
		if($match_id)
			$this->liveScore($match_id);
	}
	
	public function liveScore($match_id)
	{
		$this->getBattingTeam($match_id);
		$sql = "SELECT * FROM livescore_details 
				WHERE match_id = '".$match_id."' AND inngings = '".$this->currentInnings."' AND team_id = ".(int)($this->batting->id);
		$matchScore = Db::getInstance()->getRow($sql);
		$this->match = new Matches($match_id);
		$this->score = $matchScore['score'];
		$this->wickets = $matchScore['wickets'];
		$this->overs = (int)($matchScore['overs']/6).'.'.($matchScore['overs']%6);
		$this->innings = $this->getInningScore($match_id);
		$this->status = $this->scoredifferent($match_id);
	}
	
	public function getBattingTeam($match_id)
	{
		$match = new Matches($match_id);
		$sql = "SELECT * FROM battingteam WHERE match_id = ".$match_id;
		$batting = Db::getInstance()->getRow($sql);
		if($batting)
		{
			$this->batting = new Teams($batting['batting']);
			$this->bowling = (($match->team1 == $batting['batting']) ? new Teams($match->team2) : new Teams($match->team1));
			$this->currentInnings = $batting['inn_id'];
		}
	}
	
	public function getInningScore($match_id)
	{
		$sql = "SELECT * FROM livescore_details 
				WHERE match_id = '".$match_id."' AND inngings <= '".$this->currentInnings."'";
		$results = Db::getInstance()->ExecuteS($sql);
		$innings = array();
		if($results)
		{
			foreach($results as $result)
				$innings[$result['team_id']][$result['inngings']] = $result;
		}
		
		return $innings;
	}
	
	public function getConsFour($match_id, $player_id)
	{
		$sql = 'SELECT sum(fourcount) AS four FROM (select *,@id, if(run_formate = \'4\' OR run_formate = \'4nb\',@four_count := @four_count + 1,@four_count := 0) AS four,if(@four_count%3=0 AND @four_count <> 0, 1,0) AS fourcount, @id := id from text_commentary_wagonwheel,
				(SELECT @four_count := 0, @id := 0, @four_num := 0) test where batman_id = '.$player_id.' AND match_id = '.$match_id.') t GROUP BY batman_id';
		return Db::getInstance()->getValue($sql);
	}
	
	public function getConsSix($match_id, $player_id)
	{
		$sql = 'SELECT sum(fourcount) AS four FROM (select *,@id, if(run_formate = \'6\' OR run_formate = \'6nb\',@four_count := @four_count + 1,@four_count := 0) AS four,if(@four_count%3=0 AND @four_count <> 0, 1,0) AS fourcount, @id := id from text_commentary_wagonwheel,
				(SELECT @four_count := 0, @id := 0, @four_num := 0) test where batman_id = '.$player_id.' AND match_id = '.$match_id.') t GROUP BY batman_id';
		return Db::getInstance()->getValue($sql);
	}
	
	public function  scoredifferent($matchId)
	{
	
			$sql="SELECT * FROM match_details WHERE id ='".$matchId."'";
		$result=mysql_fetch_array(mysql_query($sql));
		$matchtype=$result['type'];
		if($result['resultstatus'] != '')
		{
			return $result['resultstatus'];
		}
		$manofthematchstr='';
		$manofmatch=$result['man_of_the_match'];
		if($manofmatch != '')
		{
			$manofthematchstr='( Man of the match : '.$manofmatch.'  )';
		}
		if($result['resultstatus'] == '')
		{
		$sql="SELECT * FROM team_inngings_details WHERE match_id='".$matchId."' ORDER BY id ASC ";
		$result=mysql_query($sql);
		$count=1;
		while($row=mysql_fetch_array($result))
		{
			$team[$count]=$row['team_id'];
			$count++;
		}
		$resultSet=mysql_num_rows($result);
		if($resultSet == 3 && $matchtype == 'test')
		{
			if($team[2] == $team[3])
			{
				$sql="SELECT * FROM livescore_details  INNER JOIN team_details ON team_details.id='".$team[1]."' WHERE match_id='".$matchId."' AND team_id='".$team[1]."' AND inngings='1'";
				$row1=mysql_fetch_array(mysql_query($sql));
				$sql="SELECT * FROM livescore_details  INNER JOIN team_details ON team_details.id='".$team[2]."' WHERE match_id='".$matchId."' AND team_id='".$team[2]."' AND inngings='1'";
				$row2=mysql_fetch_array(mysql_query($sql));
				$sql="SELECT * FROM livescore_details INNER JOIN team_details ON team_details.id='".$team[3]."'  WHERE match_id='".$matchId."' AND team_id='".$team[3]."' AND inngings='2'";
				$row3=mysql_fetch_array(mysql_query($sql));
					if( $row3['follow_on'] == 1)
					{
						if($row1['score'] >  ($row2['score']+$row3['score']) && $row3['wickets'] =='10' )
						{
							$str=ucfirst($row1['teamname']).'&nbsp;won by  an innings&nbsp; & &nbsp'.($row1['score']-($row2['score']+$row3['score'] )).'&nbsp;runs';
						}
						else if($row1['score'] > ($row2['score']+$row3['score'] ))
						{
							$str= ucfirst($row3['teamname']).'&nbsp;Trial By '.($row1['score']-($row2['score']+$row3['score'])).' Runs';
						}
						else if($row1['score'] == ($row2['score']+$row3['score']) && $row3['wickets'] ==10 )
						{
						$str= ucfirst($row1['teamname']).'&nbsp;Require another &nbsp;1 Run';
						}
						else if($row1['score'] == $row2['score']+$row3['score'])
						{
							$str='Score level';
						}
						else if($row1['score'] < $row2['score']+$row3['score'])
						{
						$str= ucfirst($row3['teamname']).'&nbsp;Lead By '.($row3['score']+$row2['score']-$row1['score']).' Runs';
						}
					}
					else 
					{
						if($row1['score'] > ($row2['score']+$row3['score'] ))
						{
						$str= ucfirst($row3['teamname']).'&nbsp;Trial By '.($row1['score']-($row2['score']+$row3['score'])).' Runs';
						}
						else if($row1['score'] == $row2['score']+$row3['score'])
						{
							$str='Score level';
						}
						else if($row1['score'] < $row2['score']+$row3['score'])
						{
						$str= ucfirst($row3['teamname']).'&nbsp;Lead By '.($row3['score']+$row2['score']-$row1['score']).' Runs';
						}
						
					}
			}
			else if($team[2] != $team[3])
			{
				$sql="SELECT * FROM livescore_details  INNER JOIN team_details ON team_details.id='".$team[1]."' WHERE match_id='".$matchId."' AND team_id='".$team[1]."' AND inngings='1'";
				$row1=mysql_fetch_array(mysql_query($sql));
				$sql="SELECT * FROM livescore_details  INNER JOIN team_details ON team_details.id='".$team[2]."' WHERE match_id='".$matchId."' AND team_id='".$team[2]."' AND inngings='1'";
				$row2=mysql_fetch_array(mysql_query($sql));
				$sql="SELECT * FROM livescore_details INNER JOIN team_details ON team_details.id='".$team[3]."'  WHERE match_id='".$matchId."' AND team_id='".$team[3]."' AND inngings='2'";
				$row3=mysql_fetch_array(mysql_query($sql));
				 if($row2['score'] >  ($row1['score']+$row3['score'] ) && $row3['wickets'] =='10' )
				{
					$str=ucfirst($row2['teamname']).'&nbsp;won by innings&nbsp; & &nbsp'.($row2['score']-$row1['score']+$row3['score'] ).'runs';
				}
				else if($row2['score'] > ($row1['score']+$row3['score'] ))
				{
				$str= ucfirst($row2['teamname']).'&nbsp;Lead By '.($row2['score']-($row1['score']+$row3['score'])).' Runs';
				}
				else if($row2['score'] < ($row1['score']+$row3['score'] ))
				{
					$str=ucfirst($row3['teamname']).'&nbsp;Lead By &nbsp;'.($row1['score']+$row3['score']-$row2['score']).'Runs';
				}
				else if($row1['score'] == $row2['score']+$row3['score'])
				{
					$str='Score level';
				}
				else if($row1['score'] < $row2['score']+$row3['score'])
				{
				$str= ucfirst($row3['teamname']).'&nbsp;Lead By &nbsp;'.($row3['score']+$row2['score']-$row1['score']).' Runs';
				}
			}
			return $str;
		}
		else if($resultSet == 2 && $matchtype == 'test')
		{
			$sql="SELECT * FROM livescore_details  INNER JOIN team_details ON team_details.id='".$team[1]."' WHERE match_id='".$matchId."' AND team_id='".$team[1]."' AND inngings='1'";
			$row1=mysql_fetch_array(mysql_query($sql));
			$sql="SELECT * FROM livescore_details INNER JOIN team_details ON team_details.id='".$team[2]."'  WHERE match_id='".$matchId."' AND team_id='".$team[2]."' AND inngings='1'";
			$row2=mysql_fetch_array(mysql_query($sql));
			if($row1['score'] > $row2['score'] )
			{
			$str= ucfirst($row2['teamname']).'&nbsp;Trial By '.($row1['score']-$row2['score']).' Runs';
			}
			else if($row1['score'] == $row2['score'])
			{
				$str='Score level';
			}
			else if($row1['score'] < $row2['score'])
			{
			$str= ucfirst($row2['teamname']).'&nbsp;Lead By '.($row2['score']-$row1['score']).' Runs';
			}
			return $str;
		}
		else if($resultSet == 4 && $matchtype == 'test')
		{
			if($team[2] == $team[3])
			{
				$sql="SELECT * FROM livescore_details  INNER JOIN team_details ON team_details.id='".$team[1]."' WHERE match_id='".$matchId."' AND team_id='".$team[1]."' AND inngings='1'";
				$row1=mysql_fetch_array(mysql_query($sql));
				$sql="SELECT * FROM livescore_details  INNER JOIN team_details ON team_details.id='".$team[2]."' WHERE match_id='".$matchId."' AND team_id='".$team[2]."' AND inngings='1'";
				$row2=mysql_fetch_array(mysql_query($sql));
				$sql="SELECT * FROM livescore_details INNER JOIN team_details ON team_details.id='".$team[3]."'  WHERE match_id='".$matchId."' AND team_id='".$team[3]."' AND inngings='2'";
				
				$row3=mysql_fetch_array(mysql_query($sql));
				$target=($row3['score']+$row2['score']-$row1['score']);
			}
			else if($team[2] != $team[3])
			{
				$sql="SELECT * FROM livescore_details  INNER JOIN team_details ON team_details.id='".$team[1]."' WHERE match_id='".$matchId."' AND team_id='".$team[1]."' AND inngings='1'";
				$row1=mysql_fetch_array(mysql_query($sql));
				$sql="SELECT * FROM livescore_details  INNER JOIN team_details ON team_details.id='".$team[2]."' WHERE match_id='".$matchId."' AND team_id='".$team[2]."' AND inngings='1'";
				$row2=mysql_fetch_array(mysql_query($sql));
				$sql="SELECT * FROM livescore_details INNER JOIN team_details ON team_details.id='".$team[3]."'  WHERE match_id='".$matchId."' AND team_id='".$team[3]."' AND inngings='2'";
				$row3=mysql_fetch_array(mysql_query($sql));
				$target=($row1['score']+$row3['score']-$row2['score']);

				
			}
				$sql="SELECT * FROM livescore_details INNER JOIN team_details ON team_details.id='".$team[4]."'  WHERE match_id='".$matchId."' AND team_id='".$team[4]."' AND inngings='2'";
				
				$row4=mysql_fetch_array(mysql_query($sql));
				if($row4['score'] > $target && $row4['wickets'] == 10)
				{
					$str= ucfirst($row4['teamname']).'&nbsp;won ';

				}
				else if($row4['score'] == $target && $row4['wickets'] == 10)
				{
					$str= 'Match tied';

				}
				else if($row4['score'] < $target && $row4['wickets'] == 10)
				{
					$str= ucfirst($row1['teamname']).'&nbsp;won by &nbsp;'.($target-$row4['score']).'&nbsp;Runs';

				}
				else if($row4['score'] > $target && $row4['wickets'] < 10)
				{
					$str= ucfirst($row4['teamname']).'&nbsp;won by &nbsp;'.(10-$row4['wickets'] ).'&nbsp;wickets';
				}
				else if($row4['score'] < $target)
				{
					$str= ucfirst($row4['teamname']).'&nbsp;Require another &nbsp;'.($target+1-$row4['score']).'&nbsp;runs';

				}
				else if($row1['score'] == ($row2['score']+$row3['score']) && $row3['wickets'] ==10 )
				{
				$str= ucfirst($row1['teamname']).'&nbsp;require another &nbsp;1 run';
				}
				else if( $row4['score'] == $target)
				{
					$str="Score Level";
				}
			return $str;
		}
		
		else if($resultSet == 2 && $matchtype == 'test')
		{
			$sql="SELECT * FROM livescore_details  INNER JOIN team_details ON team_details.id='".$team[1]."' WHERE match_id='".$matchId."' AND team_id='".$team[1]."' AND inngings='1'";
			$row1=mysql_fetch_array(mysql_query($sql));
			$sql="SELECT * FROM livescore_details INNER JOIN team_details ON team_details.id='".$team[2]."'  WHERE match_id='".$matchId."' AND team_id='".$team[2]."' AND inngings='1'";
			$row2=mysql_fetch_array(mysql_query($sql));
			if($row1['score'] > $row2['score'] )
			{
			$str= ucfirst($row2['teamname']).'&nbsp;Trial By '.($row1['score']-$row2['score']).' Runs';
			}
			else if($row1['score'] == $row2['score'])
			{
				$str='Score level';
			}
			else if($row1['score'] < $row2['score'])
			{
			$str= ucfirst($row2['teamname']).'&nbsp;Lead By '.($row2['score']-$row1['score']).' Runs';
			}
			return $str;
		}
		else if($resultSet==2 && $matchtype != 'test')
		{
			$overs='';
			$sql="SELECT * FROM livescore_details  INNER JOIN team_details ON team_details.id='".$team[1]."' WHERE match_id='".$matchId."' AND team_id='".$team[1]."' AND inngings='1'";
			$row1=mysql_fetch_array(mysql_query($sql));
			$sql="SELECT * FROM livescore_details INNER JOIN team_details ON team_details.id='".$team[2]."'  WHERE match_id='".$matchId."' AND team_id='".$team[2]."' AND inngings='1'";
			$row2=mysql_fetch_array(mysql_query($sql));
			
			$dl='';
			if($row1['d_l'] == '1')
			{
				$dl='(D/L)';
			}
			
			
			if($matchtype == '50-50')
			{
				$overs=$row1['def_overs']-$row2['overs'];
			}
			else if($matchtype == '20-20')
			{
				$overs=$row1['def_overs']-$row2['overs'];
			}
			$reqover=floor($overs/6).'.'.$overs%6;
			$runs=$row1['score']-$row2['score'];
			if( $reqover ==0.0)
			{
				$reqrate=0.0;
			}
			else
			{
				if($row1['d_l'] == '1')
				{
				$reqrate=($row1['score_one']-$row2['score_one'])/$reqover;
				$target=$row1['score_one']-$row2['score'];
				}
				else
				{
				$target=$row1['score_one']+1-$row2['score'];
				$reqrate=($row1['score_one']+1-$row2['score_one'])/$reqover;
				}
			}
			 if($row1['score_one']-$row2['score'] < 0)
			 {
				 if($overs == 1)
				 {
					 $b='ball';
				 }
				 else
				 {
					 $b='balls';
				 }
				 $wks=(10-$row2['wickets']);
				 if($wks ==1)
				 {
					 $strwkt='wicket';
				 }
				 else
				 {
					  $strwkt='wickets';
				 }
				$str= ucfirst($row2['teamname']).'&nbsp;won by&nbsp;'.(10-$row2['wickets']).' '.$strwkt.'&nbsp;with'.'&nbsp;'.$overs.'&nbsp;'.$b.'&nbspRemaining&nbsp;'.$dl.'  '.$manofthematchstr;
			 }
			else  if(($row1['score_one'] == $row2['score']) && ($overs == 0 || $row2['wickets'] ==10) )
			 {
				 $str ="Match tied";
			 }
			else  if($row1['score_one'] == $row2['score'])
			 {
				 $str ="Score Level";
			 }
			 else if($row1['score_one'] > $row2['score_one'] && $overs == 0  )
			 {
				 $differRuns=$row1['score_one']-$row2['score_one'];
				 if($differRuns == 1)
				 {
					 $b='run';
				 }
				 else
				 {
					 $b='runs';
				 }
				$str= ucfirst($row1['teamname']).'&nbsp;won by&nbsp;'.$differRuns.' '.$b.'&nbsp;'.$manofthematchstr;
			 }
			else if( $overs < '0' || $row2['wickets'] == '10' )
			 {
				$str= ucfirst($row1['teamname']).'&nbsp;won by&nbsp;'.($target-1).'&nbsp;runs&nbsp;'.$dl.'  '.$manofthematchstr;
			 }
			 else
			 {
				 if($overs == 1)
				 {
					 $b='ball';
				 }
				 else
				 {
					 $b='balls';
				 }
				$str= ucfirst($row2['teamname']).'&nbsp;require another '.$target.' runs&nbsp;in'.'&nbsp;'.$overs.'&nbsp;'.$b.' &nbsp;'.$dl.'&nbsp &nbsp &nbsp &nbsp;Required runrate &nbsp;'.number_format($reqrate,2).'';
			 }
			return $str;
		}
		}
		else
		{
			return $result['resultstatus'];
		}
	}
}