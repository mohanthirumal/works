<?php
function updatePrizes($details, $prizes, $coins)
{
	$prevRun = 0;
	$rank = -1;
	$count = 1;
	$prizeCount = array();
	while(true)
	{
		if(isset($details[$count]['run']) && $details[$count]['run'] == $prevRun)
		{
			$details[$count]['rank'] = $rank;
			$prizeCount[$rank]++;
		}
		else
		{
			$rank++;
			if($rank > (count($prizes) - 1))
				break;
			$details[$count]['rank'] = $rank;
			$prizeCount[$rank] = 0;
		}
		$prevRun = $details[$count]['run'];
		$count++;
	}
	$sql = 'INSERT INTO coc_leaderboard(tournament_id, user_id, prize_money, rank) VALUES ';
	$count = 1;
	$now = date('Y-m-d H:i:s');
	for($i = 0; $i < count($prizes); $i++)
	{
		$prizeMoney = 0;
		for($k = 0; $k <= $prizeCount[$i]; $k++)
			if(isset($prizes[$i + $k]))
				$prizeMoney = $prizeMoney + $prizes[$i + $k];
		
		
		$prizeMoney = (int)$prizeMoney/($prizeCount[$i] + 1);
		for($j = 0; $j <= ($prizeCount[$i]); $j++)
		{
			$sql .= '('.$details[$count]['tournament_id'].', '.$details[$count]['user_id'].', '.$prizeMoney.', '.($i+1).'),';
			$sql1 = 'UPDATE coc_users SET cash = cash + '.$prizeMoney.', coin = coin + '.$coins.' WHERE id = '.$details[$count]['user_id'];
			mysql_query($sql1);
			$sql1 = 'INSERT INTO `coc_transaction_history`(`user_id`, cash, current_cash, reason, timestamp) VALUES
				('.(int)($details[$count]['user_id']).', '.$details[$count]['cash'].', '.$prizeMoney.', \'Prize Money from '.$details[$count]['tname'].'\', \''.$now.'\')';
			mysql_query($sql1);
			$count++;
		}
		$i = $i + $prizeCount[$i];
	}
	$sql = substr($sql, 0, -1);
	mysql_query($sql);
	
}
?>