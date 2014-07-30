<?php
function updatePrizes($details, $prizes, $coins)
{
	$prevRun = 0;
	$rank = 0;
	$count = 1;
	$prizeCount = array();
	while($rank <= count($prizes))
	{
		if($details[$count]['run'] == $prevRun)
		{
			$details[$count]['rank'] = $rank;
			$prizeCount[$rank]++;
		}
		else
		{
			$rank++;
			$details[$count]['rank'] = $rank;
			$prizeCount[$rank] = 1;
		}
		$prevRun = $details[$count]['run'];
		$count++;
	}
	$sql = 'INSERT INTO coc_leaderboard(tournament_id, user_id, prize_money, rank) VALUES ';
	$count = 1;
	for($i = 1; $i <= count($prizes); $i++)
	{
		$prizeMoney = (int)$prizes[$i]/count($prizeCount[$i]);
		for($j = 1; $j <= count($prizeCount[$i]); $j++)
		{
			$sql .= '('.$details[$count]['tournament_id'].', '.$details[$count]['user_id'].', '.$prizeMoney.', '.$i.'),';
			$sql1 = 'UPDATE coc_users SET cash = cash + '.$prizeMoney.', coin = coin + '.$coins.' WHERE id = '.$details[$count]['user_id'];
			//mysql_query($sql1);
			$count++;
		}
	}
	$sql = substr($sql, 0, -1);echo $sql;
	//mysql_query($sql);
	
}
?>