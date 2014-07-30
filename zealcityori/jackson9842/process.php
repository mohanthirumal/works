<?php
include '../include/config.php';
$con = mysql_connect(_DB_SERVER_, _DB_USER_, _DB_PASSWD_);
mysql_select_db(_DB_NAME_, $con);
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'KITTY')
{
	$percentage = $_REQUEST['txtpercentage'];
	$sql = "INSERT INTO coc_kitty(percentage) VALUES('".$percentage."');";
	mysql_query($sql);
	header('Location: kitty.php');
}
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'KITTYEDIT')
{
	$percentage = $_REQUEST['txtpercentage'];
	$id = $_REQUEST['id'];
	$sql = "UPDATE coc_kitty SET percentage = '".$percentage."' WHERE id = '".$id."'";
	mysql_query($sql);
	header('Location: kitty.php');
}
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'DELETEKITTY')
{
	$id = $_REQUEST['id'];
	$sql = "DELETE FROM coc_kitty WHERE id = ".$id;
	mysql_query($sql);
	header('Location: kitty.php');
}
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'FEE')
{
	$amount = $_REQUEST['txtamount'];
	$sql = "INSERT INTO coc_entry_fee(amount) VALUES('".$amount."');";
	mysql_query($sql);
	header('Location: entryfee.php');
}
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'FEEEDIT')
{
	$amount = $_REQUEST['txtamount'];
	$id = $_REQUEST['id'];
	$sql = "UPDATE coc_entry_fee SET amount = '".$amount."' WHERE id = '".$id."'";
	mysql_query($sql);
	header('Location: entryfee.php');
}
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'DELETEFEE')
{
	$id = $_REQUEST['id'];
	$sql = "DELETE FROM coc_entry_fee WHERE id = ".$id;
	mysql_query($sql);
	header('Location: entryfee.php');
}
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'PLAYER')
{
	$player = $_REQUEST['txtplayer'];
	$sql = "INSERT INTO coc_players(player) VALUES('".$player."');";
	mysql_query($sql);
	header('Location: players.php');
}
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'PLAYEREDIT')
{
	$player = $_REQUEST['txtplayer'];
	$id = $_REQUEST['id'];
	$sql = "UPDATE coc_players SET player = '".$player."' WHERE id = '".$id."'";
	mysql_query($sql);
	header('Location: players.php');
}
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'DELETEPLAYER')
{
	$id = $_REQUEST['id'];
	$sql = "DELETE FROM coc_players WHERE id = ".$id;
	mysql_query($sql);
	header('Location: players.php');
}
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'TOURNTYPE')
{
	$type = $_REQUEST['txttourtype'];
	$sql = "INSERT INTO coc_tournament_type(name) VALUES('".$type."');";
	mysql_query($sql);
	header('Location: tournamenttype.php');
}
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'TOURNTYPEEDIT')
{
	$type = $_REQUEST['txttourtype'];
	$id = $_REQUEST['id'];
	$sql = "UPDATE coc_tournament_type SET name = '".$type."' WHERE id = '".$id."'";
	mysql_query($sql);
	header('Location: tournamenttype.php');
}
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'DELETETOURNTYPE')
{
	$id = $_REQUEST['id'];
	$sql = "DELETE FROM coc_tournament_type WHERE id = ".$id;
	mysql_query($sql);
	header('Location: tournamenttype.php');
}
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'PRIZEPOOL')
{
	$prizepoolname = $_REQUEST['txtprizepool'];
	$prizelist = $_REQUEST['txtprizepoollist'];
	$sql = "INSERT INTO coc_prize_pool(name,prize_amount) VALUES('".$prizepoolname."','".$prizelist."')";
	mysql_query($sql);
	header('Location: prizepool.php');
}
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'PRIZEPOOLEDIT')
{
	$prizepoolname = $_REQUEST['txtprizepool'];
	$id = $_REQUEST['id'];
	$sql = "UPDATE coc_prize_pool SET name = '".$prizepoolname."' WHERE id = '".$id."'";
	mysql_query($sql);
	header('Location: prizepool.php');
}
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'DELETEPRIZEPOOL')
{
	$id = $_REQUEST['id'];
	$sql = "DELETE FROM coc_prize_pool WHERE id = ".$id;
	mysql_query($sql);
	header('Location: prizepool.php');
}
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'TOURNAMENT')
{
	$sql = "INSERT INTO coc_tournament(name, entry_fee_id, tournament_type_id, player_id, match_id, endtime, kitty_id, 
			no_of_changes, prize_id, rule_id, salary_cap, recreate, status) VALUES(
			'".$_REQUEST['txttourname']."',
			'".$_REQUEST['txtentryfee']."',
			'".$_REQUEST['txttourtype']."',
			'".$_REQUEST['txtplayer']."',
			'".$_REQUEST['match']."',
			'".$_REQUEST['txtendtime']."',
			'".$_REQUEST['txtkitty']."',
			'".$_REQUEST['txtchanges']."',
			1,
			'".$_REQUEST['rule']."',
			'".$_REQUEST['txtsalarycap']."',
			'".$_REQUEST['recreate']."',
			'".$_REQUEST['status']."'
			);";
	mysql_query($sql);
	
	$tid = mysql_insert_id();	
	$sql = "INSERT INTO coc_tournament_prize(tournament_id, prize) VALUES(
			'".$tid."',
			'".$_REQUEST['txtprizepool']."'
			)";
	mysql_query($sql);	
	$startDate = '2014-3-';
	$sql = 'INSERT INTO coc_parent_tournament(name, tournament_type_id, user_id, start_date, end_date) VALUES
			(\'test\', \''.$_REQUEST['txttourtype'].'\', 0, )';
	header('Location: tournament.php');
}

if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'TOURNAMENTEDIT')
{
	$id = $_REQUEST['id'];
	$tname = $_REQUEST['txttourname'];
	$efee = $_REQUEST['txtentryfee'];
	$nop =$_REQUEST['txtplayer'];
	$kity =$_REQUEST['txtkitty'];
	$prize =$_REQUEST['txtprizepool'];
	$type =$_REQUEST['txttourtype'];
	$match =$_REQUEST['match'];
	$noofchange =$_REQUEST['txtchanges'];
	$endtime =$_REQUEST['txtendtime'];
	$salcap =$_REQUEST['txtsalarycap'];
	$recreate =$_REQUEST['recreate'];
	$status =$_REQUEST['status'];
	$rule =$_REQUEST['rule'];
	$sql="UPDATE coc_tournament SET name= '".$tname."', entry_fee_id='".$efee."', player_id='".$nop."', kitty_id='".$kity."', prize_id='".$prize."', tournament_type_id='".$type."', match_id='".$match."', no_of_changes='".$noofchange."', endtime='".$endtime."', salary_cap='".$salcap."', recreate='".$recreate."', status='".$status."', rule_id='".$rule."' where id= '".$id."'"; //
	mysql_query($sql);
	if($status == 'Destroyed')
	{
		$userIds = array();
		$sql = 'SELECT * FROM coc_joined_tournament WHERE tournament_id = '.$id;
		$resultResource = mysql_query($sql);
		while($result = mysql_fetch_array($resultResource))
		{
			$userIds[] = $result['user_id'];
		}
		$userId = implode(',', $userIds);
		$sql = 'SELECT amount FROM coc_entry_fee WHERE id = '.$efee;
		$entryFee = mysql_fetch_array(mysql_query($sql));
		$sql = 'UPDATE coc_users SET cash = cash + '.$entryFee['amount'].' WHERE id IN ('.$userId.')';
		mysql_query($sql);
	}
	header('Location: tournament.php');
}

if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'DELETETOURNAMENT')
{
	$id = $_REQUEST['id'];
	$sql = "DELETE FROM coc_tournament WHERE id = ".$id;
	mysql_query($sql);
	header('Location: tournament.php');
}
if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'ODIPOINTEDIT')
{
	$odipoints = $_POST;
	foreach ($odipoints as $key => $value)
	{
		$sql="UPDATE coc_points_system SET run='".$value."' where key='".$key."' and type='ODI'";
		mysql_query($sql);
	}
	header('Location: odi_points.php');
}

if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'TTWENTYEDIT')
{
	$t20points = $_POST;
	foreach ($t20points as $key => $value)
	{
		$sql="UPDATE coc_points_system SET run='".$value."' where key='".$key."' and type='T20'";
		mysql_query($sql);
	}
	header('Location: T20_points.php');
}

if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'TESTPOINTEDIT')
{
	$testpoints = $_POST;
	foreach ($testpoints as $key => $value)
	{
		$sql="UPDATE coc_points_system SET run='".$value."' where key='".$key."' and type='TEST'";
		mysql_query($sql);
	}
	header('Location: test_points.php');
}




if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'PERIODTOURNAMENT')
{
	
	if($_REQUEST['txttourtype'] == 6 )
	{
		$series = $_REQUEST['series-match-list'];
		$endtime = getTourStartTime($series);
		$endDate = date('Y-m-d',getSeriesEndDate($series));
	
		$sql = "INSERT INTO coc_period_tournament(name, user_id, series_id,  entry_fee_id, tournament_type_id, player_id, kitty_id, 
			no_of_changes, prize_id, rule_id, salary_cap, `status`, recreate,  endtime, start_date, end_date) VALUES(
			'".$_REQUEST['txttourname']."',
			0,
			'".$series."',
			'".$_REQUEST['txtentryfee']."',
			'".$_REQUEST['txttourtype']."',
			'".$_REQUEST['txtplayer']."',
			'".$_REQUEST['txtkitty']."',
			'".$_REQUEST['txtchanges']."',
			1,
			'".$_REQUEST['rule']."',
			'".$_REQUEST['txtsalarycap']."',
			1,
			'".$_REQUEST['recreate']."',
			'".date('Y-m-d H:i:s', strtotime('-45 minutes', $endtime))."',
			'".date('Y-m-d')."',
			'".$endDate."'
			);";	
	}
	else
	{
	$id = $_REQUEST['datelist'];
	$dates = getWeeksDate($id);
	$date = explode('-', $dates);		
			
	$sql = "INSERT INTO coc_period_tournament(name, user_id, series_id,  entry_fee_id, tournament_type_id, player_id, kitty_id, 
			no_of_changes, prize_id, rule_id, salary_cap, `status`, recreate,  endtime, start_date, end_date) VALUES(
			'".$_REQUEST['txttourname']."',
			0,
			0,
			'".$_REQUEST['txtentryfee']."',
			'".$_REQUEST['txttourtype']."',
			'".$_REQUEST['txtplayer']."',			
			'".$_REQUEST['txtkitty']."',
			'".$_REQUEST['txtchanges']."',
			1,
			'".$_REQUEST['rule']."',
			'".$_REQUEST['txtsalarycap']."',
			1,
			'".$_REQUEST['recreate']."',
			'".$_REQUEST['txtendtime']."',
			'".date('Y-m-d',strtotime($date[0]))."',
			'".date('Y-m-d',strtotime($date[1]))."'
			);";
	}
	mysql_query($sql);
	
	$ptId = mysql_insert_id();
	
	$sql = "INSERT INTO coc_pt_prize(pt_id, prize) VALUES(
			'".$ptId."',
			'".$_REQUEST['txtprizepool']."'	
			)";
	mysql_query($sql);
	if($_REQUEST['txttourtype'] == 6 )
	{
		$matches = getMatchFromDate(date('Y-m-d'), $endDate);
		$sql = "INSERT INTO coc_pt_matches(pt_id, match_id, `status`) VALUES ";
		foreach($matches as $match)
		{
			$sql .= "('".$ptId."', '".$match['id']."', 4),";
		}
		$sql = substr($sql, 0, -1);
		mysql_query($sql);
	}
	else
	{
		$matches = getMatchFromDate($date[0], $date[1]);
		
		$sql = "INSERT INTO coc_pt_matches(pt_id, match_id, `status`) VALUES ";
		foreach($matches as $match)
		{
			$sql .= "('".$ptId."', '".$match['id']."', 4),";
		}
		$sql = substr($sql, 0, -1);
		mysql_query($sql);	
	}
	
	$startDate = '2014-3-';
	$sql = 'INSERT INTO coc_parent_tournament(name, tournament_type_id, user_id, start_date, end_date) VALUES
			(\'test\', \''.$_REQUEST['txttourtype'].'\', 0, )';
	header('Location: period-tournament.php');
}


if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'PERIODTOURNAMENTEDIT')
{
	$id = $_REQUEST['id'];
	$tname = $_REQUEST['txttourname'];
	$efee = $_REQUEST['txtentryfee'];
	$nop =$_REQUEST['txtplayer'];
	$kity =$_REQUEST['txtkitty'];
	$prize =$_REQUEST['txtprizepool'];
	$type =$_REQUEST['txttourtype'];
	$noofchange =$_REQUEST['txtchanges'];
	$endtime =$_REQUEST['txtendtime'];
	$salcap =$_REQUEST['txtsalarycap'];
	$recreate =$_REQUEST['recreate'];
	$status =$_REQUEST['status'];
	$rule =$_REQUEST['rule'];
	if($type == 6)
	{
		$sql="UPDATE coc_period_tournament SET name= '".$tname."', entry_fee_id='".$efee."', player_id='".$nop."', kitty_id='".$kity."', no_of_changes='".$noofchange."', salary_cap='".$salcap."', recreate='".$recreate."', status='".$status."', rule_id='".$rule."' where id= '".$id."'"; //
	}
	else
	{
		$sql="UPDATE coc_period_tournament SET name= '".$tname."', entry_fee_id='".$efee."', player_id='".$nop."', kitty_id='".$kity."', no_of_changes='".$noofchange."', endtime='".$endtime."', salary_cap='".$salcap."', recreate='".$recreate."', status='".$status."', rule_id='".$rule."' where id= '".$id."'";
	}
	mysql_query($sql);
	
	$sql = "UPDATE coc_pt_prize SET prize = '".$prize."' where pt_id= ".$id."";
	mysql_query($sql);
	
	if($status == 'Destroyed')
	{
		$userIds = array();
		$sql = 'SELECT * FROM coc_joined_tournament WHERE tournament_id = '.$id;
		$resultResource = mysql_query($sql);
		while($result = mysql_fetch_array($resultResource))
		{
			$userIds[] = $result['user_id'];
		}
		$userId = implode(',', $userIds);
		$sql = 'SELECT amount FROM coc_entry_fee WHERE id = '.$efee;
		$entryFee = mysql_fetch_array(mysql_query($sql));
		$sql = 'UPDATE coc_users SET cash = cash + '.$entryFee['amount'].' WHERE id IN ('.$userId.')';
		mysql_query($sql);
	}
	header('Location: period-tournament.php');
}

if(isset($_REQUEST['action']) && strlen($_REQUEST['action']) && strtoupper($_REQUEST['action']) == 'DELETETOURNAMENT')
{
	$id = $_REQUEST['id'];
	$sql = "DELETE FROM coc_tournament WHERE id = ".$id;
	mysql_query($sql);
	header('Location: period-tournament.php');
}



function getWeeksDate($week)
{
	$weeks = getWeeks(5, 'Y/m/d');
	return $weeks[$week];
}

function getWeeks($count, $format = 'F jS, Y')
{
	$timestamp = strtotime('now');
	$weeks = array();
	$weekCount = 1;
	if(date('D', $timestamp) !== 'Sun')
	{
		$weeks[$weekCount] = date($format, $timestamp).' - '.date($format, strtotime('next Sunday'));
		$weekCount++;
	}
	$weeks[$weekCount] = date($format, strtotime('next Monday')).' - '.date($format, strtotime('Sunday +1 week'));
	for($i = 1;$weekCount < $count;$i++)
	{
		$weekCount++;
		$weeks[$weekCount] = date($format, strtotime('Monday +'.$i.' week')).' - '.date($format, strtotime('Sunday +'.($i+1).' week'));
	}
	return $weeks;
}

function getMatchFromDate($from, $to)
{
	$sql = 'SELECT md.type,md.match_date,t1.flag_url AS t1flag, t2.flag_url AS t2flag, t1.teamname AS t1name, t2.teamname AS t2name, 
			t1.team_nickname AS team1, t2.team_nickname AS team2, md.id AS id FROM match_details md
			INNER JOIN team_details t1 ON t1.id = md.team1
			INNER JOIN team_details t2 ON t2.id = md.team2
			INNER JOIN venue_details v ON v.id = md.venue_id 
			WHERE match_date > '.strtotime($from).' AND match_date < '.strtotime($to.'+23hours +59minutes');
	
	$result = mysql_query($sql);
	while($resSet=mysql_fetch_array($result))
	{
		$getTeam[] = $resSet;
	}
	return $getTeam;
}

function getTourStartTime($id)
{
	$now = strtotime(date('Y-m-d H:i:s'));
	$sql = 'SELECT * FROM match_details WHERE tour_id = '.$id.' AND match_date > '.$now.' LIMIT 1';
	$result = mysql_query($sql);
	while($res = mysql_fetch_array($result))
	{
		$resdate[] = $res;	
	}
	return $resdate[0]['match_date'];
}
	
function getSeriesEndDate($id)
{
	$sql = 'SELECT end_date FROM tournament_details WHERE id = '.$id;
	$result = mysql_query($sql);
	while($res = mysql_fetch_array($result))
	{
		$resdate[] = $res;	
	}
	return $resdate[0]['end_date'];
}
