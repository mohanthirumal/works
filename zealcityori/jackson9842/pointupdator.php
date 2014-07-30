<?php
require('classes/RunCalculator.php');
include "header.php";
if(isset($_REQUEST['id']) && strlen($_REQUEST['id']) > 0)
{
	$matchId = $_REQUEST['id'];
	$innId = $_REQUEST['inn'];
	$sql = "SELECT * FROM coc_match_points WHERE match_id = ".$matchId." AND inn_id = ".$innId;
	if(mysql_num_rows(mysql_query($sql)) == 0)
	{				
		$sql = "SELECT t1.players_id AS team1, t2.players_id AS team2, md.type FROM match_details md
				INNER JOIN squard_team t1 ON t1.team_id = md.team1
				INNER JOIN squard_team t2 ON t2.team_id = md.team2
				WHERE md.id = ".$matchId." AND t1.squard_type = md.type AND t2.squard_type = md.type;";
		$result = mysql_fetch_array(mysql_query($sql));
		$calculator = new RunCalculator();
		$calculator->type = $result['type'];
		$team1 = explode(',', $result['team1']);
		$team2 = explode(',', $result['team2']);
		$sql = "INSERT INTO coc_match_points(match_id, player_id, inn_id, run,batting,bowling,fielding) VALUES";
		foreach($team1 as $team)
		{
			$run = $calculator->calculate($matchId, $team, $innId);
			$tot_run = $run['batting'] + $run['bowling'] + $run['fielding'];
			$sql .= "(".$matchId.", ".$team.", ".$innId.", ".$tot_run.",".$run['batting'].",".$run['bowling'].",".$run['fielding']."),";
		}	
		foreach($team2 as $team)
		{
			$run = $calculator->calculate($matchId, $team, $innId);
			$tot_run = $run['batting'] + $run['bowling'] + $run['fielding'];
			$sql .= "(".$matchId.", ".$team.", ".$innId.", ".$tot_run.",".$run['batting'].",".$run['bowling'].",".$run['fielding']."),";
		}
		$sql = substr($sql, 0, -1);
		mysql_query($sql);
		$sql = 'UPDATE coc_tournament SET `status` = \'calculated\' WHERE match_id = '.$matchId.' AND `status` = \'Closed\'';
		mysql_query($sql);
		header('Location: pointupdator.php');
	}
	else
		echo 'already calculated';
}
?>
<div style="clear:both;"></div>
<h2>Completed Matches</h2>
<table border="1" cellpadding="5px" cellspacing="0">
	<tr>
		<td>Match</td>
		<td>Date</td>
		<td>Type</td>
		<td>Calculator</td>
        <td>Players List</td>
	</tr>
<?php
$sql = "SELECT t1.teamname AS team1,t2.teamname AS team2, md.id AS id, md.type, md.match_date FROM match_details md
		INNER JOIN team_details t1 ON t1.id = md.team1
		INNER JOIN team_details t2 ON t2.id = md.team2 WHERE md.display_status = 'finished'";
$resultResource = mysql_query($sql);
while($result = mysql_fetch_array($resultResource))
{
	$sql = "SELECT * FROM coc_match_points WHERE match_id = ".$result['id']." AND inn_id = 1";
	$calculated = false;
	if(mysql_num_rows(mysql_query($sql)) != 0)
		$calculated = true;
	echo '
	<tr>
		<td>'.$result['team1'].' Vs '.$result['team2'].'</td>
		<td>'.date('d-m-Y', $result['match_date']).'</td>
		<td>'.$result['type'].'</td>
		<td>';
	if($calculated)
		echo 'Inning 1 Calculated';
	else
		echo '<input type="button" value="Calculate Innings1" onclick="window.location.href=\'?id='.$result['id'].'&inn=1\'"/>';
	if($result['type'] == 'test')
	{
		$sql = "SELECT * FROM coc_match_points WHERE match_id = ".$result['id']." AND inn_id = 2";
		$calculated = false;
		if(mysql_num_rows(mysql_query($sql)) != 0)
			$calculated = true;
		if($calculated)
			echo '&nbsp;&nbsp;Inning 2 Calculated';
		else
			echo '<input type="button" value="Calculate Innings2" onclick="window.location.href=\'?id='.$result['id'].'&inn=2\'"/>';		
	}
	echo '		
		</td>
	<td><a href="players_list.php?id='.$result['id'].'&inn=1" target="_blank"><input type="button" value="Players list"/></a>';
	if($result['type'] == 'test')
	{
		echo '<a href="players_list.php?id='.$result['id'].'&inn=2" target="_blank"><input type="button" value="Players list2"/></a>';
	}
	echo '
	</td>
	</tr>
	';
}?>
</table>