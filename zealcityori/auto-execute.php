<?php
require('include/config.php');
$tournament = new Tournament();
$count = $tournament->checkTourTimeExceed();
if(count($count) > 0)
{
	$tournament->checkDestroy();
	$tournament->closeTourTimeExceed();
}
$ptournament = new PTournament();
$count = $ptournament->checkTourTimeExceed();
if(count($count) > 0)
{
	$ptournament->checkDestroy();
	$ptournament->closeTourTimeExceed();
}
?>
<html>
<head>
<meta http-equiv="refresh" content="60">
</head>
<body>
	<h1>Auto Refresh page content</h1>
</body>
</html>