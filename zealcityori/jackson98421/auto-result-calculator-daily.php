<?php
include "header.php";
require('classes/prizeSplitter.php');
$sql = 'SELECT * FROM coc_tournament WHERE `status` = \'calculated\' LIMIT 1';
$result = mysql_fetch_array(mysql_query($sql));
if(isset($result['id']))
{
$tid= $result['id'];
$sql = "SELECT t.id, ef.winner_coin, ef.participent_coin, tp.prize FROM coc_tournament as t
		INNER JOIN coc_tournament_prize tp ON tp.tournament_id = t.id
		INNER JOIN coc_entry_fee as ef ON ef.id=t.entry_fee_id
		WHERE t.`status`='calculated' AND t.id='".$tid."'";
$res = mysql_fetch_array(mysql_query($sql));
$winCoin = $res['winner_coin'];
$parCoin = $res['participent_coin'];
$prizes = explode(',', $res['prize']);
$sql = "SELECT (test.run+test.captain_run+test.coach_run) AS run,test.coach_run, test.username,test.tournament_id,test.user_id,test.name,test.cash FROM 
		(SELECT t.id as tournament_id,jt.user_id,tp.player_id,jt.captain,sum(mp.run) AS run,u.username AS username,u.coin,ef.winner_coin,t.name,u.cash,
		(SELECT SUM(run) FROM coc_match_points WHERE player_id = jt.captain AND match_id=t.match_id) AS captain_run,
		if(st.team_id=md.won_team_id,20,0) AS coach_run FROM coc_tournament as t
		LEFT OUTER  JOIN coc_joined_tournament as jt ON jt.tournament_id=t.id
		LEFT OUTER  JOIN coc_tournament_player as tp ON tp.join_id=jt.id
		LEFT OUTER  JOIN coc_match_points as mp ON mp.player_id=tp.player_id
		LEFT OUTER  JOIN coc_users as u ON u.id=jt.user_id
		LEFT OUTER  JOIN match_details md ON md.id = t.match_id
		LEFT OUTER  JOIN squard_team st ON st.coach_id = jt.coach AND st.team_id = md.won_team_id AND st.squard_type = md.`type`
		LEFT OUTER  JOIN coc_entry_fee as ef ON ef.id=t.entry_fee_id where t.id='".$tid."' and mp.match_id=t.match_id
		GROUP BY user_id order by run desc) test ORDER BY run DESC";
	$result = mysql_query($sql);
	$count = 1;
	$sql = "INSERT INTO coc_user_runs(user_id, tournament_id, runs, position) VALUES";
	$userIds = '';
	$details = array();
	while($result1=mysql_fetch_array($result))
	{
		$userIds .= $result1['user_id'].',';
		$sql .= "('".$result1['user_id']."','".$result1['tournament_id']."','".$result1['run']."', ".$count."),";
		$details[$count]['run'] = $result1['run'];
		$details[$count]['user_id'] = $result1['user_id'];
		$details[$count]['tournament_id'] = $result1['tournament_id'];
		$details[$count]['tname'] = $result1['name'];
		$details[$count]['cash'] = $result1['cash'];
		$count++;
	}
	if(count($prizes) > 0 && count($details) > 0)
	{
		updatePrizes($details, $prizes, $winCoin);
	$sql = substr($sql, 0, -1);
	//mysql_query($sql);
	$userIds = substr($userIds, 0, -1);
	$sql="UPDATE coc_tournament SET `status` = 'completed' WHERE id = '".$tid."'";
	//mysql_query($sql);
	$sql = 'UPDATE coc_users SET coin = coin + '.$parCoin.' WHERE id IN ('.$userIds.')';
	//mysql_query($sql);
	}
	//header("Location: calculate_leaderboard.php");
}
?>
<html>
<head>
<meta http-equiv="refresh" content="30">
</head>
<body>
	<h1>Auto Refresh page content</h1>
</body>
</html>