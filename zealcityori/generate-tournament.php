<?php
require('include/config.php');
require('classes/Db.php');
require('classes/MySQL.php');
require('classes/ObjectModel.php');
require('classes/Tournament.php');
require('classes/PTournament.php');
global $cookie;
$cookie->user_id = 0;
$tournament = new Tournament();
$ptournament = new PTournament();
$allTournaments = $tournament->getAllTournament();
$listTour = array();
$listImgTour = array();
$count = 0;
foreach($allTournaments as $key => $allTournament)
{
	$prizes = explode(',', $allTournament['prize']);
	$tourPrize = array_sum($prizes);
	if($allTournament['amount'] == 0)
	{
		$listTour[$allTournament['match_date']][$allTournament['prize']]['flag1'] = $allTournament['team1flag'];
		$listTour[$allTournament['match_date']][$allTournament['prize']]['flag2'] = $allTournament['team2flag'];
		$listTour[$allTournament['match_date']][$allTournament['prize']]['prize'] = $tourPrize;
		$listTour[$allTournament['match_date']][$allTournament['prize']]['entryfee'] = $allTournament['amount'];
		$listTour[$allTournament['match_date']][$allTournament['prize']]['type'] = $allTournament['prize'];
		$listTour[$allTournament['match_date']][$allTournament['prize']]['tour'][$count] = $allTournament;
		$listTour[$allTournament['match_date']][$allTournament['prize']]['prizetype'] = 'Prize Pool';
	}
	else
	{
		if($allTournament['amount'] > 0 && isset($prizes[1]))
			$imgKey = $tourPrize + 1;
		else
			$imgKey = $allTournament['prize'];
		$listImgTour[$allTournament['match_date']][$imgKey]['flag1'] = $allTournament['team1flag'];
		$listImgTour[$allTournament['match_date']][$imgKey]['flag2'] = $allTournament['team2flag'];
		$listImgTour[$allTournament['match_date']][$imgKey]['prize'] = $tourPrize;
		$listImgTour[$allTournament['match_date']][$imgKey]['entryfee'] = $allTournament['amount'];
		$listImgTour[$allTournament['match_date']][$imgKey]['type'] = $allTournament['prize'];
		$listImgTour[$allTournament['match_date']][$imgKey]['tour'][$count] = $allTournament;
		if($allTournament['amount'] > 0 && isset($prizes[1]))
			$listImgTour[$allTournament['match_date']][$imgKey]['prizetype'] = 'Prize Pool';
		else
			$listImgTour[$allTournament['match_date']][$imgKey]['prizetype'] = 'Win';
	}
	
	$count++;
}
$listTour = array_merge($listTour, $listImgTour);
foreach($listTour as $key => $data)
{
  krsort($data);
  $listTour[$key] = $data;
}
$weeklyTournaments = $ptournament->getWeeklyTournament();
$listPeriodTour = array();
$count = 0;
foreach($weeklyTournaments as $key => $allTournament)
{
	$prizes = explode(',', $allTournament['prize']);
	$tourPrize = array_sum($prizes);
	$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['prize'] = $tourPrize;
	$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['entryfee'] = $allTournament['amount'];
	$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['type'] = $allTournament['tournament_type_id'];
	$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['tour'][$count] = $allTournament;
	if(isset($prizes[1]))
		$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['prizetype'] = 'Prize Pool';
	else
		$listPeriodTour[$allTournament['tournament_type_id']][$allTournament['prize']]['prizetype'] = 'Win';
	$count++;
}
$tournaments['daily'] = $listTour;
$tournaments['period'] = $listPeriodTour;
$fp = fopen(_ROOT_DIR_.'/json/tournaments/tournaments.json', 'w');
fwrite($fp, json_encode($tournaments));
fclose($fp);
?>
<html>
<head>
<meta http-equiv="refresh" content="30">
</head>
<body>
	<h1>Auto Refresh page content</h1>
</body>
</html>