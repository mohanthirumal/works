<?php
require('include/config.php');
$liveTournament = new PTournament();
$tournaments = $liveTournament->getLiveTournament();
foreach($tournaments as $tour)
{
	$tour_id = $tour['id'];
	$matchId = $tour['match_id'];
	$tournament = new PTournament($tour_id);
	$match = new Matches($matchId);
	$file = 'json/match'.$match->id.'.json';
	if(!file_exists($file))
		continue;
	$json = file_get_contents($file);
	$matchPlayers = json_decode($json, true);
	$matchPlayersOri = $matchPlayers;
	$livescore = new LiveScore();
	$playerresult = $tournament->getJoinPlayers($match->id);
	$team = new Teams($match->won_team_id);
	$winCoach = $team->getCoach($match->type);
	$user = new User();
	foreach($playerresult as $key => $users)
	{
		$matchPlayers = $matchPlayersOri;
		$userPlayers = $tournament->getUserTourPlayers($tour_id, $match->id, $users['user_id']);
		$myTournament = $tournament->getMyTournament($users['user_id'], $match->id);
		$playerresult[$key]['run'] = 0;
		foreach($userPlayers as $key1 => $player)
		{
			if($player['id'] == $myTournament['captain'])
			{
				if(isset($matchPlayers[$player['id']]))
				{
					$matchPlayers[$player['id']]['coc']['batting'] = $matchPlayers[$player['id']]['coc']['batting'] * 2;
					$matchPlayers[$player['id']]['coc']['battingbonus'] = $matchPlayers[$player['id']]['coc']['battingbonus'] * 2;
					$matchPlayers[$player['id']]['coc']['bowling'] = $matchPlayers[$player['id']]['coc']['bowling'] * 2;
					$matchPlayers[$player['id']]['coc']['fielding'] = $matchPlayers[$player['id']]['coc']['fielding'] * 2;
				}
			}
			if(isset($matchPlayers[$player['id']]))
				$playerresult[$key]['run'] += $matchPlayers[$player['id']]['coc']['batting']+$matchPlayers[$player['id']]['coc']['battingbonus']+$matchPlayers[$player['id']]['coc']['bowling']+$matchPlayers[$player['id']]['coc']['fielding'];
		}
		if($winCoach['coach_id'] == $myTournament['coach'] && $match->won_team_id != 0)
			$playerresult[$key]['run'] += 20;
	}
	
	$fp = fopen('json/tour-'.$match->id.'-'.$tournament->id.'-'.$tournament->tournament_type_id.'.json', 'w');
	fwrite($fp, json_encode($playerresult));
	fclose($fp);
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