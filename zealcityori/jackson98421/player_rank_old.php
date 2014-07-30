<?php
include "header.php";
$tid=$_REQUEST['tid'];
	$sql="select t.id,t.name as tournament_name,k.percentage as kitty,ef.amount as entryfee,ef.winner_coin,p.player as noofplayers,pp.name as prize from coc_tournament as t 
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
	$prizes = array();
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
		$prizes[1]=$playerprize;
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
	
	else if($res['prize']=='Free Prize 100')
	{
		$prizes[1] = 100;
		$prizes[2] = 100;
		$prizes[3] = 100;
	}
	else if($res['prize']=='Free Prize 150')
	{
		$prizes[1] = 150;
		$prizes[2] = 150;
		$prizes[3] = 150;
	}
	else if($res['prize']=='Free Prize 250')
	{
		$prizes[1] = 250;
		$prizes[2] = 250;
	}
	else if($res['prize']=='Free Prize 500')
	{
		$prizes[1] = 500;
	}
	else if($res['prize']=='Free Prize 750')
	{
		$prizes[1] = 750;
	}
	else if($res['prize']=='Free Prize 150 - 2')
	{
		$prizes[1] = 150;
		$prizes[2] = 150;
	}
	else if($res['prize']=='Free Prize 100 - 2')
	{
		$prizes[1] = 100;
		$prizes[2] = 100;
	}
	else if($res['prize']=='Free Prize 100_50_2')
	{
		$prizes[1] = 100;
		$prizes[2] = 50;
	}
	else if($res['prize']=='Free Prize 600_300_150_100_50_25')
	{
		$prizes[1] = 600;
		$prizes[2] = 300;
		$prizes[3] = 150;
		$prizes[4] = 100;
		$prizes[5] = 50;
		$prizes[6] = 25;
		
	}
	else if($res['prize']=='Free Prize 250_150_100')
	{
		$prizes[1] = 250;
		$prizes[2] = 150;
		$prizes[3] = 100;
	}
	else if($res['prize']=='Free Prize 500_250_150_100_50_25')
	{
		$prizes[1] = 500;
		$prizes[2] = 250;
		$prizes[3] = 150;
		$prizes[4] = 100;
		$prizes[5] = 50;
		$prizes[6] = 25;
	}
	
	else if($res['prize']=='Top few 200_125_75_50_25_25')
	{
		$prizes[1] = 200;
		$prizes[2] = 125;
		$prizes[3] = 75;
		$prizes[4] = 50;
		$prizes[5] = 25;
		$prizes[6] = 25;
	}
	
	else if($res['prize']=='Free Prize 150_100_50')
	{
		$prizes[1] = 150;
		$prizes[2] = 100;
		$prizes[3] = 50;
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
	$sql1="SELECT (test.run+test.captain_run+test.coach_run) AS run,test.coach_run, test.username,test.winner_coin FROM 
			(select t.id as tournament_id,jt.user_id,tp.player_id,jt.captain,sum(mp.run) AS run,u.username as username,u.coin,ef.winner_coin,
			(SELECT sum(run) AS run FROM coc_match_points WHERE player_id = jt.captain AND match_id=t.match_id) AS captain_run,
     		if(st.team_id=md.won_team_id,20,0) AS coach_run from coc_tournament as t
			left outer  join coc_joined_tournament as jt on jt.tournament_id=t.id
			left outer join coc_tournament_player as tp on tp.join_id=jt.id
			left outer join coc_match_points as mp on mp.player_id=tp.player_id
			left outer join coc_users as u on u.id=jt.user_id
			left outer join squard_team st on st.coach_id=jt.coach
			left outer join match_details md on md.won_team_id=st.team_id and md.id = t.match_id
			left outer join coc_entry_fee as ef on ef.id=t.entry_fee_id where t.id='".$tid."' and mp.match_id=t.match_id
			group by user_id order by run desc) test order by run DESC";
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
