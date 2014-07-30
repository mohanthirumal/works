<?php
include "header.php";
?>
<div id="cl-wrapper" class="fixed-menu">
<?php
include('sidebar.php');

	$sql="select t.name,t.id as tournament_id,t.`status` as status,t1.teamname as team1,t2.teamname as team2 from coc_tournament as t
		inner join match_details mdet on mdet.id=t.match_id
		inner join team_details t1 on t1.id=mdet.team1
		inner join team_details t2 on t2.id=mdet.team2 where t.status='calculated' OR t.status='completed' order by t.id desc";
	$res=mysql_query($sql);
	echo '
		<table id="leaderboard" cellpadding="5px" cellspacing="0" border="1">
			<tr>
				<td>S.no</td>
				<td>Id</td>
				<td>Tournament Name</td>
				<td>Teams</td>
				<td>Status</td>
				<td>Calculator</td>
			</tr>
	';	
	$count=1;
	while($result=mysql_fetch_array($res))
	{
		echo '
			<tr>
				<td>'.$count.'</td>
				<td>'.$result['tournament_id'].'</td>
				<td>'.$result['name'].'</td>
				<td>'.$result['team1'].' Vs '.$result['team2'].' </td>
				<td>'.$result['status'].'</td>
				<td>';
					if($result['status']=='calculated')
					{
						echo '<a href="tournament_result.php?tid='.$result['tournament_id'].'"><input type="button" name="calc" value="Calculate" /></a>';
					}
					else if($result['status']=='Completed')
					{
						echo '<a href="player_rank.php?tid='.$result['tournament_id'].'"><input type="button" name="calc" value="View"/></a>';
					}
			echo '	
				</td>
			</tr>';
		$count++;
	}?>
		</table>
</div>
<?php
include "footer.php";
?>