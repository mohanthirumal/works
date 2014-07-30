<?php
include '../include/config.php';
$con = mysql_connect(_DB_SERVER_, _DB_USER_, _DB_PASSWD_);
mysql_select_db(_DB_NAME_, $con);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style>
.menu{width:100%; float:left;}
.menu ul li{float:left; list-style:none; margin-right:20px;}
.center-container{margin:0 auto; width:1000px;}
.list tr.head{font-weight:bold;}
</style>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/datetimepicker_css.js"></script>

</head>
<body>
<div class="center-container">
	<div class="menu">
		<ul>
			<li><a href="kitty.php">Kitty</a></li>
			<li><a href="tournament.php">Tournament</a></li>
            <li><a href="period-tournament.php">Period Tournament</a></li>
            <li><a href="points.php">Points</a></li>
            <li><a href="pointupdator.php">Points Updator</a></li>
            <li><a href="calculate_leaderboard.php">Calculate LeaderBoard</a></li>
            <li><a href="deposit.php">Deposit</a></li>
            <li><a href="withdraw.php">Withdraw</a></li>
            <li><a href="users.php">Users</a></li>
			<li><a href="blockuser.php">Block Users</a></li>
		</ul>
	</div>
	<div style="clear:both;"></div>