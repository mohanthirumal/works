<?php
include "header.php";
$tid=$_REQUEST['tid'];
	$sql="select t.id,t.name as tournament_name,k.percentage as kitty,ef.amount as entryfee,ef.winner_coin,p.player as noofplayers,pp.name as prize,
		pp.prize_amount as prize_amount from coc_tournament as t 
		inner join coc_kitty as k on k.id=t.kitty_id
		inner join coc_entry_fee as ef on ef.id=t.entry_fee_id
		inner join coc_prize_pool as pp on pp.id=t.prize_id
		inner join coc_players as p on p.id=t.player_id WHERE t.id='".$tid."'";
	$res=mysql_fetch_array(mysql_query($sql));
	$nop=$res['noofplayers'];
	$efee=$res['entryfee'];
	$kitty=$res['kitty'];
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
	
	echo $res['tournament_name'] . " --  " . $res['prize'];
	echo '
    <table id="leader_board" cellpadding="5px" cellspacing="0" border="1">
        <tr>
            <td width="100">Username</td>
            <td width="60">Run</td>
            <td width="50">Rank</td>
            <td>Prize</td>
			<td>Coins</td>
        </tr>
	';
	/*$sql1="SELECT (test.run+test.captain_run+test.coach_run) AS run,test.coach_run, test.username,test.winner_coin FROM 
			(select t.id as tournament_id,jt.user_id,tp.player_id,jt.captain,sum(mp.run) AS run,u.username as username,u.coin,ef.winner_coin,
			(SELECT sum(run) AS run FROM coc_match_points WHERE player_id = jt.captain AND match_id=t.match_id) AS captain_run,
     		if(st.team_id=md.won_team_id,20,0) AS coach_run from coc_tournament as t
			left outer  join coc_joined_tournament as jt on jt.tournament_id=t.id
			left outer join coc_tournament_player as tp on tp.join_id=jt.id
			left outer join coc_match_points as mp on mp.player_id=tp.player_id
			left outer join coc_users as u on u.id=jt.user_id
      		left outer join match_details md on md.id = t.match_id
			left outer join squard_team st on st.coach_id = jt.coach and st.team_id = md.won_team_id and st.squard_type = md.`type`
			left outer join coc_entry_fee as ef on ef.id=t.entry_fee_id where t.id='".$tid."' and mp.match_id=t.match_id
			group by user_id order by run desc) test order by run DESC";*/
			
	$sql1 ="SELECT u.id AS user_id,u.username,uc.connect_id,u.cash,u.coin,ur.runs as run,ur.tournament_id,ef.winner_coin FROM coc_user_runs ur
			INNER JOIN coc_users u ON u.id = ur.user_id
			LEFT OUTER JOIN coc_users_connect uc ON uc.user_id = u.id AND uc.`type` = 'facebook'
			INNER JOIN coc_tournament t ON t.id = ur.tournament_id
			INNER JOIN coc_entry_fee ef ON ef.id = t.entry_fee_id
			WHERE ur.tournament_id= '".$tid."' ";
	$result = mysql_query($sql1);
	$count=1;
    while($result1 = mysql_fetch_array($result))
	{
		echo '
			<tr>
				<td>'.$result1['username'].'</td>
				<td>'.$result1['run'].'</td>
				<td>'.$count.'</td>
				<td>Rs.'.(isset($prizes[$count]) ? $prizes[$count] : '---').'</td>
				<td>
					'.(($count==1) ? $result1['winner_coin'] : '---').'
				</td>
			</tr>
		';
		$count++;
	}
	if(isset($_POST['submit']))
    {
		header("Location: tournament_result.php");
    }
	echo "
		</table>
			<br/><br/>
		";

?>
