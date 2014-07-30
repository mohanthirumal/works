<?php
include "header.php";
require('classes/prizeSplitter.php');
$sql = 'SELECT * FROM coc_tournament WHERE `status` = \'calculated\' ORDER BY endtime LIMIT 1';
$result = mysql_fetch_array(mysql_query($sql));
$tid= $result['id'];
	$sql1="select t.id,k.percentage as kitty,ef.amount as entryfee,ef.winner_coin,ef.participent_coin,p.player as noofplayers,pp.name as prize,
		pp.prize_amount as prize_amount from coc_tournament as t
		inner join coc_kitty as k on k.id=t.kitty_id
		inner join coc_entry_fee as ef on ef.id=t.entry_fee_id
		inner join coc_prize_pool as pp on pp.id=t.prize_id
		inner join coc_players as p on p.id=t.player_id where t.`status`='calculated' AND t.id='".$tid."'";
	$res=mysql_fetch_array(mysql_query($sql1));
	$nop=$res['noofplayers'];
	$efee=$res['entryfee'];
	$kitty=$res['kitty'];
	$oldcoin=$res['winner_coin'];
	$partCoin = $res['participent_coin'];
	$totalamt=$nop*$efee;
	$kittycommision=round(($totalamt*$kitty)/100);
	$playerprize=$totalamt-$kittycommision;
	$prizes_array = array();
	$prizes = array();
	
	if($res['entryfee'] == 0)
	{
		$prizes_array = explode(',',$res['prize_amount']);
		for($i=1;$i<=count($prizes_array);$i++)
		{
			$prizes[$i] = $prizes_array[$i-1];
		}
	}
	else
	{
		if($res['prize']=='Top 3')
		{
			if($nop>15)
			{
				$prizes[1]=round(($playerprize*50)/100);
				$prizes[2]=round(($playerprize*30)/100);
				$prizes[3]=round(($playerprize*20)/100);
			}
			else
			{
				$prizes[1]=round(($playerprize*66)/100);
				$prizes[2]=round(($playerprize*33)/100);
			}
		}
		else if($res['prize']=='Winner takes all')
		{
			$prizes[1]=round($playerprize);
		}
		else if($res['prize']=='Top few')
		{
			$prizes[1]=round(($playerprize*33)/100);
			$prizes[2]=round(($playerprize*22)/100);
			$prizes[3]=round(($playerprize*16)/100);
			$prizes[4]=round(($playerprize*12)/100);
			$prizes[5]=round(($playerprize*10)/100);
			$prizes[6]=round(($playerprize*7)/100);
		}
		else if($res['prize']=='Free Prize')
		{
			$prizes[1] = 50;
			$prizes[2] = 50;
			$prizes[3] = 50;
		}
	}
	
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