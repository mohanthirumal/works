<?php
require('include/config.php');
require('classes/Db.php');
require('classes/MySQL.php');
require('classes/ObjectModel.php');
require('classes/Tournament.php');
require('classes/PTournament.php');
require('classes/Matches.php');
$matchs = new Matches();
$match = $matchs->getApprovedLiveMatch();
if(!($match))
	exit;
$liveMatches = new Matches();
$matches = $liveMatches->getLiveMatch();
$livescore = new LiveScore();
$score = new RunCalculator();
foreach($matches as $match)
{
	$return = array();
	$score->type = $match['type'];
	$players = $liveMatches->getMatchPlayerStats($match['id']);
	foreach($players as $key => $player)
	{
		$player['consfour'] = $livescore->getConsFour($match['id'], $player['id']);
		$player['conssix'] = $livescore->getConsSix($match['id'], $player['id']);
		$run = $score->calculate($player);
		$player['coc'] = $run;
		$return[$player['id']] = $player;
	}
	$fp = fopen('json/match'.$match['id'].'.json', 'w');
	fwrite($fp, json_encode($return));
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