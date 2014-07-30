<?php
include "header.php";
include "classes/pagination.php";
?>
	<form action="users-log.php" style="margin-top:30px;">
    	<input type="text" name="filtername" id="txtname"/>
        <input type="submit" name="filtersubmit" value="Submit"/>
        <a href="users-log.php"><input type="button" value="Cancel" /></a>
        <input type="hidden" name="action" value="filter" />
    </form>


<?php
$filter = '';
	$statement = "`coc_users_log` WHERE 1=1 ";
	if(isset($_REQUEST['action']) && strlen(trim($_REQUEST['action'])) > 0 && strtoupper(trim($_REQUEST['action'])) == 'FILTER')
	{
		if(strlen($_REQUEST['filtername'])>0)
		{
			$filter .= 'AND `username` LIKE "%'.$_REQUEST['filtername'].'%" ';
			$statement .= 'AND `username` LIKE "%'.$_REQUEST['filtername'].'%" ';
		}
	}
	
	$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
	$limit = 2;
	$startpoint = ($page * $limit) - $limit;

	$sql = 'SELECT  * FROM `coc_users_log` WHERE 1=1 
                      '.$filter.' ORDER BY `timestamp` DESC LIMIT '.$startpoint.' , '.$limit.';';
	
	$res = mysql_query($sql);
	
	echo '<table border="1" cellpadding="5px" cellspacing="0" align="center" >
			<tr>
				<td>USER ID</td>
				<td>USERNAME</td>
				<td>FIRSTNAME</td>
				<td>LASTNAME</td>
				<td>DOB</td>
				<td>SEX</td>
				<td>COUNTRY</td>
				<td>STATE</td>
				<td>CITY</td>
				<td>ADDRESS</td>
				<td>PINCODE</td>
				<td>EMAIL</td>			
				<td>CASH</td>
				<td>COIN</td>
				<td>IP ADDRESS</td>
				<td>TIMESTAMP</td>
			</tr>
			';
	while($result = mysql_fetch_array($res))
	{
		echo'<tr>
			<td>'.$result['user_id'].'</td>
			<td>'.$result['username'].'</td>
			<td>'.$result['firstname'].'</td>
			<td>'.$result['lastname'].'</td>
			<td>'.$result['dob'].'</td>
			<td>'.$result['sex'].'</td>
			<td>'.$result['country'].'</td>
			<td>'.$result['state'].'</td>
			<td>'.$result['city'].'</td>
			<td>'.$result['address'].'</td>
			<td>'.$result['pincode'].'</td>
			<td>'.$result['email'].'</td>
			<td>'.$result['cash'].'</td>
			<td>'.$result['coin'].'</td>
			<td>'.$result['ip'].'</td>
			<td>'.$result['timestamp'].'</td>	
		</tr>
		';	
	}
	echo '</table>';
	      
	$urlString = $_SERVER['QUERY_STRING'];
	if(substr_count($urlString, '&page=') > 0)
	$urlString = substr($urlString, 0, (strpos($urlString, '&page=')));
	echo pagination($statement, $limit, $page, '?'.$urlString.'&');
?>

<style>
	ul.pagination{margin:20px 0 0 0; padding:0; list-style:none; float:right;}
	ul.pagination li{float:left; margin:0 10px 0 0;}
	ul.pagination li a{float:left;}
</style>