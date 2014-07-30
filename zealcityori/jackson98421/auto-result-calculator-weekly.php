<?php
include "header.php";
require('classes/prizeSplitter1.php');
$sql = 'SELECT t.id, pm.match_id FROM coc_period_tournament t
		INNER JOIN coc_pt_matches pm ON pm.pt_id = t.id WHERE pm.`status` = 5 AND t.status <> 4 LIMIT 1';
$result = mysql_fetch_array(mysql_query($sql));
if(isset($result['id']))
{
$tid = $result['id'];
$mid = $result['match_id'];
$sql = "SELECT t.id, ef.winner_coin, ef.participent_coin, tp.prize FROM coc_period_tournament as t
		INNER JOIN coc_pt_prize tp ON tp.pt_id = t.id
		INNER JOIN coc_entry_fee as ef ON ef.id=t.entry_fee_id
		WHERE t.id='".$tid."'";
$res = mysql_fetch_array(mysql_query($sql));
$winCoin = $res['winner_coin'];
$parCoin = $res['participent_coin'];
$prizes = explode(',', $res['prize']);
$sql = "SELECT (test.run+test.captain_run+test.coach_run) AS run,test.coach_run, test.username,test.pt_id,test.user_id, test.match_id,test.name,test.cash FROM 
		(SELECT t.id as pt_id,jt.user_id,tp.player_id,jt.captain,sum(mp.run) AS run,u.username AS username,u.coin,ef.winner_coin, jt.match_id,t.name,u.cash,
		(SELECT SUM(run) FROM coc_match_points WHERE player_id = jt.captain AND match_id=jt.match_id) AS captain_run,
		if(st.team_id=md.won_team_id,20,0) AS coach_run FROM coc_period_tournament as t
		INNER JOIN coc_pt_matches pm ON pm.pt_id = t.id
		LEFT OUTER  JOIN coc_pt_match_joined as jt ON jt.pt_id=t.id AND jt.match_id = pm.match_id
		LEFT OUTER  JOIN coc_pt_player as tp ON tp.join_id=jt.id
		LEFT OUTER  JOIN coc_match_points as mp ON mp.player_id=tp.player_id and mp.match_id=jt.match_id
		LEFT OUTER  JOIN coc_users as u ON u.id=jt.user_id
		LEFT OUTER  JOIN match_details md ON md.id = jt.match_id
		LEFT OUTER  JOIN squard_team st ON st.coach_id = jt.coach AND st.team_id = md.won_team_id AND st.squard_type = md.`type`
		LEFT OUTER  JOIN coc_entry_fee as ef ON ef.id=t.entry_fee_id where t.id='".$tid."' AND pm.match_id = ".$mid." 
		GROUP BY user_id order by run desc) test ORDER BY run DESC";
	$result = mysql_query($sql);
	$count = 1;
	$sql = "INSERT INTO coc_pt_user_runs(user_id, pt_id, match_id, runs, position) VALUES";
	$userIds = '';
	$details = array();
	while($result1 = mysql_fetch_array($result))
	{
		$userIds .= $result1['user_id'].',';
		$sql .= "('".$result1['user_id']."','".$result1['pt_id']."','".$result1['match_id']."','".$result1['run']."', ".$count."),";
		$details[$count]['run'] = $result1['run'];
		$details[$count]['user_id'] = $result1['user_id'];
		$details[$count]['pt_id'] = $result1['pt_id'];
		$details[$count]['tname'] = $result1['name'];
		$details[$count]['cash'] = $result1['cash'];
		$count++;
	}
	if(count($prizes) > 0 && count($details) > 0)
	{
		$sql = substr($sql, 0, -1);
		mysql_query($sql);
		$sql = 'UPDATE coc_pt_matches SET `status` = 3 WHERE match_id = '.$mid.' AND pt_id = '.$tid;
		mysql_query($sql);
		$sql = 'SELECT * FROM coc_pt_matches WHERE pt_id = '.$tid.' AND status <> 3';
		$count = mysql_num_rows(mysql_query($sql));
		if($count == 0)
		{
			if(isset($prizes[0]) && count($prizes[0]) > 0)
				updatePrizes($details, $prizes, $winCoin);
			$sql = 'SELECT user_id FROM coc_pt_joined WHERE pt_id = '.$tid;
			$resultRes = mysql_query($sql);
			while($result = mysql_fetch_array($resultRes))
			{
				$userIds .= $result['user_id'].',';
			}
			$userIds = substr($userIds, 0, -1);
			$sql = 'UPDATE coc_users SET coin = coin + '.$parCoin.' WHERE id IN ('.$userIds.')';
			mysql_query($sql);
			$sql = 'UPDATE coc_period_tournament SET `status` = 3 WHERE id = '.$tid;
			mysql_query($sql);
		}
	}
}
	//header("Location: calculate_leaderboard.php");
?>
<html>
<head>
<meta http-equiv="refresh" content="30">
</head>
<body>
	<h1>Auto Refresh page content</h1>
</body>
</html>