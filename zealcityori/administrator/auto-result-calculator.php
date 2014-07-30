<?php
include "header.php";
require('classes/prizeSplitter.php');
$sql = 'SELECT * FROM coc_tournament WHERE `status` = \'calculated\' WHERE id=285 LIMIT 1';
$result = mysql_fetch_array(mysql_query($sql));
$tid= $result['id'];
	$sql1="select t.id, ef.winner_coin, ef.participent_coin, tp.prize from coc_tournament as t
		INNER JOIN coc_tournament_prize tp ON tp.tournament_id = t.id
		inner join coc_entry_fee as ef on ef.id=t.entry_fee_id
		where t.`status`='calculated' AND t.id='".$tid."'";
	$res=mysql_fetch_array(mysql_query($sql1));

	$oldcoin=$res['winner_coin'];
	$partCoin = $res['participent_coin'];
	$prizes = explode(',', $res['prize']);
	echo $sql1;exit;
	$sql2="SELECT (test.run+test.captain_run+test.coach_run) AS run,test.coach_run, test.username,test.tournament_id,test.user_id FROM 
			(select t.id as tournament_id,jt.user_id,tp.player_id,jt.captain,sum(mp.run) AS run,u.username as username,u.coin,ef.winner_coin,
			(SELECT sum(run) FROM coc_match_points WHERE player_id = jt.captain AND match_id=t.match_id) AS captain_run,
      		if(st.team_id=md.won_team_id,20,0) AS coach_run from coc_tournament as t
			left outer  join coc_joined_tournament as jt on jt.tournament_id=t.id
			left outer join coc_tournament_player as tp on tp.join_id=jt.id
			left outer join coc_match_points as mp on mp.player_id=tp.player_id
			left outer join coc_users as u on u.id=jt.user_id
     		left outer join match_details md on md.id = t.match_id
			left outer join squard_team st on st.coach_id = jt.coach and st.team_id = md.won_team_id and st.squard_type = md.`type`
			left outer join coc_entry_fee as ef on ef.id=t.entry_fee_id where t.id='".$tid."' and mp.match_id=t.match_id
			group by user_id order by run desc) test order by run DESC";
	$result = mysql_query($sql2);
	$count=1;
	$money="";
	$cash="";
	$updatecah="";
	$sql4="INSERT INTO coc_user_runs(user_id,tournament_id,runs) VALUES";
	$userIds = '';
	$details = array();
	while($result1=mysql_fetch_array($result))
	{
		$userIds .= $result1['user_id'].',';
		$sql4.="('".$result1['user_id']."','".$result1['tournament_id']."','".$result1['run']."'),";
		$details[$count]['run'] = $result1['run'];
		$details[$count]['user_id'] = $result1['user_id'];
		$details[$count]['tournament_id'] = $result1['tournament_id'];
		$count++;
	}
	if(count($prizes) > 0)
		updatePrizes($details, $prizes, $oldcoin);
	$sql4=substr($sql4,0,-1);
	//mysql_query($sql4);
	$userIds = substr($userIds, 0, -1);
	$sql="UPDATE coc_tournament SET `status` = 'completed' WHERE id = '".$tid."'";
	//mysql_query($sql);
	$sql = 'UPDATE coc_users SET coin = coin + '.$partCoin.' WHERE id IN ('.$userIds.')';
	//mysql_query($sql);
	//header("Location: calculate_leaderboard.php");
?>