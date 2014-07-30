<?php
include "header.php";
require('classes/RunCalculator.php');
if(isset($_REQUEST['id']) && strlen($_REQUEST['id']) > 0)
{
	$matchId = $_REQUEST['id'];
	$innId = $_REQUEST['inn'];
	$val = 1;	
	$count = 1;
	echo '
		<table border="1" cellpadding="5px" cellspacing="0">
			<tr>
				<td>S.No</td>
				<td>Match ID</td>
				<td>Player ID</td>
				<td>Player Name</td>				
				<td>Batting</td>
				<td>Bowling</td>
				<td>Fielding</td>
				<td>Total</td>
			</tr>
	';
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
		//$sql = "INSERT INTO coc_match_points(match_id, player_id, inn_id, run,batting,bowling,fielding) VALUES";
		foreach($team1 as $team)
		{
			$sql1 =  " SELECT player_name from players WHERE id = ".$team."";
			$pres = mysql_fetch_array(mysql_query($sql1));
			
			$run = $calculator->calculate($matchId, $team, $innId);
			$tot_run = $run['batting'] + $run['bowling'] + $run['fielding'];
			echo '
				<tr>
					<td>'.$count.'</td>
					<td>'.$matchId.'</td>
					<td>'.$team.'</td>
					<td><b>'.$pres['player_name'].'</b></td>
					<td>'.$run['batting'].'</td>
					<td>'.$run['bowling'].'</td>
					<td>'.$run['fielding'].'</td>
					<td>'.$tot_run.'</td>
			';
			$count++;
		}
		foreach($team2 as $team)
		{
			$sql1 =  " SELECT player_name from players WHERE id = ".$team."";
			$pres = mysql_fetch_array(mysql_query($sql1));
			
			$run = $calculator->calculate($matchId, $team, $innId);
			$tot_run = $run['batting'] + $run['bowling'] + $run['fielding'];
			echo '
				<tr>
					<td>'.$count.'</td>
					<td>'.$matchId.'</td>
					<td>'.$team.'</td>
					<td><b>'.$pres['player_name'].'</b></td>					
					<td>'.$run['batting'].'</td>
					<td>'.$run['bowling'].'</td>
					<td>'.$run['fielding'].'</td>
					<td>'.$tot_run.'</td>
			';
			$count++;
		}
	}
	else
	{
		$sql = "SELECT mp.player_id,p.player_name,mp.match_id,mp.batting,mp.bowling,mp.fielding,mp.run AS total FROM coc_match_points mp
				INNER JOIN players p ON p.id = mp.player_id WHERE match_id = ".$matchId;
		$result = mysql_query($sql);
		while($res = mysql_fetch_array($result))
		{
			echo '
				<tr>
					<td>'.$count.'</td>
					<td>'.$matchId.'</td>
					<td>'.$res['player_id'].'</td>
					<td><b>'.$res['player_name'].'</b></td>
					<td>'.$res['batting'].'</td>
					<td>'.$res['bowling'].'</td>
					<td>'.$res['fielding'].'</td>
					<td>'.$res['total'].'</td>
				</tr>
			';
			$count++;
		}
	}
	echo '</table>';
}