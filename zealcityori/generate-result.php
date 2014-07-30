<?php
require('include/config.php');
$liveTournament = new Tournament();
$tournaments = $liveTournament->getLiveTournament();
foreach($tournaments as $tour):
	$doc = new DOMDocument();
	$doc->formatOutput = true;
	$main = $doc->createElement('results');
	$doc->appendChild($main);
	
	$tour_id = $tour['id'];
	$user = new User();
	$tournament = new Tournament($tour_id);
	$match = new Matches($tournament->match_id);
	$score = new RunCalculator();
	$score->type = $match->type;
	$livescore = new LiveScore();
	$playerresult = $tournament->getJoinPlayers();
	$team = new Teams($match->won_team_id);
	$winCoach = $team->getCoach($match->type);
	foreach($playerresult as $key => $users)
	{
		$userPlayers = $user->getUserTeam($tour_id, $users['user_id']);
		$myTournament = $tournament->getMyTournament($users['user_id']);
		$playerresult[$key]['run'] = 0;
		foreach($userPlayers as $key1 => $player)
		{
			$player['consfour'] = $livescore->getConsFour($match->id, $player['id']);
			$player['conssix'] = $livescore->getConsSix($match->id, $player['id']);
			$run = $score->calculate($player);
			if($player['id'] == $myTournament['captain'])
			{
				$run['batting'] = $run['batting'] * 2;
				$run['battingbonus'] = $run['battingbonus'] * 2;
				$run['bowling'] = $run['bowling'] * 2;
				$run['fielding'] = $run['fielding'] * 2;
			}
			$playerresult[$key]['run'] += $run['batting']+$run['battingbonus']+$run['bowling']+$run['fielding'];
		}
		if($winCoach['coach_id'] == $myTournament['coach'] && $match->won_team_id != 0)
			$playerresult[$key]['run'] += 20;
			
		//XML Generation Goes here	
		$userNode = $doc->createElement('user');	
		$id = $doc->createElement('user_id');
		$connect_id = $doc->createElement('connect_id');
		$teamname = $doc->createElement('teamname');
		$username = $doc->createElement('username');
		$run = $doc->createElement('run');
		$id->appendChild($doc->createTextNode($playerresult[$key]['user_id']));
		$connect_id->appendChild($doc->createTextNode($playerresult[$key]['connect_id']));
		$username->appendChild($doc->createTextNode($playerresult[$key]['username']));
		$teamname->appendChild($doc->createTextNode(strlen($playerresult[$key]['teamname'])>0?$playerresult[$key]['teamname']:'ND'));
		$run->appendChild($doc->createTextNode($playerresult[$key]['run']));
		$userNode->appendChild($id);
		$userNode->appendChild($connect_id);
		$userNode->appendChild($username);
		$userNode->appendChild($teamname);
		$userNode->appendChild($run);
		$main->appendChild($userNode);
	}
	$doc->save('xml/'.$tour_id.'.xml');
endforeach;
?>
<html>
<head>
<meta http-equiv="refresh" content="30">
</head>
<body>
	<h1>Auto Refresh page content</h1>
</body>
</html>