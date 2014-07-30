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
	$sql = "INSERT INTO coc_prize_pool(name) VALUES('".$prizepoolname."');";
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
			'".$_REQUEST['txtprizepool']."',
			'".$_REQUEST['rule']."',
			'".$_REQUEST['txtsalarycap']."',
			'".$_REQUEST['recreate']."',
			'".$_REQUEST['status']."'
			);";
	mysql_query($sql);
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